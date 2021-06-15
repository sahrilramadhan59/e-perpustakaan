<?php
// memanggil library FPDF
require('../fpdf18/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(290, 7, 'E-Perpustakaan', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(290, 7, 'Data Pengembalian Buku', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(100, 20, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 10, 'Nama', 1, 0);
$pdf->Cell(35, 10, 'Buku', 1, 0);
$pdf->Cell(35, 10, 'Tgl Pinjam', 1, 0);
$pdf->Cell(35, 10, 'Tgl Kembali', 1, 0);
$pdf->Cell(35, 10, 'Jumlah', 1, 0);
$pdf->Cell(37, 10, 'Status', 1, 0);
$pdf->Cell(35, 10, 'Telat', 1, 0);
$pdf->Cell(32, 10, 'Denda', 1, 1);

$pdf->SetFont('Arial', '', 10);

include 'koneksi.php';
$peminjaman = mysqli_query($konek, "SELECT tb_anggota.nama_anggota, tb_anggota.email_anggota, tb_anggota.no_hp_anggota, tb_anggota.alamat,
buku.judul_buku, buku.tahun_buku, penerbit.nama_penerbit, pengarang.nama_pengarang, kategori.nama_kategori, pengembalian.denda, 
pengembalian.keterlambatan, status_peminjaman.status, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.kode_pinjam, 
peminjaman.jumlah, detail_peminjaman.id_detail_pinjam, detail_peminjaman.kode_pinjam FROM detail_pengembalian 
INNER JOIN pengembalian ON pengembalian.kode_kembali=detail_pengembalian.kode_kembali
INNER JOIN tb_anggota ON tb_anggota.id_anggota=pengembalian.id_anggota
INNER JOIN buku ON buku.id_buku=pengembalian.id_buku
INNER JOIN kategori ON kategori.id_kategori=pengembalian.id_kategori
INNER JOIN penerbit ON penerbit.id_penerbit=pengembalian.id_penerbit
INNER JOIN pengarang ON pengarang.id_pengarang=pengembalian.id_pengarang
INNER JOIN status_peminjaman ON status_peminjaman.kode_status_pinjam=pengembalian.kode_status_pinjam
INNER JOIN detail_peminjaman ON detail_peminjaman.id_detail_pinjam=pengembalian.id_detail_pinjam
INNER JOIN peminjaman ON peminjaman.kode_pinjam=detail_peminjaman.kode_pinjam");
while ($row = mysqli_fetch_array($peminjaman)) {
    $pdf->Cell(35, 10, $row['nama_anggota'], 1, 0);
    $pdf->Cell(35, 10, $row['judul_buku'], 1, 0);
    $pdf->Cell(35, 10, $row['tgl_pinjam'], 1, 0);
    $pdf->Cell(35, 10, $row['tgl_kembali'], 1, 0);
    $pdf->Cell(35, 10, $row['jumlah'], 1, 0);
    $pdf->Cell(37, 10, $row['status'], 1, 0);
    $pdf->Cell(35, 10, $row['keterlambatan'], 1, 0);
    $pdf->Cell(32, 10, $row['denda'], 1, 1);
}

$pdf->Output();
