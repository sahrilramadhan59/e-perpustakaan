<?php require "../koneksi/koneksi.php"; ?>
<?php include "enkripsi.php"; ?>
<?php
$id_petugas = decrypt(strip_tags($_GET["id"]));
$ambil_buku = $konek->query("SELECT * FROM petugas INNER JOIN status_petugas ON petugas.id_status=status_petugas.id_status WHERE petugas.id_petugas = '$id_petugas'");
$pecah_petugas = $ambil_buku->fetch_assoc();
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
                        <h1>Ubah Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Ubah Petugas</li>
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
                                <h3 class="card-title">Form Ubah Petugas</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <!-- <div class="form-group"> -->
                                    <!-- <label>Email</label> -->
                                    <!-- <input type="hidden" name="email" class="form-control" value="<?php echo $pecah_petugas['email_petugas'] ?>"> -->
                                    <!-- </div> -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">======Pilih========</option>
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM status_petugas");
                                            while ($pecah_status =  $ambil->fetch_assoc()) {
                                                if ($pecah_petugas['id_status'] == $pecah_status['id_status']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_status['id_status'] . "'>" . $pecah_status['nama_status'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Petugas</label>
                                        <select name="akses" class="form-control">
                                            <option value="">======Pilih========</option>
                                            <?php
                                            //Membuat Pemilihian akses petugas dari tabel akses_petugas.
                                            $ambil = $konek->query("SELECT * FROM akses_petugas");
                                            while ($pecah_akses =  $ambil->fetch_assoc()) {
                                                //Memecah Akses_Petugas lalu di looping berdasarkan banyakannya data dalam tabel akses.
                                                if ($pecah_petugas['id_akses'] == $pecah_akses['id_akses']) {
                                                    //Jika pecah_petugas berdasarkan id_aksesnya, maka ambil nilainya dari id_aksesnya. 
                                                    $select = "selected";
                                                    //Pilih, Artinya jika sesuai dengan data yang didatabasenya dan dia ingin mengubah id_aksesnya
                                                    //Misal Aktif menjadi tidak aktif id_akses petugasnya, maka Pilih.
                                                } else {
                                                    //Selain itu.
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_akses['id_akses'] . "'>" . $pecah_akses['nama_akses'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["ubah"])) {
                                // $email = strip_tags($_POST["email"]);
                                $status = strip_tags($_POST["status"]);
                                $akses = strip_tags($_POST["akses"]);

                                $konek->query("UPDATE petugas SET id_status='$status', id_akses='$akses' 
                                    WHERE id_petugas='$id_petugas'");

                                echo "<script>alert('Terima Kasih, Data Buku Berhasil Di Perbarui')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                echo "<script>location='index.php?halaman=data_petugas'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
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