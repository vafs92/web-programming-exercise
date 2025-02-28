<style>
    body {
        background: url('<?= BASEURL; ?>/img/wsbg2.png') no-repeat center center fixed;
        background-size: cover;
    }

    table {
        text-align: center;
        background-color: white;
    }

    .btn {
        background-color: maroon;
        color: white;
    }

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

<div class="container">
    <div class="form-frame">
        <h4>Data Pinjam</h4>

        <table id="example"
            class="table table-hover table-sm table-striped table-light data-table <?= $data['selectedOption'] == '' ? '' : 'hide' ?>"
            width="100%" cellspacing="0">
            <thead>
                <tr class="table-secondary">
                    <th style="text-align: center;">Kode Pinjam</th>
                    <th style="text-align: center;">Contact Person</th>
                    <th style="text-align: center;">Jam Pinjam</th>
                    <th style="text-align: center;">Tanggal Pinjam</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['items'] as $item): ?>
                    <tr>
                        <td>
                            <?= $item['kodeP'] ?? $item['kodeP_barang'] ?? $item['kodeP_ruang'] ?>
                        </td>
                        <td>
                            <?= $item['nim'] ?>
                            <?= " | " ?>
                            <?= $item['namaP'] ?>
                            <?= " | " ?>
                            <?= $item['no_WA'] ?>
                        </td>
                        <td>
                            <?= $item['jamP'] ?? $item['jamP_barang'] ?? $item['jamP_ruang'] ?>
                            <?= " - " ?>
                            <?= $item['jamKP'] ?? $item['jamKP_barang'] ?? $item['jamKP_ruang'] ?>
                        </td>
                        <td>
                            <?= $item['tanggalP'] ?? $item['tanggalP_barang'] ?? $item['tanggalP_ruang'] ?>
                        </td>
                        <td>
                            <form action="http://localhost/Tugas_mvc/public/permintaan/status" method="post">
                                <input type="hidden" name="id"
                                    value="<?= $item['kodeP'] ?? $item['kodeP_barang'] ?? $item['kodeP_ruang'] ?>">
                                <input type="hidden" name="option"
                                    value="<?= isset($item['kodeP_barang']) ? 'barang' : 'ruang' ?>">
                                <button class="btn btn-success detail-btn btn-sm" type="submit"
                                    name="Detail">Detail</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>