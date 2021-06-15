<?php
include "koneksi.php";
include "enkripsi.php";
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
                        <h1>Pengembalian Buku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Pengembalian Buku</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <?php
        $kode_pinjam = $_POST['kode_pinjam'];
        $ambil = $konek->query("SELECT peminjaman.kode_pinjam, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.jumlah, 
                        tb_anggota.id_anggota, tb_anggota.nama_anggota, tb_anggota.email_anggota, tb_anggota.no_hp_anggota, 
                        tb_anggota.alamat, buku.id_buku, buku.judul_buku, buku.tahun_buku, buku.id_status_buku, penerbit.id_penerbit, penerbit.nama_penerbit, 
                        pengarang.id_pengarang, pengarang.nama_pengarang, kategori.id_kategori, kategori.nama_kategori, petugas.id_petugas, petugas.nama_petugas, 
                        petugas.email_petugas, petugas.no_hp, status_peminjaman.kode_status_pinjam, status_peminjaman.status, 
                        detail_peminjaman.qr_code, detail_peminjaman.id_detail_pinjam FROM detail_peminjaman 
                        INNER JOIN peminjaman ON detail_peminjaman.kode_pinjam=peminjaman.kode_pinjam
                        INNER JOIN tb_anggota ON detail_peminjaman.id_anggota=tb_anggota.id_anggota
                        INNER JOIN buku ON detail_peminjaman.id_buku=buku.id_buku
                        INNER JOIN penerbit ON detail_peminjaman.id_penerbit=penerbit.id_penerbit
                        INNER JOIN pengarang ON detail_peminjaman.id_pengarang=pengarang.id_pengarang
                        INNER JOIN kategori ON detail_peminjaman.id_kategori=kategori.id_kategori
                        INNER JOIN petugas ON detail_peminjaman.id_petugas=petugas.id_petugas
                        INNER JOIN status_peminjaman ON status_peminjaman.kode_status_pinjam=peminjaman.kode_status_pinjam
                        WHERE detail_peminjaman.kode_pinjam='$kode_pinjam'"); ?>
        <?php // $ambil = $konek->query("SELECT * FROM detail_peminjaman WHERE kode_pinjam='$kode_pinjam'");
        $pecah = $ambil->fetch_assoc();
        $cocok = $ambil->num_rows;
        if ($cocok < 1) { ?>
            <script>
                alert('Data Tidak Di Temukan : Maaf, Data Tidak Di Temukan');
            </script>

        <?php } else { ?>
        <?php
            $tgl_pinjam = $pecah['tgl_pinjam'];
            $tgl_kembali = date("Y-m-d");

            $cari_hari = abs(strtotime($tgl_pinjam) - strtotime($tgl_kembali));
            $hitung_hari = floor($cari_hari / (60 * 60 * 24));

            if ($hitung_hari > 7) {
                $telat = $hitung_hari - 7;
                $denda = 1000 * $telat;
                echo "<script>alert('Kamu Telat Mengembalikan Buku. Keterlambatan Waktu : " . $telat . " Denda : " . $denda . " ');</script>";
                echo "<meta http-equiv='refresh' content='1;url=index?halaman=denda&id=" . encrypt($pecah['kode_pinjam']) . "'>";
            } else {
                $telat = 0;
                $denda = 0;
                $id_anggota = $pecah['id_anggota'];
                $id_detail_pinjam = $pecah['id_detail_pinjam'];
                $id_buku = $pecah['id_buku'];
                $id_kategori = $pecah['id_kategori'];
                $id_penerbit = $pecah['id_penerbit'];
                $id_pengarang = $pecah['id_pengarang'];
                $foto_qr = $pecah['qr_code'];

                //Jika ada file foto di dalam folder yang sudah dipilih.
                if (file_exists("../Folder_QRCode_Peminjaman_Buku/$foto_qr")) {
                    //maka hapus data tersebut dari folder. 
                    unlink("../Folder_QRCode_Peminjaman_Buku/$foto_qr");
                }

                $konek->query("INSERT INTO pengembalian(id_anggota, id_detail_pinjam, id_buku, id_kategori, id_penerbit, id_pengarang, kode_status_pinjam, denda, keterlambatan)
                    VALUES('$id_anggota', '$id_detail_pinjam', '$id_buku', '$id_kategori', '$id_penerbit', '$id_pengarang', '8', '$denda', '$telat')");

                $kode_kembali_barusan = $konek->insert_id;

                $konek->query("INSERT INTO detail_pengembalian(kode_kembali) VALUES('$kode_kembali_barusan')");

                $konek->query("UPDATE buku INNER JOIN detail_peminjaman ON buku.id_buku=detail_peminjaman.id_buku
                    SET id_status_buku = '1', stock_buku = '1' WHERE detail_peminjaman.id_detail_pinjam = '$id_detail_pinjam'");

                $konek->query("UPDATE peminjaman
                INNER JOIN detail_peminjaman ON detail_peminjaman.kode_pinjam=peminjaman.kode_pinjam
                INNER JOIN status_peminjaman ON status_peminjaman.kode_status_pinjam=peminjaman.kode_status_pinjam
                SET peminjaman.kode_status_pinjam = '8' WHERE peminjaman.kode_pinjam = '$kode_pinjam'");

                echo "<script>alert('Kamu Mengembalikan Tepat Pada Waktunya. Keterlambatan Waktu : " . $telat . " Denda : " . $denda . " ');</script>";
                echo "<meta http-equiv='refresh' content='1;url=index'>";
            }
        } ?>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- ./wrapper -->