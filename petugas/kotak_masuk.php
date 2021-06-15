<?php include('koneksi.php'); ?>
<?php include('enkripsi.php'); ?>
<?php
$id_petugas_saya = $_SESSION["petugas"]["id_petugas"];
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
                                <h3 class="card-title">Pesan Masuk</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengirim</th>
                                            <th>Subyek Pesan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Memanggil koneksi.php -->
                                        <?php include 'koneksi.php'; ?>
                                        <?php $ambil = $konek->query("SELECT C.*, P.id_petugas, P.nama_petugas FROM chat C, petugas P 
                                        WHERE C.id_pengirim=P.id_petugas AND C.id_penerima='$id_petugas_saya' ORDER BY C.id_chat DESC");
                                        //Artinya kita memanggil koneksi.php lalu kita memanggil dan membuat query select pada database kita.
                                        //lalu dimasukan ke dalam variable $ambil.
                                        //tanda "$" mengartikan variable dan ambil itu adalah nama variablenya jadi $ambil adalah variable dengan nama ambil.
                                        ?>
                                        <?php $nomor = 1; ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <!-- artinya kita memecahkan beberapa field untuk mempermudah -->
                                            <!-- lalu kita memanggil fungsi while yaitu berfungsi(untuk membuat perulangan data berdasarkan banyaknya -->
                                            <!-- data berdasarkan data dari database kita. Misal : data di dalam tabel produk kita ada 2, maka fungsi whilenya -->
                                            <!-- akan mengulang 2 kali berdasarkan banyaknya data pada tabel produk kita) dan setelah kita memanggil fungsi -->
                                            <!-- while kita masukan variable $pecah dan didalam variable $pecah berisi $ambil yang artinya di dalam variable -->
                                            <!-- $ambil mempunyai isi query. Jadi kita masukan $ambil kita yang berisi fungsi query select tabel kita -->
                                            <!-- ke dalam Variable $pecah. yang nantiya akan kita gunakan untuk mempermudah kita memanggil dari field-field -->
                                            <!-- kita yang ada di datam tabel produk kita.  -->
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo $pecah['nama_petugas']; ?></td>
                                                <td><?php echo $pecah['subyek_pesan']; ?></td>
                                                <td>
                                                    <a href="index.php?halaman=hapus_chat&id=<?php echo encrypt($pecah['id_chat']); ?>" class="btn-danger btn"><i class="fas fa-trash"> </i> Hapus </a>
                                                    <!-- Disini bisa di artikan setelah kita klik hapus, kita tidak akan menghapus semua data kita, melainkan -->
                                                    <!-- kita hanya akan menghapus berdasarkan "id" yang kita pilih saja. -->
                                                    <!-- Dari mana kok bisa si hanya dari "id" saja yang dihapus ? kok gak semua yang ke hapus ? -->
                                                    <!-- Ya !, karna "index.php?halaman=hapusproduk&id=<//?php //echo $pecah//['id_produk']; ?>" ini akanlink kepada-->
                                                    <!-- URL dan pada URLnya akan mengambil dari 1 nilai, dan nilai tersebut adalah nilai dari id_produk, -->
                                                    <!-- yaitu field yang ada di dalam tabel produk. jadi bisa dibilang id itu dimasukan nilai id_produk dari -->
                                                    <!-- field dari tabel produk kita, lalu si id nya ini menjadi perwakilan dari id_produk dan yang -->
                                                    <!-- nantinya akan kita dapatkan 1 nilainya untuk proses ubah dan hapus ini. -->
                                                    <a href="index.php?halaman=detail_pesan&id=<?php echo encrypt($pecah['id_chat']); ?>" class="btn btn-warning"><i class="fas fa-eye"> </i> Lihat Pesan</a>
                                                    <!-- Disini bisa di artikan setelah kita klik ubah, kita tidak akan mengubah semua data kita, melainkan -->
                                                    <!-- kita hanya akan mengubah berdasarkan "id" yang kita pilih saja. -->
                                                    <!-- Dari mana kok bisa si hanya dari "id" saja yang diubah ? kok gak semua yang ke ubah ? -->
                                                    <!-- Ya !, karna "index.php?halaman=hapusproduk&id=<?php //echo $pecah['id_produk']; 
                                                                                                        ?>" ini akanlink kepada-->
                                                    <!-- URL dan pada URLnya akan mengambil dari 1 nilai, dan nilai tersebut adalah nilai dari id_produk, -->
                                                    <!-- yaitu field yang ada di dalam tabel produk. jadi bisa dibilang id itu dimasukan nilai id_produk dari -->
                                                    <!-- field dari tabel produk kita, lalu si id nya ini menjadi perwakilan dari id_produk dan yang -->
                                                    <!-- nantinya akan kita dapatkan 1 nilainya untuk proses ubah dan hapus ini. -->
                                                </td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengirim</th>
                                            <th>Subyek Pesan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
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