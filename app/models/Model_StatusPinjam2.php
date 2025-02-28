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
        $this->db->query('SELECT * FROM `pinjam_barang` GROUP BY kodeP_barang');
        return $this->db->resultSet();
    }

    public function getAllPinjamR()
    {
        $this->db->query('SELECT * FROM pinjam_ruang GROUP BY kodeP_ruang');
        return $this->db->resultSet();
    }

    public function getAllPinjamBbyId($kodeP)
    {
        $this->db->query('SELECT dpb.kodeP_barang, dpb.kodeB, b.namaB, s.nama_Sekre, br.nama_Biro, dpb.statusP_barang, dpb.statusBatal_barang
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
        $this->db->query('SELECT dpb.kodeP_ruang, dpb.kodeR, b.namaR, s.nama_Sekre, br.nama_Biro, dpb.statusP_ruang, dpb.statusBatal_ruang
        FROM detail_pinjam_ruang AS dpb
        JOIN ruang AS b ON dpb.kodeR = b.kodeR
        JOIN biro AS br ON dpb.id_Biro = br.id
        JOIN sekre AS s ON dpb.id_Sekre = s.id
        WHERE dpb.kodeP_ruang = :kodeP');
    
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function cekDatabyIdB($kodeP)
    {
        $query = "SELECT kodeP_barang FROM pinjam_barang WHERE kodeP_barang = :kodeP";
        $this->db->query($query);
        $this->db->bind(':kodeP', $kodeP);
    }

    public function cekDatabyIdR($kodeP){
        $query = "SELECT kodeP_ruang FROM pinjam_ruang WHERE kodeP_ruang = :kodeP";
        $this->db->query($query);
        $this->db->bind(':kodeP', $kodeP);
    }

    public function tambahProfilPeminjamB($data)
    {
        $query = "INSERT INTO pinjam_barang (kodeP_barang, nim, tanggalP_barang, tanggalKP_barang, jamP_barang, jamKP_barang) VALUES (:kodeP, :nimP, :tanggalP, :tanggalKP, :jamP, :jamKP)";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':nimP', $data['id_peminjam']);
        $this->db->bind(':tanggalP', $data['tanggal_P']);
        $this->db->bind(':tanggalKP', $data['tanggal_KP']);
        $this->db->bind(':jamP', $data['jam_P']);
        $this->db->bind(':jamKP', $data['jam_KP']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahProfilPeminjamR($data)
    {
        $query = "INSERT INTO pinjam_ruang (kodeP_ruang, nim, tanggalP_ruang, tanggalKP_ruang, jamP_ruang, jamKP_ruang) VALUES (:kodeP, :nimP, :tanggalP, :tanggalKP, :jamP, :jamKP)";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':nimP', $data['id_peminjam']);
        $this->db->bind(':tanggalP', $data['tanggal_P']);
        $this->db->bind(':tanggalKP', $data['tanggal_KP']);
        $this->db->bind(':jamP', $data['jam_P']);
        $this->db->bind(':jamKP', $data['jam_KP']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataPinjamB($data)
    {
        $query = "INSERT INTO detail_pinjam_barang (kodeP_barang, kodeB, id_Sekre, id_Biro, statusP_barang, statusBatal_barang) VALUES (:kodeP, :kodeB, NULL, NULL, 'DIKIRIM', NULL)";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':kodeB', $data['kodeB']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataPinjamR($data)
    {
        $query = "INSERT INTO detail_pinjam_ruang (kodeP_ruang, kodeB, id_Sekre, id_Biro, statusP_ruang, statusBatal_ruang) VALUES (:kodeP, :kodeB, NULL, NULL, 'DIKIRIM', NULL)";
        $this->db->query($query);
        $this->db->bind(':kodeP', $data['kodeP']);
        $this->db->bind(':kodeB', $data['kodeB']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataBerhasilB($kodeP)
    {
        $query = "SELECT dpb.kodeP_barang, dpb.kodeB, b.namaB, dpb.statusP_barang
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

    public function hapusDataB($kodeP, $kodeB, $jamP)
    {
        $query = "DELETE FROM pinjam_barang WHERE kodeB=:kodeB AND kodeP_barang=:kodeP AND jamP_barang=:jamP";
        $this->db->query($query);
        $this->db->bind('kodeB', $kodeB);
        $this->db->bind('kodeP', $kodeP);
        $this->db->bind('jamP', $jamP);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function hapusDataR($kodeP, $kodeR, $jamP)
    {
        $query = "DELETE FROM pinjam_ruang WHERE kodeR=:kodeR AND kodeP_ruang=:kodeP AND jamP_ruang=:jamP";
        $this->db->query($query);
        $this->db->bind('kodeR', $kodeR);
        $this->db->bind('kodeP', $kodeP);
        $this->db->bind('jamP', $jamP);
        $this->db->execute();
        return $this->db->rowCount();
    }

    //atas

     public function getAllPinjamRkirim()
    {

        $this->db->query('SELECT dpb.kodeP_ruang, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, pb.tanggalKP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang FROM detail_pinjam_ruang AS dpb NATURAL JOIN ruang AS b NATURAL JOIN pinjam_ruang AS pb WHERE dpb.statusP_ruang="DIKIRIM" GROUP BY kodeP_ruang ORDER BY pb.tanggalP_ruang ASC;');
        return $this->db->resultSet();
    }
    
    public function getAllPinjamBkirim()
    {

        $this->db->query('SELECT dpb.kodeP_barang, dpb.kodeB, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, pb.tanggalKP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang FROM detail_pinjam_barang AS dpb NATURAL JOIN barang AS b NATURAL JOIN pinjam_barang AS pb WHERE dpb.statusP_barang="DIKIRIM" GROUP BY kodeP_barang ORDER BY pb.tanggalP_barang ASC;');
        return $this->db->resultSet();
    }

    public function getAllVerifR($kodeP)
    {
        $this->db->query('SELECT dpb.kodeP_ruang, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, pb.tanggalKP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang FROM detail_pinjam_ruang AS dpb NATURAL JOIN ruang AS b NATURAL JOIN pinjam_ruang AS pb WHERE dpb.kodeP_ruang = :kodeP AND dpb.statusP_ruang="DIKIRIM";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function getAllVerifB($kodeP)
    {
        $this->db->query('SELECT dpb.kodeP_barang, dpb.kodeB, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, pb.tanggalKP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang FROM detail_pinjam_barang AS dpb NATURAL JOIN barang AS b NATURAL JOIN pinjam_barang AS pb WHERE dpb.kodeP_barang = :kodeP AND dpb.statusP_barang="DIKIRIM";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function getAllPinjamBterus()
    {
        $this->db->query('SELECT dpb.kodeP_barang, dpb.kodeB, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, pb.tanggalKP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang FROM detail_pinjam_barang AS dpb NATURAL JOIN barang AS b NATURAL JOIN pinjam_barang AS pb WHERE dpb.statusP_barang="DITERUSKAN" GROUP BY kodeP_barang ORDER BY pb.tanggalP_barang ASC;');
        return $this->db->resultSet();
    }
    
    public function getAllPinjamRterus()
    {
        $this->db->query('SELECT dpb.kodeP_ruang, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, pb.tanggalKP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang FROM detail_pinjam_ruang AS dpb NATURAL JOIN ruang AS b NATURAL JOIN pinjam_ruang AS pb WHERE dpb.statusP_ruang="DITERUSKAN" GROUP BY kodeP_ruang ORDER BY pb.tanggalP_ruang ASC;');
        return $this->db->resultSet();
    }
    
    // public function ()
    // {
    //     $query = "SELECT id_mahasiswa FROM table_mahasiswa";
    //     $this->db->query($query);
    //     return $this->db->resultSet();
    // }

    public function getAllKonfirmB($kodeP)
    {
        $this->db->query('SELECT dpb.kodeP_barang, dpb.kodeB, pb.nim, pb.jamP_barang, pb.jamKP_barang, pb.tanggalP_barang, pb.tanggalKP_barang, b.namaB, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_barang FROM detail_pinjam_barang AS dpb NATURAL JOIN barang AS b NATURAL JOIN pinjam_barang AS pb WHERE dpb.kodeP_barang = :kodeP AND dpb.statusP_barang="DITERUSKAN";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function getAllKonfirmR($kodeP)
    {
        $this->db->query('SELECT dpb.kodeP_ruang, dpb.kodeR, pb.nim, pb.jamP_ruang, pb.jamKP_ruang, pb.tanggalP_ruang, pb.tanggalKP_ruang, b.namaR, dpb.id_Sekre, dpb.id_Biro, dpb.statusP_ruang FROM detail_pinjam_ruang AS dpb NATURAL JOIN ruang AS b NATURAL JOIN pinjam_ruang AS pb WHERE dpb.kodeP_ruang = :kodeP AND dpb.statusP_ruang="DITERUSKAN";');
        $this->db->bind(':kodeP', $kodeP);
        return $this->db->resultSet();
    }

    public function ubahStatusR($sekre, $data)
    {
        $query = "UPDATE detail_pinjam_ruang SET statusP_ruang = :statusP, id_Sekre = :sekre WHERE kodeP_ruang = :id AND kodeR = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':sekre', $sekre);

        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }
    
    public function ubahStatusB($sekre, $data)
    {
        $query = "UPDATE detail_pinjam_barang SET statusP_barang = :statusP, id_Sekre = :sekre WHERE kodeP_barang = :id AND kodeB = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':sekre', $sekre);


        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }

    public function ubahStatusRkonfirm($biro, $data)
    {
        $query = "UPDATE detail_pinjam_ruang SET statusP_ruang = :statusP, id_Biro = :biro WHERE kodeP_ruang = :id AND kodeR = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':biro', $biro);

        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }
    public function ubahStatusBkonfirm($biro, $data)
    {
        $query = "UPDATE detail_pinjam_barang SET statusP_barang = :statusP, id_Biro= :biro WHERE kodeP_barang = :id AND kodeB = :kode";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':statusP', $data['status']);
        $this->db->bind(':biro', $biro);

        if ($this->db->execute()) {
            return $this->db->rowCount();
        }
    }
}
