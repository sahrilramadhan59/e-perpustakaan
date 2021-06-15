<?php
session_start(); //menyimpan data ke dalam session.
include 'koneksi/koneksi.php'; //memanggil koneksi.php.
include "petugas/enkripsi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-PERPUSTAKAAN</title>
  <!-- Favicons -->
  <link rel="icon" type="image/png" href="assets/dist/img/perpus.jpg">
  <link href="Template_Home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Template_Home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Template_Home/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="Template_Home/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="Template_Home/assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="Template_Home/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="Template_Home/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="Template_Home/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Rapid - v2.0.0
  * Template URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include "menu.php"; ?>
  <!-- #header -->

  <?php if (isset($_GET['halaman'])) { //Jika mendapatkan nilai 'halaman.' proses. 
    if ($_GET['halaman'] == "login") { //jika mendapatkan dengan nilai 'halaman' sama dengan produk,
      //pindahkan halaman ke pada halaman produk.
      //memindahkan halaman ke halaman produk dari halaman index.
      include 'login';
    }
  } ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="clearfix">
    <div class="container d-flex h-100">
      <div class="row justify-content-center align-self-center">
        <div class="col-md-6 intro-info order-md-first order-last">
          <h2>E-Perpustakaan<br>Solusi Pinjam Buku <span> Tanpa Ribet</span></h2>
          <div>
            <a href="#about" class="btn-get-started scrollto">YUK BERKUNJUNG</a>
          </div>
        </div>

        <div class="col-md-6 intro-img order-md-last order-first">
          <img src="assets/dist/img/perpus2.jpg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section><!-- End Hero -->
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-6">
            <div class="about-content">
              <h2>Tentang Kami</h2>
              <h3>E-Perpustakaan adalah sebuah solusi untuk peminjaman buku secara cepat, fleksibel.</h3>
              <p>Pinjam melalui system kami yang bekerja selama 24 jam, dan kamu bisa dimana saja pinjam buku tanpa harus datang langsung ke Perpustakaan</p>
              <p>System kami memakai QRCode untuk peminjaman serta pengembalian buku, yang dengan cepat dan akurat. Dan untuk keamanan dalam peminjaman buku, kami mengenkripsi semua data anggota kami, untuk terhidar dari pencurian data.</p>
              <ul>
                <li><i class="ion-android-checkmark-circle"></i> Pinjam Buku Secara Fleksibel</li>
                <li><i class="ion-android-checkmark-circle"></i> Menggunakan System QRCode</li>
                <li><i class="ion-android-checkmark-circle"></i> Akurat</li>
                <li><i class="ion-android-checkmark-circle"></i> Cepat</li>
                <li><i class="ion-android-checkmark-circle"></i> Peminjaman Buku Secara Aman</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <!-- ======= Menghitung Jumlah Anggota ======= -->
    <?php
    $ambil_anggota = $konek->query("SELECT COUNT(*) AS jumlah FROM tb_anggota");
    $data_anggota = mysqli_fetch_array($ambil_anggota);
    ?>
    <!-- ======= Akhir Menghitung Jumlah Anggota ======= -->
    <section id="why-us" class="why-us">
      <div class="container">
        <div class="row counters">
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php echo $data_anggota['jumlah']; ?></span>
            <p>Anggota</p>
          </div>
          <!-- ======= Menghitung Jumlah Buku ======= -->
          <?php
          $ambil_buku = $konek->query("SELECT COUNT(*) AS jumlah_buku FROM buku");
          $data_buku = mysqli_fetch_array($ambil_buku);
          ?>
          <!-- ======= Akhir Menghitung Jumlah Buku ======= -->
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php echo $data_buku['jumlah_buku']; ?></span>
            <p>Buku</p>
          </div>

          <!-- ======= Menghitung Jumlah Buku Yang Di Pinjam ======= -->
          <?php
          $ambil_pinjam = $konek->query("SELECT COUNT(*) AS jumlah_pinjam FROM peminjaman WHERE kode_status_pinjam='6'");
          $data_pinjam = mysqli_fetch_array($ambil_pinjam);
          ?>
          <!-- ======= Akhir Menghitung Jumlah Buku Yang Di Pinjam ======= -->
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php echo $data_pinjam['jumlah_pinjam']; ?></span>
            <p>Buku Yang Di Pinjam</p>
          </div>
          <!-- ======= Menghitung Jumlah Buku Yang Di Pinjam ======= -->
          <?php
          $ambil_buku_tersedia = $konek->query("SELECT COUNT(*) AS buku_tersedia FROM buku WHERE id_status_buku='1'");
          $data_tersedia = mysqli_fetch_array($ambil_buku_tersedia);
          ?>
          <!-- ======= Akhir Menghitung Jumlah Buku Yang Di Pinjam ======= -->
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php echo $data_tersedia['buku_tersedia']; ?></span>
            <p>Buku Yang Tersedia</p>
          </div>
        </div>
      </div>
    </section>
    <!-- End Why Us Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Pencarian Buku</h3>
            <p class="cta-text"> Pencarian buku cepat. Berdasarkan Judul, Kategori, Pengarang, Dan Penerbit</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <form action="pencarian" class="" method="get">
              <input type="text" name="keyword" id="" class="text-lg-left">
              <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!--  End Call To Action Section -->

    <?php  ?>
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">
        <header class="section-header">
          <h3 class="section-title">Buku</h3>
        </header>
        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Semua</li>
              <?php $ambil = $konek->query("SELECT * FROM kategori"); ?>
              <?php foreach ($ambil as $pecah_kategori) { ?>
                <li data-filter=".<?php echo $pecah_kategori["nama_kategori"]; ?>"><?php echo $pecah_kategori["nama_kategori"]; ?></li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class="row portfolio-container">
          <?php $ambil = $konek->query("SELECT * FROM buku 
          INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori
          INNER JOIN status_buku ON buku.id_status_buku=status_buku.id_status_buku"); ?>
          <?php foreach ($ambil as $pecah_buku) { ?>
            <?php if ($pecah_buku['status_buku'] == "Tersedia") { ?>
              <div class="col-lg-4 col-md-6 portfolio-item <?php echo $pecah_buku["nama_kategori"]; ?>">
                <div class="portfolio-wrap">
                  <img src="foto_buku/<?php echo $pecah_buku['foto_buku']; ?>" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4><a href="#"><?php echo $pecah_buku['judul_buku']; ?></a></h4>
                    <p><?php echo $pecah_buku['nama_kategori']; ?></p>
                    <div>
                      <a href="foto_buku/<?php echo $pecah_buku['foto_buku']; ?>" data-gall="portfolioGallery" title="Perbesar" class="link-preview venobox"><i class="ion ion-eye"></i></a>
                      <a href="detail?id=<?php echo encrypt($pecah_buku['id_buku']); ?>" class="link-details" title="Lihat Detail"><i class="ion ion-android-open"></i></a>
                      <a href="pinjam?id=<?php echo encrypt($pecah_buku['id_buku']); ?>" class="link-details" title="Pinjam Buku"><i class="ion ion-ios-book"> </i></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
    </section><!-- End Portfolio Section -->
    <!-- =========== Membuat Menampilkan Semua Saran ========== -->
    <?php
    $ambil_saran = $konek->query("SELECT tb_anggota.id_anggota, tb_anggota.email_anggota, tb_anggota.nama_anggota, tb_anggota.foto, 
    saran.id_saran, saran.id_anggota, saran.saran FROM saran INNER JOIN tb_anggota ON saran.id_anggota=tb_anggota.id_anggota");
    $data = $ambil_saran->fetch_array();
    ?>
    <!-- =========== Akhir Membuat Menampilkan Semua Saran ========== -->
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">
        <header class="section-header">
          <h3>Kata Mereka</h3>
        </header>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="owl-carousel testimonials-carousel wow fadeInUp">
              <?php foreach ($ambil_saran as $saran) { ?>
                <div class="testimonial-item">
                  <img src="foto_anggota/<?php echo $saran["foto"]; ?>" class="testimonial-img" alt="">
                  <h3><?php echo $saran["nama_anggota"]; ?></h3>
                  <h4><?php echo $saran["email_anggota"]; ?></h4>
                  <p>
                    <?php echo $saran["saran"]; ?>
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <!-- Login Anggota -->
    <?php include "login.php"; ?>
    <!-- Login Anggotar -->
    <!-- End Team Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq wow fadeInUp">
      <div class="container">
        <header class="section-header">
          <h3>Question and Answer</h3>
        </header>

        <ul id="faq-list" class="wow fadeInUp">
          <li>
            <a data-toggle="collapse" class="collapsed" href="#faq1">Apakah Pinjam Buku Disini Aman ?<i class="ion-android-remove"></i></a>
            <div id="faq1" class="collapse" data-parent="#faq-list">
              <p>
                Kami mengenkripsi semua data untuk hal - hal yang tidak di inginkan seperti pencurian data - data pribadi.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq2" class="collapsed">Apakah Pinjam Buku Disini Fleksibel ? <i class="ion-android-remove"></i></a>
            <div id="faq2" class="collapse" data-parent="#faq-list">
              <p>
                Kami menggunakan system peminjaman buku online, artinya kamu tidak harus datang ke perpustakaan untuk meminjam buku.
                Dan kamu hanya tinggal pilih berdasarkan buku apa yang ingin kamu pinjam.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq3" class="collapsed">Bagaimana Kami Ingin Pinjam Buku Disini ? <i class="ion-android-remove"></i></a>
            <div id="faq3" class="collapse" data-parent="#faq-list">
              <p>
                1. Pastikan kamu sudah daftar terlebih dahulu, setelah daftar tinggal kamu login, lalu kamu cari buku apa yang sedang kamu butuhkan.<br>
                2. Setelah itu akan masuk kedalam rak kamu, dan kamu bisa pinjam lagi atau kamu langsung pinjam bukunya itu.<br>
                3. Setelah peminjaman buku selesai, kamu akan di alihkan ke riwayat peminjaman kamu, dan tunggu hingga peminjaman kamu kami proses.<br>
                4. Setelah kami proses peminjaman kamu, silakan cek lagi riwayat peminjaman buku kamu ya.<br>
                5. Lalu kamu klik detail untuk melihat buku yang kamu pinjam, lalu akan ada QRCode untuk mengambil buku yang sudah kamu pinjam.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq4" class="collapsed">Bagaimana Untuk Mengambil Buku Yang Sudah Saya Pinjam ? <i class="ion-android-remove"></i></a>
            <div id="faq4" class="collapse" data-parent="#faq-list">
              <p>
                1. Pastikan kamu sudah daftar dan login.<br>
                2. Lalu cek pada riwayat peminjaman buku kamu, setelah itu klik Detail untuk melihat detail buku yang kamu pinjam<br>
                3. Silakan datang dan scan QRCode kamu pada kami yang ada di halaman detail, untuk mengambil buku yang sudah kamu pinjam.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End F.A.Q Section -->

  </main><!-- End #main -->

  <!-- Footer -->
  <?php include "footer.php"; ?>
  <!-- Footer -->
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="Template_Home/assets/vendor/jquery/jquery.min.js"></script>
  <script src="Template_Home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Template_Home/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="Template_Home/assets/vendor/php-email-form/validate.js"></script>
  <script src="Template_Home/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="Template_Home/assets/vendor/counterup/counterup.min.js"></script>
  <script src="Template_Home/assets/vendor/venobox/venobox.min.js"></script>
  <script src="Template_Home/assets/vendor/mobile-nav/mobile-nav.js"></script>
  <script src="Template_Home/assets/vendor/wow/wow.min.js"></script>
  <script src="Template_Home/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="Template_Home/assets/vendor/waypoints/jquery.waypoints.min.js"></script>

  <!-- Template Main JS File -->
  <script src="Template_Home/assets/js/main.js"></script>

</body>

</html>