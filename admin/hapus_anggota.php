<?php
// $buku = strip_tags($_GET['id']);
include "../koneksi/koneksi.php";
if (isset($_POST["hapus"])) {
    $id_anggota_yang_dipilih = $_POST["pilih"];

    for ($i = 0; $i < sizeof($id_anggota_yang_dipilih); $i++) {
        $ambil = $konek->query("SELECT * FROM tb_anggota WHERE id_anggota='$id_anggota_yang_dipilih[$i]'"); //Ini untuk mengambil data 
        //yang disimpan didatabase
        $pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
        $foto_anggota = $pecah['foto']; //mencari data foto yang ada pada folder foto_produk.

        if (empty(file_exists("../foto_anggota/$foto_anggota"))) //Jika tidak ada file foto di dalam folder foto_produk.
        {
            $Cek = $konek->query("DELETE FROM tb_anggota WHERE id_anggota='$id_anggota_yang_dipilih[$i]'"); //lalu hapus semua data beserta
            //foto yang tersimpan di database.
        } else {
            unlink("../foto_anggota/$foto_anggota"); //maka hapus data tersebut dari folder.
            $Cek = $konek->query("DELETE FROM tb_anggota WHERE id_anggota='$id_anggota_yang_dipilih[$i]'"); //lalu hapus semua data beserta
            //foto yang tersimpan di database.
        }
    }
    if ($Cek > 0) {
        echo "<script>alert('Jumlah Anggota Yang Terhapus " . $i . ",Buku berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
        //dengan menggunakan javascript.
        echo "<script>location='index.php?halaman=data_anggota';</script>"; //lalu kembali ke halaman produk.
    } else {
        echo "<script>alert('Anggota tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
    }
}
