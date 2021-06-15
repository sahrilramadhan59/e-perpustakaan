<?php include('koneksi.php'); ?>
<?php
include "enkripsi.php";
$id_kategori = decrypt(strip_tags($_GET["id"]));
$ambil = $konek->query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'");
$pecah_buku = $ambil->fetch_assoc();
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
                        <h1>Ubah Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Ubah Kategori</li>
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
                                <h3 class="card-title">Form Ubah Kategori</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <input type="text" name="nama_kategori" class="form-control" value="<?php echo strip_tags($pecah_buku['nama_kategori']) ?>">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["ubah"])) {
                                $nama_kategori = strip_tags($_POST["nama_kategori"]);
                                //Mulai.
                                $konek->query("UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
                                //Akhir.
                                echo "<script>alert('Terima Kasih, Data Kategori Berhasil Di Perbarui')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                echo "<script>location='index.php?halaman=kategori_buku'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
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