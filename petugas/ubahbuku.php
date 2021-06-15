<?php include('koneksi.php'); ?>
<?php
include "enkripsi.php";
$id_buku = decrypt(strip_tags($_GET["id"]));
$ambil_buku = $konek->query("SELECT * FROM buku INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit
		                                    INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang 
                                            INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE id_buku = '$id_buku'");
$pecah_buku = $ambil_buku->fetch_assoc();
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
                        <h1>Ubah Buku</h1>
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
                                <h3 class="card-title">Form Ubah Buku</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Judul Buku *</label>
                                        <input type="text" name="judul_buku" class="form-control" value="<?php echo $pecah_buku['judul_buku'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Penerbit *</label>
                                        <select name="penerbit" class="form-control">
                                            <option value="">======Pilih========</option>
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM penerbit");
                                            while ($pecah_penerbit =  $ambil->fetch_assoc()) {
                                                if ($pecah_buku['id_penerbit'] == $pecah_penerbit['id_penerbit']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_penerbit['id_penerbit'] . "'>" . $pecah_penerbit['nama_penerbit'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pengarang *</label>
                                        <select name="pengarang" class="form-control">
                                            <option value="">======Pilih========</option>
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM pengarang");
                                            while ($pecah_pengarang =  $ambil->fetch_assoc()) {
                                                if ($pecah_buku['id_pengarang'] == $pecah_pengarang['id_pengarang']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_pengarang['id_pengarang'] . "'>" . $pecah_pengarang['nama_pengarang'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Buku *</label>
                                        <input type="date" name="tahun_buku" class="form-control" value="<?php echo $pecah_buku['tahun_buku'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori *</label><br>
                                        <select name="kategori" class="form-control">
                                            <option value="">======Pilih========</option>
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM kategori");
                                            while ($pecah_kategori =  $ambil->fetch_assoc()) {
                                                if ($pecah_buku['id_kategori'] == $pecah_kategori['id_kategori']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_kategori['id_kategori'] . "'>" . $pecah_kategori['nama_kategori'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>stock *</label>
                                        <input type="number" name="stock" class="form-control" min="1" value="<?php echo $pecah_buku['stock_buku']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <img src="../foto_buku/<?php echo $pecah_buku['foto_buku']; ?>" class="user-image img-size-64">
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
                                $judul_buku = strip_tags($_POST["judul_buku"]);
                                $penerbit = strip_tags($_POST["penerbit"]);
                                $pengarang = strip_tags($_POST["pengarang"]);
                                $tahun_buku = strip_tags($_POST["tahun_buku"]);
                                $kategori = strip_tags($_POST["kategori"]);
                                $stock_buku = strip_tags($_POST["stock"]);
                                if (!empty($lokasifoto)) { //Jika tidak kosong(ada isiya) fotonya. artinya dalam folder lokasi foto sementara ada 
                                    //fotonya , lalu kita mengedit(mengubah foto baru) lalu menganti foto yang lama ke foto yang baru.
                                    //Memindahkan file foto ke dalam folder foto_produk.
                                    //Mulai.
                                    move_uploaded_file($lokasifoto, "../foto_buku/$namafoto"); //Artinya, setelah kita upload foto pada form upload 
                                    //foto lalu kita memindahkan foto kita ke pada folder foto_produk dimana pada folder tersebut adalah tempat(lokasi 
                                    //kita) menyimpan foto. " move_uploaded_file($lokasifoto, "../foto_produk/$namafoto" " $lokasifoto adalah kita 
                                    //mengambil foto yang sudah kita upload, lalu ../foto_produk/ adalah kita memindahkan kepada folder foto_produk, 
                                    //dan terakhir $namafoto adalah nama foto kita yang sudah kita upload artinya kita memindahkan nama foto dan file 
                                    //fotonya, lalu kita menyimpannya ke dalam folder foto_produk tersebut. 

                                    //Ubah lalu simpan ke dalam database.
                                    //Mulai.
                                    $konek->query("UPDATE buku SET judul_buku='$judul_buku', id_penerbit='$penerbit', id_pengarang='$pengarang', tahun_buku='$tahun_buku', id_kategori='$kategori', stock_buku='$stock_buku', foto_buku='$namafoto' WHERE id_buku='$id_buku'");
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
                                    $konek->query("UPDATE buku SET judul_buku='$judul_buku', id_penerbit='$penerbit', id_pengarang='$pengarang', tahun_buku='$tahun_buku', id_kategori='$kategori', stock_buku='$stock_buku' WHERE id_buku='$id_buku'"); //Artinya apabila kita mengubah data produk kita, TANPA mengubah fotonya maka script ini yang akan dijalankan.
                                    $konek->query("UPDATE buku SET judul_buku='$judul_buku', id_penerbit='$penerbit', id_pengarang='$pengarang', tahun_buku='$tahun_buku', id_kategori='$kategori', stock_buku='$stock_buku' WHERE id_buku='$id_buku'"); //Artinya apabila kita mengubah data produk kita, TANPA mengubah fotonya maka script ini yang akan dijalankan.
                                }
                                echo "<script>alert('Terima Kasih, Data Buku Berhasil Di Perbarui')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                echo "<script>location='index.php?halaman=buku'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
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