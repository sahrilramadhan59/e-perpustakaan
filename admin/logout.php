<?php
// echo "<pre>";
// print_r($_SESSION["admin"]);
// echo "</pre>";
include "../koneksi/koneksi.php";
$id_admin = $_SESSION["admin"]["id_admin"]; //Mengambil id admin yang
$tanggal = date("d"); //Menset Tanggal Sekarang.
$bulan = date("F"); //Menset Bulan Sekarang.
$tahun = date("Y"); //Menset Tahun Sekarang.
$konek->query("UPDATE tb_admin SET tanggal='$tanggal', bulan='$bulan', tahun='$tahun' WHERE id_admin='$id_admin'"); //Setelah itu, Update datanya untuk login terakhirnya kapan
session_destroy(); //Selajutnya kita Hancurkan(Destroy)(Hapus Session).
echo "<script>alert('Anda Berhasil Logout')</script>"; //Kirim Notifikasi
echo "<script>location='login.php'</script>"; //Lalu arahkan ke halaman login.
