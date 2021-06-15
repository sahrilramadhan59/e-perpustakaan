<?php
session_start(); //menyimpan data ke dalam session.

//Jika tidak ada session pelanggan
if (!isset($_SESSION["anggota"]) or empty($_SESSION["anggota"])) {
    echo "<script>alert('Silakan login');</script>";
    echo "<script>location = 'login';</script>";
    exit();
}
?>
<?php
include 'koneksi/koneksi.php'; //memanggil koneksi.php.
include 'petugas/enkripsi.php'; //memanggil koneksi.php.
$id_anggota = $_SESSION["anggota"]['id_anggota'];
$ambil = $konek->query("SELECT * FROM tb_anggota WHERE id_anggota = '$id_anggota'");
$pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
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
</head>

<body>
    <!-- Navbar -->
    <?php include "menu.php"; ?>
    <!-- Navbar -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <!-- Membuat Status Online Anggota     -->
            <br>
            <div class="alert alert-info">
                <h5 class="text-right"><b><?php echo $pecah["online"]; ?></b></h5>
            </div>
            <!-- Akhir Membuat Status Online Anggota     -->
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="about-img">
                        <a href="foto_anggota/<?php echo $pecah["foto"]; ?>" title="<?php echo $pecah["nama_anggota"]; ?>" class="link-preview venobox">
                            <img src="foto_anggota/<?php echo $pecah["foto"]; ?>" title="<?php echo $pecah["nama_anggota"]; ?>">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="about-content">
                        <h2>Profil <b><?php echo $pecah['nama_anggota']; ?></b></h2>
                        <h3>Nama Lengkap : <?php echo $pecah['nama_anggota']; ?></h3>
                        <h3>Email : <?php echo $pecah['email_anggota']; ?></h3>
                        <h3>No. Hp/Telp : <?php echo $pecah['no_hp_anggota']; ?></h3>
                        <h3>Alamat Lengkap : <?php echo $pecah['alamat']; ?></h3>
                        <a href="ubah_data_pelanggan?i&id=<?php echo encrypt($pecah['id_anggota']); ?>" class="btn btn-warning"><i class="fa fa-edit"> </i> Ubah Data</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->

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