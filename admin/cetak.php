<?php
// memanggil library FPDF
require('../fpdf18/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(190, 7, 'E-Perpustakaan', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'Peminjaman Buku', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(100, 20, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Kode Buku', 1, 0);
$pdf->Cell(25, 6, 'Judul Buku', 1, 0);
$pdf->Cell(27, 6, 'Kategori', 1, 0);
$pdf->Cell(30, 6, 'Tanggal Pinjam', 1, 0);
$pdf->Cell(30, 6, 'Tanggal Kembali', 1, 0);
$pdf->Cell(25, 6, 'No Hp', 1, 0);
$pdf->Cell(27, 6, 'Jumlah Pinjam', 1, 1);

$pdf->SetFont('Arial', '', 10);

include '../koneksi/koneksi.php';
$peminjaman = mysqli_query($konek, "SELECT * FROM peminjaman INNER JOIN buku ON buku.id_buku=peminjaman.id_buku 
                                    INNER JOIN tb_anggota ON tb_anggota.id_anggota=peminjaman.id_anggota
                                    INNER JOIN kategori ON kategori.id_kategori=peminjaman.id_kategori");
while ($row = mysqli_fetch_array($peminjaman)) {
    $pdf->Cell(20, 6, $row['kode_pinjam'], 1, 0);
    $pdf->Cell(25, 6, $row['judul_buku'], 1, 0);
    $pdf->Cell(27, 6, $row['nama_kategori'], 1, 0);
    $pdf->Cell(30, 6, $row['tgl_pinjam'], 1, 0);
    $pdf->Cell(30, 6, $row['tgl_kembali'], 1, 0);
    $pdf->Cell(25, 6, $row['no_hp_anggota'], 1, 0);
    $pdf->Cell(27, 6, $row['jumlah'], 1, 1);
}

$pdf->Output();
