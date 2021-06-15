<?php
include "koneksi.php";
?>
<?php
include "enkripsi.php";
$kode_kembali = decrypt($_GET["id"]);
$ambil = $konek->query("SELECT tb_anggota.nama_anggota, tb_anggota.email_anggota, tb_anggota.no_hp_anggota, tb_anggota.alamat,
buku.judul_buku, buku.tahun_buku, penerbit.nama_penerbit, pengarang.nama_pengarang, kategori.nama_kategori, pengembalian.denda, 
pengembalian.keterlambatan, status_peminjaman.status, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.kode_pinjam, 
peminjaman.jumlah, detail_peminjaman.id_detail_pinjam, detail_peminjaman.kode_pinjam FROM detail_pengembalian 
INNER JOIN pengembalian ON pengembalian.kode_kembali=detail_pengembalian.kode_kembali
INNER JOIN tb_anggota ON tb_anggota.id_anggota=pengembalian.id_anggota
INNER JOIN buku ON buku.id_buku=pengembalian.id_buku
INNER JOIN kategori ON kategori.id_kategori=pengembalian.id_kategori
INNER JOIN penerbit ON penerbit.id_penerbit=pengembalian.id_penerbit
INNER JOIN pengarang ON pengarang.id_pengarang=pengembalian.id_pengarang
INNER JOIN status_peminjaman ON status_peminjaman.kode_status_pinjam=pengembalian.kode_status_pinjam
INNER JOIN detail_peminjaman ON detail_peminjaman.id_detail_pinjam=pengembalian.id_detail_pinjam
INNER JOIN peminjaman ON peminjaman.kode_pinjam=detail_peminjaman.kode_pinjam
WHERE detail_pengembalian.kode_kembali='$kode_kembali'");
$pecah = $ambil->fetch_assoc();
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
                        <h1>Detail Pengembalian Buku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Detail Pengembalian Buku</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="my-3">Data Anggota</h5>
                            <hr>
                            <p class="text text-md">Nama : <?php echo $pecah['nama_anggota']; ?></p>
                            <p class="text text-md">Email : <?php echo $pecah['email_anggota']; ?></p>
                            <p class="text text-md">No Hp : <?php echo $pecah['no_hp_anggota']; ?></p>
                            <p class="text text-md">Alamat : <?php echo $pecah['alamat']; ?></p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="my-3">Data Pinjam Buku</h5>
                            <hr>
                            <p class="text text-md">Tgl Pinjam : <?php echo $pecah['tgl_pinjam']; ?></p>
                            <p class="text text-md">Tgl Kembali : <?php echo $pecah['tgl_kembali']; ?></p>
                            <p class="text text-md">Jumlah Buku : <?php echo $pecah['jumlah']; ?></p>
                            <p class="text text-md text-success">Status : <?php echo $pecah['status']; ?></p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="my-3">Buku</h5>
                            <hr>
                            <p class="text text-md">Judul : <?php echo $pecah['judul_buku']; ?></p>
                            <p class="text text-md">Tahun : <?php echo $pecah['tahun_buku']; ?></p>
                            <p class="text text-md">Penerbit : <?php echo $pecah['nama_penerbit']; ?></p>
                            <p class="text text-md">Pengarang : <?php echo $pecah['nama_pengarang']; ?></p>
                            <p class="text text-md">Kategori : <?php echo $pecah['nama_kategori']; ?></p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="my-3">Denda</h5>
                            <hr>
                            <p class="text text-md">Telat : <?php echo $pecah['keterlambatan']; ?> Hari</p>
                            <p class="text text-md">Denda : Rp. <?php echo number_format($pecah['denda']); ?>,-</p>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="my-3">Cetak</h5>
                            <hr>
                            <a href="cetak_pengembalian.php" target=" _blank" class="btn btn-primary"><i class="fas fa-print"></i> CETAK</a>
                    </div>
                </div>
                <!-- <pre>
                <? //php print_r($pecah['id_detail_pinjam']); 
                ?>
                </pre> -->
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- ./wrapper -->