<?php include('koneksi.php'); ?>
<?php
include "enkripsi.php";
$id_pengarang = decrypt(strip_tags($_GET["id"]));
$ambil_pengarang = $konek->query("SELECT * FROM pengarang WHERE id_pengarang = '$id_pengarang'");
$pecah_pengarang = $ambil_pengarang->fetch_assoc();
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
                        <h1>Ubah Data Pengarang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Ubah Pengarang</li>
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
                                <h3 class="card-title">Form Ubah Pengarang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pengarang</label>
                                        <input type="text" name="nama_pengarang" class="form-control" value="<?php echo strip_tags($pecah_pengarang['nama_pengarang']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>No Hp</label>
                                        <input type="text" name="no_hp" class="form-control" min="1" value="<?php echo strip_tags($pecah_pengarang['no_hp']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" id="" cols="30" rows="10" class="form-control"><?php echo strip_tags($pecah_pengarang['alamat']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <img src="../foto_pengarang/<?php echo $pecah_pengarang['foto_pengarang']; ?>" class="user-image img-size-64">
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
                                    <button class="btn btn-primary" name="ubah"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["ubah"])) {
                                //Langkah awal ambil fotonya terlebih dahulu.
                                $namafoto = $_FILES['foto']['name']; //Mengambil nama foto. _FILES['foto']['name'], maksudnya adalah, foto di dapat
                                //dari form tempat dimana kita mengganti/upload foto pada form ubah produk ini, 
                                //lalu name adalah nama foto yang kita inputkan ke dalam tempat inputan foto.
                                $lokasifoto = $_FILES['foto']['tmp_name']; //mengambil lokasi foto yang disimpan dalam folder. 
                                //atau letak foto sementara.
                                //Jika foto di rubah
                                $nama_pengarang = strip_tags($_POST["nama_pengarang"]);
                                $no_hp = strip_tags($_POST["no_hp"]);
                                $alamat = strip_tags($_POST["alamat"]);
                                if (!empty($lokasifoto)) { //Jika tidak kosong(ada isiya) fotonya. artinya dalam folder lokasi foto sementara ada 
                                    //fotonya , lalu kita mengedit(mengubah foto baru) lalu menganti foto yang lama ke foto yang baru.
                                    //Memindahkan file foto ke dalam folder foto_produk.
                                    //Mulai.
                                    move_uploaded_file($lokasifoto, "../foto_pengarang/$namafoto"); //Artinya, setelah kita upload foto pada form upload 
                                    //foto lalu kita memindahkan foto kita ke pada folder foto_produk dimana pada folder tersebut adalah tempat(lokasi 
                                    //kita) menyimpan foto. " move_uploaded_file($lokasifoto, "../foto_produk/$namafoto" " $lokasifoto adalah kita 
                                    //mengambil foto yang sudah kita upload, lalu ../foto_produk/ adalah kita memindahkan kepada folder foto_produk, 
                                    //dan terakhir $namafoto adalah nama foto kita yang sudah kita upload artinya kita memindahkan nama foto dan file 
                                    //fotonya, lalu kita menyimpannya ke dalam folder foto_produk tersebut. 

                                    //Ubah lalu simpan ke dalam database.
                                    //Mulai.
                                    $konek->query("UPDATE pengarang SET nama_pengarang='$nama_pengarang', no_hp='$no_hp', alamat='$alamat', foto_pengarang='$namafoto' WHERE id_pengarang='$id_pengarang'");
                                    //$_GET[id] diambil dari mana ? $_GET[id] diambil dari URL yang sudah sinkron dengan field id_produk 
                                    //yang ada pada tabel produk kita.

                                    //Artinya, Setelah kita mengambil foto dan upload foto 
                                    //baru kita, selanjutnya kita masukan semua data baru + file foto terbaru ke dalam database kita.
                                    //Apakah di ubah semua datanya ? Tidak ! kita hanya mengubah berdasarkan id yang dipilih dengan cara memasukan 
                                    //fungsi query WHERE. lalu Fungsi GET artinya kita mengambil nilai id yang kita pilih lalu kita mengubah dan 
                                    //memasukan data baru yang sudah kita ubah ke dalam database.

                                    //Biar lebih jelas untuk tau dari mana kita ambil fungsi GET[id]nya, 
                                    //silakan liat penjelasan yang ada pada file produk.php kita.
                                } else {
                                    //Mengubah produk tanpa harus mengubah foto kita.
                                    $konek->query("UPDATE pengarang SET nama_pengarang='$nama_pengarang', no_hp='$no_hp', alamat='$alamat' WHERE id_pengarang='$id_pengarang'"); //Artinya apabila kita mengubah data produk kita, TANPA mengubah fotonya maka script ini yang akan dijalankan.
                                }
                                echo "<script>alert('Terima Kasih, Data Pengarang Berhasil Di Perbarui')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                echo "<script>location='index.php?halaman=pengarang_buku'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
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