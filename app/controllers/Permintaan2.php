<?php

class Permintaan extends Controller
{
    public function status()
    {
        $data['judul'] = 'Status';
        $data['selectedOption'] = isset($_POST['option']) ? $_POST['option'] : '';
        $this->view('templates/header', $data);

        if ($data['selectedOption'] == 'barang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamB();
            $this->view('permintaan/status', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllPinjamBbyId($id);
                $this->view('permintaan/status_barang', $data);
            }
        } elseif ($data['selectedOption'] == 'ruang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamR();
            $this->view('permintaan/status', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllPinjamRbyId($id);
                $this->view('permintaan/status_ruang', $data);
            }
        } else {
            $data['items_barang'] = [];
            $data['items_ruang'] = [];
            $data['kodeLabel'] = '';
            $data['namaLabel'] = '';
            $this->view('permintaan/status', $data);
        }

        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data['judul'] = 'Rekam';

        $data['selectedOption'] = isset($_POST['option']) ? $_POST['option'] : '';

        // var_dump($data['kodeP']);
        if (isset($data['kodeP']) && !empty($data['kodeP']) && substr($data['kodeP'], 0, 2) === 'PB') {
            $profilPinjam = $this->model('Model_User')->getDatabyUserKodePB($_SESSION['username'], $data['kodeB']);
        } else if (isset($data['kodeP']) && !empty($data['kodeP']) && substr($data['kodeP'], 0, 2) === 'PR') {
            $profilPinjam = $this->model('Model_User')->getDatabyUserKodePR($_SESSION['username'], $data['kodeP']);
        } else {
            $profilPinjam = $this->model('Model_User')->getUserData($_SESSION['username']);
        }
        $this->ambilInfo($data, $profilPinjam);
        //bingung untuk pengecekan dan selannjutnya

        $this->view('templates/header', $data);
        $this->view('permintaan/rekam', $data);

        if ($data['selectedOption'] == 'barang' && $_POST != null) {
            $data['kodeB'] = $_POST['kode'];
            $this->simpanInfo($data);
            $data['kodeP'] = isset($_POST['kodeP']) ? $_POST['kodeP'] : '';
            $this->model('Model_StatusPinjam')->tambahDataPinjamB($data) > 0;
            $data['items_barang'] = $this->model('Model_StatusPinjam')->getDataBerhasilB($data['kodeP']);
            $this->view('permintaan/rekam_barang', $data);
            // }
        } elseif ($data['selectedOption'] == 'ruang' && $_POST != null) {
            $data['kodeR'] = $_POST['kode'];
            $this->simpanInfo($data);
            $data['kodeP'] = isset($_POST['kodeP']) ? $_POST['kodeP'] : '';
            $this->model('Model_StatusPinjam')->tambahDataPinjamR($data) > 0;
            $data['items_ruang'] = $this->model('Model_StatusPinjam')->getDataBerhasilR($data['kodeP']);
            $this->view('permintaan/rekam_ruang', $data);
        }

        $this->view('templates/footer', $data);
    }

    public function ambilInfo(&$data, $profilPinjam)
    {
        $data['id_peminjam'] = $profilPinjam['id'];
        $data['nama_peminjam'] = $profilPinjam['namaP'];
        $data['no_peminjam'] = $profilPinjam['no_WA'];

        // $data['kodeP'] = isset($profilPinjam['kodeP_barang']) ? $profilPinjam['kodeP_barang'] : '';
        $data['tanggal_P'] = isset($profilPinjam['tanggalP_barang']) ? $profilPinjam['tanggalP_barang'] : '';
        $data['tanggal_KP'] = isset($profilPinjam['tanggalK_barang']) ? $profilPinjam['tanggalK_barang'] : '';
        $data['jam_P'] = isset($profilPinjam['jamP_barang']) ? $profilPinjam['jamP_barang'] : '';
        $data['jam_KP'] = isset($profilPinjam['jamKP_barang']) ? $profilPinjam['jamKP_barang'] : '';
        // $data['kodeP'] = isset($profilPinjam['kodeP_ruang']) ? $profilPinjam['kodeP_ruang'] : '';
        $data['tanggal_P'] = isset($profilPinjam['tanggalP_ruang']) ? $profilPinjam['tanggalP_ruang'] : '';
        $data['tanggal_KP'] = isset($profilPinjam['tanggalK_ruang']) ? $profilPinjam['tanggalK_ruang'] : '';
        $data['jam_P'] = isset($profilPinjam['jamP_ruang']) ? $profilPinjam['jamP_ruang'] : '';
        $data['jam_KP'] = isset($profilPinjam['jamKP_ruang']) ? $profilPinjam['jamKP_ruang'] : '';
    }

    public function simpanInfo($data)
    {
        $data['kodeP'] = $_POST['kodeP'];
        $data['tanggal_P'] = $_POST['tanggalP'];
        $data['tanggal_KP'] = $_POST['tanggalK'];
        $data['jam_P'] = $_POST['jamP'];
        $data['jam_KP'] = $_POST['jamK'];
        $data['selectedOption'] = isset($_POST['option']) ? $_POST['option'] : '';
        if ($data['selectedOption']=='barang'){
        if ($this->model('Model_StatusPinjam')->cekDatabyIdB($data['kodeP']) == null) {
            $this->model('Model_StatusPinjam')->tambahProfilPeminjamB($data);
        }}
        else if ($data['selectedOption']=='barang'){
        if ($this->model('Model_StatusPinjam')->cekDatabyIdR($data['kodeP']) == null) {
            $this->model('Model_StatusPinjam')->tambahProfilPeminjamR($data);
        }}
    }





