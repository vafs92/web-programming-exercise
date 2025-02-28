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
    <h4>Detail Konfirmasi Ruang</h4>

    <table class="table table-striped table-light">
        <thead>
            <tr class="table-secondary">
                <th style="text-align: center;">Kode Pinjam</th>
                <th style="text-align: center;">Tanggal Pinjam</th>
                <th style="text-align: center;">Jam Pinjam</th>
                <th style="text-align: center;">Kode ruang</th>
                <th style="text-align: center;">Nama ruang</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Keterangan</th>
                <th style="text-align: center;">Stok</th>
                <th style="text-align: center;">Aksi</th>
            </tr> 
        </thead>
        <tbody>
            <?php foreach ($data['items_ruang'] as $item) : ?>
                <form class="myForm" action="http://localhost/Tugas_mvc/public/permintaan/konfirmasi" method="post">
                    <tr>
                        <td><?= $item['kodeP_ruang'] ?></td>
                        <td><?= $item['tanggalP_ruang'] ?></td>
                        <td><?= $item['jamP_ruang'] ?></td>
                        <td><?= $item['kodeR'] ?></td>
                        <td><?= $item['namaR'] ?></td>
                        <td>
                            <?php if ($item['jmlh'] > $item['remaining_stock']) : ?>
                                <input type="text" id="jmlh" name="jmlh" class="form-control jmlh" size="3" value="<?= isset($item['jmlh']) ? $item['jmlh'] : '' ?>">
                            <?php else : ?>
                                <input type="text" id="jmlh" name="jmlh" class="form-control jmlh" size="3" value="<?= isset($item['jmlh']) ? $item['jmlh'] :  '' ?>" readonly>
                            <?php endif; ?>
                        </td>
                        <td>
                            <select class="form-control" name="status">
                                <option value="DITERUSKAN">DITERUSKAN</option>
                                <option value="ACC">ACC</option>
                                <option value="TOLAK">TOLAK</option>
                            </select>
                        </td>
                        <td><textarea name="keteranganR" rows="2" cols="30"><?= isset($item['ketR']) ? $item['ketR'] : '' ?></textarea></td>
                        <td class="stok"><?= $item['remaining_stock'] ?></td>
                        <td>
                            <input type="hidden" name="option" value="ruang">
                            <input type="hidden" name="id" value="<?= $item['kodeP_ruang'] ?>">
                            <input type="hidden" name="kode" value="<?= $item['kodeR'] ?>">
                            <input type="hidden" name="jamP" value="<?= $item['jamP_ruang'] ?>">
                            <input type="hidden" name="jamKP" value="<?= $item['jamKP_ruang'] ?>">
                            <input type="hidden" name="tglP" value="<?= $item['tanggalP_ruang'] ?>">
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

