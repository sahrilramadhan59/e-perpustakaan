<?php
include 'koneksi.php'; //memanggil koneksi.php.
?>
<?php
$id_petugas = $_SESSION["petugas"]["id_petugas"];
$detail_petugas = $konek->query("SELECT foto, nama_petugas, tanggal, bulan, tahun FROM petugas WHERE id_petugas='$id_petugas'");
$pecah = $detail_petugas->fetch_assoc();
?>
<div class="wrapper">
  <!-- Isi Dashboard -->
  <?php include('isi_dashboard.php'); ?>
  <!-- Isi Dashboard -->
</div>