<section id="team" class="team section-bg">
    <div class="container">
        <div class="section-header">
            <h3>Masuk</h3>
            <p>Silakan Masuk Dengan Username Dan Password Anda Untuk Memulai Minjam Buku Dengan Nyaman, Mudah, Dan Fleksibel.</p>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 wow fadeInUp">
                <form method="post">
                    <div class="form-group">
                        <label><i class="fa fa-user"></i> Email</label>
                        <input type="email" name="email" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button class="btn btn-primary" name="login">LOGIN</button>
                </form>
                <?php
                include "koneksi/koneksi.php";
                // Jika tombol Simpan di tekan(ada masukan dari tombol simpan).
                if (isset($_POST['login'])) {
                    $email = strip_tags($_POST['email']);
                    $password = strip_tags($_POST['password']);
                    // Lakukan Query untuk ngecek akun di tabel pelanggan pada database.
                    $ambil = $konek->query("SELECT * FROM tb_anggota WHERE email_anggota= '$email' AND password_anggota= md5('$password')");

                    // Ngitung akun yang terambil(Cocok pada database).
                    $akunyangcocok = $ambil->num_rows;

                    // Jika 1 akun yang cocok, maka di loginkan(Di Masukan).
                    if ($akunyangcocok == 1) {
                        // Anda Sudah Login.
                        // Mendapatkan akun dalam bentuk array.
                        $akun = $ambil->fetch_assoc();
                        // Kemudian, simpan di SESSION pelanggan.
                        $_SESSION["anggota"] = $akun;
                        $id_anggota = $_SESSION["anggota"]["id_anggota"];
                        //Jika sudah belanja, atau sudah ada masukan belanja.
                        if (isset($_SESSION["keranjang"]) or !empty($_SESSION["keranjang"])) { //maka 
                            echo "<script>location = 'checkout';</script>"; //larikan ke checkout untuk pembayaran.
                        } else { //Selain itu, maka larikan saja ke riwayat untuk melihat sudah pernah beli apa saja.
                            echo "<script>location = 'riwayat';</script>";
                        }
                        echo "<script>alert('Anda Berhasil Login');</script>";
                        $konek->query("UPDATE tb_anggota SET online='Sedang Aktif' WHERE id_anggota='$id_anggota'");
                        echo "<script>location = 'checkout'</script>";
                    }
                    // Selain itu.
                    else {
                        // Anda Gagal Login.
                        echo "<script>alert('Anda Belum Terdaftar');</script>";
                        echo "<script>location = 'daftar'</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>