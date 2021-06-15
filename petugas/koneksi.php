<?php
$db_host	= 'localhost'; //Ini adalah nama hostnya. Kalau dari MYSQL hostnya adalah 'localhost.'
$db_usn		= 'root'; //nama username default dari Database MYSQL. #NOTE: Kita bisa mengubah dari nama usernamenya sesuai kebutuhan kita.
$db_pwd		= ''; //password Default dari Database MYSQL adalah tidak menggunakan password. #NOTE: Kita bisa mengubah passwordnya sesuia kebutuhan kita.
$db_name	= 'perpustakaan2'; //nama database dari database kita. #NOTE: disini saya menggunakan nama database saya dengan 'akademik1', dan bisa kita ganti 								nama database kita sesaui kebutuhan kita.

$konek	= mysqli_connect($db_host, $db_usn, $db_pwd, $db_name);

if (!$konek) {
	echo 'Tidak dapat terhubung ke database';
}
