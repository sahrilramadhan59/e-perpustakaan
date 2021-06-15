<?php
include "../koneksi/koneksi.php";
$id_kategori = base64_decode(strip_tags($_GET['id']));
$konek->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'"); //lalu hapus semua data beserta
//foto yang tersimpan di database.

echo "<script>alert('Kategori berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
//dengan menggunakan javascript.
echo "<script>location='index.php?halaman=kategori_buku';</script>"; //lalu kembali ke halaman produk.
