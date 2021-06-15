<?php
session_start();
require "koneksi/koneksi.php";
include "petugas/enkripsi.php";

// Jika tidak ada session pelanggan(blm login pelanggan), maka di larikan(di alihkan) ke form login(login.php).
if (!isset($_SESSION['anggota'])) {
    echo "<script>alert('Anda belum login, Silakan login dulu');</script>";
    echo "<script>location = 'index?halaman=login2';</script>";
} elseif (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Di Keranjang Anda Kosong, Silakan Berbelanja Dulu Sebelum Checkout');</script>";
    echo "<script>location = 'index?halaman=login2';</script>";
}
?>

<!-- <? //php
        //Mengetahui Dari Petugas Yang Mempunyai Akses Petugas Sebagai Peminjaman. 
        //Jika Petugas dengan Akses Peminjaman Tidak Aktif, maka System akan mencari dari petugas yang memiliki Akses Peminjaman
        //Yang Sedang Online(Sedang Aktif).
        // $ambil_petugas = $konek->query("SELECT akses_petugas.id_akses, akses_petugas.nama_akses, 
        //     petugas.online, petugas.nama_petugas, petugas.id_petugas FROM petugas 
        //     INNER JOIN akses_petugas ON akses_petugas.id_akses=petugas.id_akses 
        //     WHERE petugas.online = 'Sedang Aktif'");
        // $pecah_petugas = $ambil_petugas->fetch_assoc();
        ?> -->
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
    <!-- <pre><//?php //print_r($_SESSION['keranjang']); ?></pre> -->
    <!-- <pre><//?php //print_r($pecah_petugas); ?></pre> -->
    <!-- <pre><//?php //print_r($_SESSION['anggota']); ?></pre> -->

    <!-- Navbar -->
    <?php include "menu.php"; ?>
    <!-- Navbar -->

    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="about-content"><br>
                        <h2>Checkout Buku</h2>
                        <form method="post">
                            <!-- <pre><//?php print_r($_SESSION["anggota"]); ?></pre> -->
                            <hr>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Penerbit</th>
                                        <th>Pangarang</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
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
                                        INNER JOIN status_buku ON buku.id_status_buku=status_buku.id_status_buku
                                        WHERE buku.id_buku = '$id_buku'");
                                        $pecah = $ambil->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $pecah['judul_buku']; ?></td>
                                            <td><?php echo $pecah['nama_penerbit']; ?></td>
                                            <td><?php echo $pecah['nama_pengarang']; ?></td>
                                            <td><?php echo $pecah['nama_kategori']; ?></td>
                                            <td><?php echo $jumlah; ?></td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <!-- <th colspan="4">Total Belanja</th>
                        <th>Rp.<//?php //echo //number_format($totalbelanja); ?></th> -->
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                            $ambil_cek_peminjaman = $konek->query("SELECT buku.id_buku, buku.id_status_buku, status_buku.id_status_buku, 
                            status_buku.status_buku, peminjaman.tgl_kembali, peminjaman.kode_pinjam, peminjaman.id_buku
                            FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku 
                            INNER JOIN status_buku ON status_buku.id_status_buku=buku.id_status_buku
                            WHERE buku.id_buku='$id_buku'");
                            $pecah_pinjam = $ambil_cek_peminjaman->fetch_assoc();
                            if ($pecah_pinjam["status_buku"] == "Dipinjam") { ?>
                                <p class="alert alert-danger">Maaf, Buku Sedang Di Pinjam. Buku Tersedia Pada Tanggal : <b> <?php echo $pecah_pinjam["tgl_kembali"]; ?></b></p>
                                <a href="index" class="btn btn-primary">Kembali</a>
                            <?php } else { ?>
                                <button class="btn btn-primary" name="checkout">Pinjam</button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST["checkout"])) {
            $id_anggota = $_SESSION["anggota"]["id_anggota"];

            //1. Menyimpan data ke tabel peminjaman
            foreach ($_SESSION["keranjang"] as $id_buku => $jumlah) {
                //Mendapatkan data produk berdasarkan id_produk.
                $ambildata = $konek->query("SELECT * FROM buku WHERE id_buku='$id_buku'");
                $perproduk = $ambildata->fetch_assoc();

                $tanggal_pinjam = date("Y-m-d"); //Membuat Tanggal Dengan Tanggal Sekarang.
                $tanggal_kembali = date('Y-m-d', strtotime('+7 days', strtotime($tanggal_pinjam)));
                $id_kategori = $perproduk['id_kategori'];
                $id_penerbit = $perproduk['id_penerbit'];
                $id_pengarang = $perproduk['id_pengarang'];
                // $petugas = $pecah_petugas['id_petugas'];

                $konek->query("INSERT INTO peminjaman (id_anggota, id_buku, id_kategori, id_petugas, id_penerbit, id_pengarang, tgl_pinjam, tgl_kembali, jumlah, kode_status_pinjam)
					VALUES('$id_anggota','$id_buku','$id_kategori','','$id_penerbit','$id_pengarang','$tanggal_pinjam','$tanggal_kembali','$jumlah','1')");

                //2. Mendapatkan kode_pinjam yang baru saja terjadi.
                $kode_peminjaman_barusan = $konek->insert_id;

                // 3.Mendapatkan data buku berdasarkan id_buku.
                $konek->query("INSERT INTO detail_peminjaman(kode_pinjam, id_buku, id_penerbit, id_pengarang, id_anggota, id_petugas, id_kategori)
                                VALUES('$kode_peminjaman_barusan','$id_buku','$id_penerbit','$id_pengarang','$id_anggota','','$id_kategori')");

                //Skrip update Stok Buku.
                $konek->query("UPDATE buku SET stock_buku = stock_buku -$jumlah, id_status_buku='2'
                    WHERE id_buku = '$id_buku'");
            }

            //Mengkosongkan keranjang belanja.
            unset($_SESSION["keranjang"]);

            //Tampilan di alihkan ke halaman nota, nota dari pembelian yang barusan terjadi.
            echo "<script>alert('Peminjaman Berhasil');</script>";
            echo "<script>location='riwayat';</script>";
        }
        ?>
    </section>
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