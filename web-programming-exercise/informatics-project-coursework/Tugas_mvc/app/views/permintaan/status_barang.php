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
    <h4>Detail Pinjam Barang</h4>

    <table class="table table-striped table-light">
      <thead>
        <tr class="table-secondary">
          <th style="text-align: center;">Kode Pinjam</th>
          <th style="text-align: center;">Kode Barang</th>
          <th style="text-align: center;">Nama Barang</th>
          <th style="text-align: center;">Jumlah</th> <!--diubah-->
          <th style="text-align: center;">Sekre</th>
          <th style="text-align: center;">Biro</th>
          <th style="text-align: center;">Status Pinjam</th>
          <th style="text-align: center;">Keterangan</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($data['items_barang'] as $item) : ?>
          <tr>

            <td>
              <?= $item['kodeP_barang'] ?>
            </td>
            <td>
              <?= $item['kodeB'] ?>
            </td>
            <td>
              <?= $item['namaB'] ?>
            </td>
            <td>
              <?= $item['jmlh'] ?>
            </td>
            <td>
              <?= $item['nama_Sekre'] ?>
            </td>
            <td>
              <?= $item['nama_Biro'] ?>
            </td>
            <td>
              <?= $item['statusP_barang'] ?>
            </td>
            <td>
              <?= $item['ketB'] ?>
            </td>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>