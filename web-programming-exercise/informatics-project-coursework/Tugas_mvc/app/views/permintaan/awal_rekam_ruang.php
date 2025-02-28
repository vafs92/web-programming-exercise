<style>
    body {
        background: url('<?= BASEURL; ?> /img/wsbg2.png') no-repeat center center fixed;
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
        border-radius: 20px;
        background-color: #f9f9f9;
        opacity: 0.9;
        margin-top: 25px;
    }

    .btn {
        background-color: #B22222;
        color: white;
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
<script>
    document.getElementById('simpanDataBtn').addEventListener('click', function () {
        var inputs = document.querySelectorAll('#myForm input[required]:not(#kode):not(#nama)');
        var isInputsValid = true;

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() === '') {
                inputs[i].focus();
                isInputsValid = false;
                break;
            }
        }

        if (isInputsValid) {
            var jamP = document.getElementById('jamP').value;
            var jamKP = document.getElementById('jamKP').value;

            if (jamP >= jamKP) {
                alert('Jam Kembali harus lebih dari Jam Pinjam.');
                return;
            }
            document.getElementById('myForm').submit();
        }
    });
</script>

<div class="container">
    <!-- <h3>Tambah Data Ruang :</h3> -->
    <div class="form-frame">
        <form id="myForm" action="<?= BASEURL ?>/permintaan/tambahR" method="post" enctype="multipart/form-data">

            <select id="option" name="option" required class="btn btn-primary" hidden>
                <option value="ruang" hidden>Ruang</option>
            </select>

            <div class="row">
                <div class="col">
                    <label for="kodeP">Kode Pinjam:</label>
                    <!-- <input type="text" id="kodeP" class="form-control" name="kodeP" required value="<?= isset($data['kodeP']) ? $data['kodeP'] : '' ?>"> -->
                    <input type="text" id="kodeP" class="form-control" name="kodeP" value='<?= $data['kodeP'] ?>' readonly>

                </div>
                <div class="col">
                    <label for="namaP">Nama Peminjam :</label>
                    <input type="text" id="namaP" name="namaP" class="form-control" value='<?= $data['nama_peminjam'] ?>'readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="nimP">NIM:</label>
                    <input type="text" id="nimP" name="nimP" class="form-control" value='<?= $data['id_peminjam'] ?>'readonly>
                </div>
                <div class="col">
                    <label for="noWA">No WA:</label>
                    <input type="text" id="noWA" name="noWA" class="form-control" value='<?= $data['no_peminjam'] ?>'readonly>
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
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="jamP">Jam Pinjam:</label>
                    <?php
                    echo '<select id="jamP" name="jamP" class="form-control" required>';
                    if ($data['jam_P'] == null) {
                        foreach ($data['enumValuesJamP'] as $value) {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                    } else {
                        echo '<option value="' . $data['jam_P'] . '" selected>' . $data['jam_P'] . '</option>';
                        foreach ($data['enumValuesJamP'] as $value) {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                    }
                    echo '</select>';
                    ?>
                </div>

                <div class="col">
                    <label for="jamKP">Jam Kembali:</label>
                    <?php
                    echo '<select id="jamKP" name="jamKP" class="form-control" required>';

                    if ($data['jam_KP'] == null) {
                        foreach ($data['enumValuesJamKP'] as $value) {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                    } else {
                        echo '<option value="' . $data['jam_KP'] . '" selected>' . $data['jam_KP'] . '</option>';
                        foreach ($data['enumValuesJamKP'] as $value) {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                    }
                    echo '</select>';
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="surat">Soft File Surat (Format : .pdf atau .docx)</label>
                    <?php
                    if (isset($data['surat'])) {
                        // Check if the key 'surat' exists in the $data array
                        echo '<input type="file" id="surat" name="surat" class="form-control" disabled>';
                    } else {
                        echo '<input type="file" id="surat" name="surat" class="form-control" required>';
                    }
                    ?>
                </div>
            </div>


            <br>
            <button id="simpanDataBtn" class="btn btn-primary" type="submit">Simpan Data</button>

            <a href="<?= BASEURL; ?>/permintaan/status" class="btn btn-dark float-end " style="color:white"
                onclick="return confirm('yakin?')">Keluar</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('simpanDataBtn').addEventListener('click', function (event) {
        var inputs = document.querySelectorAll('#myForm input[required]:not(#kode):not(#nama)');
        var isInputsValid = true;

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() === '') {
                inputs[i].focus();
                isInputsValid = false;
                break;
            }
        }

        if (isInputsValid) {
            var jamP = document.getElementById('jamP').value;
            var jamKP = document.getElementById('jamKP').value;

            if (jamP >= jamKP) {
                alert('Jam Kembali harus lebih dari Jam Pinjam.');
                event.preventDefault(); // Prevent form submission
            }
        }
    });
</script>