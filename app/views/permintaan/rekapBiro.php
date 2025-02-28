<style>
    body {
        background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
        background-size: cover;
    }

    table {
        text-align: center;
        background-color: white;
    }

    h3 {
        font-weight: bold;
        text-align: center;
    }

    .btn {
        background-color: maroon;
        color: white;
    }

    label {
        font-weight: bold;
    }

    #header {
        height: 35px;
        background-color: maroon;
    }

    .paginate_button {}

    .form-frame {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 20px;
        background-color: #f9f9f9;
        opacity: 0.9;
        margin-top: 20px;
    }
</style>
<header id="header" class="fixed-down d-flex align-items-center" style="background-color:maroon;">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo text-center mx-auto">
                <h1 style="color: white">
                    Rekap Data Peminjaman</h1>
            </div>
        </div>
    </div>
</header>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-frame">

                <table id="example2" class=" table table-hover table-sm" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-secondary">
                            <th>Kode Pinjam</th>
                            <th>NIM</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jam Pinjam</th>
                            <th>Jam Kembali</th>
                            <th>SarPras</th>
                            <th>Sekre</th>
                            <th>Biro</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['items'] as $item) : ?>
                            <tr>
                                <td>
                                    <?= $item['kodeP'] ?>
                                </td>
                                <td>
                                    <?= $item['nim'] ?>
                                </td>
                                <td>
                                    <?= $item['tanggalP'] ?>
                                </td>
                                <td>
                                    <?= $item['jamP'] ?>
                                </td>
                                <td>
                                    <?= $item['jamKP'] ?>
                                </td>
                                <td>
                                    <?= $item['nama'] ?>
                                </td>
                                <td>
                                    <?= $item['nama_Sekre'] ?>
                                </td>
                                <td>
                                    <?= $item['nama_Biro'] ?>
                                </td>
                                <td>
                                    <?= $item['status'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>