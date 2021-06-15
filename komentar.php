<?php
session_start();
require "koneksi/koneksi.php";
include "petugas/enkripsi.php";

// Jika tidak ada session pelanggan(blm login pelanggan), maka di larikan(di alihkan) ke form login(login.php).
if (!isset($_SESSION['anggota'])) {
    echo "<script>alert('Anda belum login, Silakan login dulu');</script>";
    echo "<script>location = 'index?halaman=login2';</script>";
}

//Jika ada tombol daftar(atau tombol daftar di klik). 
if (isset($_POST["kirim"])) { //Maka proses selanjutnya. Yaitu.
    //Mengambil nilai dari nama, email, password, telepon, alamat.
    $id_anggota = $_SESSION["anggota"]["id_anggota"];
    $saran = htmlspecialchars($_POST["saran"]);

    $konek->query("INSERT INTO saran(id_anggota, saran)
                                VALUES('$id_anggota','$saran')");

    echo "<script>alert('Terima Kasih Atas Saran Kamu');</script>";
    echo "<script>location='index';</script>";
}
