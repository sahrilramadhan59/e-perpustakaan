<?php
include "koneksi.php";
include "enkripsi.php";
$id_pengarang = decrypt(strip_tags($_GET["id"]));
$ambil = $konek->query("SELECT * FROM pengarang WHERE id_pengarang='$pengarang'"); //Ini untuk mengambil data 
//yang disimpan didatabase
$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
$foto_pengarang = strip_tags($pecah['foto_pengarang']); //mencari data foto yang ada pada folder foto_produk.

if (file_exists("../foto_pengarang/$foto_pengarang")) //Jika ada file foto di dalam folder foto_produk.
{
    unlink("../foto_pengarang/$foto_pengarang"); //maka hapus data tersebut dari folder.
}

$konek->query("DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'"); //lalu hapus semua data beserta
//foto yang tersimpan di database.

echo "<script>alert('Pengarang berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
//dengan menggunakan javascript.
echo "<script>location='index.php?halaman=pengarang_buku';</script>"; //lalu kembali ke halaman produk.
