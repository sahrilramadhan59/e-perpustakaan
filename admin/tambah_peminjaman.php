<?php include('../koneksi/koneksi.php'); ?>
<div class="wrapper">
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Peminjaman</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Form Tambah Peminjaman</li>
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
                                <h3 class="card-title">Form Tambah Peminjaman</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Anggota *</label>
                                        <select name="anggota" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT * FROM tb_anggota"); ?>
                                            <?php while ($pecah_anggota = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_anggota['id_anggota']; ?>"><?php echo $pecah_anggota['nama_anggota'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Buku *</label>
                                        <select name="buku" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT * FROM buku"); ?>
                                            <?php while ($pecah_buku = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_buku['id_buku']; ?>"><?php echo $pecah_buku['judul_buku'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori *</label><br>
                                        <select name="kategori" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT * FROM kategori"); ?>
                                            <?php while ($pecah_kategori = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_kategori['id_kategori']; ?>"><?php echo $pecah_kategori['nama_kategori'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Penerbit *</label><br>
                                        <select name="penerbit" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT * FROM penerbit"); ?>
                                            <?php while ($pecah_penerbit = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_penerbit['id_penerbit']; ?>"><?php echo $pecah_penerbit['nama_penerbit'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pengarang *</label><br>
                                        <select name="pengarang" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT * FROM pengarang"); ?>
                                            <?php while ($pecah_pengarang = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_pengarang['id_pengarang']; ?>"><?php echo $pecah_pengarang['nama_pengarang'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pinjam *</label>
                                        <input type="date" name="tgl_pinjam" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Kembali *</label>
                                        <input type="date" name="tgl_kembali" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah *</label>
                                        <input type="number" name="jumlah" class="form-control" min="1">
                                    </div>
                                    <div class="form-group">
                                        <label>Status Pinjam *</label><br>
                                        <select name="status_pinjam" class="form-control">
                                            <option value="">----Pilih-------</option>
                                            <?php $ambil = $konek->query("SELECT * FROM status_peminjaman"); ?>
                                            <?php while ($pecah_status = $ambil->fetch_assoc()) { ?>
                                                <option value="<?php echo $pecah_status['kode_status_pinjam']; ?>"><?php echo $pecah_status['status'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="simpan"><i class=" glyphicon glyphicon-plus"></i> Simpan</button>
                                </div>
                            </form>
                            <?php
                            //Jika ada tombol simpan(tombol simpan di tekan)
                            if (isset($_POST["simpan"])) {
                                $jumlah = strip_tags($_POST["jumlah"]);
                                $buku = strip_tags($_POST["buku"]);
                                $penerbit = strip_tags($_POST["penerbit"]);
                                $pengarang = strip_tags($_POST["pengarang"]);
                                $tgl_pinjam = strip_tags($_POST["tgl_pinjam"]);
                                $tgl_kembali = strip_tags($_POST["tgl_kembali"]);
                                $kategori = strip_tags($_POST["kategori"]);
                                $anggota = strip_tags($_POST["anggota"]);
                                $status_pinjam = strip_tags($_POST["status_pinjam"]);

                                $konek->query("INSERT INTO peminjaman(id_anggota, id_buku, id_kategori, id_petugas, id_penerbit, id_pengarang, tgl_pinjam, tgl_kembali, jumlah, kode_status_pinjam)
                                VALUES('$anggota','$buku','$kategori','26','$penerbit','$pengarang','$tgl_pinjam','$tgl_kembali','$jumlah','$status_pinjam')");

                                //2. Mendapatkan kode_pinjam yang baru saja terjadi.
                                $kode_peminjaman_barusan = $konek->insert_id;

                                // 3.Mendapatkan data buku berdasarkan id_buku.
                                $konek->query("INSERT INTO detail_peminjaman(kode_pinjam, id_buku, id_penerbit, id_pengarang, id_anggota, id_petugas, id_kategori, kode_status_pinjam)
                                VALUES('$kode_peminjaman_barusan','$buku','$penerbit','$pengarang','$anggota','26','$kategori','$status_pinjam')");

                                //Skrip update Stok Produk.
                                $konek->query("UPDATE buku SET stock_buku = stock_buku -$jumlah WHERE id_buku = '$buku'");

                                echo "<div class='alert alert-info'>Data Tersimpan</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=data_peminjaman'>";
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