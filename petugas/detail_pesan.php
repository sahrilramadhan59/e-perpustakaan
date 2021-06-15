<?php
include "enkripsi.php";
$id_petugas_saya = $_SESSION["petugas"]["id_petugas"];
$id_chat = decrypt($_GET["id"]);
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
                        <h1>Pesan Masuk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php?halaman=pesan">Lihat Pesan</a></li>
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
                        <!-- /.col -->
                        <div class="col-md-9">
                            <?php include('koneksi.php'); ?>
                            <?php
                            $ambil = $konek->query("SELECT C.*, P.id_petugas, P.nama_petugas FROM chat C, petugas P 
                                WHERE id_chat='$id_chat' AND C.id_pengirim=P.id_petugas");
                            $pecah_pesan = $ambil->fetch_assoc();
                            ?>
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Baca Pesan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="mailbox-read-info">
                                        <h5>&nbsp; Subyek : <?php echo $pecah_pesan['subyek_pesan']; ?></h5>
                                        <h6>&nbsp;&nbsp; Dari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $pecah_pesan['nama_petugas']; ?>
                                            <span class="mailbox-read-time float-right">Dikirim Pada Tanggal : <?php echo $pecah_pesan['tanggal_chat']; ?></span></h6>
                                    </div>
                                    <!-- /.mailbox-read-info -->
                                    <div class="mailbox-read-message">
                                        &nbsp;&nbsp;&nbsp;<?php echo $pecah_pesan['pesan']; ?>
                                    </div>
                                    <!-- /.mailbox-read-message -->
                                </div>
                                <!-- /.card-footer -->
                                <div class="card-footer">
                                    <div class="float-right">

                                    </div>

                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Balas Pesan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body" id="balas">
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                        <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                        <div class="form-group">
                                            <label>Penerima : <?php echo $pecah_pesan['nama_petugas']; ?></label>
                                            <input type="hidden" id="penerima_balas_pesan" name="balas_pesan" value="<?php echo $pecah_pesan['id_pengirim']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Subyek Pesan (Re) *</label>
                                            <input type="text" class="form-control" name="subyek">
                                        </div>
                                        <div class="form-group">
                                            <label>Pesan *</label>
                                            <textarea name="pesan" id="compose-textarea" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                        <button class="btn btn-primary" name="simpan"><i class=" glyphicon glyphicon-plus"></i> Balas</button>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                                <?php
                                //Jika ada tombol simpan(tombol simpan di tekan)
                                if (isset($_POST["simpan"])) {
                                    $penerima = strip_tags($_POST["balas_pesan"]);
                                    $subyek_pesan = strip_tags($_POST["subyek"]);
                                    $pesan = strip_tags($_POST["pesan"]);
                                    $tanggal = date("Y-m-d");

                                    $konek->query("INSERT INTO chat(id_pengirim, id_penerima, subyek_pesan, pesan, baca_pesan, tanggal_chat)
                                VALUES('$id_petugas_saya','$penerima','Re : $subyek_pesan','$pesan','Belum','$tanggal')");

                                    echo "<div class='alert alert-info'>Pesan Sudah Terbalas</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kotak_masuk'>";
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
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php $sudah_dibaca = mysqli_query($konek, "UPDATE chat SET baca_pesan='Sudah' WHERE id_chat=$id_chat"); ?>