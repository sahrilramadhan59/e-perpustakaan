<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verifikasi Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/img/logo.png">
    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <center>
        <h1>Hasil Verifikasi Petugas</h1>
    </center>
    <div class="panel-body">
        <?php
        $email = $_POST['email_petugas'];
        $ambil = $konek->query("SELECT * FROM petugas WHERE email_petugas='$email'");
        $cocok = $ambil->num_rows;
        if ($cocok == 1) {
            $_SESSION['petugas'] = $ambil->fetch_assoc();
            $id_petugas = $_SESSION["petugas"]["id_petugas"];
            //Jika status petugas aktif, maka diperbolehkan untuk akses.
            if ($_SESSION['petugas']['id_status'] == "1") {
                $konek->query("UPDATE petugas SET online='Sedang Aktif' WHERE id_petugas='$id_petugas'");
                echo "<center><strong>Login Sukses ! Data Terverifikasi !!</strong></center>";
                echo "<center><div class='alert alert-info'>Login Sukses</div></center>";
                echo "<script>alert('LOGIN SUKSES : Selamat Datang Petugas E-Perpustakaan')</script>";
                //Menampilkan notif sukses Login.
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                //Mengalihkan ke Dashboard Administrator(Halaman Admin).
            } else {
                //Selain itu, artinya status petugas tidak aktif, maka tidak diperbolehkan untuk akses.
                //atau tidak memiliki hak akses manapun maka.
                echo "<script>alert('LOGIN GAGAL : Maaf, Anda Sudah Tidak Di Perbolehkan Lagi')</script>";
                //Akan menampilkan notif Gagal Login.
                echo "<meta http-equiv='refresh' content='1;url=login.php'>"; //Dan akan di 
                //alihkan ke form login untuk memasukan data sesuai hak aksesnya.
                session_destroy();
            }
        } else {
        ?>
            <div class="alert alert-danger">
                <center>
                    <script>
                        alert('LOGIN GAGAL : Maaf, Data Tidak Di Temukan')
                    </script>
                    <strong>Maaf, Data tidak ditemukan..!</strong><br>
                    <a class="btn btn-danger" href="./qr_login">Kembali</a>
                </center>
            </div>
        <?php } ?>
    </div>
    </div>
    </div>
    </div>
</body>

</html>