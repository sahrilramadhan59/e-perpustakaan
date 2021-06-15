<?php include('koneksi.php'); ?>
<?php include('enkripsi.php'); ?>
<?php
$id_petugas_saya = $_SESSION["petugas"]["id_petugas"];
$id_petugas = decrypt(strip_tags($_GET["id"]));
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
                        <h1>Kirim Pesan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php?halaman=kotak_masuk">Lihat Pesan</a></li>
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
                                <h3 class="card-title">Form Kirim Pesan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                    <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                    <div class="form-group">
                                        <label>Penerima *</label>
                                        <select name="penerima" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT id_petugas, email_petugas, nama_petugas FROM petugas WHERE id_petugas='$id_petugas'"); ?>
                                            <?php while ($pecah_petugas = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_petugas['id_petugas']; ?>"><?php echo $pecah_petugas['nama_petugas'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Subyek Pesan *</label>
                                        <input type="text" class="form-control" name="subyek">
                                    </div>
                                    <div class="form-group">
                                        <label>Pesan *</label>
                                        <textarea name="pesan" id="compose-textarea" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <button class="btn btn-primary" name="simpan"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            <?php
                            //Jika ada tombol simpan(tombol simpan di tekan)
                            if (isset($_POST["simpan"])) {
                                $penerima = strip_tags($_POST["penerima"]);
                                $subyek_pesan = strip_tags($_POST["subyek"]);
                                $pesan = strip_tags($_POST["pesan"]);
                                $tanggal = date("Y-m-d");

                                $konek->query("INSERT INTO chat(id_pengirim, id_penerima, subyek_pesan, pesan, tanggal_chat)
                                VALUES('$id_petugas_saya','$penerima','$subyek_pesan','$pesan','$tanggal')");

                                echo "<div class='alert alert-info'>Pesan Terkirim</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kontak'>";
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