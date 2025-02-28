<div class="container">
    <h3>Data Pinjam Barang</h3>

    <table class = "table table-striped table-light">
    <thead>
            <tr>
            <th>Kode Pinjam</th>
                <th>Kode Barang</th> 
                <th>Nama Barang</th>
                <th>Nama Sekre</th>
                <th>Nama Biro</th>
                <th>Status Pinjam</th>
                <th>Status Batal</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($data['items_barang'] as $item) : ?>
                <tr>

                    <td><?= $item['kodeP_barang'] ?></td>
                    <td><?= $item['kodeB'] ?></td>
                    <td><?= $item['namaB'] ?></td>
                    <td><?= $item['nama_Sekre'] ?></td>
                    <td><?= $item['nama_Biro'] ?></td>
                    <td><?= $item['statusP_barang'] ?></td>
                    <td><?= $item['statusBatal_barang'] ?>
                    </td>

                </tr>
            <?php endforeach; ?>
            <!-- <php endif; ?> -->
        </tbody>
    </table>
    <!-- </form> -->
</div>