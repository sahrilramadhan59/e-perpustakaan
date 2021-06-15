<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Peminjaman</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Peminjaman</li>
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
                            <h3 class="card-title">Tabel Data Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="index.php?halaman=hapus_peminjaman" method="POST" enctype="multipart/form-data">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Buku</th>
                                            <th>Pinjam</th>
                                            <th>Kembali</th>
                                            <th>Status Pinjam</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Memanggil koneksi.php -->
                                        <?php include "koneksi.php"; ?>
                                        <?php include "enkripsi.php"; ?>
                                        <?php $ambil = $konek->query("SELECT * FROM peminjaman
                                            INNER JOIN buku ON buku.id_buku=peminjaman.id_buku 
                                            INNER JOIN status_peminjaman ON peminjaman.kode_status_pinjam=status_peminjaman.kode_status_pinjam
                                            INNER JOIN tb_anggota ON tb_anggota.id_anggota=peminjaman.id_anggota
                                            INNER JOIN kategori ON kategori.id_kategori=peminjaman.id_kategori");
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
                                                <td align="center"><input type="checkbox" name="pilih[]" value="<?php echo $pecah['kode_pinjam']; ?>"></td>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo strip_tags($pecah['nama_anggota']); ?></td>
                                                <td><?php echo strip_tags($pecah['judul_buku']); ?></td>
                                                <td><?php echo strip_tags($pecah['tgl_pinjam']); ?></td>
                                                <td><?php echo strip_tags($pecah['tgl_kembali']); ?></td>
                                                <td><?php echo strip_tags($pecah['status']); ?></td>
                                                <td>
                                                    <?php
                                                    if ($pecah['status'] == "Menunggu Konfirmasi") { ?>
                                                        <a href="index.php?halaman=ubah_peminjaman&id=<?php echo encrypt($pecah['kode_pinjam']); ?>" class="btn btn-primary" title="Edit Data Peminjaman"><i class="fas fa-edit"> </i></a>
                                                    <?php } else { ?>
                                                        <a href="index.php?halaman=detail_peminjaman&id=<?php echo encrypt($pecah['kode_pinjam']); ?>" class="btn btn-warning" title="Lihat Detail Peminjaman"><i class="fas fa-eye fa-1x"> </i></a>
                                                    <?php } ?>
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
                                                <button class="btn btn-danger" name="hapus" onclick="return confirm('Yakin Ingin Menghapusnya ? ');" title="Hapus Data Peminjaman"><i class="fas fa-trash"></i></button>
                                            </th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Buku</th>
                                            <th>Pinjam</th>
                                            <th>Kembali</th>
                                            <th>Status Pinjam</th>
                                            <th></th>
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