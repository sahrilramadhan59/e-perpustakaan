<?php
// Memanggil koneksi.php 
include '../koneksi/koneksi.php';
include "enkripsi.php"; //Memanggil Class Enkripsi. Yang berisikan Class - Class untuk mengenkripsikan id dengan metode MD5 dan juga base64.
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
            <h1>Data Buku</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Buku</li>
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
              <h3 class="card-title">Tabel Data Buku</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="index.php?halaman=hapusbuku" method="POST" enctype="multipart/form-data">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>No</th>
                      <th>Judul Buku</th>
                      <th>Nama Penerbit</th>
                      <th>Nama Pengarang</th>
                      <th>Tahun Buku</th>
                      <th>Stock Buku</th>
                      <th>Kategori</th>
                      <th>Foto Buku</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $ambil = $konek->query("SELECT * FROM buku INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit
		                                      INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang 
                                          INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori");
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
                        <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah['id_buku']; ?>"></td>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['judul_buku']; ?></td>
                        <td><?php echo $pecah['nama_penerbit']; ?></td>
                        <td><?php echo $pecah['nama_pengarang']; ?></td>
                        <td><?php echo $pecah['tahun_buku']; ?></td>
                        <td><?php echo $pecah['stock_buku']; ?></td>
                        <td><?php echo $pecah['nama_kategori']; ?></td>
                        <td>
                          <img src="../foto_buku/<?php echo $pecah['foto_buku']; ?>" width="100">
                        </td>
                        <td>
                          <a href="index.php?halaman=ubahbuku&id=<?php echo encrypt(strip_tags($pecah['id_buku'])); ?>" class="btn btn-warning"><i class="fas fa-edit"> </i> Ubah</a>
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
                      <th>
                        <button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');"><i class="fas fa-trash"></i></button>
                      </th>
                      <th>No</th>
                      <th>Judul Buku</th>
                      <th>Nama Penerbit</th>
                      <th>Nama Pengarang</th>
                      <th>Tahun Buku</th>
                      <th>Stock Buku</th>
                      <th>Kategori</th>
                      <th>Foto Buku</th>
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
      <a href="index.php?halaman=tambahbuku" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->