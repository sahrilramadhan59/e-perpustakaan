<?php
include "koneksi.php";
include "enkripsi.php";
?>
<?php
$id_petugas = strip_tags($_SESSION["petugas"]["id_petugas"]);
$ambil = $konek->query("SELECT * FROM petugas INNER JOIN status_petugas ON petugas.id_status=status_petugas.id_status 
INNER JOIN akses_petugas ON petugas.id_akses=akses_petugas.id_akses 
WHERE petugas.id_petugas='$id_petugas'");
$pecah = $ambil->fetch_assoc();
?>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Diri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profil Saya</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../foto_petugas/<?php echo $pecah['foto']; ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $pecah['nama_petugas']; ?></h3>
                <p class="text-muted text-center">Petugas E-Perpustakaan</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right"><?php echo $pecah['nama_status']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Akses</b> <a class="float-right"><?php echo $pecah['nama_akses']; ?></a>
                  </li>
                  <a href="index.php?halaman=edit_data_pribadi&id=<?php echo encrypt($pecah['id_petugas']); ?>" class="btn btn-warning"><i class="fas fa-edit"> </i> Ubah Data</a>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <div class="col-md-8">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tentang Saya</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-map-marker-alt mr-1"></i>Alamat Rumah</strong>

                <p class="text-muted"><?php echo $pecah['alamat']; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>

                <p class="text-muted">
                  <?php echo $pecah['email_petugas']; ?>
                </p>
                <hr>
                <strong><i class="fab fa-whatsapp mr-1"></i> Nomor Hp</strong>

                <p class="text-muted">
                  <?php echo $pecah['no_hp']; ?>
                </p>
                <hr>
                <strong><i class="fas fa-qrcode mr-1"></i> KODE QR SAYA : <?php echo $pecah['nama_petugas']; ?></strong><br>
                <?php if ($pecah['qr_code']) {
                ?><img class="img img-thumbnail img-lg" src="../Folder_QRCode_Petugas_Perpus/<?php echo $pecah['qr_code']; ?>">
                  <br><br><br><br><br>&nbsp;<a href="download.php?kode_qr=<?= $pecah['qr_code'] ?>" class="btn btn-primary btn-md">Simpan</a>
                <?php } else { ?>
                  <p class="text-muted">Maaf Kode QR anda belum dibuat, hubungi kepada pihak administrator Kami. Terima Kasih.</p>
                <?php } ?>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->

          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->