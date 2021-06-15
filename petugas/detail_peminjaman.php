<?php
include "koneksi.php";
?>
<?php
include "enkripsi.php";
$id_peminjaman = decrypt($_GET["id"]);
$ambil = $konek->query("SELECT peminjaman.kode_pinjam, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.jumlah, 
tb_anggota.id_anggota, tb_anggota.nama_anggota, tb_anggota.email_anggota, tb_anggota.no_hp_anggota, buku.id_buku, buku.judul_buku, 
buku.tahun_buku, penerbit.id_penerbit, penerbit.nama_penerbit, pengarang.id_pengarang, pengarang.nama_pengarang, kategori.id_kategori, 
kategori.nama_kategori, petugas.id_petugas, petugas.nama_petugas, petugas.email_petugas, petugas.no_hp, petugas.alamat, 
detail_peminjaman.qr_code FROM detail_peminjaman 
INNER JOIN peminjaman ON detail_peminjaman.kode_pinjam=peminjaman.kode_pinjam
INNER JOIN tb_anggota ON detail_peminjaman.id_anggota=tb_anggota.id_anggota
INNER JOIN buku ON detail_peminjaman.id_buku=buku.id_buku
INNER JOIN penerbit ON detail_peminjaman.id_penerbit=penerbit.id_penerbit
INNER JOIN pengarang ON detail_peminjaman.id_pengarang=pengarang.id_pengarang
INNER JOIN kategori ON detail_peminjaman.id_kategori=kategori.id_kategori
INNER JOIN petugas ON detail_peminjaman.id_petugas=petugas.id_petugas
INNER JOIN status_peminjaman ON status_peminjaman.kode_status_pinjam=peminjaman.kode_status_pinjam
WHERE detail_peminjaman.kode_pinjam='$id_peminjaman'");
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
                        <h1>Detail Peminjaman Buku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Detail Peminjaman</li>
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
                        <h3 class="my-3">Data Peminjam</h5>
                            <hr>
                            <p class="text text-md">Nama : <?php echo $pecah['nama_anggota']; ?></p>
                            <p class="text text-md">Email : <?php echo $pecah['email_anggota']; ?></p>
                            <p class="text text-md">No Hp : <?php echo $pecah['no_hp_anggota']; ?></p>
                            <p class="text text-md">Tgl Pinjam : <?php echo $pecah['tgl_pinjam']; ?></p>
                            <p class="text text-md">Tgl Kembali : <?php echo $pecah['tgl_kembali']; ?></p>
                            <p class="text text-md">Jumlah Buku : <?php echo $pecah['jumlah']; ?></p>
                            <p class="text text-md">Alamat : <?php echo $pecah['alamat']; ?></p>
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
                        <h3 class="my-3">Petugas</h5>
                            <hr>
                            <p class="text text-md">Nama : <?php echo $pecah['nama_petugas']; ?></p>
                            <p class="text text-md">Email : <?php echo $pecah['email_petugas']; ?></p>
                            <p class="text text-md">No Hp : <?php echo $pecah['no_hp']; ?></p>
                            <p class="text text-md">Alamat : <?php echo $pecah['alamat']; ?></p>
                    </div>
                </div>
                <a href="cetak.php" target=" _blank" class="btn btn-primary"><i class="fas fa-print"></i> CETAK</a>
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