<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
if (isset($_GET['id']) && $_GET['email'] != '') {
    //tampung data kiriman
    $id_petugas = decrypt(strip_tags($_GET['id']));
    $email = decrypt(strip_tags($_GET['email']));

    // include file qrlib.php
    include "../phpqrcode/qrlib.php";

    //Nama Folder file QR Code kita nantinya akan disimpan
    $tempdir = "../Folder_QRCode_Petugas_Perpus/";

    //jika folder belum ada, buat folder 
    if (!file_exists($tempdir)) {
        mkdir($tempdir);
    }

    #parameter inputan
    $isi_teks = $email;
    $namafile = $id_petugas . ".png";
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
    $padding = 2;

    QRCode::png($isi_teks, $tempdir . $namafile, $quality, $ukuran, $padding);
    $ambil = $konek->query("UPDATE petugas SET qr_code='$namafile' WHERE id_petugas='$id_petugas'");
    echo "<script>location='index.php?halaman=data_petugas'</script>"; //Redirect(Melakukan) Kembali ke Halaman Produk.
} else {
    header('location:index.php?halaman=data_petugas');
}
