<?php session_start(); ?>
<?php require "koneksi/koneksi.php"; ?>
<?php
include "petugas/enkripsi.php";
$id_peminjaman = decrypt($_GET["id"]);
$ambil = $konek->query("SELECT peminjaman.kode_pinjam, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.jumlah, 
tb_anggota.id_anggota, tb_anggota.nama_anggota, tb_anggota.email_anggota, tb_anggota.no_hp_anggota, buku.id_buku, buku.judul_buku, 
buku.tahun_buku, penerbit.id_penerbit, penerbit.nama_penerbit, pengarang.id_pengarang, pengarang.nama_pengarang, kategori.id_kategori, 
kategori.nama_kategori, petugas.id_petugas, petugas.nama_petugas, petugas.email_petugas, petugas.no_hp, 
status_peminjaman.kode_status_pinjam, status_peminjaman.status, detail_peminjaman.qr_code FROM peminjaman 
INNER JOIN detail_peminjaman ON detail_peminjaman.kode_pinjam=peminjaman.kode_pinjam
INNER JOIN tb_anggota ON detail_peminjaman.id_anggota=tb_anggota.id_anggota
INNER JOIN buku ON detail_peminjaman.id_buku=buku.id_buku
INNER JOIN penerbit ON detail_peminjaman.id_penerbit=penerbit.id_penerbit
INNER JOIN pengarang ON detail_peminjaman.id_pengarang=pengarang.id_pengarang
INNER JOIN kategori ON detail_peminjaman.id_kategori=kategori.id_kategori
INNER JOIN petugas ON detail_peminjaman.id_petugas=petugas.id_petugas
INNER JOIN status_peminjaman ON peminjaman.kode_status_pinjam=status_peminjaman.kode_status_pinjam
WHERE peminjaman.kode_pinjam='$id_peminjaman'");
$pecah = $ambil->fetch_assoc();
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
    <!-- <pre>
        <? //php print_r($pecah); 
        ?>
    </pre> -->
    <?php
    //Mendapatkan id_pelanggan yang beli.
    $id_pelanggan_yang_beli = $pecah["id_anggota"];
    //Mendapatkan id_pelanggan yang login.
    $id_pelanggan_yang_login = $_SESSION["anggota"]["id_anggota"];

    //Jika id_pelanggan yang beli dan id_pelanggan yang login tidak sama
    if ($id_pelanggan_yang_beli !== $id_pelanggan_yang_login) {
        echo "<script>alert('Jangan Nakal Ya.');</script>";
        echo "<script>location = 'riwayat';</script>";
        exit();
    }
    ?>
    <!-- Navbar -->
    <?php include "menu.php"; ?>
    <!-- Navbar -->
    <!-- <pre><//?php //print_r($_SESSION['anggota']); ?></pre> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <br><br><br><br><br>
                <h3 class="my-3"><b>Peminjam</b></h5>
                    <hr>
                    <p class="text text-md"><b>Nama : </b></p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['nama_anggota']; ?>"><br>
                    <p class="text text-md">Email : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['email_anggota']; ?>"><br>
                    <p class="text text-md">No Hp : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['no_hp_anggota']; ?>"><br>
                    <p class="text text-md">Tgl Pinjam : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['tgl_pinjam']; ?>"><br>
                    <p class="text text-md">Tgl Kembali : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['tgl_kembali']; ?>"><br>
                    <p class="text text-md">Jumlah Buku : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['jumlah']; ?>">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <br><br><br><br><br>
                <h3 class="my-3"><b>Buku</b></h5>
                    <hr>
                    <p class="text text-md"><b>Judul : </b></p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['judul_buku']; ?>"><br>
                    <p class="text text-md">Tahun : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['tahun_buku']; ?>"><br>
                    <p class="text text-md">Penerbit : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['nama_penerbit']; ?>"><br>
                    <p class="text text-md">Pengarang : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['nama_pengarang']; ?>"><br>
                    <p class="text text-md">Kategori :</p>
                    <input readonly type="text" class="form-control" value=" <?php echo $pecah['nama_kategori']; ?>"><br>
                    <p class="text text-md">Status Buku :</p>
                    <input readonly type="text" class="form-control" value=" <?php echo $pecah['status']; ?>">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <br><br><br><br><br>
                <h3 class="my-3"><b>Petugas</b></h5>
                    <hr>
                    <p class="text text-md"><b>Nama : </b></p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['nama_petugas']; ?>"><br>
                    <p class="text text-md">Email : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['email_petugas']; ?>"><br>
                    <p class="text text-md">No Hp : </p>
                    <input readonly type="text" class="form-control" value="<?php echo $pecah['no_hp']; ?>"><br>
                    <p class="text text-md">Kode QR : </p>
                    <?php
                    if ($pecah['status'] == "Di Batalkan") {
                        $foto_qr = $pecah['qr_code'];
                        //Jika ada file foto di dalam folder yang dipilih.
                        if (file_exists("Folder_QRCode_Peminjaman_Buku/$foto_qr")) {
                            //maka hapus data tersebut dari folder. 
                            unlink("Folder_QRCode_Peminjaman_Buku/$foto_qr");
                        }
                        $konek->query("UPDATE peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku 
                            SET id_status_buku = '1', stock_buku = '1' WHERE peminjaman.kode_pinjam='$id_peminjaman'");
                    } else { ?>
                        <img class="img img-responsive img-thumbnail" src="Folder_QRCode_Peminjaman_Buku/<?php echo $pecah['qr_code']; ?>">
                        <br><br>
                        <a href="download.php?kode_qr=<?= $pecah['qr_code'] ?>" class="btn btn-primary btn-md" title="Simpan QRCode Anda"><i class="fa fa-download fa-2x"></i></a>
                    <?php } ?>
            </div>
        </div>
    </div><br>
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