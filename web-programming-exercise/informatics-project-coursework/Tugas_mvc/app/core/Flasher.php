<?php
class Flasher
{
    // Alert for add
    public static function setFlash($pesan, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            // 'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {

        if (isset($_SESSION['flash'])) {
            $pesan = $_SESSION['flash']['pesan'];
            // $aksi = $_SESSION['flash']['aksi'];
            $tipe = $_SESSION['flash']['tipe'];

            // Menggunakan SweetAlert untuk menampilkan pesan flash
            echo "<script>
                    Swal.fire({
                        title: '$pesan',
                        icon: '$tipe'
                    });
                  </script>";

            unset($_SESSION['flash']);
        }
    }

 }