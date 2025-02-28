<style>
    body {
        background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
        /* background-color: #EAE9E9; */
        background-size: cover;
    }

    table {
        text-align: center;
    }

    h4 {
        font-weight: bold;
        text-align: center;
    }

    label {
        font-weight: bold;
    }

    .form-frame {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
        opacity: 0.9;
        margin-top: 10px;
    }

    .btn {
        background-color: #B22222;
        color: white;
    }

    #header {
        height: 12px;
        background-color: maroon;
    }

    .pinjam-info-container {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 12px;
        margin-right: 12px;
        opacity: 0.8;
        font-size: 16px;
        line-height: 1.6;
        color: #333;
        border: 1px solid #ccc;
    }

    table {
        width: 100%;
    }

    td {
        padding: 5px;
        text-align: left;
    }

    td:first-child {
        width: 200px;
    }

    tbody {
        text-align: center;
    }
    #header {
        height: 35px;
        background-color: maroon;
    }
</style>
<header id="header" class="fixed-down d-flex align-items-center" style="background-color:maroon;">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="logo text-center mx-auto">
                <h1 style="color: white">
                    Perekaman Permintaan Ruang</h1>
            </div>
        </div>
    </div>
</header>
<body>

    <div class="container">
        <div class="pinjam-info-container">
            <table>
                <tr>
                    <td>Kode Pinjam Ruang</td>
                    <td> :
                        <?= $data['kodeP'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pinjam</td>
                    <td> :
                        <?= $data['tanggal_P'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Jam Pinjam</td>
                    <td> :
                        <?= $data['jam_P'] ?> -
                        <?= $data['jam_KP'] ?>
                    </td>
                </tr>
            </table>
        </div>


        <div class="container">
            <div class="form-frame">
                <form id="myFormS" action="<?= BASEURL ?>/permintaan/pilihR" method="post"
                    enctype="multipart/form-data">
                    <div id="additionalFormContainer">
                        <div class="row">
                            <div class="col">
                                <label for="kode">Kode :</label>
                                <input type="text" id="kode" name="kode" class="form-control" required readonly>
                                <button class="btn btn-primary mt-2" type="button" id="pilihData" data-bs-toggle="modal"
                                    data-bs-target="#modalData">Pilih Data</button>
                            </div>
                            <div class="col">
                                <label for="nama">Nama :</label>
                                <input type="text" id="nama" name="nama" class="form-control" required readonly>
                            </div>
                        </div>
                    </div>
                    <button style="margin-top : 5px" id="tambahDataBtn" class="btn btn-primary" type="submit">Tambah Data</button>
                    <a href="<?= BASEURL; ?>/permintaan/status" class="btn btn-dark float-end " style="color:white" onclick="return confirm('yakin?')">Selesai</a>

                </form>
            </div>
        </div>

        <div class="container">
            <div class="form-frame">

                <h4>Data Pinjam Ruang</h4>
                <table class="table table-striped table-light">
                    <thead>
                        <tr class="table-secondary">
                            <th>Kode Pinjam</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php if (isset($data['items_ruang']) && is_array($data['items_ruang'])): ?>
                        <tbody>
                            <?php foreach ($data['items_ruang'] as $item): ?>
                                <tr>
                                    <td style="text-align:center">
                                        <?= $item['kodeP_ruang'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $item['kodeR'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $item['namaR'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $item['statusP_ruang'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="#" class="badge badge-danger delete-item"
                                            data-kodep="<?= $item['kodeP_ruang']; ?>" data-kodeb="<?= $item['kodeR']; ?>"
                                            style="color: black;">hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</body>

<!-- Modal -->
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDataLabel">Daftar Ruang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- <div class="modal-body"> -->
                    <table class="table table-striped table-light">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['ruang'] as $ruang): ?>
                                <tr>
                                    <td style="text-align:center" class='pilihKode'>
                                        <?= $ruang['kodeR'] ?>
                                    </td>
                                    <td style="text-align:center" class='pilihNama'>
                                        <?= $ruang['namaR'] ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm pilihDataBtn" type="button"
                                            data-bs-dismiss="modal">Pilih</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-item').click(function (e) {
            e.preventDefault();

            var kodeP = $(this).data('kodep');
            var kodeR = $(this).data('kodeb');

            $.ajax({
                url: '<?= BASEURL; ?>/permintaan/hapusR/' + kodeP + '/' + kodeR,
                method: 'POST',
                success: function (response) {
                    $(e.target).closest('tr').remove();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    var pilihDataBtns = document.querySelectorAll('.pilihDataBtn');

    pilihDataBtns.forEach(function (button) {
        button.addEventListener('click', function () {
            var row = button.closest('tr');
            var kodeR = row.querySelector('.pilihKode').textContent.trim();
            var namaR = row.querySelector('.pilihNama').textContent.trim();

            document.getElementById('kode').value = kodeR;
            document.getElementById('nama').value = namaR;

            $('modalData').modal('toggle');
        });
    });

    document.getElementById('tambahDataBtn').addEventListener('click', function () {
        document.getElementById('myFormS').submit();
    });
</script>