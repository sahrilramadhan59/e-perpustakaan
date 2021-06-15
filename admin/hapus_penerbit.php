<?php
include "../koneksi/koneksi.php";
$id_penerbit = base64_decode(strip_tags($_GET['id']));
$ambil = $konek->query("SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit'"); //Ini untuk mengambil data 
//yang disimpan didatabase
$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
$foto_penerbit = strip_tags($pecah['foto_penerbit']); //mencari data foto yang ada pada folder foto_produk.

if (file_exists("../foto_penerbit/$foto_penerbit")) //Jika ada file foto di dalam folder foto_produk.
{
    unlink("../foto_penerbit/$foto_penerbit"); //maka hapus data tersebut dari folder.
}

$konek->query("DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'"); //lalu hapus semua data beserta
//foto yang tersimpan di database.

echo "<script>alert('Penerbit berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
//dengan menggunakan javascript.
echo "<script>location='index.php?halaman=penerbit_buku';</script>"; //lalu kembali ke halaman produk.
