<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    HOME
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Diagram
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?halaman=chart" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Diagram</p>
                    </a>
                </li>
            </ul>
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
                <li class="nav-item">
                    <a href="index.php?halaman=tambah_kategori" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=tambah_pengarang" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Pengarang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=tambah_penerbit" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Penerbit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=tambah_petugas" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Petugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=tambah_peminjaman" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Peminjaman</p>
                    </a>
                </li>
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
                <li class="nav-item">
                    <a href="index.php?halaman=buku" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=penerbit_buku" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Penerbit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=kategori_buku" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=pengarang_buku" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Pengarang</p>
                    </a>
                </li>
                <?php if ($_SESSION['admin']['tingkatan_admin'] == "Super Admin") { ?>
                    <li class="nav-item">
                        <a href="index.php?halaman=data_admin" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Admin</p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="index.php?halaman=data_petugas" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Petugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=data_peminjaman" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Peminjaman Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=data_anggota" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Anggota</p>
                    </a>
                </li>
            </ul>
        </li>
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
                <?php if ($_SESSION['admin']['tingkatan_admin'] == "Super Admin") {  ?>
                    <!-- Jika yang masuk tingkatannya super admin maka, -->
                    <!-- Berhak untuk melihat Kontak -->
                    <li class="nav-item">
                        <a href="index.php?halaman=kontak" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Contacts</p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>