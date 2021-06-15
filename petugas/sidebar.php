<?php
if (!isset($_SESSION['petugas'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    echo "<script>alert('Anda Harus Login !!!')</script>";
    echo "<script>location='login'</script>"; //mengalihkan secara paksa ke dalam form login untuk memastikan apakah yang login admin atau bukan. jika admin maka akan dialihkan ke dashboard administrator. dan jika bukan maka akan di alihkan ke form login untuk login kembali.
    exit();
}
?>
<?php
include('koneksi.php');
$id_petugas = $_SESSION['petugas']['id_petugas'];
$ambil_akses_petugas = $konek->query("SELECT * FROM petugas INNER JOIN akses_petugas ON petugas.id_akses=akses_petugas.id_akses 
WHERE petugas.id_petugas='$id_petugas'");
$pecah_akses = $ambil_akses_petugas->fetch_assoc();
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="index" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    HOME
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Forms
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if ($pecah_akses['id_akses'] == "1") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=tambahbuku" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Buku</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "3") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=tambah_kategori" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Kategori</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "4") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=tambah_pengarang" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Pengarang</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "2") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=tambah_penerbit" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Penerbit</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "5") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=tambah_peminjaman" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Peminjaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./qr_peminjaman/index.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Scan Peminjaman</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "6") { ?>
                    <li class="nav-item">
                        <a href="./qr_pengembalian/index.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengembalian Buku</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Tables
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if ($pecah_akses['id_akses'] == "1") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=buku" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Buku</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "2") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=penerbit_buku" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Penerbit</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "3") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=kategori_buku" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Kategori</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "4") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=pengarang_buku" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pengarang</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "5") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=data_peminjaman" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Peminjaman Buku</p>
                        </a>
                    </li>
                <?php } elseif ($pecah_akses['id_akses'] == "6") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=data_pengembalian" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pengembalian Buku</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <!-- MEMBUAT KOTAK MASUK -->
        <?php
        $pesan_baru = mysqli_query($konek, "SELECT * FROM chat WHERE id_penerima='$id_petugas' AND baca_pesan='Belum'");
        $jumlah_pesan_baru = mysqli_num_rows($pesan_baru);
        ?>
        <?php if ($jumlah_pesan_baru == 0) { ?>
            <li class="nav-item has-treeview">
                <a href="index.php?halaman=kotak_masuk" class="nav-link">
                    <i class="nav-icon fas fa-inbox"></i>
                    <p>
                        Kotak Surat
                    </p>
                </a>
            </li>
        <?php } else if ($jumlah_pesan_baru > 0) { ?>
            <li class="nav-item has-treeview">
                <a href="index.php?halaman=kotak_masuk" style="color:red;" class="nav-link">
                    <i class="nav-icon fas fa-inbox"></i>
                    <p>
                        Kotak Surat <?php echo $jumlah_pesan_baru; ?>
                    </p>
                </a>
            </li>
        <?php } ?>
        <!-- AKHIR MEMBUAT KOTAK MASUK -->
        <li class="nav-header">Data Diri</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Data Pribadi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?halaman=data_pribadi" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=kontak" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Contacts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=ubah_password" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ubah Password</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>