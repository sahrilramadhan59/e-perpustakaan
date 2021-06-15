<?php require_once "koneksi.php"; ?>

<?php
if (isset($_GET['kode_qr'])) {
    $filename    = $_GET['kode_qr'];

    $back_dir    = "../Folder_QRCode_Petugas_Perpus/";
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
        $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
        header("location:index.php");
    }
}
?>