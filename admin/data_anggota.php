<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Anggota</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Anggota</li>
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
                            <h3 class="card-title">Tabel Data Anggota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="index.php?halaman=hapus_anggota" method="POST" enctype="multipart/form-data">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Memanggil koneksi.php -->
                                        <?php require "../koneksi/koneksi.php"; ?>
                                        <?php include "enkripsi.php"; ?>
                                        <?php $ambil = $konek->query("SELECT * FROM tb_anggota");
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
                                                <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah['id_anggota']; ?>"></td>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo strip_tags($pecah['nama_anggota']); ?></td>
                                                <td><?php echo strip_tags($pecah['email_anggota']); ?></td>
                                                <td><?php echo strip_tags($pecah['no_hp_anggota']); ?></td>
                                                <td><?php echo strip_tags($pecah['alamat']); ?></td>
                                                <td>
                                                    <a href="index.php?halaman=detail_anggota&id=<?php echo encrypt(strip_tags($pecah['id_anggota'])); ?>" class="btn btn-success"><i class="fas fa-eye" title="Lihat Detail"> </i></a>
                                                    <a href="index.php?halaman=ubah_anggota&id=<?php echo encrypt(strip_tags($pecah['id_anggota'])); ?>" class="btn btn-warning"><i class="fas fa-edit" title="Edit Data"> </i></a>
                                                </td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');" title="Hapus"><i class="fas fa-trash"></i></button></th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
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