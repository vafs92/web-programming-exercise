<?php

class Perekaman extends Controller
{
	public function ruang()
	{
		$data['judul'] = 'Perekaman Sarana dan Prasarana';
		$data['ruang'] = $this->model('Model_PerekamanR')->getAllPerekaman();
		$this->view('templates/header', $data);
		$this->view('perekaman/ruang', $data);
		$this->view('templates/footer', $data);
	}

	public function tabelRuang()
	{
		$data['judul'] = 'Perekaman Sarana dan Prasarana';
		$data['ruang'] = $this->model('Model_PerekamanR')->getAllPerekaman();
		$this->view('templates/header', $data);
		$this->view('perekaman/tabelRuang', $data);
		$this->view('templates/footer', $data);
	}

	public function barang()
	{
		$data['judul'] = 'Perekaman Sarana dan Prasarana';
		$data['barang'] = $this->model('Model_PerekamanB')->getAllPerekaman();
		$this->view('templates/header', $data);
		$this->view('perekaman/barang', $data);
		$this->view('templates/footer', $data);
	}

	public function tabelBarang()
	{
		$data['judul'] = 'Perekaman Sarana dan Prasarana';
		$data['barang'] = $this->model('Model_PerekamanB')->getAllPerekaman();
		$this->view('templates/header', $data);
		$this->view('perekaman/tabelBarang', $data);
		$this->view('templates/footer', $data);
	}

	public function tambahR()
	{
		$Foto = $this->model('Model_PerekamanR')->unggahFoto(); // Mengambil nama file yang diunggah

		if ($Foto) {
			if ($this->model('Model_PerekamanR')->tambahDataR($_POST, $Foto) > 0) {
				// Flasher::setFlash('berhasil', ' ditambahkan', 'success');
				Flasher::setFlash('Data berhasil disimpan!', 'success');
				header('Location: ' . BASEURL . '/perekaman/ruang');
				exit;
			} else {
				// Flasher::setFlash('gagal', ' ditambahkan', 'danger');
				Flasher::setFlash('Data gagal disimpan!', 'danger');
				header('Location: ' . BASEURL . '/perekaman/ruang');
				exit;
			}
		} else {
			// Handle kesalahan pengunggahan file
			// Anda dapat menampilkan pesan kesalahan atau melakukan tindakan sesuai kebutuhan
		}
	}

	public function hapusR($kodeR)
	{

		if ($this->model('Model_PerekamanR')->hapusDataR($kodeR) > 0) {
			$response = ['status' => 'success', 'message' => 'Data berhasil dihapus!'];
		}

		// Tambahkan pesan log
		// error_log(json_encode($response));

		// Mengirim respons sebagai JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}


	public function hapusB($kodeB)
	{

		if ($this->model('Model_PerekamanB')->hapusDataB($kodeB) > 0) {
			$response = ['status' => 'success', 'message' => 'Data berhasil dihapus!'];
		}

		// Mengirim respons sebagai JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function tambahB()
	{
		$Foto = $this->model('Model_PerekamanB')->unggahFoto(); // Mengambil nama file yang diunggah

		if ($Foto) {
			if ($this->model('Model_PerekamanB')->tambahDataB($_POST, $Foto) > 0) {
				// Flasher::setFlash('berhasil', ' ditambahkan', 'success');
				Flasher::setFlash('Data berhasil disimpan!', 'success');
				header('Location: ' . BASEURL . '/perekaman/barang');
				exit;
			} else {
				// Flasher::setFlash('gagal', ' ditambahkan', 'danger');
				Flasher::setFlash('Data gagal disimpan!', 'danger');
				header('Location: ' . BASEURL . '/perekaman/barang');
				exit;
			}
		} else {
			// Handle kesalahan pengunggahan file
			// Anda dapat menampilkan pesan kesalahan atau melakukan tindakan sesuai kebutuhan
		}
	}
	

	public function getubahR()
	{
		$id = $_POST['id'];
		$data = $this->model('Model_PerekamanR')->getPerekamanByKodeR($id);
		echo json_encode($data);

	}

	
	public function getubahB()
	{
		$id = $_POST['id'];
		$data = $this->model('Model_PerekamanB')->getPerekamanByKodeB($id);
		echo json_encode($data);
	}

	

	public function editR()
	{

		if ($this->model('Model_PerekamanR')->ubahDataR($_POST) > 0) {
			// Flasher::setFlash('berhasil', ' diubah', 'success');
			Flasher::setFlash('Data berhasil diubah', 'success');
			// Flasher::flashEdit();
			header('Location: ' . BASEURL . '/perekaman/ruang');
			exit;
		} else {
			// Flasher::setFlash('gagal', 'diubah', 'danger');
			Flasher::setFlash('Data gagal diubah', 'danger');
			// Flasher::flashEdit();
			header('Location: ' . BASEURL . '/perekaman/ruang');
			exit;
		}
	}
 
	public function editB()
	{

		if ($this->model('Model_PerekamanB')->ubahDataB($_POST) > 0) {
			Flasher::setFlash('Data berhasil diubah', 'success');
			header('Location: ' . BASEURL . '/perekaman/barang');
			exit;
		} else {
			Flasher::setFlash('Data gagal diubah', 'danger');
			header('Location: ' . BASEURL . '/perekaman/barang');
			exit;
		}
	}

	public function cariR()
	{
		$data['judul'] = 'Daftar Ruang';
		$data['ruang'] = $this->model('Model_PerekamanR')->cariDataR();
		$this->view('templates/header', $data);
		$this->view('perekaman/ruang', $data);
		$this->view('templates/footer');
	}

	public function cariB()
	{
		$data['judul'] = 'Daftar Barang';
		$data['barang'] = $this->model('Model_PerekamanB')->cariDataB();
		$this->view('templates/header', $data);
		$this->view('perekaman/barang', $data);
		$this->view('templates/footer');
	}

	public function caritabelR()
	{
		$data['judul'] = 'Daftar Ruang';
		$data['ruang'] = $this->model('Model_PerekamanR')->cariDataR();
		$this->view('templates/header', $data);
		$this->view('perekaman/tabelRuang', $data);
		$this->view('templates/footer');
	}

	public function caritabelB()
	{
		$data['judul'] = 'Daftar Barang';
		$data['barang'] = $this->model('Model_PerekamanB')->cariDataB();
		$this->view('templates/header', $data);
		$this->view('perekaman/tabelBarang', $data);
		$this->view('templates/footer');
	}
}