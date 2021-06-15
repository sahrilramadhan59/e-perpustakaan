<?php
include "koneksi.php";
?>
<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Edit Data Password</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input type="password" name="password_lama" class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" name="password_baru" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" name="konfirmasi_password" class="form-control" required>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["ubah"])) {
                                $password_baru = strip_tags($_POST["password_baru"]);
                                $password_lama = strip_tags($_POST["password_lama"]);
                                $konfirmasi_password = strip_tags($_POST["konfirmasi_password"]);

                                //Cek Validasi Password Lama
                                $id_petugas = $_SESSION["petugas"]["id_petugas"]; //Ambil Id_Petugas Di Dalam Session.
                                $ambil = $konek->query("SELECT * FROM petugas WHERE id_petugas='$id_petugas' AND password=md5('$password_lama')");
                                $cek_pass = $ambil->num_rows;

                                //Jika Tidak ada Pass yang sesuai 
                                if (!$cek_pass >= 1) {
                                    echo "<script>alert('Maaf, Password Lama Anda Tidak Sesuai');</script>";
                                    echo "<script>location='index.php?halaman=ubah_password'</script>";
                                }
                                //Jika Kolom Pass Baru Dan Konfirmasi Kosong.
                                elseif (empty($password_baru) || empty($konfirmasi_password)) {
                                    echo "<script>alert('Maaf, Password Baru Atau Konfirmasi Password Tidak Di Isi');</script>";
                                    echo "<script>location='index.php?halaman=ubah_password'</script>";
                                }
                                //Jika Pass Baru Dan Pass Lama Tidak Sesuai 
                                elseif ($password_baru != $konfirmasi_password) {
                                    echo "<script>alert('Maaf, Password Baru Atau Konfirmasi Password Tidak Sama');</script>";
                                    echo "<script>location='index.php?halaman=ubah_password'</script>";
                                }
                                //Selain Itu. Atau jika password baru dan konfirmasi password sama. 
                                else {
                                    $konek->query("UPDATE petugas SET password=md5('$password_baru') WHERE id_petugas='$id_petugas'");
                                    echo "<script>alert('Terima Kasih, Password Berhasil Di Perbarui.')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                    session_start(); //menyimpan data ke dalam session.
                                    //Artinya : Saat query dijalankan dan kita sudah siap untuk melakukan ubah data, maka kita buka sessionnya untuk menyimpan pembaruan data kita, lalu saat
                                    //itu juga kita ubah bersama session baru yang barusan disimpan(diperbarui datanya).
                                    echo "<script>location='index.php?halaman=logout'</script>"; //Redirect(Melakukan) Kembali ke Halaman Login.
                                    session_destroy();
                                }
                            }
                            ?>
                        </div>
                        <!-- /.card -->
                        <!-- Horizontal Form -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->