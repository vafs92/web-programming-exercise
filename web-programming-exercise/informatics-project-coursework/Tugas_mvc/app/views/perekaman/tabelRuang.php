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
					Daftar Ruang</h1>
			</div>
		</div>
	</div>
</header>

<div class="container mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="form-frame">
				<!-- <h3>Daftar Ruang</h3> -->
				<table id="example" class=" table table-hover table-striped table-light data-table" width="100%"
					cellspacing="0">
					<thead>
						<tr class="table-secondary">
							<th style="text-align: center;">Kode Ruangan</th>
							<th style="text-align: center;">Nama Ruangan</th>
							<th style="text-align: center;">Foto</th>
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
								<td><a href="#" class="btn btn-success ms-1 tampilModalViewR btn-sm" data-bs-toggle="modal"
										data-bs-target="#detailModal_<?= $ruang['kodeR'] ?>"
										data-id="<?= $ruang['kodeR']; ?>">View</a> </td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php foreach ($data['ruang'] as $ruang): ?>
		<!-- Modal untuk menampilkan detail ruang -->
		<div class="modal fade" id="detailModal_<?= $ruang['kodeR'] ?>" tabindex="-1" aria-labelledby="detailModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="detailModalLabel"><b> Detail Ruang</b></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Isi modal untuk menampilkan detail ruang di sini -->
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