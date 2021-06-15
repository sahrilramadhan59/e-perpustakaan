<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Pengembalian</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Pengembalian</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Pengembalian</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status Buku</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Memanggil koneksi.php -->
                                    <?php include "koneksi.php"; ?>
                                    <?php include "enkripsi.php"; ?>
                                    <?php $ambil = $konek->query("SELECT * FROM pengembalian
                                    INNER JOIN tb_anggota ON tb_anggota.id_anggota=pengembalian.id_anggota
                                    INNER JOIN detail_peminjaman ON detail_peminjaman.id_detail_pinjam=pengembalian.id_detail_pinjam  
                                    INNER JOIN buku ON buku.id_buku=pengembalian.id_buku 
                                    INNER JOIN kategori ON kategori.id_kategori=pengembalian.id_kategori
                                    INNER JOIN penerbit ON penerbit.id_penerbit=pengembalian.id_penerbit
                                    INNER JOIN pengarang ON pengarang.id_pengarang=pengembalian.id_pengarang 
                                    INNER JOIN status_peminjaman ON status_peminjaman.kode_status_pinjam=pengembalian.kode_status_pinjam");
                                    //Artinya kita memanggil koneksi.php lalu kita memanggil dan membuat query select pada database kita.
                                    //lalu dimasukan ke dalam variable $ambil.
                                    //tanda "$" mengartikan variable dan ambil itu adalah nama variablenya jadi $ambil adalah variable dengan nama ambil.
                                    ?>
                                    <?php $nomor = 1; ?>
                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo strip_tags($pecah['nama_anggota']); ?></td>

                                            <!-- Mengambil Data Peminjaman Dari Tabel Peminjaman -->
                                            <?php
                                            $id_detail = $pecah['id_detail_pinjam'];
                                            $ambil_peminjaman = $konek->query("SELECT peminjaman.kode_pinjam, peminjaman.tgl_pinjam, peminjaman.tgl_kembali FROM peminjaman 
                                            INNER JOIN detail_peminjaman ON peminjaman.kode_pinjam=detail_peminjaman.kode_pinjam 
                                            WHERE detail_peminjaman.id_detail_pinjam = '$id_detail'");
                                            $pecah_peminjaman = $ambil_peminjaman->fetch_assoc();
                                            ?>
                                            <!-- Akhir Mengambil Data Peminjaman Dari Tabel Peminjaman -->
                                            <td><?php echo strip_tags($pecah['status']); ?></td>
                                            <td>
                                                <a href="index.php?halaman=detail_pengembalian&id=<?php echo encrypt($pecah['kode_kembali']); ?>" class="btn-warning btn" title="Lihat Detail"><i class="fas fa-eye"> </i></a>
                                                <!-- Disini bisa di artikan setelah kita klik ubah, kita tidak akan mengubah semua data kita, melainkan -->
                                                <!-- kita hanya akan mengubah berdasarkan "id" yang kita pilih saja. -->
                                                <!-- Dari mana kok bisa si hanya dari "id" saja yang diubah ? kok gak semua yang ke ubah ? -->
                                                <!-- Ya !, karna "index.php?halaman=hapusproduk&id=<?php //echo $pecah['id_produk']; 
                                                                                                    ?>" ini akanlink kepada-->
                                                <!-- URL dan pada URLnya akan mengambil dari 1 nilai, dan nilai tersebut adalah nilai dari id_produk, -->
                                                <!-- yaitu field yang ada di dalam tabel produk. jadi bisa dibilang id itu dimasukan nilai id_produk dari -->
                                                <!-- field dari tabel produk kita, lalu si id nya ini menjadi perwakilan dari id_produk dan yang -->
                                                <!-- nantinya akan kita dapatkan 1 nilainya untuk proses ubah dan hapus ini. -->
                                            </td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status Buku</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- ./wrapper -->