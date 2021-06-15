<?php require "koneksi.php"; ?>
<?php include "enkripsi.php"; ?>
<?php
$id_peminjaman = decrypt(strip_tags($_GET["id"]));
$ambil_peminjaman = $konek->query("SELECT * FROM peminjaman 
    INNER JOIN status_peminjaman ON peminjaman.kode_status_pinjam=status_peminjaman.kode_status_pinjam 
    WHERE peminjaman.kode_pinjam = '$id_peminjaman'");
$pecah_peminjaman = $ambil_peminjaman->fetch_assoc();
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
                        <h1>Ubah Peminjaman</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Ubah Peminjaman</li>
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
                                <h3 class="card-title">Ubah Peminjaman</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data">
                                <!-- karena harus upload atau ada kegiatan untuk upload foto, -->
                                <!-- harus juga menggunakan fungsi dari "enctype="multipart"". -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Status Peminjaman</label>
                                        <select name="status" class="form-control">
                                            <?php
                                            $ambil = $konek->query("SELECT * FROM status_peminjaman");
                                            while ($pecah_status =  $ambil->fetch_assoc()) {
                                                if ($pecah_peminjaman['kode_status_pinjam'] == $pecah_status['kode_status_pinjam']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option $select value='" . $pecah_status['kode_status_pinjam'] . "'>" . $pecah_status['status'] . "</option>";
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
                                // ================ BUAT QRCODE UNTUK PEMINJAMAN ================
                                // include file qrlib.php
                                include "../phpqrcode/qrlib.php";

                                //Nama Folder file QR Code kita nantinya akan disimpan
                                $tempdir = "../Folder_QRCode_Peminjaman_Buku/";

                                //jika folder belum ada, buat folder 
                                if (!file_exists($tempdir)) {
                                    mkdir($tempdir);
                                }

                                #parameter inputan
                                // Isi Teks.
                                $isi_teks = $id_peminjaman;
                                // Nama File Setelah Menjadi QrCode.
                                $namafile = $id_peminjaman . ".jpg";
                                // Kualitas ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
                                $quality = 'H'; //
                                // Ukuran batasan 1 paling kecil, 10 paling besar
                                $ukuran = 5;
                                // Jarak.
                                $padding = 2;

                                QRCode::png($isi_teks, $tempdir . $namafile, $quality, $ukuran, $padding);
                                // ================ AKHIR BUAT QRCODE UNTUK PEMINJAMAN ================

                                // $email = strip_tags($_POST["email"]);
                                $status = strip_tags($_POST["status"]);
                                $id_petugas = $_SESSION["petugas"]["id_petugas"];
                                $konek->query("UPDATE peminjaman SET kode_status_pinjam='$status', id_petugas='$id_petugas' WHERE kode_pinjam='$id_peminjaman'");

                                $konek->query("UPDATE detail_peminjaman SET id_petugas='$id_petugas', qr_code='$namafile' WHERE kode_pinjam='$id_peminjaman'");

                                echo "<script>alert('Terima Kasih, Data Peminjaman Berhasil Di Perbarui')</script>"; //Tampilkan Notifikasi Berhasil di update.
                                echo "<script>location='index.php?halaman=data_peminjaman'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
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