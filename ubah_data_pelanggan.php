<?php
session_start();
include "koneksi/koneksi.php";
include "petugas/enkripsi.php";
?>
<?php
$id_anggota = decrypt(strip_tags($_GET["id"]));
$ambil = $konek->query("SELECT * FROM tb_anggota WHERE id_anggota='$id_anggota'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil : Ubah Data</title>
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
                        <img src="foto_anggota/<?php echo $pecah['foto']; ?>">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="about-content">
                        <h2>Edit Data</h2>
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" class=" control-label col-md-3">Nama</label>
                                <div class="col-md-12">
                                    <input type="text" name="nama" value="<?php echo $pecah['nama_anggota']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="" class=" control-label col-md-3">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" value="<?php echo $pecah['email_anggota']; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class=" form-group">
                                <label for="" class=" control-label col-md-3">Telepon/Hp</label>
                                <div class="col-md-12">
                                    <input type="text" name="telepon" value="<?php echo $pecah['no_hp_anggota']; ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class=" form-group">
                                <label for="" class=" control-label col-md-3">Alamat</label>
                                <div class="col-md-12">
                                    <textarea name="alamat" cols="30" rows="10" class=" form-control" required><?php echo $pecah['alamat']; ?></textarea>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="" class=" control-label col-md-3">Foto Baru</label>
                                <div class="col-md-12">
                                    <input type="file" name="foto_anggota" class="form-control">
                                </div>
                            </div>
                            <div class=" form-group">
                                <div class=" col-md-12 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Simpan</button>
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
                            $telepon = htmlspecialchars($_POST["telepon"], ENT_QUOTES);
                            $alamat = strip_tags($_POST["alamat"], '<b><i>');

                            if (!empty($nama_foto)) {
                                if (strlen($nama_foto)) {
                                    //Perintah untuk mengecek format gambar.
                                    list($txt, $ext) = explode(".", $nama_foto);
                                    if (in_array($ext, $valid)) {
                                        if ($size < (1024 * 1024 * 5)) {
                                            $lokasi     = $_FILES["foto_anggota"]["tmp_name"]; //Mengambil foto.
                                            if (move_uploaded_file($lokasi, $folder . $nama_foto)) {
                                                $konek->query("UPDATE tb_anggota SET nama_anggota='$nama', email_anggota='$email', no_hp_anggota='$telepon', alamat='$alamat' ,foto='$nama_foto' WHERE id_anggota='$id_anggota'");
                                                echo "<script>alert('Terima Kasih, Data Profil Anda Berhasil Di Ubah.')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                                session_start(); //menyimpan data ke dalam session.
                                                //Artinya : Saat query dijalankan dan kita sudah siap untuk melakukan ubah data, maka kita buka sessionnya untuk menyimpan pembaruan data kita, lalu saat
                                                //itu juga kita ubah bersama session baru yang barusan disimpan(diperbarui datanya).
                                                echo "<script>location='profil'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
                                            } else {
                                                echo "<script>alert('ERROR : Data Tidak Tersimpan');</script>";
                                                echo "<script>location='profil'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
                                            }
                                        } else {
                                            echo "<script>alert('ERROR : File Maksimal 2MB');</script>";
                                            echo "<script>location='profil'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
                                        }
                                    } else {
                                        echo "<script>alert('ERROR : Format Gambar Tidak Valid, Format Harus(png, jpg, jpeg)');</script>";
                                        echo "<script>location='profil'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
                                    }
                                }
                            } else {
                                //Mengubah produk tanpa harus mengubah foto kita.
                                $data =  $konek->query("UPDATE tb_anggota SET nama_anggota='$nama', email_anggota='$email', no_hp_anggota='$telepon', alamat='$alamat' WHERE id_anggota='$id_anggota'"); //Artinya apabila kita mengubah data produk kita, TANPA mengubah fotonya maka script ini yang akan dijalankan.
                                if ($data) {
                                    echo "<script>alert('Terima Kasih, Data Profil Anda Berhasil Di Ubah.')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                    session_start(); //menyimpan data ke dalam session.
                                    //Artinya : Saat query dijalankan dan kita sudah siap untuk melakukan ubah data, maka kita buka sessionnya untuk menyimpan pembaruan data kita, lalu saat
                                    //itu juga kita ubah bersama session baru yang barusan disimpan(diperbarui datanya).
                                    echo "<script>location='profil'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
                                } else {
                                    echo "<script>alert('Maaf, Data Tidak Dapat Di Perbarui')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                    echo "<script>location='ubah_data_pelanggan'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
                                }
                            }
                        }
                        ?>
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