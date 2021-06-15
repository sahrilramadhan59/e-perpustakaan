<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
if (isset($_GET['id'])) {
    // ================ BUAT QRCODE UNTUK PEMINJAMAN ================
    //tampung data kiriman
    $kode_pinjam = decrypt(strip_tags($_GET['id']));

    // include file qrlib.php
    include "../phpqrcode/qrlib.php";

    //Nama Folder file QR Code kita nantinya akan disimpan
    $tempdir = "../Folder_QRCode_Peminjaman_Buku/";

    //jika folder belum ada, buat folder 
    if (!file_exists($tempdir)) {
        mkdir($tempdir);
    }

    #parameter inputan
    $isi_teks = $kode_pinjam;
    $namafile = $kode_pinjam . ".png";
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
    $padding = 2;

    QRCode::png($isi_teks, $tempdir . $namafile, $quality, $ukuran, $padding);
    $ambil = $konek->query("UPDATE detail_peminjaman SET qr_code='$namafile' WHERE kode_pinjam='$kode_pinjam'");
    echo "<script>location='index.php?halaman=data_peminjaman'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
    // ================ AKHIR BUAT QRCODE UNTUK PEMINJAMAN ================
} else {
    header('location:index.php?halaman=data_peminjaman');
}
