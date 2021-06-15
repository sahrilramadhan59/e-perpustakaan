<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validasi</title>
</head>

<body>
    <?php
    if (isset($_POST["kirim"])) {
        $capctha = $_SESSION["bilangan"];
        $bil_capctha = strip_tags($_POST["aktivasi"]);
        if ($capctha == $bil_capctha) {
            echo "<script>alert('Capctha Benar');</script>";
            echo "<script>location='../index?halaman=login';</script>";
        } else {
            echo "<script>alert('Capctha Salah');</script>";
            echo "<script>location='form_captcha';</script>";
        }
    }
    ?>
</body>

</html>