<!-- Vendor CSS Files -->
<link href="<?= BASEURL; ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="<?= BASEURL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= BASEURL; ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?= BASEURL; ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?= BASEURL; ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="<?= BASEURL; ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?= BASEURL; ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="<?= BASEURL; ?>/assets/css/style.css" rel="stylesheet">

<!-- <link rel="stylesheet" href="<?= BASEURL; ?> /css/bootstrap.css"> -->

<header id="header" class="fixed-down d-flex align-items-center" style="background-color:maroon;">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo text-center mx-auto">
        <h1 style="color: white">
          Sistem Informasi Peminjaman Barang & Ruang</h1>
      </div>
    </div>
  </div>
</header>

<section id="hero" style="margin-top: 0px;">
  <div class="hero-container">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <!-- <ol class="carousel-indicators" id="hero-carousel-indicators"></ol> -->

      <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(<?= BASEURL; ?>/img/gedungFST.jpg); background-size: cover">
          <div class="carousel-container">
            <div class="carousel-content">
              <h2 class="animate__animated animate__fadeInDown">Selamat Datang di SIP</h2>
              <a href="#about" class="btn-get-started scrollto animate__animated animate__fadeInUp">Baca Lebih
                Lanjut</a>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item carousel-item next " style="background-image: url(<?= BASEURL; ?>/img/insideUSD.jpg);">
          <div class="carousel-container">
            <div class="carousel-content">
              <h2 class="animate__animated animate__fadeInDown">Fakultas Sains dan Teknologi</h2>
            </div>
          </div>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon ri-arrow-left-line" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon ri-arrow-right-line" aria-hidden="true"></span>
      </a>

    </div>
  </div>
</section>

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row content">
        <div class="col-lg-6">
          <h2>ALUR PROSES PEMINJAMAN BARANG DAN RUANG</h2>
          <!-- <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assum perenda sruen jonee trave</h3> -->
          <div class="col-lg-6">
            <div class="icon-box mt-5">
              <h4>Dokumen Template</h4>
              <p>Unduh dokumen template surat permohonan peminjaman:</p>
              <a href="https://docs.google.com/document/d/1Sq75EUPgB113DO_pHgcs5fW6QNynCW3d/edit?usp=sharing&ouid=116754467409344597508&rtpof=true&sd=true" class="btn btn-primary" download>Unduh Template</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <img src="<?= BASEURL; ?>/img/Peminjam.png" class="img-fluid" alt="">
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= About List Section ======= -->
  <section id="about-list" class="about-list">
    <div class="container">

      <div class="row">
        <div class="col-lg-6">
          <div class="icon-box mt-5">
            <i class="bx bx-receipt"></i>
            <h4>Syarat Peminjaman</h4>
            <p>1. Mahasiswa Fakultas Sains dan Teknologi</p>
            <p>2. Mengisi Formulir Peminjaman Ruang atau Barang </p>
            <p>3. Menyertakan Softfile yang telah disetujui oleh Wakil Dekan/Wakaprodi</p>
          </div>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <div class="icon-box mt-5">
            <i class="bx bx-cube-alt"></i>
            <h4>Info</h4>
            <p>Jika permintaan peminjaman tidak disetujui oleh sekretariat, silahkan lakukan peminjaman ulang sesuai
              dengan Syarat Peminjaman </p>
            <p>Jika permintaan peminjaman tidak disetujui oleh Biro, silahkan lakukan peminjaman ulang dengan merubah
              hari atau jam peminjaman</P>
          </div>
        </div>
        <!-- <div class="image col-lg-6 order-1 order-lg-2" style='background-image: url("assets/img/about-list-img.jpg");'></div> -->
      </div>

    </div>
  </section><!-- End About List Section -->

  <footer id="footer">


    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <h2>Tentang SIP</h2>
            <p>SIP merupakan situs fakultas untuk melakukan peminjaman yang digunakan di Universitas Sanata Dharma
              Yogyakarta</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h3>Contact Us</h3>
            <p>
              Fakultas Sains dan Teknologi USD<br>
              Kampus III Universitas Sanata Dharma,<br>
              Paingan, Maguwoharjo, Depok, Yogyakarta<br><br>
              <strong>Phone:</strong> 0274-883037, 883968 ext : 2340, 2320<br>
              <strong>Fax:</strong> 0274-886529<br>
              <strong>Email:</strong> fst@usd.ac.id<br>
            </p>
          </div>

          <div class="col-lg-5 col-md-6 footer-newsletter">


          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>KelompokSIP</span></strong>
      </div>
    </div>
  </footer>