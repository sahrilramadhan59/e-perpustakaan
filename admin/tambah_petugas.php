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
                        <h1>Tambah Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Tambah Petugas</li>
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
                                <h3 class="card-title">Form Tambah Petugas</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-group" role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Lengkap *</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin *</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-inline">
                                        <label>No Hp * : &nbsp;</label>
                                        <input type="text" name="nomor" class="form-control col-sm-1" readonly value="62">
                                        <input type="text" name="no_hp" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Akses Petugas</label>
                                        <select name="akses" class="form-control">
                                            <option value="">======Pilih========</option>
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM akses_petugas");
                                            while ($pecah_akses =  $ambil->fetch_assoc()) {
                                                if ($pecah_petugas['id_akses'] == $pecah_akses['id_akses']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_akses['id_akses'] . "'>" . $pecah_akses['nama_akses'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat *</label>
                                        <textarea name="alamat" cols="30" rows="10" class="form-control"></textarea>
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
                                move_uploaded_file($lokasi, "../foto_petugas/" . $nama_foto); //Menentukan dimana foto akan di upload.

                                $no_hp = strip_tags($_POST["no_hp"]);
                                $nomor = strip_tags($_POST["nomor"]);
                                $nomor_hp = $nomor . $no_hp; //Menggabungkan 2 String.

                                $nama = strip_tags($_POST["nama"]);
                                $email = strip_tags($_POST["email"]);
                                $pass = strip_tags($_POST["password"]);
                                $akses = strip_tags($_POST["akses"]);
                                $jenis_kelamin = strip_tags($_POST["jenis_kelamin"]);
                                $alamat = strip_tags($_POST["alamat"]);
                                $tanggal = date("d"); //Menset Tanggal Sekarang.
                                $bulan = date("F"); //Menset Bulan Sekarang.
                                $tahun = date("Y"); //Menset Tahun Sekarang.

                                //Mulai Melakukan Validasi Email.
                                $ambil_data_email = $konek->query("SELECT email_petugas FROM petugas WHERE email_petugas = '$email'");
                                $email_yang_cocok = $ambil_data_email->num_rows;
                                //Jika email yang Masukan sudah ada
                                if ($email_yang_cocok == 1) {
                                    echo "<script>alert('Email Yang Anda Masukan Sudah Terdaftar');</script>";
                                    echo "<script>location='index.php?halaman=tambah_petugas';</script>";
                                }
                                //Selain Itu.
                                else {
                                    //Jika email belum ada yang terdaftar, maka kita lakukan query simpan.
                                    $konek->query("INSERT INTO petugas(email_petugas, nama_petugas, password, jenis_kelamin, no_hp, alamat, foto, id_status, id_akses, tanggal, bulan, tahun)
                                            VALUES('$email', '$nama', md5('$pass'), '$jenis_kelamin', '$nomor_hp', '$alamat', '$nama_foto', '1', '$akses', '$tanggal', '$bulan', '$tahun')");

                                    echo "<div class='alert alert-info'>Data Tersimpan</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=data_petugas'>";
                                }
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