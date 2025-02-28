<?php
class Model_User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserByUsername($username)
    {
        $this->db->query('SELECT * FROM table_user WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }
    public function getUserByUsernameAndPassword($username, $password)
    {
        // Query database untuk mendapatkan data pengguna berdasarkan username dan password
        $query = "SELECT * FROM akun WHERE username = :username AND password = :password";
        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->bind('password', $password);
        return $this->db->single();
    }

    public function getUserDetailAndRole($username)
    {
        $query = "SELECT 
                    CASE
                        WHEN m.id = :username THEN m.role
                        WHEN b.id = :username THEN b.role
                        WHEN s.id = :username THEN s.role
                        ELSE NULL
                    END AS role
                FROM mahasiswa m
                LEFT JOIN biro b ON b.id = :username
                LEFT JOIN sekre s ON s.id = :username
                WHERE m.id = :username OR b.id = :username OR s.id = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function getUserData($username){
        $query = "SELECT id, namaP, no_WA FROM mahasiswa WHERE id = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        return $this->db->single();        
    }

    public function getDatabyUserKodePB($user, $kode)
    {
        $query = "SELECT kodeP_barang, tanggalP_barang, tanggalKP_barang, jamP_barang, jamKP_barang FROM pinjam_barang WHERE kodeP_barang = :kodeP AND nim = :nim";
        $this->db->query($query);
        $this->db->bind(':kodeP', $kode);
        $this->db->bind(':nim', $user);
        return $this->db->resultSet();


    }

    public function getDatabyUserKodePR($user, $kode)
    {
        $query = "SELECT kodeP_ruang, tanggalP_ruang, tanggalKP_ruang, jamP_ruang, jamKP_ruang FROM pinjam_ruang WHERE kodeP_ruang = :kodeP AND nim = :nim";
        $this->db->query($query);
        $this->db->bind(':kodeP', $kode);
        $this->db->bind(':nim', $user);
        return $this->db->resultSet();


    }
}
