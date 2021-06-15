<?php include('koneksi.php'); ?>
<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Pengarang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Tambah Pengarang Buku</li>
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
                                <h3 class="card-title">Form Tambah Pengarang Buku</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pengarang</label>
                                        <input type="text" name="nama_pengarang" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No Hp</label>
                                        <input type="text" name="no_hp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Foto</label>
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
                                    <button class="btn btn-primary" name="simpan"><i class=" fas fa-save"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            //Jika ada tombol simpan(tombol simpan di tekan)
                            if (isset($_POST["simpan"])) {
                                //Membuat Untuk Menyimpan Foto(Upload Foto).
                                $nama_foto = $_FILES["foto"]["name"]; //Menamai foto yang akan kita ingin upload(Ini juga bisa di upload ke database).
                                $lokasi = $_FILES["foto"]["tmp_name"]; //Mengambil foto.
                                move_uploaded_file($lokasi, "../foto_pengarang/" . $nama_foto); //Menentukan dimana foto akan di upload.

                                $nama_pengarang = strip_tags($_POST["nama_pengarang"]);
                                $no_hp = strip_tags($_POST["no_hp"]);
                                $alamat = strip_tags($_POST["alamat"]);

                                $konek->query("INSERT INTO pengarang(nama_pengarang, no_hp, alamat, foto_pengarang)
                                VALUES('$nama_pengarang','$no_hp','$alamat','$nama_foto')");

                                echo "<div class='alert alert-info'>Data Tersimpan</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pengarang_buku'>";
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