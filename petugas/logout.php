<?php
// echo "<pre>";
// print_r($_SESSION["admin"]);
// echo "</pre>";
$id_admin = $_SESSION["petugas"]["id_petugas"]; //Mengambil id admin yang
$tanggal = date("d"); //Menset Tanggal Sekarang.
$bulan = date("F"); //Menset Bulan Sekarang.
$tahun = date("Y"); //Menset Tahun Sekarang.
$konek->query("UPDATE petugas SET online='Tidak Aktif' WHERE id_petugas='$id_petugas'");
$konek->query("UPDATE petugas SET tanggal='$tanggal', bulan='$bulan', tahun='$tahun' WHERE id_petugas='$id_petugas'"); //Setelah itu, Update datanya untuk login terakhirnya kapan
session_destroy(); //Selajutnya kita Hancurkan(Destroy)(Hapus Session).
echo "<script>alert('Anda Berhasil Logout')</script>"; //Kirim Notifikasi
echo "<script>location='login.php'</script>"; //Lalu arahkan ke halaman login.
