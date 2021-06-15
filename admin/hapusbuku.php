<?php
// $buku = strip_tags($_GET['id']);
include "../koneksi/koneksi.php";
if (isset($_POST["hapus"])) {
	$id_buku_yang_dipilih = $_POST["pilih"];

	for ($i = 0; $i < sizeof($id_buku_yang_dipilih); $i++) {
		$ambil = $konek->query("SELECT * FROM(buku LEFT JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit)
		                                	LEFT JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang 
                                        	LEFT JOIN kategori ON buku.id_kategori=kategori.id_kategori 
											WHERE id_buku='$id_buku_yang_dipilih[$i]'"); //Ini untuk mengambil data 
		//yang disimpan didatabase
		$pecah = $ambil->fetch_assoc(); //Ini untuk membuat pemecahan data untuk mempermudah filter data.
		$foto_buku = $pecah['foto_buku']; //mencari data foto yang ada pada folder foto_produk.

		if (empty(file_exists("../foto_buku/$foto_buku"))) //Jika tidak ada file foto di dalam folder foto_produk.
		{
			$Cek = $konek->query("DELETE FROM buku WHERE id_buku='$id_buku_yang_dipilih[$i]'"); //lalu hapus semua data beserta
			//foto yang tersimpan di database.
		} else {
			unlink("../foto_buku/$foto_buku"); //maka hapus data tersebut dari folder.
			$Cek = $konek->query("DELETE FROM buku WHERE id_buku='$id_buku_yang_dipilih[$i]'"); //lalu hapus semua data beserta
			//foto yang tersimpan di database.
		}
	}
	if ($Cek > 0) {
		echo "<script>alert('Jumlah Buku Yang Terhapus " . $i . ",Buku berhasil terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
		//dengan menggunakan javascript.
		echo "<script>location='index.php?halaman=buku';</script>"; //lalu kembali ke halaman produk.
	} else {
		echo "<script>alert('buku tidak terhapus');</script>"; //setelah itu buat laporan pengapusan berhasil 
	}
}
