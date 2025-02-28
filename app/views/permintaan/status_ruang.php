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
        <h4>Detail Pinjam Ruang</h4>

        <table class="table table-striped table-light">
            <thead>
                <tr class="table-secondary">
                    <th style="text-align: center;">Kode Pinjam</th>
                    <th style="text-align: center;">Kode Ruang</th>
                    <th style="text-align: center;">Nama Ruang</th>
                    <th style="text-align: center;">Sekre</th>
                    <th style="text-align: center;">Biro</th>
                    <th style="text-align: center;">Status Pinjam</th>
                    <th style="text-align: center;">Keterangan</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($data['items_ruang'] as $item) : ?>
                    <tr>

                        <td>
                            <?= $item['kodeP_ruang'] ?>
                        </td>
                        <td>
                            <?= $item['kodeR'] ?>
                        </td>
                        <td>
                            <?= $item['namaR'] ?>
                        </td>
                        <td>
                            <?= $item['nama_Sekre'] ?>
                        </td>
                        <td>
                            <?= $item['nama_Biro'] ?>
                        </td>
                        <td>
                            <?= $item['statusP_ruang'] ?>
                        </td>
                        <td>
                            <?= $item['ketR'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </form>
            </tbody>
        </table>
    </div>