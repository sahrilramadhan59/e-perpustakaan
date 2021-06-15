<?php
session_start();
include "petugas/enkripsi.php";
$id_produk = decrypt(strip_tags($_GET["id"]));
unset($_SESSION["keranjang"]["$id_produk"]);

echo "<script>alert('Buku Di Hapus Dari Keranjang');</script>";
echo "<script>location = 'peminjaman';</script>";
