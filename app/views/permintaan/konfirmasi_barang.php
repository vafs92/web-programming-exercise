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
        <h4>Detail Konfirmasi Barang</h4>

        <table class="table table-striped table-light">
            <thead>
                <tr class="table-secondary">
                    <th style="text-align: center;">Kode Pinjam</th>
                    <th style="text-align: center;">Tanggal Pinjam</th>
                    <th style="text-align: center;">Jam Pinjam</th>
                    <th style="text-align: center;">Kode barang</th>
                    <th style="text-align: center;">Nama barang</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Keterangan</th>
                    <th style="text-align: center;">Stok</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['items_barang'] as $item) : ?>
                    <form class="myForm" action="http://localhost/Tugas_mvc/public/permintaan/konfirmasi" method="post">

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
                            <td>
                                <?php if ($item['jmlh'] > $item['remaining_stock']) : ?>
                                    <input type="text" id="jmlh" name="jmlh" class="form-control jmlh" size="3" value="<?= isset($item['jmlh']) ? $item['jmlh'] : '' ?>">
                                <?php else : ?>
                                    <input type="text" id="jmlh" name="jmlh" class="form-control jmlh" size="3" value="<?= isset($item['jmlh']) ? $item['jmlh'] : '' ?>" readonly>
                                <?php endif; ?>
                            </td>
                            <td>
                                <select class="form-control" id="status" name="status">
                                    <option value="DITERUSKAN">DITERUSKAN</option>
                                    <option value="ACC">ACC</option>
                                    <option value="TOLAK">TOLAK</option>
                                </select>
                            </td>
                            <td><textarea name="keteranganB" rows="2" cols="30"><?= isset($item['ketB']) ? $item['ketB'] : '' ?></textarea></td>
                            <td class="stok">
                                <?= $item['remaining_stock'] ?>
                            </td>
                            <td>
                                <input type="hidden" name="option" value="barang">
                                <input type="hidden" name="id" value="<?= $item['kodeP_barang'] ?>">
                                <input type="hidden" name="kode" value="<?= $item['kodeB'] ?>">
                                <input type="hidden" name="jamP" value="<?= $item['jamP_barang'] ?>">
                                <input type="hidden" name="jamKP" value="<?= $item['jamKP_barang'] ?>">
                                <input type="hidden" name="tglP" value="<?= $item['tanggalP_barang'] ?>">
                                <button class="btn btn-success btn-sm simpanBtn" type="submit">SIMPAN</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>


    <script>
        document.addEventListener('submit', function(event) {
            if (event.target.classList.contains('myForm')) {
                var form = event.target;
                var jmlh = form.querySelector('[name="jmlh"]').value; // Use [name="jmlh"] selector
                var stok = form.querySelector('.stok').textContent;

                if (parseInt(jmlh) > parseInt(stok)) {
                    alert('Stok Tidak Mencukupi');
                    event.preventDefault(); // Prevent form submission
                }
            }
        });
    </script> 