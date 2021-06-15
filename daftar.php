<?php require "koneksi/koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pelanggan</title>
    <!-- Favicons -->
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

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <header class="section-header">
                        <br><br><br>
                        <h3>Daftar Anggota</h3>
                    </header>

                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class=" control-label col-md-3">Nama</label>
                            <div class="col-md-12">
                                <input type="text" name="nama" placeholder="Masukan Nama Anda" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class=" control-label col-md-3">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" placeholder="Masukan Email Anda" class="form-control" required>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class=" control-label col-md-3">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class=" control-label col-md-3">Telepon/Hp</label>
                            <div class="col-md-12">
                                <input type="text" name="telepon" placeholder="Masukan Nomor Telepon/HP Anda" class="form-control" required>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class=" control-label col-md-3">Jenis Kelamin</label>
                            <div class="col-md-12">
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">----Pilih-------</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class=" control-label col-md-3">Alamat</label>
                            <div class="col-md-12">
                                <textarea name="alamat" cols="30" rows="10" class=" form-control" placeholder="Masukan Alamat Lengkap Anda" required></textarea>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class=" control-label col-md-3">Foto</label>
                            <div class="col-md-12">
                                <input type="file" name="foto_anggota" class="form-control">
                            </div>
                        </div>
                        <div class=" form-group">
                            <div class=" col-md-12 col-md-offset-3">
                                <button class="btn btn-primary" name="daftar">Daftar</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    //Jika ada tombol daftar(atau tombol daftar di klik). 
                    if (isset($_POST["daftar"])) { //Maka proses selanjutnya. Yaitu.
                        //Upload Foto Bukti.
                        $nama_foto  = $_FILES["foto_anggota"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                        $folder     = "foto_anggota/";
                        $tipe_vidio = $_FILES["foto_anggota"]["type"];
                        $size       = $_FILES["foto_anggota"]["size"]; //Membuat Size(Ukuran Maksimal).
                        $valid      = array('jpg', 'jpeg', 'png'); //Format FIle Yang Di Izinkan.

                        //Mengambil nilai dari nama, email, password, telepon, alamat.
                        $nama = htmlspecialchars($_POST["nama"], ENT_QUOTES);
                        $email = strip_tags($_POST["email"]);
                        $password = htmlspecialchars($_POST["password"]);
                        $telepon = htmlspecialchars($_POST["telepon"], ENT_QUOTES);
                        $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"], ENT_QUOTES);
                        $alamat = strip_tags($_POST["alamat"]);
                        $tanggal_daftar = date("Y-m-d"); //Masukan pada tanggal sekarang.

                        //Mulai Melakukan Validasi Email.
                        $ambil_data_email = $konek->query("SELECT email_anggota FROM tb_anggota WHERE email_anggota = '$email'");
                        $email_yang_cocok = $ambil_data_email->num_rows;
                        //Jika email yang Masukan sudah ada
                        if ($email_yang_cocok == 1) {
                            echo "<script>alert('Email Yang Anda Masukan Sudah Terdaftar');</script>";
                            echo "<script>location='daftar';</script>";
                        }
                        //Selain Itu.
                        else {
                            if (strlen($nama_foto)) {
                                //Perintah untuk mengecek format gambar.
                                list($txt, $ext) = explode(".", $nama_foto);
                                if (in_array($ext, $valid)) {
                                    if ($size < (1024 * 1024 * 5)) {
                                        $lokasi     = $_FILES["foto_anggota"]["tmp_name"]; //Mengambil foto.
                                        if (move_uploaded_file($lokasi, $folder . $nama_foto)) {
                                            //Jika email belum ada yang terdaftar, maka kita lakukan query simpan.
                                            $konek->query("INSERT INTO tb_anggota(email_anggota, password_anggota, nama_anggota, no_hp_anggota, alamat, foto, jenis_kelamin, tgl_daftar)
                                            VALUES('$email',md5('$password'),'$nama','$telepon','$alamat','$nama_foto','$jenis_kelamin','$tanggal_daftar')");

                                            echo "<script>alert('Pendaftaran Berhasil');</script>";
                                            echo "<script>location='CAPTCHA/form_captcha';</script>";
                                        } else {
                                            echo "<script>alert('ERROR : Data Tidak Tersimpan');</script>";
                                            echo "<script>location='index';</script>";
                                        }
                                    } else {
                                        echo "<script>alert('ERROR : File Maksimal 2MB');</script>";
                                        echo "<script>location='index';</script>";
                                    }
                                } else {
                                    echo "<script>alert('ERROR : Format Gambar Tidak Valid, Format Harus(png, jpg, jpeg)');</script>";
                                    echo "<script>location='index';</script>";
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section><!-- End F.A.Q Section -->

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