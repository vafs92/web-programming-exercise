<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' | ' : "" ?><?= env('system_name') ?></title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 100px);
            /* Kurangi tinggi navbar */
        }

        .welcome-box {
            text-align: center;
            padding: 2em;
            border-radius: 15px;
            background: #fff;
            /* Warna box */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Efek bayangan */
            max-width: 600px;
            width: 90%;
        }

        .welcome-box h1 {
            font-size: 2.5em;
            color: #333;
            font-weight: bold;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
        }

        .bg-home2 {
            background-image: url('<?= base_url('public/gambar/home2.jpeg') ?>');
            background-size: cover;
            background-position: center;
            /* background-repeat: no-repeat; */
            min-height: 100vh;
        }

        button#user-topnav-menu {
            background: #fff;
            border: 1px solid #b1b1b1;
            padding: 0.2em 2em;
            text-align: left !important;
            border-radius: 2em;
        }

        /* Membuat navbar lebih lebar */
        .navbar {
            width: 100%;
            /* Lebar penuh */
            background-color: #333;
            /* Warna latar navbar */
            padding: 0.8em 1.5em;
            /* Tambahkan padding untuk spasi */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Tambahkan bayangan jika diinginkan */
        }

        /* Menu navbar bold */
        .navbar-nav .nav-link {
            font-weight: bold;
            /* Membuat teks bold */
            color: white;
            /* Warna teks default */
            transition: color 0.3s ease;
            /* Efek transisi warna */
            padding: 0.5em 1em;
            /* Memberikan spasi antar menu */
        }

        /* Hover efek hanya warna */
        .navbar-nav .nav-link:hover {
            color: grey;
            /* Warna teks saat hover */
        }

        /* Menu aktif */
        .navbar-nav .nav-link.active {
            color: grey;
            /* Warna teks untuk menu aktif */
            /* text-decoration: underline; */
            /* Opsional: tambahkan garis bawah untuk membedakan*/
        }
    </style>
    <?= $this->renderSection('custom_css') ?>

</head>

<body class="<?= isset($page_title) && in_array($page_title, ['Home', 'Products', 'POS', 'Transactions', 'Users', 'Rekapan']) ? 'bg-home2' : '' ?>">
    <!-- Konten halaman lainnya -->
    <nav class="navbar navbar-expand-md navbar-dark bg-gradient" style="background-color: #B22222;">
        <div class="container">
            <a class="navbar-brand"><?= env('short_name') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= isset($page_title) && $page_title == 'Home' ? 'active' : '' ?>" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($page_title) && $page_title == 'Products' ? 'active' : '' ?>" href="<?= base_url('Main/products') ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($page_title) && $page_title == 'POS' ? 'active' : '' ?>" href="<?= base_url('Main/pos') ?>">POS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($page_title) && $page_title == 'Transactions' ? 'active' : '' ?>" href="<?= base_url('Main/transactions') ?>">Transactions</a>
                    </li>
                    <?php if (session()->get('role') == "Manager"): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($page_title) && $page_title == 'Users' ? 'active' : '' ?>" href="<?= base_url('Main/users') ?>">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($page_title) && $page_title == 'Report' ? 'active' : '' ?>" href="<?= base_url('Main/report') ?>">Report</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="dropdown">
                    <button type='button' class="" id="user-topnav-menu" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user rounded-circle border"></i> <?= $session->get('login_name') ?> <i class="fa fa-angle-down text-muted"></i></button>
                    <ul class="dropdown-menu" aria-labelledby="user-topnav-menu-items">
                        <!-- <li><a class="dropdown-item" href="<//?= base_url('update_user') ?>"><i class="fa fa-cog text-muted"></i> Update User</a></li> -->
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fa fa-sign-out text-muted"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <?php if ($session->getFlashdata('main_error')): ?>
            <div class="alert alert-danger rounded-0">
                <?= $session->getFlashdata('main_error') ?>
            </div>
        <?php endif; ?>
        <?php if ($session->getFlashdata('main_success')): ?>
            <div class="alert alert-success rounded-0">
                <?= $session->getFlashdata('main_success') ?>
            </div>
        <?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>


</body>
<?= $this->renderSection('custom_js') ?>

</html>