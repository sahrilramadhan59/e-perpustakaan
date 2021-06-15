<?php
include "koneksi.php";
include "enkripsi.php";
$buku = decrypt(strip_tags($_GET['id']));
$ambil = $konek->query("SELECT * FROM(buku LEFT JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit)
		                                	LEFT JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang 
                                        	LEFT JOIN kategori ON buku.id_kategori=kategori.id_kategori 
											WHERE id_buku='$buku'"); //Ini untuk mengambil data 
//yang disimpan didatabase
$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
$foto_buku = $pecah['foto_buku']; //mencari data foto yang ada pada folder foto_produk.

if (file_exists("../foto_buku/$foto_buku")) //Jika ada file foto di dalam folder foto_produk.
{
	unlink("../foto_buku/$foto_buku"); //maka hapus data tersebut dari folder.
}

$konek->query("DELETE FROM buku WHERE id_buku='$buku'"); //lalu hapus semua data beserta
//foto yang tersimpan di database.

echo "<script>alert('buku berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
//dengan menggunakan javascript.
echo "<script>location='index.php?halaman=buku';</script>"; //lalu kembali ke halaman produk.
