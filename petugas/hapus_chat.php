<?php
include "koneksi.php";
include "enkripsi.php";
$id_chat = decrypt($_GET['id']);
$konek->query("DELETE FROM chat WHERE id_chat='$id_chat'"); //lalu hapus semua data beserta

echo "<script>location='index.php?halaman=kotak_masuk';</script>"; //lalu kembali ke halaman produk.
