<?php
session_start(); //menyimpan data ke dalam session.
require "koneksi/koneksi.php"; //memanggil koneksi.php.
include "petugas/enkripsi.php";
//Jika tidak ada session pelanggan
if (!isset($_SESSION["anggota"]) or empty($_SESSION["anggota"])) {
    echo "<script>alert('Silakan login');</script>";
    echo "<script>location = 'index?login2';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="about-content"><br>
                        <h2>Riwayat Peminjaman</h2>
                        <h3>Riwayat Peminjaman : <b><?php echo $_SESSION["anggota"]["nama_anggota"] ?></b></h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Judul Buku</th>
                                    <th class="text-center">Tanggal Pinjam</th>
                                    <th class="text-center">Tanggal Kembali</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor = 1;
                                //Mendapatkan id_pelanggan yang login dari SESSION.
                                $id_anggota = $_SESSION["anggota"]["id_anggota"]; //dibacanya, pada session pelanggan ada id_pelanggan lalu keluarkan dan masukan kepada variable id_pelanggan.
                                //Melakukan Query, Menampilkan pelanggan dari id_pelanggan dimana id_pelanggan yang masuk kedalam SESSION.
                                $ambil_data_pelanggan = $konek->query("SELECT * FROM peminjaman 
                                INNER JOIN detail_peminjaman ON peminjaman.kode_pinjam=detail_peminjaman.kode_pinjam
                                INNER JOIN buku ON peminjaman.id_buku=buku.id_buku
                                INNER JOIN status_peminjaman ON peminjaman.kode_status_pinjam=status_peminjaman.kode_status_pinjam
                                WHERE peminjaman.id_anggota = '$id_anggota'");
                                while ($pecah = $ambil_data_pelanggan->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $nomor; ?></td>
                                        <td class="text-center"><?php echo $pecah["judul_buku"]; ?></td>
                                        <td class="text-center">
                                            <?php echo $pecah["tgl_pinjam"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $pecah["tgl_kembali"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($pecah['status'] == "Di Batalkan") { ?>
                                                <p class=" text-danger"><?php echo $pecah['status'] ?></p>
                                            <?php } elseif ($pecah['status'] == "Kadaluarsa") { ?>
                                                <p class=" text-danger"><?php echo $pecah['status'] ?></p>
                                            <?php } else { ?>
                                                <p class=" text-primary"><?php echo $pecah['status'] ?></p>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($pecah['status'] == "Berhasil Di Pinjam") { ?>
                                                <?php
                                                $tgl_pinjam = $pecah["tgl_pinjam"];
                                                $kode_pinjam = $pecah["kode_pinjam"];
                                                // Menghitung hari Dimana Untuk Batas Waktu Pengambilan Buku Perpustakaan.
                                                $cek = date('Y-m-d', strtotime('+2 days', strtotime($tgl_pinjam)));
                                                $cek2 = date("Y-m-d"); // Membuat Untuk Menghitung Hari Ini
                                                // Jika Tanggal Peminjaman Lebih Dari Hari Ini. 
                                                //Artinya Jika Anggota Mengambil Lebih Dari Waktu Yang Di Tentukan. Maka System Akan Menghapus Peminjaman
                                                // Dari Anggota Tersebut.
                                                if ($cek2 > $cek) {
                                                    $foto_qr = $pecah['qr_code'];
                                                    //Jika ada file foto di dalam folder yang sudah dipilih.
                                                    if (file_exists("Folder_QRCode_Peminjaman_Buku/$foto_qr")) {
                                                        //maka hapus data tersebut dari folder. 
                                                        unlink("Folder_QRCode_Peminjaman_Buku/$foto_qr");
                                                    }

                                                    $konek->query("UPDATE peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku 
                                                    SET kode_status_pinjam = '7', id_status_buku = '1', stock_buku = '1' WHERE peminjaman.kode_pinjam = '$kode_pinjam'");
                                                }
                                                ?>
                                                <p class=" text-primary">Silakan Ambil Buku Anda Sebelum Tanggal <?php echo $tanggal_kembali = date('Y-m-d', strtotime('+2 days', strtotime($tgl_pinjam))); ?></p>
                                                <a href="detail_pinjam?id=<?php echo encrypt($pecah["kode_pinjam"]); ?>" class=" btn btn-info">Detail</a>
                                            <?php } elseif ($pecah['status'] == "Di Batalkan") { ?>
                                                <a href="detail_pinjam?id=<?php echo encrypt($pecah["kode_pinjam"]); ?>" class=" btn btn-danger">Detail</a>
                                            <?php } elseif ($pecah['status'] == "Kadaluarsa") { ?>
                                                <p class=" text-danger">Kamu Belum <br> Ambil Buku <br>Sampai Sudah <br>Melewati Batas <br>Waktu Yang <br>Telah Di Tentukan.</p>
                                            <?php } elseif ($pecah['status'] == "Menunggu Konfirmasi") { ?>
                                                <p class=" text-primary">Menunggu Konfirmasi Dari Petugas</p>
                                            <?php } elseif ($pecah['status'] == "Sudah Di Kembalikan") { ?>
                                                <?php
                                                $kode_pinjam = $pecah['kode_pinjam'];
                                                $ambil_kembali = $konek->query("SELECT detail_peminjaman.id_detail_pinjam, detail_peminjaman.kode_pinjam, 
                                                pengembalian.id_detail_pinjam, pengembalian.keterlambatan, pengembalian.denda 
                                                FROM pengembalian INNER JOIN detail_peminjaman 
                                                ON detail_peminjaman.id_detail_pinjam = pengembalian.id_detail_pinjam 
                                                WHERE detail_peminjaman.kode_pinjam = '$kode_pinjam'");
                                                $pecah_kembali = $ambil_kembali->fetch_assoc();
                                                ?>
                                                <p class=" text-primary"> Telat = <?php echo $pecah_kembali['keterlambatan']; ?> Hari. <br>
                                                    Denda = Rp. <?php echo number_format($pecah_kembali['denda']); ?>,-</p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Memanggil Session dengan cara yaitu, echo $_SESSION["nama sessionnya"]["jika sudah dapat nama session, silakan panggil apa yang ingin ditampilkan."] -->
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