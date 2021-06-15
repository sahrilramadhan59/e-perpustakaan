<?php
session_start();
require "koneksi/koneksi.php";
require "petugas/enkripsi.php";
?>
<?php
$keyword = mysqli_real_escape_string($konek, strip_tags($_GET["keyword"]));

$semua_data = array();
$ambil = $konek->query("SELECT * FROM buku 
INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit
INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang
INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori
INNER JOIN status_buku ON buku.id_status_buku=status_buku.id_status_buku
WHERE buku.judul_buku LIKE '%$keyword%' 
OR penerbit.nama_penerbit LIKE '%$keyword%' 
OR pengarang.nama_pengarang LIKE '%$keyword%' 
OR kategori.nama_kategori LIKE '%$keyword%' "); //Cara membacanya : Mengambil semua data dari produk dimana yang saya ambil berdasarkan nama produk
//seperti yang diantaranya yang saya cari berdasarkan inputan apa yang saya ingin cari. Atau mencari deskripsi  produk seperti yang saya
//cari melalui inputan saya.

//Setelah itu masukan ke dalam array.
while ($pecah = $ambil->fetch_assoc()) {
    $semua_data[] = $pecah;
}

// echo "<pre>";
// print_r($semua_data);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pencarian Buku</title>
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

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
        <div class="container">
            <header class="section-header"><br><br><br>
                <h3 class="section-title">Buku</h3>
                <h3>Hasil Pencarian : <b><?php echo $keyword; ?></b></h3>
                <!-- Jika kata pencarian yang tidak ada maka tampilkan pesan. -->
                <?php if (empty($semua_data)) : ?>
                    <div class="alert alert-danger">
                        <h3>Pencarian Dengan Kata <b><?php echo $keyword; ?></b> Tidak Di Temukan</h3>
                    </div>
                <?php endif ?>
                <!-- pesannya pencarian dengan kata yang di cari tidak ada. -->
            </header>
            <div class="row">
                <div class="col-lg-12">
                    <ul id="portfolio-flters">

                        <div class="">
                            <form action="pencarian" class="" method="get">
                                <input type="text" name="keyword" id="" class="text-lg-left" class="form-control" placeholder="Cari Buku">
                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </form>
                        </div><br>
                        <!-- ======= Menghitung Jumlah Buku Yang Di Pinjam ======= -->
                        <?php
                        $ambil_pinjam = $konek->query("SELECT nama_kategori, COUNT(*) AS jumlah FROM peminjaman 
                        INNER JOIN kategori ON peminjaman.id_kategori=kategori.id_kategori GROUP BY nama_kategori ORDER BY COUNT(*) ASC");
                        $data_pinjam = mysqli_fetch_array($ambil_pinjam);
                        ?>
                        <!-- ======= Akhir Menghitung Jumlah Buku Yang Di Pinjam ======= -->
                        <div class="alert alert-info alert-dismissable fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Rekomendasi Buku Yang Paling Banyak Di Pinjam Berdasarkan Kategori : <?php echo $data_pinjam['nama_kategori']; ?></strong>
                        </div>

                        <li data-filter="*" class="filter-active">Semua</li>
                        <?php $ambil = $konek->query("SELECT * FROM kategori"); ?>
                        <?php foreach ($ambil as $pecah_kategori) { ?>
                            <li data-filter=".<?php echo $pecah_kategori["nama_kategori"]; ?>"><?php echo $pecah_kategori["nama_kategori"]; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row portfolio-container">
                <?php foreach ($semua_data as $pecah) { ?>
                    <div class="col-lg-4 col-md-6 portfolio-item <?php echo $pecah["nama_kategori"]; ?>">
                        <div class="portfolio-wrap">
                            <img src="foto_buku/<?php echo $pecah['foto_buku']; ?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4><a href="#"><?php echo $pecah['judul_buku']; ?></a></h4>
                                <p><?php echo $pecah['nama_kategori']; ?></p>
                                <div>
                                    <a href="foto_buku/<?php echo $pecah['foto_buku']; ?>" data-gall="portfolioGallery" title="<?php echo $pecah_buku['judul_buku']; ?>" class="link-preview venobox"><i class="ion ion-eye"></i></a>
                                    <a href="detail?id=<?php echo encrypt($pecah['id_buku']); ?>" class="link-details" title="Lihat Detail"><i class="ion ion-android-open"></i></a>
                                    <a href="pinjam?id=<?php echo encrypt($pecah['id_buku']); ?>" class="link-details" title="Pinjam Buku"><i class="ion ion-ios-book"> </i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </section><!-- End Portfolio Section -->

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