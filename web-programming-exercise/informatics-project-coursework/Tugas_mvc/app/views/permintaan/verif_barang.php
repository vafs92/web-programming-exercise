<style>
    h4 {
        font-weight: bold;
        text-align: center;
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
        <h4>Detail Verifikasi Barang</h4>

        <table class="table table-striped table-light">
            <thead>
                <tr class="table-secondary">
                    <th>Kode Pinjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jam Pinjam</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- <php if (is_array($data['items_barang'])) : ?> -->
                <form action="http://localhost/Tugas_mvc/public/permintaan/verif" method="post">
                    <?php foreach ($data['items_barang'] as $item): ?>
                        <tr>
                            <td>
                                <?= $item['kodeP_barang'] ?>
                            </td>
                            <td>
                                <?= $item['tanggalP_barang'] ?>
                            </td>
                            <td>
                                <?= $item['jamP_barang'] ?>
                            </td>
                            <td>
                                <?= $item['kodeB'] ?>
                            </td>
                            <td>
                                <?= $item['namaB'] ?>
                            </td>
                            <td><input type="text" id="jmlh" name="jmlh" class="form-control" size="3"
                                    value="<?= isset($item['jmlh']) ? $item['jmlh'] : '' ?> " disabled></td>

                            <td>
                                <select class="form-control" id="status" name="status">
                                    <option value="DIKIRIM">DIKIRIM</option>
                                    <option value="DITERUSKAN">DITERUSKAN</option>
                                    <option value="TOLAK">TOLAK</option>
                                </select>
                            </td>
                            <td>
                                <textarea id="keteranganB" name="keteranganB" rows="2"
                                    cols="30"><?= isset($item['ketB']) ? $item['ketB'] : '' ?></textarea>
                            </td>
                            <td>
                                <input type="hidden" name="option" value="barang">
                                <input type="hidden" name="id" id="id" value="<?= $item['kodeP_barang'] ?>">
                                <input type="hidden" name="kode" id="kode" value="<?= $item['kodeB'] ?>">
                                <button class="btn btn-success btn-sm" type="submit">SIMPAN</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </form>
            </tbody>
        </table>
    </div>