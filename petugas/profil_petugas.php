<?php
include "koneksi.php";
include "enkripsi.php";
?>
<?php
$id_petugas = decrypt(strip_tags($_GET["id"]));
$ambil = $konek->query("SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
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
                        <h1>Detail Profil Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Detail Profil Petugas</li>
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
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="../foto_petugas/<?php echo $pecah['foto']; ?>" class="product-image"
                                alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3"><?php echo $pecah['nama_petugas']; ?></h3>
                        <hr>
                        <h4>Email</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['email_petugas']; ?></p>
                        </div>
                        <hr>
                        <h4>Jenis Kelamin</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['jenis_kelamin']; ?></p>
                        </div>

                        <hr>
                        <h4 class="mt-3">Nomor Hp</h4>
                        <div class="btn-group btn-group-toggle">
                            <?php
                            if ($pecah['no_hp'] == "-") {
                                echo $pecah['no_hp'];
                            } else { ?>
                            <p class="text text-md"><?php echo $pecah['no_hp']; ?> &nbsp;
                                <a
                                    href="https://api.whatsapp.com/send?phone=<?php echo $pecah['no_hp']; ?> &text=Hai%20<?php echo $pecah['nama_petugas']; ?>">Hubungi
                                    Saya Di Wa <i class="fab fa-whatsapp"></i></a>
                            </p>
                            <?php } ?>
                        </div>
                        <hr>
                        <h4 class="mt-3">Alamat</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['alamat']; ?></p>
                        </div>

                        <hr>
                        <h4 class="mt-3">Terakhir Login</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <?php if ($pecah['online'] == "Sedang Aktif") { ?>
                            <p class="text text-md text-info">Sedang Aktif</p>
                            <?php } else { ?>
                            <p class="text text-md text-danger"><?php echo $pecah['tanggal']; ?>,
                                <?php echo $pecah['bulan']; ?> <?php echo $pecah['tahun']; ?></p>
                            <?php } ?>
                        </div>

                        <hr>
                        <h4 class="mt-3">Status</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <!-- Membuat Relasi Petugas Untuk Mengetahui Status Petugas -->
                            <?php
                            //Buat Query nya.
                            $ambil_status = $konek->query("SELECT status_petugas.nama_status FROM status_petugas INNER JOIN petugas ON 
                            petugas.id_status=status_petugas.id_status 
                            WHERE petugas.id_petugas = '$id_petugas'");
                            $pecah_status = $ambil_status->fetch_assoc();
                            //Artinya ambil data dari tabel status petugas hanya nama statusnya saja dari tabel status_petugas join ke petugas.
                            //Lalu pecahkan menjadi array.

                            // Jika status petugas aktif maka kaasih tau dan berikan warna biru untuk menandakan dia aktif.
                            if ($pecah_status['nama_status'] == "Aktif") { ?>
                            <p class="text text-md text-info"><?php echo $pecah_status['nama_status']; ?></p>

                            <!-- Selain itu(artinya dia tidak aktif, maka tampilkan dengan warna merah) yang menandakan dia sudah tidak aktif -->
                            <?php } else { ?>
                            <p class="text text-md text-danger"><?php echo $pecah_status['nama_status']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.row -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->