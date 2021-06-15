<?php
session_start();
require "koneksi/koneksi.php"; //Membutuhkan Koneksi.
include "petugas/enkripsi.php"; //Menambahkan file enkripsi.

if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Belum ada buku yang di pinjam nih, Silakan Pinjam Buku Dulu');</script>";
    echo "<script>location = 'index?#portfolio';</script>";
}
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
</head>

<body>
    <!-- Navbar -->
    <?php include "menu.php"; ?>
    <!-- Navbar -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="about-content"><br>
                        <h2>Rak Peminjaman Buku</h2>
                        <div class="alert alert-success alert-dismissable fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <center><strong>Peminjaman Buku Tidak Boleh Lebih Dari 2 Buku.</strong></center>
                        </div>
                        <form method="post">
                            <hr>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tahun Buku</th>
                                        <th>Jumlah Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    <?php foreach ($_SESSION["keranjang"] as $id_buku => $jumlah) : ?>
                                        <!-- Menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
                                        <?php
                                        $ambil = $konek->query("SELECT * FROM buku 
                                        INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit 
                                        INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang
                                        INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori
                                        WHERE buku.id_buku = '$id_buku'");
                                        $pecah = $ambil->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $pecah['judul_buku']; ?></td>
                                            <td><?php echo $pecah['tahun_buku']; ?></td>
                                            <td><?php echo $jumlah; ?></td>
                                            <td>
                                                <a href="hapuskeranjang?id=<?php echo encrypt($id_buku); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"> </i></a>
                                            </td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <?php if ($nomor != 2) { ?>
                                <!-- <button class="btn btn-primary" name="checkout">Pinjam</button> -->
                                <a href="checkout" class="btn btn-success">Pinjam</a>
                            <?php } else { ?>
                                <a href="index?#portfolio" class="btn btn-primary">Ingin Pinjam Lagi ?</a>
                                <a href="checkout" class="btn btn-success">Pinjam</a>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

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