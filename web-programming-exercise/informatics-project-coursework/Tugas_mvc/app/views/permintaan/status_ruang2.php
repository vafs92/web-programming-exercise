<div class="container">
    <h3>Data Pinjam Ruang</h3>

    <table class = "table table-striped table-light">
        <thead>
            <tr>
                <th>Kode Pinjam</th>
                <th>Kode Ruang</th>
                <th>Nama Ruang</th>
                <th>Nama Sekre</th>
                <th>Nama Biro</th>
                <th>Status Pinjam</th>
                <th>Status Batal</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($data['items_ruang'] as $item) : ?>
                <tr>

                    <td><?= $item['kodeP_ruang'] ?></td>
                    <td><?= $item['kodeR'] ?></td>
                    <td><?= $item['namaR'] ?></td>
                    <td><?= $item['nama_Sekre'] ?></td>
                    <td><?= $item['nama_Biro'] ?></td>
                    <td><?= $item['statusP_ruang'] ?></td>
                    <td><?= $item['statusBatal_ruang'] ?>
                    </td>

                </tr>
            <?php endforeach; ?>
            </form>
        </tbody>
    </table>
</div>