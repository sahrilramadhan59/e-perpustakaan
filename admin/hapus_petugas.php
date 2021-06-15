<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
$id_petugas = decrypt(strip_tags($_GET['id']));
$ambil = $konek->query("SELECT * FROM petugas INNER JOIN status_petugas ON petugas.id_status=status_petugas.id_status 
INNER JOIN akses_petugas ON petugas.id_akses=akses_petugas.id_akses 
WHERE id_petugas='$id_petugas'"); //Ini untuk mengambil data 
//yang disimpan didatabase
$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
$foto_petugas = $pecah['foto']; //mencari data foto yang ada pada folder foto_produk.

if (file_exists("../foto_petugas/$foto_petugas")) //Jika ada file foto di dalam folder foto_produk.
{
    unlink("../foto_petugas/$foto_petugas"); //maka hapus data tersebut dari folder.
}

$konek->query("DELETE FROM petugas WHERE id_petugas='$id_petugas'"); //lalu hapus semua data beserta
//foto yang tersimpan di database.

echo "<script>alert('Petugas berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
//dengan menggunakan javascript.
echo "<script>location='index.php?halaman=data_petugas';</script>"; //lalu kembali ke halaman produk.
