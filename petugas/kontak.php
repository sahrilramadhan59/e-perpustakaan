<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kontak Profil Petugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Kontak Profil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                    <?php
          include('koneksi.php');
          include('enkripsi.php');
          $id_petugas_saya = $_SESSION["petugas"]["id_petugas"];
          $ambil = $konek->query("SELECT * FROM petugas INNER JOIN akses_petugas ON petugas.id_akses=akses_petugas.id_akses");
          while ($pecah = $ambil->fetch_assoc()) {
          ?>
                    <?php if ($pecah["id_petugas"] != $id_petugas_saya) {  ?>
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                Petugas E-Perpustakaan
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b><?php echo $pecah['nama_petugas']; ?></b></h2>
                                        <p class="text-muted text-sm"><b>Akses Saya: </b>
                                            <?php echo $pecah['nama_akses']; ?> </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span> Address:
                                                <?php echo $pecah['alamat']; ?></li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span> Phone :
                                                <?php echo $pecah['no_hp']; ?></li>
                                            <?php if ($pecah['online'] == "Sedang Aktif") { ?>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-eye"></i></span> Terakhir Dilihat : <p
                                                    class="text-info"><?php echo $pecah['online']; ?></p>
                                            </li>
                                            <?php } else { ?>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-eye"></i></span> Terakhir Dilihat : <br>
                                                <p class=" text-danger"> <?php echo $pecah['tanggal']; ?>,
                                                    <?php echo $pecah['bulan']; ?> <?php echo $pecah['tahun']; ?></p>
                                            </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="../foto_petugas/<?php echo $pecah['foto']; ?>" alt=""
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <?php
                      if ($pecah['id_status'] == "1") { ?>
                                    <a href="index.php?halaman=chat&id=<?php echo encrypt(strip_tags($pecah['id_petugas'])); ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Chat
                                    </a>
                                    <a href="index.php?halaman=profil_petugas&id=<?php echo encrypt(strip_tags($pecah['id_petugas'])); ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Kunjungi
                                    </a>
                                    <?php } else { ?>
                                    <a href="index.php?halaman=profil_petugas&id=<?php echo encrypt(strip_tags($pecah['id_petugas'])); ?>"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-user"></i> Kunjungi
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer"> -->

                    <!-- /.card-footer -->
                    <!-- </div> -->
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->