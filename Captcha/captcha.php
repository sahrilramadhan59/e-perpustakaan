<?php
session_start();

//Membuat Bilangan acak 7 digit.
$bilangan = rand(1000000, 9999999);

//Mendaftarkan variable ke dalam sessio.
$_SESSION["bilangan"] = $bilangan;

//Membuat gambar Captcha.
$gambar = imagecreatetruecolor(100, 35);
$background = imagecolorallocate($gambar, 99, 99, 99);
$foreground = imagecolorallocate($gambar, 255, 255, 255);

imagefill($gambar, 20, 20, $background);
imagestring($gambar, 10, 17, 10, $bilangan, $foreground);

//Menentukan Header.
header("Cache-control: no-cache, must-revalidate");
header("COntent-type: image/png");

imagepng($gambar);
imagedestroy($gambar);
