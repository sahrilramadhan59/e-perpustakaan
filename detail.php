<?php session_start(); ?>
<?php
include 'koneksi/koneksi.php'; //memanggil koneksi.php.
include "petugas/enkripsi.php";

$id_buku = decrypt(strip_tags($_GET['id']));

//Query Ambil Data.
$ambildata = $konek->query("SELECT * FROM buku 
INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit
INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang
INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori
INNER JOIN status_buku ON buku.id_status_buku=status_buku.id_status_buku
WHERE buku.id_buku = '$id_buku'");
$detail_buku = $ambildata->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Buku</title>
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
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="about-img">
                        <img src="foto_buku/<?php echo $detail_buku["foto_buku"]; ?>">
                    </div>
                </div>
                <!-- =============== Mengetahui Buku Di Pinjam, Tersedia, Atau Hilang ============ -->
                <?php
                $ambil_pinjam = $konek->query("SELECT peminjaman.tgl_kembali, peminjaman.id_buku, buku.id_buku FROM peminjaman 
                    INNER JOIN buku ON peminjaman.id_buku=buku.id_buku 
                    WHERE buku.id_buku='$id_buku'");
                $data_pinjam = $ambil_pinjam->fetch_assoc();
                ?>
                <!-- =============== Akhir Mengetahui Buku Di Pinjam, Tersedia, Atau Hilang ============ -->
                <div class="col-lg-7 col-md-6">
                    <div class="about-content">
                        <?php if ($detail_buku["status_buku"] == "Dipinjam") { ?>
                            <div class="alert alert-warning alert-dismissable fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Maaf, Buku Yang Kamu Pilih Lagi Di Pinjam, Tersedia Pada Tanggal : <?php echo $data_pinjam["tgl_kembali"]; ?></strong>
                            </div>
                        <?php } else if ($detail_buku["status_buku"] == "Tersedia") { ?>
                            <div class="alert alert-success alert-dismissable fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Buku Tersedia.</strong>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger alert-dismissable fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Buku Hilang.</strong>
                            </div>
                        <?php } ?>
                        <h2>Detail Buku</h2>
                        <h3>Judul : <?php echo $detail_buku["judul_buku"]; ?></h3>
                        <h3>Tahun Buku : <?php echo $detail_buku["tahun_buku"]; ?></h3>
                        <h3>Kategori : <?php echo $detail_buku["nama_kategori"]; ?></h3>
                        <h3>Pengarang : <?php echo $detail_buku["nama_pengarang"]; ?></h3>
                        <h3>Penerbit : <?php echo $detail_buku["nama_penerbit"]; ?></h3>
                        <h3>Sinopsis</h3>
                        <p><?php echo $detail_buku["deskripsi"]; ?></p>
                        <a href="pinjam?id=<?php echo encrypt($detail_buku['id_buku']); ?>" class="btn btn-primary" title="Pinjam Buku"><i class="ion ion-ios-book"> </i> Pinjam Buku</a>
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