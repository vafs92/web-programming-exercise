<style>
	body {
		background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
		background-size: cover;
	}

	.btn-primary,
	.btn-warning,
	.btn-success,
	.btn-danger {
		background-color: maroon;
		color: white;
	}

	.table {
		background-color: white;
		text-align: center;
	}

	#header {
		height: 35px;
		background-color: maroon;
	}

	/* h3 {
		text-align: center;
	} */

	.form-frame {
		border: 1px solid #ccc;
		padding: 20px;
		border-radius: 20px;
		background-color: #f9f9f9;
		opacity: 0.9;
		margin-top: 10px;
	}
</style>
<!-- <script src="sweetalert2.min.js"></script> -->
<!-- <header id="header" class="fixed-down d-flex"></header> -->
<header id="header" class="fixed-down d-flex align-items-center" style="background-color:maroon;">
	<div class="container d-flex justify-content-center justify-content-md-between">
		<div class="container d-flex align-items-center justify-content-between">
			<div class="logo text-center mx-auto">
				<h1 style="color: white">
					Daftar Barang</h1>
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
				<!-- <h3><b>Daftar Barang</b></h3> -->
				<!-- <button type="button" class="btn btn-primary tombolTambahDataB" data-bs-toggle="modal"
				data-bs-target="#formModalTambah">
				TAMBAH
			</button> -->
				<button type="button" class="btn btn-primary tombolTambahDataR" data-bs-toggle="modal" data-bs-target="#formModalTambah" style="margin-bottom: 10px;">
					TAMBAH
				</button>
				<table id="example" class="table table-hover table-sm table-striped table-light data-table " width="100%" cellspacing="0">
					<thead>
						<tr class="table-secondary">
							<th style="text-align: center;">Kode Barang</th>
							<th style="text-align: center;">Nama Barang</th>
							<th style="text-align: center;">Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($data['barang'] as $barang) : ?>
							<tr>
								<td>
									<?= $barang['kodeB'] ?>
								</td>
								<td>
									<?= $barang['namaB'] ?>
								</td>
								<td><a href="<?= BASEURL; ?>/perekaman/editB/<?= $barang['kodeB']; ?>" class="btn btn-warning ms-1 tampilModalUbahB btn-sm " 
								data-bs-toggle="modal" data-bs-target="#formModal_<?= $barang['kodeB'] ?>" data-id="<?= $barang['kodeB']; ?>">
								<i class="bi bi-pencil-fill"></i></a>

									<a href="<?= BASEURL; ?>/perekaman/hapusB/<?= $barang['kodeB']; ?>" class="btn btn-danger btn-ms-1 btn-sm" id="delete"><i class="bi bi-trash-fill"></i></a>

									<a href="#" class="btn btn-success ms-1 tampilModalViewB btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal_<?= $barang['kodeB'] ?>" data-id="<?= $barang['kodeB']; ?>"><i class="bi bi-eye-fill"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php foreach ($data['barang'] as $barang) : ?>
		<!-- Modal -->
		<div class="modal fade" id="formModal_<?= $barang['kodeB'] ?>" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="formModalLabelB"><b>Edit Data</b></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="<?= BASEURL; ?>/perekaman/editB" method="post" enctype="multipart/form-data">
							<!-- <input type="hidden" name="id" id="id"> -->
							<div class="mb-3">
								<label for="kodeB" class="form-label">Kode Barang</label>
								<input type="text" class="form-control" id="kodeB" name="kodeB" value="<?= $barang['kodeB'] ?>" readonly>
							</div>
							<div class="mb-3">
								<label for="namaB" class="form-label">Nama Barang</label>
								<input type="text" class="form-control" id="namaB" name="namaB" value="<?= $barang['namaB'] ?>">
							</div>
							<div class="mb-3">
								<label for="foto" class="form-label">Foto</label>
								<input type="file" class="form-control" id="foto" name="foto">
							</div>
							<div class="mb-3">
								<label for="fotoSebelumnya" class="form-label">Foto Sebelumnya</label>
								<img src="<?= BASEURL; ?>/foto/<?= $barang['foto']; ?>" id="fotoSebelumnya" alt="Foto Sebelumnya" class="img-thumbnail">
							</div>
							<div class="mb-3">
								<label for="keterangan" class="form-label">Keterangan</label>
								<input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $barang['keterangan'] ?>">
							</div>
							<div class="mb-3">
								<label for="stock" class="form-label">Stock</label>
								<input type="text" class="form-control" id="stock" name="stock" value="<?= $barang['stock'] ?>">
							</div>
					</div>
					<div class="modal-footer">
						<a href="<?= BASEURL; ?>/perekaman/barang"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
						<button type="submit"class="btn btn-success">Simpan Perubahan</button>
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
					<h5 class="modal-title" id="formModalLabelB"><b>Tambah Data</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="<?= BASEURL; ?>/perekaman/tambahB" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="kodeB" class="form-label">Kode Barang</label>
							<input type="text" class="form-control" id="kodeB" name="kodeB">
						</div>
						<div class="mb-3">
							<label for="namaB" class="form-label">Nama Barang</label>
							<input type="text" class="form-control" id="namaB" name="namaB">
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
					<a href="<?= BASEURL; ?>/perekaman/barang"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
					<button type="submit" class="btn btn-success">Tambah Data</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php foreach ($data['barang'] as $barang) : ?>
		<!-- Modal untuk menampilkan detail barang -->
		<div class="modal fade" id="detailModal_<?= $barang['kodeB'] ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="detailModalLabel"><b>Detail Barang</b></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Isi modal untuk menampilkan detail barang di sini -->
						<div class="row">
							<div class="col-md-4">
								<p>Kode Barang:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $barang['kodeB'] ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Nama Barang:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $barang['namaB'] ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Foto:</p>
							</div>
							<div class="col-md-8">
								<?php if (!empty($barang['foto'])) : ?>
									<img src="<?= BASEURL; ?>/foto/<?= $barang['foto'] ?>" alt="Foto Barang" width="200">
								<?php else : ?>
									<p>Tidak ada foto untuk barang ini.</p>
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Keterangan:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $barang['keterangan'] ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p>Stock:</p>
							</div>
							<div class="col-md-8">
								<p>
									<?= $barang['stock'] ?>
								</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: grey">Close</button>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>