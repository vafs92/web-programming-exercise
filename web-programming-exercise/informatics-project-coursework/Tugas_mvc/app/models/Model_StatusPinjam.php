<?php
class Model_StatusPinjam
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPinjamB()
    {
        $this->db->query('SELECT 
        pb.surat, 
        dpb.kodeP_barang, 
        m.namaP, 
        m.no_WA, 
        dpb.kodeB, 
        pb.nim, 
        pb.jamP_barang, 
        pb.jamKP_barang, 
        pb.tanggalP_barang, 
        b.namaB, 
        dpb.id_Sekre, 
        dpb.id_Biro, 
        dpb.statusP_barang 
        FROM 
            detail_pinjam_barang AS dpb 
        JOIN 
            pinjam_barang AS pb ON dpb.kodeP_barang = pb.kodeP_barang 
        JOIN 
            mahasiswa AS m ON m.id = pb.nim
        JOIN 
            barang AS b ON dpb.kodeB = b.kodeB
        GROUP BY 
            dpb.kodeP_barang 
        ORDER BY 
            pb.tanggalP_barang ASC;
        ');
        return $this->db->resultSet();
    }

    public function getAllPinjamR()
    {
        $this->db->query('SELECT 
        pb.surat, 
        dpb.kodeP_ruang, 
        m.namaP, 
        m.no_WA, 
        dpb.kodeR, 
        pb.nim, 
        pb.jamP_ruang, 
        pb.jamKP_ruang, 
        pb.tanggalP_ruang, 
        b.namaR, 
        dpb.id_Sekre, 
        dpb.id_Biro, 
        dpb.statusP_ruang 
        FROM 
            detail_pinjam_ruang AS dpb 
        JOIN 
            pinjam_ruang AS pb ON dpb.kodeP_ruang = pb.kodeP_ruang 
        JOIN 
            mahasiswa AS m ON m.id = pb.nim
        JOIN 
            ruang AS b ON dpb.kodeR = b.kodeR
        GROUP BY 
            dpb.kodeP_ruang 
        ORDER BY 
            pb.tanggalP_ruang ASC;
        ');
        return $this->db->resultSet();
    }

    public function getAllPinjamBbyId($kodeP) //diubah
    {
        $this->db->query('SELECT dpb.kodeP_barang, dpb.kodeB, b.namaB, dpb.jmlh, s.nama_Sekre, br.nama_Biro, dpb.statusP_barang, dpb.ketB
        FROM detail_pinjam_barang AS dpb
        JOIN barang AS b ON dpb.kodeB = b.kodeB
        JOIN biro AS br ON dpb.id_Biro = br.id
        JOIN sekre AS s ON dpb.id_Sekre = s.id
        WHERE dpb.kodeP_barang = :kodeP');

        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function getAllPinjamRbyId($kodeP)
    {
        $this->db->query('SELECT dpb.kodeP_ruang, dpb.kodeR, b.namaR, s.nama_Sekre, br.nama_Biro, dpb.statusP_ruang, dpb.ketR
        FROM detail_pinjam_ruang AS dpb
        JOIN ruang AS b ON dpb.kodeR = b.kodeR
        JOIN biro AS br ON dpb.id_Biro = br.id
        JOIN sekre AS s ON dpb.id_Sekre = s.id
        WHERE dpb.kodeP_ruang = :kodeP');

        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }


    public function tambahProfilPeminjamB($data, $Surat)
    {
        $query = "INSERT INTO pinjam_barang (kodeP_barang, nim, tanggalP_barang, jamP_barang, jamKP_barang, surat) VALUES (:kodeP, :nimP, :tanggalP, :jamP, :jamKP, :surat)";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':nimP', $data['id_peminjam']);
        $this->db->bind(':tanggalP', $data['tanggal_P']);
        $this->db->bind(':jamP', $data['jam_P']);
        $this->db->bind(':jamKP', $data['jam_KP']);
        $this->db->bind(':surat', $Surat);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahProfilPeminjamR($data, $Surat)
    {
        $query = "INSERT INTO pinjam_ruang (kodeP_ruang, nim, tanggalP_ruang, jamP_ruang, jamKP_ruang, surat) VALUES (:kodeP, :nimP, :tanggalP, :jamP, :jamKP, :surat)";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':nimP', $data['id_peminjam']);
        $this->db->bind(':tanggalP', $data['tanggal_P']);
        $this->db->bind(':jamP', $data['jam_P']);
        $this->db->bind(':jamKP', $data['jam_KP']);
        $this->db->bind(':surat', $Surat);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cekKodePinjamR($nim, $nomor)
    {
        $query = "SELECT * FROM pinjam_ruang WHERE nim = :nim AND kodeP_ruang = CONCAT('PR', :nomor)";
        $this->db->query($query);
        $this->db->bind(':nim', $nim);
        $this->db->bind(':nomor', $nomor);
        $this->db->execute();
        return $this->db->single();
    }

    public function cekKodePinjamB($nim, $nomor)
    {
        $query = "SELECT * FROM pinjam_barang WHERE nim = :nim AND kodeP_barang = CONCAT('PB', :nomor)";
        $this->db->query($query);
        $this->db->bind(':nim', $nim);
        $this->db->bind(':nomor', $nomor);
        $this->db->execute();
        return $this->db->single();
    }

    public function getEnumValuesB($columnName)
    { //model baru
        $query = "SHOW COLUMNS FROM pinjam_barang LIKE '$columnName'";
        $this->db->query($query);
        $this->db->execute();
        $result = $this->db->resultSet();  // Use resultSet() to fetch data

        if (count($result) > 0) {
            $row = reset($result);  // Get the first row
            preg_match_all("/'([^']+)'/", $row['Type'], $matches);
            return $matches[1];
        } else {
            return [];
        }
    }

    public function getEnumValuesR($columnName)
    { //model baru
        $query = "SHOW COLUMNS FROM pinjam_ruang LIKE '$columnName'";
        $this->db->query($query);
        $this->db->execute();
        $result = $this->db->resultSet();  // Use resultSet() to fetch data

        if (count($result) > 0) {
            $row = reset($result);  // Get the first row
            preg_match_all("/'([^']+)'/", $row['Type'], $matches);
            return $matches[1];
        } else {
            return [];
        }
    }

    public function unggahSurat()
    {
        // Check if the 'surat' key exists in the $_FILES array
        if (isset($_FILES['surat']) && isset($_FILES['surat']['name'])) {
            $Surat = $_FILES['surat']['name'];
            var_dump($Surat);
            $tmpName = $_FILES['surat']['tmp_name'];

            $tujuan = 'surat/' . $Surat;

            if (move_uploaded_file($tmpName, $tujuan)) {
                // Jika berhasil diunggah, kembalikan nama file asli
                return $Surat;
            } else {
                // Jika gagal diunggah, Anda dapat menangani kesalahan di sini
                return false;
            }
        } else {
            // Handle the case where 'surat' key is not set in $_FILES
            return false;
        }
    }

    public function getLastId($table)
    { //diubah
        $query = "SELECT COUNT(*) as max_id FROM $table";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->single();
    }

    public function tambahDataPinjamB($data) //diubah dan ditambah
    {
        $query = "INSERT INTO detail_pinjam_barang (kodeP_barang, kodeB, id_Sekre, id_Biro, jmlh, statusP_barang) VALUES (:kodeP, :kodeB, '-', '-', :jmlh, 'DIKIRIM')";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':kodeB', $data['kodeB']);
        $this->db->bind(':jmlh', $data['jmlh']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataPinjamR($data)
    {
        $query = "INSERT INTO detail_pinjam_ruang (kodeP_ruang, kodeR, id_Sekre, id_Biro, jmlh, statusP_ruang) VALUES (:kodeP, :kodeR, '-', '-', '1', 'DIKIRIM')";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':kodeR', $data['kodeR']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataBerhasilB($kodeP) //diubah dan ditambah
    {
        $query = "SELECT pb.jamP_barang, dpb.kodeP_barang, dpb.kodeB, b.namaB, dpb.statusP_barang, dpb.jmlh
        FROM pinjam_barang AS pb
        JOIN detail_pinjam_barang AS dpb ON pb.kodeP_barang = dpb.kodeP_barang
        JOIN barang AS b ON dpb.kodeB = b.kodeB
        WHERE dpb.kodeP_barang = :kodeP";
        $this->db->query($query);
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }


    public function getDataBerhasilR($kodeP)
    {
        $query = "SELECT dpr.kodeP_ruang, dpr.kodeR, r.namaR, dpr.statusP_ruang
        FROM pinjam_ruang AS pr
        JOIN detail_pinjam_ruang AS dpr ON pr.kodeP_ruang = dpr.kodeP_ruang
        JOIN ruang AS r ON dpr.kodeR = r.kodeR
        WHERE dpr.kodeP_ruang = :kodeP";
        $this->db->query($query);
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }


    public function hapusDataB($kodeP, $kodeB)
    {
        $query = "DELETE FROM detail_pinjam_barang
                  WHERE kodeP_barang = :kodeP_barang AND kodeB = :kodeB";

        $this->db->query($query);
        $this->db->bind('kodeP_barang', $kodeP);
        $this->db->bind('kodeB', $kodeB);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataR($kodeP, $kodeR)
    {
        $query = "DELETE FROM detail_pinjam_ruang
                  WHERE kodeP_ruang = :kodeP_ruang AND kodeR = :kodeR";

        $this->db->query($query);
        $this->db->bind('kodeP_ruang', $kodeP);
        $this->db->bind('kodeR', $kodeR);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function getAllPinjamRkirim()
    {
        $this->db->query('SELECT 
        pb.surat, 
        dpb.kodeP_ruang, 
        m.namaP, 
        m.no_WA, 
        dpb.kodeR, 
        pb.nim, 
        pb.jamP_ruang, 
        pb.jamKP_ruang, 
        pb.tanggalP_ruang, 
        b.namaR, 
        dpb.id_Sekre, 
        dpb.id_Biro, 
        dpb.statusP_ruang 
        FROM 
            detail_pinjam_ruang AS dpb 
        JOIN 
            pinjam_ruang AS pb ON dpb.kodeP_ruang = pb.kodeP_ruang 
        JOIN 
            mahasiswa AS m ON m.id = pb.nim
        JOIN 
            ruang AS b ON dpb.kodeR = b.kodeR
        WHERE dpb.statusP_ruang="DIKIRIM" GROUP BY dpb.kodeP_ruang ORDER BY pb.tanggalP_ruang ASC;
        ');
        return $this->db->resultSet();
    }


    public function getAllPinjamBkirim()
    {
        $this->db->query('SELECT 
        pb.surat, 
        dpb.kodeP_barang, 
        m.namaP, 
        m.no_WA, 
        dpb.kodeB, 
        pb.nim, 
        pb.jamP_barang, 
        pb.jamKP_barang, 
        pb.tanggalP_barang, 
        b.namaB, 
        dpb.id_Sekre, 
        dpb.id_Biro, 
        dpb.statusP_barang 
        FROM 
            detail_pinjam_barang AS dpb 
        JOIN 
            pinjam_barang AS pb ON dpb.kodeP_barang = pb.kodeP_barang 
        JOIN 
            mahasiswa AS m ON m.id = pb.nim
        JOIN 
            barang AS b ON dpb.kodeB = b.kodeB
        WHERE dpb.statusP_barang="DIKIRIM" GROUP BY dpb.kodeP_barang ORDER BY pb.tanggalP_barang ASC;');
        return $this->db->resultSet();
    }


    // WHERE dpb.statusP_barang="DIKIRIM" GROUP BY dpb.kodeP_barang ORDER BY pb.tanggalP_barang ASC;


    public function getAllVerifR($kodeP)
    {
        $this->db->query('SELECT dpb.ketR, dpb.kodeP_ruang, dpb.jmlh, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang FROM detail_pinjam_ruang AS dpb NATURAL JOIN ruang AS b NATURAL JOIN pinjam_ruang AS pb WHERE dpb.kodeP_ruang = :kodeP AND dpb.statusP_ruang="DIKIRIM";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function getAllVerifB($kodeP) //diubah
    {
        $this->db->query('SELECT dpb.ketB, dpb.kodeP_barang, dpb.jmlh, dpb.jmlh, dpb.kodeB, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang FROM detail_pinjam_barang AS dpb NATURAL JOIN barang AS b NATURAL JOIN pinjam_barang AS pb WHERE dpb.kodeP_barang = :kodeP AND dpb.statusP_barang="DIKIRIM";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }


    public function getAllPinjamBterus()
    {
        $this->db->query('SELECT 
        pb.surat, 
        dpb.kodeP_barang, 
        m.namaP, 
        m.no_WA, 
        dpb.kodeB, 
        pb.nim, 
        pb.jamP_barang, 
        pb.jamKP_barang, 
        pb.tanggalP_barang, 
        b.namaB, 
        dpb.id_Sekre, 
        dpb.id_Biro, 
        dpb.statusP_barang 
        FROM 
            detail_pinjam_barang AS dpb 
        JOIN 
            pinjam_barang AS pb ON dpb.kodeP_barang = pb.kodeP_barang 
        JOIN 
            mahasiswa AS m ON m.id = pb.nim
        JOIN 
            barang AS b ON dpb.kodeB = b.kodeB
        WHERE dpb.statusP_barang="DITERUSKAN" 
        GROUP BY kodeP_barang 
        ORDER BY pb.tanggalP_barang ASC;');
        return $this->db->resultSet();
    }

    public function getAllPinjamRterus()
    {
        $this->db->query('SELECT 
        pb.surat, 
        dpb.kodeP_ruang, 
        m.namaP, 
        m.no_WA, 
        dpb.kodeR, 
        pb.nim, 
        pb.jamP_ruang, 
        pb.jamKP_ruang, 
        pb.tanggalP_ruang, 
        b.namaR, 
        dpb.id_Sekre, 
        dpb.id_Biro, 
        dpb.statusP_ruang 
        FROM 
            detail_pinjam_ruang AS dpb 
        JOIN 
            pinjam_ruang AS pb ON dpb.kodeP_ruang = pb.kodeP_ruang 
        JOIN 
            mahasiswa AS m ON m.id = pb.nim
        JOIN 
            ruang AS b ON dpb.kodeR = b.kodeR
        WHERE dpb.statusP_ruang="DITERUSKAN" 
        GROUP BY kodeP_ruang
        ORDER BY pb.tanggalP_ruang ASC;');
        return $this->db->resultSet();
    }
    

    public function getStokKonfirmB($kodeP, $jamP, $jamKP, $tglP)
    {
        $query = "SELECT *
        FROM (
            SELECT 
                dpb.ketB, dpb.kodeP_barang, dpb.jmlh, dpb.kodeB, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang,
                (b.stock - COALESCE(SUM(
                    CASE WHEN (pb.jamP_barang >= :jamP
                                AND pb.jamKP_barang <= :jamKP) 
                                AND pb.tanggalP_barang = :tglP
                                AND dpb.statusP_barang = 'ACC' 
                                THEN dpb.jmlh ELSE 0 END), 0)) AS remaining_stock 
            FROM 
                barang AS b 
            LEFT JOIN 
                detail_pinjam_barang AS dpb ON dpb.kodeB = b.kodeB 
            LEFT JOIN 
                pinjam_barang AS pb ON pb.kodeP_barang = dpb.kodeP_barang 
            WHERE 
                dpb.kodeP_barang = :kodeP
                AND dpb.statusP_barang = 'DITERUSKAN'
            GROUP BY 
                dpb.kodeB, b.stock
            
            UNION
            
            SELECT 
                dpb.ketB, dpb.kodeP_barang, dpb.kodeB, dpb.jmlh, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang, NULL AS remaining_stock
            FROM 
                detail_pinjam_barang AS dpb 
                NATURAL JOIN barang AS b 
                NATURAL JOIN pinjam_barang AS pb 
            WHERE 
                dpb.kodeP_barang = :kodeP
                AND dpb.statusP_barang = 'DITERUSKAN'
        ) AS result
        WHERE remaining_stock IS NOT NULL;
        
    ";

        $this->db->query($query);
        $this->db->bind(':kodeP', $kodeP);
        $this->db->bind(':jamP', $jamP);
        $this->db->bind(':jamKP', $jamKP);
        $this->db->bind(':tglP', $tglP);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getStokKonfirmR($kodeP, $jamP, $jamKP, $tglP)
    {
        $query = "SELECT *
        FROM (
            SELECT 
                dpb.ketR, dpb.kodeP_ruang, dpb.jmlh, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang,
                (b.stock - COALESCE(SUM(
                    CASE WHEN (pb.jamP_ruang >= :jamP
                                AND pb.jamKP_ruang <= :jamKP) 
                                AND pb.tanggalP_ruang = :tglP
                                AND dpb.statusP_ruang = 'ACC' 
                                THEN dpb.jmlh ELSE 0 END), 0)) AS remaining_stock 
            FROM 
                ruang AS b 
            LEFT JOIN 
                detail_pinjam_ruang AS dpb ON dpb.kodeR = b.kodeR 
            LEFT JOIN 
                pinjam_ruang AS pb ON pb.kodeP_ruang = dpb.kodeP_ruang 
            WHERE 
                dpb.kodeP_ruang = :kodeP
                AND dpb.statusP_ruang = 'DITERUSKAN'
            GROUP BY 
                dpb.kodeR, b.stock
            
            UNION
            
            SELECT 
                dpb.ketR, dpb.kodeP_ruang, dpb.kodeR, dpb.jmlh, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang, NULL AS remaining_stock
            FROM 
                detail_pinjam_ruang AS dpb 
                NATURAL JOIN ruang AS b 
                NATURAL JOIN pinjam_ruang AS pb 
            WHERE 
                dpb.kodeP_ruang = :kodeP
                AND dpb.statusP_ruang = 'DITERUSKAN'
        ) AS result
        WHERE remaining_stock IS NOT NULL;
        
    ";

        $this->db->query($query);
        $this->db->bind(':kodeP', $kodeP);
        $this->db->bind(':jamP', $jamP);
        $this->db->bind(':jamKP', $jamKP);
        $this->db->bind(':tglP', $tglP);
        $this->db->execute();
        return $this->db->resultSet();
    }


    public function getAllKonfirmB($kodeP) //diubah
    {
        $this->db->query('SELECT 
        dpb.ketB, dpb.kodeP_barang, dpb.kodeB, dpb.jmlh, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang,b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang
        FROM detail_pinjam_barang AS dpb 
        NATURAL JOIN barang AS b 
        NATURAL JOIN pinjam_barang AS pb 
        WHERE dpb.kodeP_barang = :kodeP 
        AND dpb.statusP_barang="DITERUSKAN";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function getAllKonfirmR($kodeP)
    {
        $this->db->query('SELECT dpb.ketR, dpb.kodeP_ruang, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang FROM detail_pinjam_ruang AS dpb NATURAL JOIN ruang AS b NATURAL JOIN pinjam_ruang AS pb WHERE dpb.kodeP_ruang = :kodeP AND dpb.statusP_ruang="DITERUSKAN";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function ubahStatusR($sekre, $data)
    {
        $query = "UPDATE detail_pinjam_ruang SET ketR= :ketR, statusP_ruang = :statusP, id_Sekre = :sekre WHERE kodeP_ruang = :id AND kodeR = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':ketR', $data['keteranganR']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':sekre', $sekre);

        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }
    public function ubahStatusB($sekre, $data)
    {
        $query = "UPDATE detail_pinjam_barang SET ketB= :ketB, statusP_barang = :statusP, id_Sekre = :sekre WHERE kodeP_barang = :id AND kodeB = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':ketB', $data['keteranganB']);
        $this->db->bind(':sekre', $sekre);


        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }

    public function ubahStatusRkonfirm($biro, $data)
    {
        $query = "UPDATE detail_pinjam_ruang SET ketR=:ketR, statusP_ruang = :statusP, id_Biro = :biro WHERE kodeP_ruang = :id AND kodeR = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':ketR', $data['keteranganR']);
        $this->db->bind(':biro', $biro);

        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }

    public function ubahStatusBkonfirm($biro, $data)
    {
        $query = "UPDATE detail_pinjam_barang SET jmlh= :jmlh, ketB=:ketB, statusP_barang = :statusP, id_Biro= :biro WHERE kodeP_barang = :id AND kodeB = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':ketB', $data['keteranganB']);
        $this->db->bind(':jmlh', $data['jmlh']);
        $this->db->bind(':biro', $biro);

        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }

    public function getAllACCData()
    {
        $this->db->query('SELECT * FROM (SELECT pb.kodeP_barang AS kodeP, pb.nim, pb.jamP_barang AS jamP, pb.jamKP_barang AS jamKP, pb.tanggalP_barang AS tanggalP, b.namaB AS nama, s.nama_Sekre, br.nama_Biro, dpb.statusP_barang AS status
                    FROM pinjam_barang AS pb
                    JOIN detail_pinjam_barang AS dpb ON pb.kodeP_barang = dpb.kodeP_barang
                    JOIN barang AS b ON dpb.kodeB = b.kodeB
                    JOIN sekre AS s ON dpb.id_Sekre = s.id
                    JOIN biro AS br ON dpb.id_Biro = br.id
                    WHERE dpb.statusP_barang = "ACC"
                    UNION
                    SELECT pr.kodeP_ruang AS kodeP, pr.nim, pr.jamP_ruang AS jamP, pr.jamKP_ruang AS jamKP, pr.tanggalP_ruang AS tanggalP, r.namaR AS nama, s.nama_Sekre, br.nama_Biro, dpr.statusP_ruang AS status
                    FROM pinjam_ruang AS pr
                    JOIN detail_pinjam_ruang AS dpr ON pr.kodeP_ruang = dpr.kodeP_ruang
                    JOIN ruang AS r ON dpr.kodeR = r.kodeR
                    JOIN sekre AS s ON dpr.id_Sekre = s.id
                    JOIN biro AS br ON dpr.id_Biro = br.id
                    WHERE dpr.statusP_ruang = "ACC") AS acc_data
                    ORDER BY tanggalP, jamP ASC');

        return $this->db->resultSet();
    }

    public function getAllTerusData()
    {
        $this->db->query('SELECT * FROM (SELECT pb.kodeP_barang AS kodeP, pb.nim, pb.jamP_barang AS jamP, pb.jamKP_barang AS jamKP, pb.tanggalP_barang AS tanggalP, b.namaB AS nama, s.nama_Sekre, dpb.statusP_barang AS status
                    FROM pinjam_barang AS pb
                    JOIN detail_pinjam_barang AS dpb ON pb.kodeP_barang = dpb.kodeP_barang
                    JOIN barang AS b ON dpb.kodeB = b.kodeB
                    JOIN sekre AS s ON dpb.id_Sekre = s.id
                    WHERE dpb.statusP_barang = "DITERUSKAN"
                    UNION
                    SELECT pr.kodeP_ruang AS kodeP, pr.nim, pr.jamP_ruang AS jamP, pr.jamKP_ruang AS jamKP, pr.tanggalP_ruang AS tanggalP, r.namaR AS nama, s.nama_Sekre, dpr.statusP_ruang AS status
                    FROM pinjam_ruang AS pr
                    JOIN detail_pinjam_ruang AS dpr ON pr.kodeP_ruang = dpr.kodeP_ruang
                    JOIN ruang AS r ON dpr.kodeR = r.kodeR
                    JOIN sekre AS s ON dpr.id_Sekre = s.id
                    WHERE dpr.statusP_ruang = "DITERUSKAN") AS acc_data
                    ORDER BY tanggalP, jamP ASC');

        return $this->db->resultSet();
    }
}
