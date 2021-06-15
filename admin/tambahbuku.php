  <?php include('../koneksi/koneksi.php'); ?>
  <div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Buku</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Form Tambah Buku</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Tambah Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" enctype="multipart/form-data">
                  <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                  <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                  <div class="card-body">
                    <div class="form-group">
                      <label>Judul Buku *</label>
                      <input type="text" name="judul_buku" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Penerbit *</label>
                      <select name="penerbit" class="form-control">
                        <option value="">----Pilih-------</option>
                        <?php $ambil = $konek->query("SELECT * FROM penerbit"); ?>
                        <?php while ($pecah_penerbit = $ambil->fetch_assoc()) { ?>
                          <option value="<?php echo $pecah_penerbit['id_penerbit']; ?>"><?php echo $pecah_penerbit['nama_penerbit'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pengarang *</label>
                      <select name="pengarang" class="form-control">
                        <option value="">----Pilih-------</option>
                        <?php $ambil = $konek->query("SELECT * FROM pengarang"); ?>
                        <?php while ($pecah_pengarang = $ambil->fetch_assoc()) { ?>
                          <option value="<?php echo $pecah_pengarang['id_pengarang']; ?>"><?php echo $pecah_pengarang['nama_pengarang'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tahun Buku *</label>
                      <input type="number" name="tahun_buku" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Kategori *</label><br>
                      <select name="kategori" class="form-control">
                        <option value="">----Pilih-------</option>
                        <?php $ambil = $konek->query("SELECT * FROM kategori"); ?>
                        <?php while ($pecah_kategori = $ambil->fetch_assoc()) { ?>
                          <option value="<?php echo $pecah_kategori['id_kategori']; ?>"><?php echo $pecah_kategori['nama_kategori'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>stock *</label>
                      <input type="number" name="stock" class="form-control" min="1">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Foto *</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                          <label class="custom-file-label" for="exampleInputFile">Pilih File Foto</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button class="btn btn-primary" name="simpan"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                  </div>
                </form>
                <?php
                //Jika ada tombol simpan(tombol simpan di tekan)
                if (isset($_POST["simpan"])) {
                  //Membuat Untuk Menyimpan Foto(Upload Foto).
                  $nama_foto = $_FILES["foto"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                  $lokasi = $_FILES["foto"]["tmp_name"]; //Mengambil foto.
                  move_uploaded_file($lokasi, "../foto_buku/" . $nama_foto); //Menentukan dimana foto akan di upload.

                  $stok = strip_tags($_POST["stock"]);
                  $judul_buku = strip_tags($_POST["judul_buku"]);
                  $penerbit = strip_tags($_POST["penerbit"]);
                  $pengarang = strip_tags($_POST["pengarang"]);
                  $tahun_buku = strip_tags($_POST["tahun_buku"]);
                  $kategori = strip_tags($_POST["kategori"]);

                  $konek->query("INSERT INTO buku(judul_buku, id_penerbit, id_pengarang, tahun_buku, id_kategori, stock_buku, foto_buku)
                                VALUES('$judul_buku','$penerbit','$pengarang','$tahun_buku','$kategori','$stok','$nama_foto')");

                  echo "<div class='alert alert-info'>Data Tersimpan</div>";
                  echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=buku'>";
                }
                ?>
              </div>
              <!-- /.card -->
              <!-- Horizontal Form -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->