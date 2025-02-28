<style>
	body {
		background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
		background-size: cover;
	}
	table {
		background-color: white;
		text-align: center;
	}

	.btn-primary,
	.btn-warning,
	.btn-success,
	.btn-danger {
		background-color: maroon;
		color: white;
	}

	#header {
		height: 35px;
		background-color: maroon;
	}

	.form-frame {
		border: 1px solid #ccc;
		padding: 20px;
		border-radius: 20px;
		background-color: #f9f9f9;
		opacity: 0.9;
		margin-top: 10px;
	}
</style>
<!-- <header id="header" class="fixed-down d-flex"><h3>Daftar Ruang</h3></header> -->
<header id="header" class="fixed-down d-flex align-items-center" style="background-color:maroon;">
	<div class="container d-flex justify-content-center justify-content-md-between">
		<div class="container d-flex align-items-center justify-content-between">
			<div class="logo text-center mx-auto">
				<h1 style="color: white">
					Daftar Ruang</h1>
			</div>
		</div>
	</div>
</header>

<div class="container mt-3">
	<div class="row">
		<div class="col-lg-6">
			<?php Flasher::flash() ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-frame">
				<!-- <h3><b>Daftar Ruang</b></h3> -->
				<button type="button" class="btn btn-primary tombolTambahDataR" data-bs-toggle="modal"
					data-bs-target="#formModalTambah" style="margin-bottom: 10px;">
					TAMBAH
				</button>

				<table id="example" class="table table-hover table-sm table-striped table-light data-table ">
					<thead>
						<tr class="table-secondary">
							<th style="text-align: center;">Kode Ruangan</th>
							<th style="text-align: center;">Nama Ruangan</th>
							<th style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['ruang'] as $ruang): ?>
							<tr>
								<td>
									<?= $ruang['kodeR'] ?>
								</td>
								<td>
									<?= $ruang['namaR'] ?>
								</td>
								<td><a href="<?= BASEURL; ?>/perekaman/editR/<?= $ruang['kodeR']; ?>"
										class="btn btn-warning ms-1 tampilModalUbahR btn-sm" data-bs-toggle="modal"
										data-bs-target="#formModal_<?= $ruang['kodeR'] ?>"
										data-id="<?= $ruang['kodeR']; ?>"><i class="bi bi-pencil-fill"></i></a>

									<a href="<?= BASEURL; ?>/perekaman/hapusR/<?= $ruang['kodeR']; ?>"
										class="btn btn-danger ms-1 btn-sm" id="delete"><i class="bi bi-trash-fill"></i></a>

									<a href="#" class="btn btn-success ms-1 tampilModalViewR btn-sm" data-bs-toggle="modal"
										data-bs-target="#detailModal_<?= $ruang['kodeR'] ?>"
										data-id="<?= $ruang['kodeR']; ?>"><i class="bi bi-eye-fill"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php foreach ($data['ruang'] as $ruang): ?>
		<!-- Modal -->
		<div class="modal fade" id="formModal_<?= $ruang['kodeR'] ?>" tabindex="-1" aria-labelledby="formModal"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="formModalLabelR"><b>Edit Data</b></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<form action="<?= BASEURL; ?>/perekaman/editR" method="post" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="kodeR" class="form-label">Kode Ruang</label>
								<input type="text" class="form-control" id="kodeR" name="kodeR"
									value="<?= $ruang['kodeR'] ?>" readonly>
							</div>
							<div class="mb-3">
								<label for="namaR" class="form-label">Nama Ruang</label>
								<input type="text" class="form-control" id="namaR" name="namaR"
									value="<?= $ruang['namaR'] ?>">
							</div>
							<div class="mb-3">
								<label for="foto" class="form-label">Foto</label>
								<input type="file" class="form-control" id="foto" name="foto">
								<label for="fotoSebelumnya" class="form-label">Foto Sebelumnya</label>
								<img src="<?= BASEURL; ?>/foto/<?= $ruang['foto']; ?>" alt="Foto Sebelumnya"
									class="img-thumbnail">
							</div>
							<div class="mb-3">
								<label for="keterangan" class="form-label">Keterangan</label>
								<input type="text" class="form-control" id="keterangan" name="keterangan"
									value="<?= $ruang['keterangan'] ?>">
							</div>
							<div class="mb-3">
								<label for="stock" class="form-label">Stock</label>
								<input type="text" class="form-control" id="stock" name="stock"
									value="<?= $ruang['stock'] ?>">
							</div>
					</div>
					<div class="modal-footer">
						<a href="<?= BASEURL; ?>/perekaman/ruang"><button type="button" class="btn btn-secondary"
								data-bs-dismiss="modal">Close</button></a>
						<button type="submit" class="btn btn-success">Simpan Perubahan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

	<div class="modal fade" id="formModalTambah" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModalLabelR"><b>Tambah Data</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<form action="<?= BASEURL; ?>/perekaman/tambahR" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="kodeR" class="form-label">Kode Ruang</label>
							<input type="text" class="form-control" id="kodeR" name="kodeR">
						</div>
						<div class="mb-3">
							<label for="namaR" class="form-label">Nama Ruang</label>
							<input type="text" class="form-control" id="namaR" name="namaR">
						</div>
						<div class="mb-3">
							<label for="foto" class="form-label">Foto</label>
							<input type="file" class="form-control" id="foto" name="foto">
						</div>
						<div class="mb-3">
							<label for="keterangan" class="form-label">Keterangan</label>
							<input type="text" class="form-control" id="keterangan" name="keterangan">
						</div>
						<div class="mb-3">
							<label for="stock" class="form-label">Stock</label>
							<input type="text" class="form-control" id="stock" name="stock">
						</div>
				</div>
				<div class="modal-footer">
					<a href="<?= BASEURL; ?>/perekaman/ruang"><button type="button" class="btn btn-secondary"
							data-bs-dismiss="modal">Close</button></a>
					<button type="submit"  class="btn btn-success">Tambah Data</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php foreach ($data['ruang'] as $ruang): ?>
		<!-- Modal untuk menampilkan detail barang -->
		<div class="modal fade" id="detailModal_<?= $ruang['kodeR'] ?>" tabindex="-1" aria-labelledby="detailModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="detailModalLabel"><b>Detail Ruang</b></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Isi modal untuk menampilkan detail barang di sini -->
						<div class="row">
							<div class="col-md-4">
								<p>Kode Ruang:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $ruang['kodeR'] ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Nama Ruang:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $ruang['namaR'] ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Foto:</p>
							</div>
							<div class="col-md-8">
								<?php if (!empty($ruang['foto'])): ?>
									<img src="<?= BASEURL; ?>/foto/<?= $ruang['foto'] ?>" alt="Foto Ruang" width="200">
								<?php else: ?>
									<p>Tidak ada foto untuk ruang ini.</p>
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Keterangan:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $ruang['keterangan'] ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Stock:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $ruang['stock'] ?>
								</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>