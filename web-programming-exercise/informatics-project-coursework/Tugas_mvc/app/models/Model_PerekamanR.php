<?php
class Model_PerekamanR
{
    private $table = 'ruang';
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
                        b.kodeR, 
                        b.namaR, 
                        (b.stock - COALESCE(SUM(
                            CASE WHEN (pb.jamP_ruang >= :jamP
                                        AND pb.jamKP_ruang <= :jamKP) 
                                        AND pb.tanggalP_ruang = :tanggal 
                                        AND dpb.statusP_ruang = 'ACC' 
                                        THEN dpb.jmlh ELSE 0 END), 0)) AS remaining_stock 
                        FROM ruang AS b 
                        LEFT JOIN detail_pinjam_ruang AS dpb ON dpb.kodeR = b.kodeR
                        LEFT JOIN pinjam_ruang AS pb ON pb.kodeP_ruang = dpb.kodeP_ruang 
                        GROUP BY b.kodeR
                        HAVING remaining_stock > 0;
        ";

        $this->db->query($query);
        $this->db->bind(':tanggal', $tanggal);
        $this->db->bind(':jamP', $jamP);
        $this->db->bind(':jamKP', $jamKP);
        return $this->db->resultSet();
    }

    public function getPerekamanByKodeR($kodeR)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kodeR=:kodeR');
        $this->db->bind('kodeR', $kodeR);
        return $this->db->single();
    }

    public function tambahDataR($data, $Foto)
    {
        // Validasi apakah kode barang sudah ada
        $queryCekKode = "SELECT kodeR FROM $this->table WHERE kodeR = :kodeR";
        $this->db->query($queryCekKode);
        $this->db->bind('kodeR', $data['kodeR']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Kode barang sudah ada, berikan notifikasi atau handling sesuai kebutuhan
            return 0; // 0 menandakan kode barang sudah ada    

        }

        // Lanjutkan proses tambah data jika kode barang belum ada
        $query = "INSERT INTO $this->table (kodeR, namaR, foto, keterangan, stock) VALUES (:kodeR, :namaR, :foto, :keterangan, :stock)";

        $this->db->query($query);
        $this->db->bind('kodeR', $data['kodeR']);
        $this->db->bind('namaR', $data['namaR']);
        $this->db->bind('foto', $Foto); // Simpan nama file foto
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('stock', $data['stock']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataR($kodeR)
    {
        $query = "DELETE FROM ruang WHERE kodeR=:kodeR";
        $this->db->query($query);
        $this->db->bind('kodeR', $kodeR);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariDataR()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM ruang WHERE namaR LIKE :keyword";
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

    public function ubahDataR($data)
    {
        // Ambil data nama dan kode ruang yang diubah
        $namaR = $data['namaR'];
        $kodeR = $data['kodeR'];

        // Ambil data foto lama
        $query = "SELECT foto FROM ruang WHERE kodeR = :kodeR";
        $this->db->query($query);
        $this->db->bind('kodeR', $kodeR);
        $fotoLama = $this->db->single()['foto'];

        // Proses unggah foto baru
        if (!empty($_FILES['foto']['name'])) {
            // Hapus foto lama jika ada
            if (!empty($fotoLama)) {
                unlink('public/foto/' . $fotoLama);
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
        $query = "UPDATE ruang SET namaR = :namaR, foto = :foto, keterangan = :keterangan, stock = :stock WHERE kodeR = :kodeR"; // Perbaikan di sini
        $this->db->query($query);
        $this->db->bind('kodeR', $kodeR);
        $this->db->bind('namaR', $namaR); // Perbaikan di sini
        $this->db->bind('foto', $fotoBaru);
        $this->db->bind('keterangan', $keterangan);
        $this->db->bind('stock', $stock);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
?>