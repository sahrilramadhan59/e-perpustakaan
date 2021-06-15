<?php
//Membuat Penyimpanan Dengan Session.
session_start();
include "petugas/enkripsi.php";

// Mendapatkan id_produk dari url.
$id_produk = decrypt(strip_tags($_GET['id']));

// Jika sudah ada produk itu di keranjang, maka produk itu jumlahnya di + 1.
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
}
// Selain itu (blm ada di keranjang), maka produk itu dianggap di beli 1. 
else {
    $_SESSION['keranjang'][$id_produk] = 1;
}

// Larikan Ke Keranjang Belanja.
echo "<script>alert('Buku Telah Masuk Ke Rak Peminjaman Buku');</script>";
echo "<script>location = 'peminjaman'</script>";
