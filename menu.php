<header id="header">

    <div id="topbar">
        <div class="container">
            <div class="social-links">
                <a href="https://bit.ly/39r5JHG" class="twitter"><i class="fa fa-youtube"></i></a>
                <a href="https://bit.ly/3arO9mS" class="facebook"><i class="fa fa-instagram"></i></a>
                <a href="https://github.com/syahrilramadhan775" class="instagram"><i class="fab fa-github"></i></a>
                <a href="https://bit.ly/2x9rkpU" class="linkedin"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="logo float-left">
            <!-- Uncomment below if you prefer to use an image logo -->
            <h1 class="text-light"><a href="index?#hero" class="scrollto"><span>E-Perpustakaan</span></a></h1>
            <!-- <a href="#header" class="scrollto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
        </div>

        <nav class="main-nav float-right d-none d-lg-block">
            <ul>
                <li class="active"><a href="index?#hero"><i class="fas fa-home fa-2x"></i></a></li>
                <!-- Jika sudah login(ada session pelanggan) -->
                <?php if (isset($_SESSION["anggota"])) : ?>
                    <li class="drop-down"><a href=""><?php echo $_SESSION["anggota"]["nama_anggota"] ?></a>
                        <ul>
                            <li><a href="riwayat">Riwayat Peminjaman</a></li>
                            <li><a href="profil">Profil</a></li>
                            <li><a href="logout">Keluar</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li><a href="index?#about">Tentang Kami</a></li>
                    <li><a href="index?#team">Masuk</a></li>
                    <li><a href="daftar">Daftar</a></li>
                <?php endif ?>
                <li><a href="index?#portfolio">Buku</a></li>
                <li><a href="peminjaman">Pinjam Buku</a></li>
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header>