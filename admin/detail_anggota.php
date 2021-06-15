<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
?>
<?php
$id_anggota = decrypt(strip_tags($_GET["id"]));
$ambil = $konek->query("SELECT * FROM tb_anggota WHERE id_anggota='$id_anggota'");
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
                        <h1>Detail Profil Anggota</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Detail Profil Anggota</li>
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
                            <img src="../foto_anggota/<?php echo $pecah['foto']; ?>" class="product-image" title="<?php echo $pecah['nama_anggota']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h4>Email</h4>
                        <p class="text text-md"><?php echo $pecah['email_anggota']; ?></p>
                        <hr>
                        <h4>Nama</h4>
                        <p class="text text-md"><?php echo $pecah['nama_anggota']; ?></p>
                        <hr>
                        <h4>Jenis Kelamin</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['jenis_kelamin']; ?></p>
                        </div>

                        <hr>
                        <h4 class="mt-3">Nomor Hp</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <?php
                            if ($pecah['no_hp_anggota'] == "-") {
                                echo $pecah['no_hp_anggota'];
                            } else { ?>
                                <p class="text text-md"><?php echo $pecah['no_hp_anggota']; ?> &nbsp;
                                    <a href="https://api.whatsapp.com/send?phone=<?php echo $pecah['no_hp_anggota']; ?> &text=Hai%20<?php echo $pecah['nama_petugas']; ?>">Hubungi Saya Di Wa <i class="fab fa-whatsapp"></i></a>
                                </p>
                            <?php } ?>
                        </div>

                        <hr>
                        <h4 class="mt-3">Alamat</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <p class="text text-md"><?php echo $pecah['alamat']; ?></p>
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