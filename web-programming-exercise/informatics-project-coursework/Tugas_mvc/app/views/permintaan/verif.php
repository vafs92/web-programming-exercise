<style>
    body {
        background: url('<?= BASEURL; ?>/img/wsbg2.png') no-repeat center center fixed;
        background-size: cover;
    }

    table {
        text-align: center;
    }

    .btn {
        background-color: maroon;
        color: white;
    }

    h3,
    h4 {
        font-weight: bold;
        text-align: center;
    }

    label {
        font-weight: bold;
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
        margin-top: 20px;
    }
</style>

<!-- <header id="header" class="fixed-down d-flex"></header> -->
<header id="header" class="fixed-down d-flex align-items-center" style="background-color:maroon;">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo text-center mx-auto">
                <h1 style="color: white">
                    Verifikasi Peminjaman</h1>
            </div>
        </div>
    </div>
</header>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">
            <form action="http://localhost/Tugas_mvc/public/permintaan/verif" method="post">
                <label for="option">Pilih Jenis Layanan :</label>
                <select name="option" id="option" class="btn btn-light">
                    <option value="">-- Pilih --</option>
                    <option value="barang" <?= $data['selectedOption'] == 'barang' ? 'selected' : '' ?>>Barang</option>
                    <option value="ruang" <?= $data['selectedOption'] == 'ruang' ? 'selected' : '' ?>>Ruang</option>
                </select>
                <button class="btn btn-primary" type="submit">Tampilkan</button>
            </form>

            <?php if ($data['selectedOption'] == 'barang') : ?>
                <div class="form-frame">
                    <h4>Data Pinjam Barang</h4>
                    <table id="example" class="table table-hover table-striped table-light data-table <?= $data['selectedOption'] == 'barang' ? '' : 'hide' ?>" width="100%" cellspacing="0">
                        <thead>
                            <tr class="table-secondary">
                                <th style="text-align: center;">Kode Pinjam</th>
                                <th style="text-align: center;">Contact Person</th>
                                <th style="text-align: center;">Jam Pinjam</th>
                                <th style="text-align: center;">Tanggal Pinjam</th>
                                <th style="text-align: center;">Surat</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['items'] as $item) : ?>
                                <tr>
                                    <td>
                                        <?= $item['kodeP_barang'] ?>
                                    </td>
                                    <td>
                                        <?= $item['nim'] ?>
                                        <?= " | " ?>
                                        <?= $item['namaP'] ?>
                                        <?= " | " ?>
                                        <?= $item['no_WA'] ?>
                                    </td>
                                    <td>
                                        <?= $item['jamP_barang'] ?>
                                        <?= " - " ?>
                                        <?= $item['jamKP_barang'] ?>

                                    </td>
                                    <td>
                                        <?= $item['tanggalP_barang'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/surat/<?= $item['surat'] ?>" target="_blank" download>
                                            <button class="btn btn-success btn-sm">Download</button>
                                        </a>
                                    </td>

                                    <td>
                                        <form action="http://localhost/Tugas_mvc/public/permintaan/verif" method="post">
                                            <input type="hidden" name="option" value="barang">
                                            <input type="hidden" name="id" value="<?= $item['kodeP_barang'] ?>">
                                            <button class="btn btn-success btn-sm" type="submit">Detail</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (isset($data['items_barang']) && is_array($data['items_barang'])) : ?>
                        <?php include 'verif_barang.php'; ?>
                    <?php endif; ?>


                <?php elseif ($data['selectedOption'] == 'ruang') : ?>
                    <div class="form-frame">
                        <h4>Data Pinjam Ruang</h4>
                        <table id="example" class="table table-hover table-striped table-light data-table <?= $data['selectedOption'] == 'ruang' ? '' : 'hide' ?>" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-secondary">
                                    <th style="text-align: center;">Kode Pinjam</th>
                                    <th style="text-align: center;">Contact Person</th>
                                    <th style="text-align: center;">Jam Pinjam</th>
                                    <th style="text-align: center;">Tanggal Pinjam</th>
                                    <th style="text-align: center;">Surat</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['items'] as $item) : ?>
                                    <tr>
                                        <td>
                                            <?= $item['kodeP_ruang'] ?>
                                        </td>
                                        <!-- <td><= $item['nim'] ?></td> -->
                                        <td>
                                            <?= $item['nim'] ?>
                                            <?= " | " ?>
                                            <?= $item['namaP'] ?>
                                            <?= " | " ?>
                                            <?= $item['no_WA'] ?>
                                        </td>
                                        <td>
                                            <?= $item['jamP_ruang'] ?>
                                            <?= " - " ?>
                                            <?= $item['jamKP_ruang'] ?>
                                        </td>
                                        <td>
                                            <?= $item['tanggalP_ruang'] ?>
                                        </td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/surat/<?= $item['surat'] ?>" target="_blank" download>
                                                <button class="btn btn-success btn-sm">Download</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="http://localhost/Tugas_mvc/public/permintaan/verif" method="post">
                                                <input type="hidden" name="option" value="ruang">
                                                <input type="hidden" name="id" value="<?= $item['kodeP_ruang'] ?>">
                                                <button class="btn btn-success btn-sm" type="submit">Detail</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (isset($data['items_ruang']) && is_array($data['items_ruang'])) : ?>
                            <?php include 'verif_ruang.php'; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php include 'verif_awal.php'; ?>
                    <?php endif; ?>
                    </div>
                </div>
        </div>
    </div>
</div>