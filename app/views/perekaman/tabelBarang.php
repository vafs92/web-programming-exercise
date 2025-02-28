<style>
	body {
		background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
		background-size: cover;
	}

	h3 {
		font-weight: bold;
		text-align: center;
	}

	table {
		background-color: white;
	}

	td {
		text-align: center;
	}

	.btn {
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
		<div class="col-lg-12">
			<div class="form-frame">
				<!-- <h3>Daftar Barang</h3> -->
				<table id="example" class="table table-hover table-striped table-light data-table" width="100%"
					cellspacing="0">
					<thead>
						<tr class="table-secondary">
							<th style="text-align: center;">Kode Barang</th>
							<th style="text-align: center;">Nama Barang</th>
							<th style="text-align: center;">Foto</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['barang'] as $barang): ?>
							<tr>
								<td>
									<?= $barang['kodeB'] ?>
								</td>
								<td>
									<?= $barang['namaB'] ?>
								</td>
								<td>
									<a href="#" class="btn btn-light ms-1 tampilModalViewB btn-sm" data-bs-toggle="modal"
										data-bs-target="#detailModal_<?= $barang['kodeB'] ?>"
										data-id="<?= $barang['kodeB']; ?>">View</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php foreach ($data['barang'] as $barang): ?>
		<!-- Modal untuk menampilkan detail barang -->
		<div class="modal fade" id="detailModal_<?= $barang['kodeB'] ?>" tabindex="-1" aria-labelledby="detailModalLabel"
			aria-hidden="true">
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
								<p>Foto:</p>
							</div>
							<div class="col-md-8">
								<?php if (!empty($barang['foto'])): ?>
									<img src="<?= BASEURL; ?>/foto/<?= $barang['foto'] ?>" alt="Foto Barang" width="200">
								<?php else: ?>
									<p>Tidak ada foto untuk barang ini.</p>
								<?php endif; ?>
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
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>