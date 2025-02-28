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
                $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllPinjamBbyId($id); //diubah
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
            $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllPinjamB();
            $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllPinjamR();
            $data['items'] = array_merge($data['items_barang'], $data['items_ruang']);

            $data['items_barang'] = [];
            $data['items_ruang'] = [];
            $data['kodeLabel'] = '';
            $data['namaLabel'] = '';
            $this->view('permintaan/status', $data);
        }

        $this->view('templates/footer', $data);
    }

    private function autonumberB($table) //diubah
    {
        $id_terakhir = $this->model('Model_StatusPinjam')->getLastId($table);
        $angka_baru = intval($id_terakhir['max_id']) + 1;
        $id_baru = "PB" . $angka_baru;

        return $id_baru;
    }

    private function autonumberR($table)
    {
        $id_terakhir = $this->model('Model_StatusPinjam')->getLastId($table);
        $angka_baru = intval($id_terakhir['max_id']) + 1;
        $id_baru = "PR" . $angka_baru;
        return $id_baru;
    }

    public function tambahB()
    {
        $data = $this->prepareData();


        if ($_POST != null) {
            $data = $this->processBarangOption($data);
            header('Location: ' . BASEURL . '/permintaan/pilihB');
            exit;
        } else {
            $data['kodeP'] = $this->autonumberB('pinjam_barang'); //diubah
            $data['enumValuesJamP'] = $this->model('Model_StatusPinjam')->getEnumValuesB('jamP_barang'); //untuk jam
            $data['enumValuesJamKP'] = $this->model('Model_StatusPinjam')->getEnumValuesB('jamKP_barang'); //untuk jam
        }
        $this->view('templates/header', $data);
        $this->view('permintaan/awal_rekam_barang', $data);
        $this->view('templates/footer', $data);
    }

    public function pilihB()
    {
        $data = $this->handleBarangExistingRequest();

        $this->view('templates/header', $data);

        $data['barang'] = $this->model('Model_PerekamanB')->getAllRekamStok($data['tanggal_P'], $data['jam_P'], $data['jam_KP']);

        if ($_POST != null) {
            $data['kodeB'] = $_POST['kode'];
            $data['jmlh'] = $_POST['jmlh'];
            $this->model('Model_StatusPinjam')->tambahDataPinjamB($data) > 0;
            $data['items_barang'] = $this->model('Model_StatusPinjam')->getDataBerhasilB($data['kodeP']);
        }

        $this->view('permintaan/rekam_barang', $data);
        $this->view('templates/footer', $data);
    }

    public function tambahR()
    {
        $data = $this->prepareData();
        if ($_POST != null) {
            $data = $this->processRuangOption($data);
            header('Location: ' . BASEURL . '/permintaan/pilihR');
            exit;
        } else {
            $data['kodeP'] = $this->autonumberR('pinjam_ruang'); //diubah
            $data['enumValuesJamP'] = $this->model('Model_StatusPinjam')->getEnumValuesR('jamP_ruang'); //untuk jam.
            $data['enumValuesJamKP'] = $this->model('Model_StatusPinjam')->getEnumValuesR('jamKP_ruang'); //untuk jam 

        }
        $this->view('templates/header', $data);
        $this->view('permintaan/awal_rekam_ruang', $data);
        $this->view('templates/footer', $data);
    }

    public function pilihR()
    {
        $data = $this->handleRuangExistingRequest();

        $this->view('templates/header', $data);

        $data['ruang'] = $this->model('Model_PerekamanR')->getAllRekamStok($data['tanggal_P'], $data['jam_P'], $data['jam_KP']);

        if ($_POST != null) {
            $data['kodeR'] = $_POST['kode'];
            $this->model('Model_StatusPinjam')->tambahDataPinjamR($data) > 0;
            $data['items_ruang'] = $this->model('Model_StatusPinjam')->getDataBerhasilR($data['kodeP']);
        }

        $this->view('permintaan/rekam_ruang', $data);
        $this->view('templates/footer', $data);
    }

    private function prepareData()
    {
        $data['judul'] = 'Rekam';
        $data['selectedOption'] = isset($_POST['option']) ? $_POST['option'] : '';
        $profilPinjam = $this->model('Model_User')->getUserData($_SESSION['username']);
        $data['nama_peminjam'] = $profilPinjam['namaP'];
        $data['id_peminjam'] = $profilPinjam['id'];
        $data['no_peminjam'] = $profilPinjam['no_WA'];
        return $data;
    }


    private function processBarangOption($data) //diubah
    {
        $data['kodeP'] = $_POST['kodeP'];
        $data['tanggal_P'] = $_POST['tanggalP'];
        $data['jam_P'] = $_POST['jamP'];
        $data['jam_KP'] = $_POST['jamKP'];

        $Surat = $this->model('Model_StatusPinjam')->unggahSurat();
        $data['surat'] = $Surat;
        $exist = $this->autonumberB('pinjam_barang');

        if ($data['kodeP'] == $exist) {
            $this->model('Model_StatusPinjam')->tambahProfilPeminjamB($data, $Surat);
        }
        return $data;
    }

    private function processRuangOption($data) //diubah
    {
        $data['kodeP'] = $_POST['kodeP'];
        $data['tanggal_P'] = $_POST['tanggalP'];
        $data['jam_P'] = $_POST['jamP'];
        $data['jam_KP'] = $_POST['jamKP'];

        $Surat = $this->model('Model_StatusPinjam')->unggahSurat();
        $data['surat'] = $Surat;
        $exist = $this->autonumberR('pinjam_ruang');

        if ($data['kodeP'] == $exist) {
            $this->model('Model_StatusPinjam')->tambahProfilPeminjamR($data, $Surat);
        }

        // Fix: Check if the insertion is successful
        return $data;
    }

    private function handleRuangExistingRequest()
    {
        $data = $this->prepareData(); //diubah
        $nomor = $this->model('Model_StatusPinjam')->getLastId('pinjam_ruang'); //diubah
        $angka_baru = intval($nomor['max_id']); //diubah
        $pinjam = $this->model('Model_StatusPinjam')->cekKodePinjamR($data['id_peminjam'], $angka_baru); //diubah
        $data['kodeP'] = $pinjam['kodeP_ruang'];
        $data['tanggal_P'] = $pinjam['tanggalP_ruang'];
        $data['jam_P'] = $pinjam['jamP_ruang'];
        $data['jam_KP'] = $pinjam['jamKP_ruang'];
        $data['surat'] = $pinjam['surat'];

        return $data;
    }

    private function handleBarangExistingRequest()
    {
        $data = $this->prepareData(); //diubah
        $nomor = $this->model('Model_StatusPinjam')->getLastId('pinjam_barang'); //diubah
        $angka_baru = intval($nomor['max_id']); //diubah
        $pinjam = $this->model('Model_StatusPinjam')->cekKodePinjamB($data['id_peminjam'], $angka_baru); //diubah
        $data['kodeP'] = $pinjam['kodeP_barang'];
        $data['tanggal_P'] = $pinjam['tanggalP_barang'];
        $data['jam_P'] = $pinjam['jamP_barang'];
        $data['jam_KP'] = $pinjam['jamKP_barang'];
        $data['surat'] = $pinjam['surat'];

        return $data;
    }

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
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusB($_SESSION['username'], $_POST);
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
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusR($_SESSION['username'], $_POST);
                }
                $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllVerifR($id);
                $this->view('permintaan/verif_ruang', $data);
            }
        } else {
            // Mengambil data pinjam barang
            $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllPinjamBkirim();
            // Mengambil data pinjam ruang
            $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllPinjamRkirim();
            //  Gabungkan data pinjam barang dan ruang
            $data['items'] = array_merge($data['items_barang'], $data['items_ruang']);

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
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusBkonfirm($_SESSION['username'], $_POST);
                }
                $data['items_barang'] = $this->model('Model_StatusPinjam')->getStokKonfirmB($id, $_POST['jamP'], $_POST['jamKP'], $_POST['tglP']);
                $this->view('permintaan/konfirmasi_barang', $data);
            }
        } elseif ($data['selectedOption'] == 'ruang') {
            $data['items'] = $this->model('Model_StatusPinjam')->getAllPinjamRterus();
            $this->view('permintaan/konfirmasi', $data);

            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                if (isset($_POST['status']) && isset($_POST['kode'])) {
                    $data['result'] = $this->model('Model_StatusPinjam')->ubahStatusRkonfirm($_SESSION['username'], $_POST);
                }
                $data['items_ruang'] = $this->model('Model_StatusPinjam')->getStokKonfirmR($id, $_POST['jamP'], $_POST['jamKP'], $_POST['tglP']);
                $this->view('permintaan/konfirmasi_ruang', $data);
            }
        } else {
            // baru (-sasha)

            // Mengambil data pinjam barang
            $data['items_barang'] = $this->model('Model_StatusPinjam')->getAllPinjamBterus();
            // Mengambil data pinjam ruang
            $data['items_ruang'] = $this->model('Model_StatusPinjam')->getAllPinjamRterus();
            //  Gabungkan data pinjam barang dan ruang
            $data['items'] = array_merge($data['items_barang'], $data['items_ruang']);
            
            $data['items_barang'] = [];
            $data['items_ruang'] = [];
            $data['kodeLabel'] = '';
            $data['namaLabel'] = '';
            $this->view('permintaan/konfirmasi', $data);
        }

        $this->view('templates/footer', $data);
    }


    public function hapusB($kodeP, $kodeB)
    {
        // Ensure that you pass all three required arguments
        if ($this->model('Model_StatusPinjam')->hapusDataB($kodeP, $kodeB) > 0) {
            Flasher::setFlash('Data berhasil', 'success');
            header('Location: ' . BASEURL . '/permintaan/pilihB');
            exit;
        } else {
            // Flasher::setFlash('gagal', ' dihapus', 'danger');
            Flasher::setFlash('Data gagal', 'success');
            header('Location: ' . BASEURL . '/permintaan/pilihB');
            exit;
        }
    }

    public function hapusR($kodeP, $kodeR)
    {
        if ($this->model('Model_StatusPinjam')->hapusDataR($kodeP, $kodeR) > 0) {
            Flasher::setFlash('Data berhasil', 'success');
            header('Location: ' . BASEURL . '/permintaan/pilihR');
            exit;
        } else {
            Flasher::setFlash('Data gagal', 'success');
            header('Location: ' . BASEURL . '/permintaan/pilihR');
            exit;
        }
    }

    public function rekapBiro()
    {
        $data['judul'] = 'Rekapitulasi';
        $data['items'] = $this->model('Model_StatusPinjam')->getAllACCData();
        $this->view('templates/header', $data);
        $this->view('permintaan/rekapBiro', $data);
        $this->view('templates/footer', $data);
    }

    public function rekapSekre()
    {
        $data['judul'] = 'Rekapitulasi';
        $data['items'] = $this->model('Model_StatusPinjam')->getAllTerusData();
        $this->view('templates/header', $data);
        $this->view('permintaan/rekapSekre', $data);
        $this->view('templates/footer', $data);
    }
}
