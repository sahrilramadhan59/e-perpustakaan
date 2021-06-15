<?php require_once "koneksi/koneksi.php"; ?>

<?php
if (isset($_GET['kode_qr'])) {
    $filename    = $_GET['kode_qr'];

    $back_dir    = "Folder_QRCode_Peminjaman_Buku/";
    $file = $back_dir . $_GET['kode_qr'];

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        exit;
    } else {
        echo "<script>alert('Maaf, File - " . $filename . " - Tidak Di Temukan');</script>";
        echo "<script>location='index?#hero';</script>"; //lalu kembali ke halaman produk.
    }
}
?>