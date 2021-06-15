<?php
include "../koneksi/koneksi.php";
include "enkripsi.php";
$id_pinjam = decrypt(strip_tags($_GET['id']));
$ambil = $konek->query("SELECT * FROM detail_peminjaman 
INNER JOIN peminjaman ON detail_peminjaman.kode_pinjam=peminjaman.kode_pinjam
INNER JOIN buku ON detail_peminjaman.id_buku=buku.id_buku
INNER JOIN penerbit ON detail_peminjaman.id_penerbit=penerbit.id_penerbit
INNER JOIN pengarang ON detail_peminjaman.id_pengarang=pengarang.id_pengarang
INNER JOIN tb_anggota ON detail_peminjaman.id_anggota=tb_anggota.id_anggota
INNER JOIN kategori ON detail_peminjaman.id_kategori=kategori.id_kategori
INNER JOIN petugas ON detail_peminjaman.id_petugas=petugas.id_petugas
INNER JOIN status_peminjaman ON detail_peminjaman.kode_status_pinjam=status_peminjaman.kode_status_pinjam
WHERE peminjaman.kode_pinjam='$id_pinjam'"); //Ini untuk mengambil data 
//yang disimpan didatabase
$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.

//Menghapus 2 Tabel Dengan INNER JOIN.
$konek->query("DELETE detail_peminjaman, peminjaman FROM detail_peminjaman 
INNER JOIN peminjaman ON peminjaman.kode_pinjam=detail_peminjaman.kode_pinjam 
WHERE detail_peminjaman.kode_pinjam='$id_pinjam'"); //lalu hapus semua data beserta
//foto yang tersimpan di database.

echo "<script>alert('Peminjaman berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
//dengan menggunakan javascript.
echo "<script>location='index.php?halaman=data_peminjaman';</script>"; //lalu kembali ke halaman produk.