    public function hapusB($kodeP, $kodeB)
    {
        if ($this->model('Model_StatusPinjam')->hapusDataB($kodeP, $kodeB) > 0) {
            // Flasher::setFlash('berhasil', ' dihapus', 'success');
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/permintaan/tambah');
            exit;
        } else {
            // Flasher::setFlash('gagal', ' dihapus', 'danger');
            Flasher::setFlash('Data gagal dihapus!', 'danger');
            header('Location: ' . BASEURL . '/permintaan/tambah');
            exit;
        }
    }
    public function hapusR($kodeP, $kodeR, $jamP)
    {
        // $data['kodeP'] = isset($_POST['kodeP']) ? $_POST['kodeP'] : '';
        if ($this->model('Model_StatusPinjam')->hapusDataR($kodeP, $kodeR, $jamP) > 0) {
            // Flasher::setFlash('berhasil', ' dihapus', 'success');
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/permintaan/tambah');
            exit;
        } else {
            // Flasher::setFlash('gagal', ' dihapus', 'danger');
            Flasher::setFlash('Data gagal dihapus!', 'danger');
            header('Location: ' . BASEURL . '/permintaan/tambah');
            exit;
        }
    }

    public function getData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $option = $_POST['option'];

            // Lakukan query ke database berdasarkan pilihan tabel
            if ($option == 'barang') {
                $data = $this->model('Model_PerekamanB')->getAllPerekaman();
            } elseif ($option == 'ruang') {
                $data = $this->model('Model_PerekamanR')->getAllPerekaman();
            }
            // $data = $this->model('Model_StatusPinjam')->getDataMahasiswa();

            // Kirim data sebagai respons JSON ke JavaScript
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    // public function getDataMahasiswa()
    // {
    //     $data = $this->model('Model_StatusPinjam')->getDataMahasiswa();

    //     // Kirim data sebagai respons JSON ke JavaScript
    //     header('Content-Type: application/json');
    //     echo json_encode($data);
    // }

    public function verif()
    {
        $data['judul'] = 'Verifikasi';
        $data['selectedOption'] = isset($_POST['option']) ? $_POST['option'] : '';
        $this->view('templates/header', $data);

        if ($data['selectedOption'] == 'barang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamBkirim();
            $this->view('permintaan/verif', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                if (isset($_POST['status']) && isset($_POST['kode'])) {
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusB($_POST);
                }
                $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllVerifB($id);
                $this->view('permintaan/verif_barang', $data);
            }
        } elseif ($data['selectedOption'] == 'ruang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamRkirim();
            $this->view('permintaan/verif', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                if (isset($_POST['status']) && isset($_POST['kode'])) {
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusR($_POST);
                }
                $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllVerifR($id);
                $this->view('permintaan/verif_ruang', $data);
            }
        } else {
            $data['items_barang'] = [];
            $data['items_ruang'] = [];
            $data['kodeLabel'] = '';
            $data['namaLabel'] = '';
            $this->view('permintaan/verif', $data);
        }

        $this->view('templates/footer', $data);
    }


    public function konfirmasi()
    {
        $data['judul'] = 'Konfirmasi';
        $data['selectedOption'] = isset($_POST['option']) ? $_POST['option'] : '';
        $this->view('templates/header', $data);

        if ($data['selectedOption'] == 'barang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamBterus();
            $this->view('permintaan/konfirmasi', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                if (isset($_POST['status']) && isset($_POST['kode'])) {
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusB($_POST);
                }
                $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllKonfirmB($id);
                $this->view('permintaan/konfirmasi_barang', $data);
            }
        } elseif ($data['selectedOption'] == 'ruang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamRterus();
            $this->view('permintaan/konfirmasi', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                if (isset($_POST['status']) && isset($_POST['kode'])) {
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusR($_POST);
                }
                $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllKonfirmR($id);
                $this->view('permintaan/konfirmasi_ruang', $data);
            }
        } else {
            $data['items_barang'] = [];
            $data['items_ruang'] = [];
            $data['kodeLabel'] = '';
            $data['namaLabel'] = '';
            $this->view('permintaan/konfirmasi', $data);
        }

        $this->view('templates/footer', $data);
    }



    public function verifR($kodeP)
    {
        if ($this->model('Model_StatusPinjam')->getAllVerifR($kodeP) > 0) {
            // Flasher::setFlash('berhasil', ' dihapus', 'success');
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/permintaan/verif');
            exit;
        } else {
            // Flasher::setFlash('gagal', ' dihapus', 'danger');
            Flasher::setFlash('Data gagal dihapus!', 'danger');
            header('Location: ' . BASEURL . '/permintaan/verif');
            exit;
        }
    }

    public function verifB($kodeP)
    {
        if ($this->model('Model_StatusPinjam')->getAllVerifB($kodeP) > 0) {
            // Flasher::setFlash('berhasil', ' dihapus', 'success');
            Flasher::setFlash('Data berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/permintaan/verif');
            exit;
        } else {
            // Flasher::setFlash('gagal', ' dihapus', 'danger');
            Flasher::setFlash('Data gagal dihapus!', 'danger');
            header('Location: ' . BASEURL . '/permintaan/verif');
            exit;
        }
    }


    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            $status = $_POST['status'];

            // Update the status in your model based on the provided data
            $success = $this->model('Model_Perekaman')->updateStatus($kode, $nama, $status);

            // Return the success status as a JSON response
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
        }
    }
}
