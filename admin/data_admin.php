<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Admin E-Perpustakaan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Memanggil koneksi.php -->
                                    <?php include '../koneksi/koneksi.php'; ?>
                                    <?php $ambil = $konek->query("SELECT * FROM tb_admin");
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
                                            <td><?php echo strip_tags($pecah['username']); ?></td>
                                            <td><?php echo strip_tags($pecah['nama']); ?></td>
                                            <td><?php echo strip_tags($pecah['tingkatan_admin']); ?></td>
                                            <td><?php echo strip_tags($pecah['no_hp']); ?></td>
                                            <td><?php echo strip_tags($pecah['alamat']); ?></td>
                                            <td>
                                                <img src="../foto_admin/<?php echo strip_tags($pecah['foto_admin']); ?>" width="100">
                                            </td>
                                            <td>
                                                <a href="index.php?halaman=ubah_admin&id=<?php echo base64_encode(strip_tags($pecah['id_admin'])); ?>" class="btn btn-warning"><i class="fas fa-edit"> </i> Ubah</a>
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
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- ./wrapper -->