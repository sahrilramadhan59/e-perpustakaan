<?php
include '../koneksi/koneksi.php'; //memanggil koneksi.php.
?>
<?php
$id_admin = $_SESSION["admin"]["id_admin"];
$detail_admin = $konek->query("SELECT foto_admin, nama, tanggal, bulan, tahun FROM tb_admin WHERE id_admin='$id_admin'");
$pecah = $detail_admin->fetch_assoc();
?>
<div class="wrapper">
  <!-- Isi Dashboard -->
  <?php include('isi_dashboard.php'); ?>
  <!-- Isi Dashboard -->
</div>