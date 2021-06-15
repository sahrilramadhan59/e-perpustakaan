<?php
include "koneksi.php";
if (isset($_POST["hapus"])) {
    $kode_pinjam_yang_dipilih = $_POST["pilih"];

    for ($i = 0; $i < sizeof($kode_pinjam_yang_dipilih); $i++) {
        $ambil = $konek->query("SELECT * FROM detail_peminjaman 
        INNER JOIN peminjaman ON detail_peminjaman.kode_pinjam=peminjaman.kode_pinjam
        INNER JOIN buku ON detail_peminjaman.id_buku=buku.id_buku
        INNER JOIN penerbit ON detail_peminjaman.id_penerbit=penerbit.id_penerbit
        INNER JOIN pengarang ON detail_peminjaman.id_pengarang=pengarang.id_pengarang
        INNER JOIN tb_anggota ON detail_peminjaman.id_anggota=tb_anggota.id_anggota
        INNER JOIN kategori ON detail_peminjaman.id_kategori=kategori.id_kategori
        INNER JOIN petugas ON detail_peminjaman.id_petugas=petugas.id_petugas
        WHERE peminjaman.kode_pinjam='$kode_pinjam_yang_dipilih[$i]'"); //Ini untuk mengambil data 
        //yang disimpan didatabase

        $pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
        //Menghapus 2 Tabel Dengan INNER JOIN.
        $Cek = $konek->query("DELETE detail_peminjaman, peminjaman FROM detail_peminjaman 
        INNER JOIN peminjaman ON peminjaman.kode_pinjam=detail_peminjaman.kode_pinjam 
        WHERE detail_peminjaman.kode_pinjam='$kode_pinjam_yang_dipilih[$i]'");
        //lalu hapus semua data beserta
    }
    if ($Cek > 0) {
        echo "<script>alert('Jumlah Buku Yang Terhapus " . $i . ",Buku berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
        //dengan menggunakan javascript.
        echo "<script>location='index.php?halaman=data_peminjaman';</script>"; //lalu kembali ke halaman produk.
    } else {
        echo "<script>alert('buku tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
    }
}
