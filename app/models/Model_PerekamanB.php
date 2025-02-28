<?php
class Model_PerekamanB
{
    private $table = 'barang';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPerekaman()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getAllRekamStok($tanggal, $jamP, $jamKP) //baru
    {
        $query = "  SELECT 
                        b.kodeB, 
                        b.namaB, 
                        (b.stock - COALESCE(SUM(
                            CASE WHEN (pb.jamP_barang >= :jamP 
                                        AND pb.jamKP_barang <= :jamKP) 
                                        AND pb.tanggalP_barang = :tanggal 
                                        AND dpb.statusP_barang = 'ACC' 
                                        THEN dpb.jmlh ELSE 0 END), 0)) AS remaining_stock 
                        FROM barang AS b 
                        LEFT JOIN detail_pinjam_barang AS dpb ON dpb.kodeB = b.kodeB 
                        LEFT JOIN pinjam_barang AS pb ON pb.kodeP_barang = dpb.kodeP_barang 
                        GROUP BY b.kodeB
                        HAVING remaining_stock > 0;
        ";

        $this->db->query($query);
        $this->db->bind(':tanggal', $tanggal);
        $this->db->bind(':jamP', $jamP);
        $this->db->bind(':jamKP', $jamKP);
        return $this->db->resultSet();
    }

    public function getPerekamanByKodeB($kodeB)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kodeB=:kodeB');
        $this->db->bind('kodeB', $kodeB);
        return $this->db->single();
    }

    public function tambahDataB($data, $Foto)
    {
        // Validasi apakah kode barang sudah ada
        $queryCekKode = "SELECT kodeB FROM $this->table WHERE kodeB = :kodeB";
        $this->db->query($queryCekKode);
        $this->db->bind('kodeB', $data['kodeB']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Kode barang sudah ada, berikan notifikasi atau handling sesuai kebutuhan
            return 0; // 0 menandakan kode barang sudah ada    

        }

        // Lanjutkan proses tambah data jika kode barang belum ada
        $queryTambahData = "INSERT INTO $this->table (kodeB, namaB, foto, keterangan, stock) VALUES (:kodeB, :namaB, :foto, :keterangan, :stock)";

        $this->db->query($queryTambahData);
        $this->db->bind('kodeB', $data['kodeB']);
        $this->db->bind('namaB', $data['namaB']);
        $this->db->bind('foto', $Foto); // Simpan nama file foto
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('stock', $data['stock']);

        $this->db->execute();
        return $this->db->rowCount(); // Jumlah baris yang berhasil ditambahkan
    }


    public function hapusDataB($kodeB)
    {
        $query = "DELETE FROM barang WHERE kodeB=:kodeB";
        $this->db->query($query);
        $this->db->bind('kodeB', $kodeB);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataB()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM barang WHERE namaB LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
    // Fungsi untuk mengunggah foto
    public function unggahFoto()
    {
        $Foto = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        $tujuan = 'foto/' . $Foto;

        if (move_uploaded_file($tmpName, $tujuan)) {
            // Jika berhasil diunggah, kembalikan nama file asli
            return $Foto;
        } else {
            // Jika gagal diunggah, Anda dapat menangani kesalahan di sini
            return false;
        }
    }

    public function ubahDataB($data)
    {
        // Ambil data nama dan kode ruang yang diubah
        $namaB = $data['namaB'];
        $kodeB = $data['kodeB'];

        // Ambil data foto lama
        $query = "SELECT foto FROM barang WHERE kodeB = :kodeB";
        $this->db->query($query);
        $this->db->bind('kodeB', $kodeB);
        $this->db->execute();
        $fotoLama = $this->db->single()['foto'];

        // Proses unggah foto baru
        if (!empty($_FILES['foto']['name'])) {
            // Hapus foto lama jika ada
            if (!empty($fotoLama)) {
                unlink('foto/' . $fotoLama);
            }
            // Menggunakan fungsi unggahFoto() yang sudah ada
            $fotoBaru = $this->unggahFoto(); // Perubahan di sini
            // Periksa apakah foto berhasil diunggah
            if (!$fotoBaru) {
                die('Foto gagal diunggah.');
            }
        } else {
            $fotoBaru = $fotoLama; // Gunakan foto lama jika tidak ada foto yang diunggah
        }

        $keterangan = $data['keterangan'];
        $stock = $data['stock'];

        // Update data termasuk foto baru
        $query = "UPDATE barang SET namaB = :namaB, foto = :foto, keterangan = :keterangan, stock = :stock WHERE kodeB = :kodeB";
        $this->db->query($query);
        $this->db->bind('kodeB', $kodeB);
        $this->db->bind('namaB', $namaB);
        $this->db->bind('foto', $fotoBaru);
        $this->db->bind('keterangan', $keterangan);
        $this->db->bind('stock', $stock);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
