<style>
    body {
        background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
        /* background-color: #EAE9E9; */
        background-size: cover;
    }

    table {
        text-align: center;
    }

    h3 {
        font-weight: bold;
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
    }

    .btn {
        background-color: #B22222;
        color: white;
    }

    #header {
        height: 12px;
        background-color: maroon;
    }
</style>
<header id="header" class="fixed-down d-flex"></header>
<div class="container">
    <h3>Tambah Data :</h3>
    <div class="form-frame">
        <form id="myForm" action="<?= BASEURL ?>/permintaan/tambah" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <form action="<?= BASEURL ?>/permintaan/prepareData" method="post" enctype="multipart/form-data">
                    <label for="option">Pilih Jenis Layanan :</label>
                    <select id="option" name="option" required class="btn btn-primary">
                        <option value="">-- Pilih --</option>
                        <option value="barang" <?= $data['selectedOption'] == 'barang' ? 'selected' : '' ?>>Barang</option>
                        <option value="ruang" <?= $data['selectedOption'] == 'ruang' ? 'selected' : '' ?>>Ruang</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Tampilkan</button>
                </form>
            </div>

            <!-- <form id="formUmum" action="<?= BASEURL ?>/permintaan/simpanInfo" method="post"> -->
            <div class="row">
                <div class="col">
                    <label for="kodeP">Kode Pinjam:</label>
                    <!-- <input type="text" id="kodeP" class="form-control" name="kodeP" required value="<?= isset($data['kodeP']) ? $data['kodeP'] : '' ?>"> -->
                    <input type="text" id="kodeP" class="form-control" name="kodeP" required value=<?= $data['kodeP'] ?>>

                </div>
                <div class="col">
                    <label for="namaP">Nama Peminjam :</label>
                    <input type="text" id="namaP" name="namaP" class="form-control" value=<?= $data['nama_peminjam'] ?>
                        required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="nimP">NIM:</label>
                    <input type="text" id="nimP" name="nimP" class="form-control" value=<?= $data['id_peminjam'] ?>>
                </div>
                <div class="col">
                    <label for="noWA">No WA:</label>
                    <input type="text" id="noWA" name="noWA" class="form-control" value=<?= $data['no_peminjam'] ?>>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="tanggalP">Tanggal Pinjam:</label>
                    <input type="date" id="tanggalP" name="tanggalP" class="form-control" required
                        value="<?= isset($data['tanggal_P']) ? $data['tanggal_P'] : '' ?>">
                </div>
                <div class="col">
                    <label for="tanggalK">Tanggal Kembali:</label>
                    <input type="date" id="tanggalK" name="tanggalK" class="form-control" required
                        value="<?= isset($data['tanggal_KP']) ? $data['tanggal_KP'] : '' ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="jamP">Jam Pinjam:</label>
                    <input type="time" id="jamP" name="jamP" class="form-control" required
                        value="<?= isset($data['jam_P']) ? $data['jam_P'] : '' ?>">
                </div>
                <div class="col">
                    <label for="jamK">Jam Kembali:</label>
                    <input type="time" id="jamK" name="jamK" class="form-control" required
                        value="<?= isset($data['jam_KP']) ? $data['jam_KP'] : '' ?>">
                </div>
            </div>
            <div class="row">
                <label for="surat">Soft File Surat (Format : .pdf atau .docx)</label>
                <input type="file" id="surat" name="surat" class="form-control" required>
            </div>

            <br>
            <button id="simpanDataBtn" class="btn btn-primary" type="submit">Simpan Data</button>

            <div id="additionalFormContainer" style="display: none;">
                <div class="row">
                    <div class="col">
                        <label for="kode">Kode :</label>
                        <input type="text" id="kode" name="kode" class="form-control" required>
                        <button class="btn btn-primary" type="button" id="pilihData" data-bs-toggle="modal"
                            data-bs-target="#modalData">Pilih Data</button>
                    </div>
                    <div class="col">
                        <label for="nama">Nama :</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                </div>
                <!-- Add more form fields as needed -->
            </div>
            <button id="tambahDataBtn" class="btn btn-primary" type="submit" disabled>Tambah Data</button>

            <a href="<?= BASEURL; ?>/permintaan/status" class="btn btn-dark float-end " style="color:white"
                onclick="return confirm('yakin?')">Keluar</a>
        </form>
        <?php if (isset($data['items_barang']) && is_array($data['items_barang'])): ?>
            <?php include 'rekam_barang.php'; ?>
        <?php endif; ?>
        <?php if (isset($data['items_ruang']) && is_array($data['items_ruang'])): ?>
            <?php include 'rekam_ruang.php'; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDataLabel">Data Tabel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari tabel akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('simpanDataBtn').addEventListener('click', function () {
        var inputs = document.querySelectorAll('#myForm input[required]:not(#kode):not(#nama)');
        var isInputsValid = true;

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value === '') {
                inputs[i].focus();
                isInputsValid = false;
                break;
            }
        }

        if (isInputsValid) {
            document.getElementById('additionalFormContainer').style.display = 'block';
            document.getElementById('tambahDataBtn').removeAttribute('disabled');
        }
    });

    document.getElementById('myForm').addEventListener('submit', function (event) {
        var inputs = document.querySelectorAll('#additionalFormContainer input[required]');
        var isInputsValid = true;

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value === '') {
                inputs[i].focus();
                isInputsValid = false;
                break;
            }
        }

        if (!isInputsValid) {
            event.preventDefault(); // Prevent form submission
        }
    });
</script>