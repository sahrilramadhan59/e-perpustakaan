<?php
include "../koneksi/koneksi.php";
?>
<?php
$id_admin = strip_tags($_SESSION["admin"]["id_admin"]);
$ambil = $konek->query("SELECT * FROM tb_admin WHERE id_admin='$id_admin'");
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
              </div>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../foto_admin/<?php echo $pecah['foto_admin']; ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $pecah['nama']; ?></h3>
                <p class="text-muted text-center">Software Engineer</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Level</b> <a class="float-right"><?php echo $pecah['tingkatan_admin']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Hobi</b> <a class="float-right">Code</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right">Belum Menikah</a>
                  </li>
                  <li class="list-group-item">
                    <a href="index.php?halaman=edit_data_pribadi&id=<?php echo base64_encode($pecah['id_admin']); ?>" class="btn btn-warning"><i class="fas fa-edit"> </i> Ubah</a>
                  </li>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  FAKULTAS TEKNOLOGI KOMUNIKASI INFORMASI dengan Jurusan SISTEM INFORMASI didalam UNIVERSITAS NASIONAL
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i>Alamat Rumah</strong>

                <p class="text-muted"><?php echo $pecah['alamat']; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills Yang Di Kuasai</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">Bahasa Pemograman Java,</span>
                  <span class="tag tag-success">Bahasa Pemograman PHP,</span>
                  <span class="tag tag-danger">MYSQL</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Catatan Singkat</strong>

                <p class="text-muted">
                  Selama Saya Masih Hidup Maka Saya Harus Semangat, Terus Belajar Dengan Tekun, Dan Ingat Berdo'a Kepada Tuhan(ALLAH SWT).
                  KEEP SMILE, KEEP HUMBLE, AND KEEP SPIRIT.
                </p>
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