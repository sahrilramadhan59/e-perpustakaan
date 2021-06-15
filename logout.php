<?php
session_start();
require "koneksi/koneksi.php";
include "petugas/enkripsi.php";

// Menghancurkan $_Session["pelanggan"].
$id_anggota = $_SESSION["anggota"]["id_anggota"]; //Mengambil id admin yang
$konek->query("UPDATE tb_anggota SET online='Tidak Aktif' WHERE id_anggota='$id_anggota'"); //Setelah itu, Update datanya untuk login terakhirnya kapan
session_destroy();

echo "<script>alert('Anda Telah Logout');</script>";
echo "<script>location = 'index';</script>";
