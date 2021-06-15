<?php
session_start(); //menyimpan data ke dalam session.
include '../koneksi/koneksi.php'; //memanggil koneksi.php.
?>
<?php
if (!isset($_SESSION['admin'])) { //Artinya jika tidak ada $_SESSION['admin'] yang login tidak akan bisa masuk ke dalam dashboard administrator. dan akan di alihkan secara paksa untuk login kembali.
    echo "<script>alert('Anda Harus Login !!!')</script>";
    echo "<script>location='login.php'</script>"; //mengalihkan secara paksa ke dalam form login untuk memastikan apakah yang login admin atau bukan. jika admin maka akan dialihkan ke dashboard administrator. dan jika bukan maka akan di alihkan ke form login untuk login kembali.
    exit();
}
?>
<?php
$id_admin = $_SESSION["admin"]["id_admin"];
$detail_admin = $konek->query("SELECT foto_admin, nama, tanggal, bulan, tahun FROM tb_admin WHERE id_admin='$id_admin'");
$pecah = $detail_admin->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>E-PERPUSTAKAAN</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- FITUR CHATTING E-PERPUSTAKAAN -->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php?halaman=kontak" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3" method="get">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <p class=" text-danger text-right">Terakhir Dilihat Pada Tanggal : <?php echo $pecah["tanggal"]; ?>, <?php echo $pecah["bulan"]; ?> / <?php echo $pecah["tahun"]; ?> &nbsp;</p>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">

                    <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust btn-sm">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">E-PERPUSTAKAAN</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../foto_admin/<?php echo $pecah['foto_admin']; ?>" class="user-image img-responsive" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"><?php echo $pecah['nama']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?php include('sidebar.php'); ?>
                <!-- Sidebar Menu -->
                <?php
                if (isset($_GET['halaman'])) { //Jika mendapatkan nilai 'halaman.' proses. 
                    if ($_GET['halaman'] == "buku") { //jika mendapatkan dengan nilai 'halaman' sama dengan produk,
                        //pindahkan halaman ke pada halaman produk.
                        //memindahkan halaman ke halaman produk dari halaman index.
                        include 'buku.php';
                    }
                    if ($_GET['halaman'] == "buatQRCode") { //jika mendapatkan dengan nilai 'halaman' sama dengan produk,
                        //pindahkan halaman ke pada halaman produk.
                        //memindahkan halaman ke halaman produk dari halaman index.
                        include 'buatQRCode.php';
                    } elseif ($_GET['halaman'] == 'data_anggota') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'data_anggota.php';
                    } elseif ($_GET['halaman'] == 'hapus_anggota') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'hapus_anggota.php';
                    } elseif ($_GET['halaman'] == 'detail_anggota') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'detail_anggota.php';
                    } elseif ($_GET['halaman'] == 'tambahbuku') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'tambahbuku.php';
                    } elseif ($_GET['halaman'] == 'ubahbuku') { //jika mendapatkan dengan nilai 'halaman' samadengan tambahproduk,
                        //pindahkan halaman ke pada halaman tambahproduk.
                        //memindahkan halaman ke halaman tambahproduk dari halaman index.
                        include 'ubahbuku.php';
                    } elseif ($_GET['halaman'] == 'hapusbuku') { //jika mendapatkan dengan nilai 'halaman' samadengan hapusproduk,
                        //pindahkan halaman ke pada halaman hapusproduk.
                        //memindahkan halaman ke halaman hapusproduk dari halaman index.
                        include 'hapusbuku.php';
                    } elseif ($_GET['halaman'] == 'kategori_buku') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'kategori_buku.php';
                    } elseif ($_GET['halaman'] == 'tambah_kategori') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'tambah_kategori.php';
                    } elseif ($_GET['halaman'] == 'ubah_kategori') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'ubah_kategori.php';
                    } elseif ($_GET['halaman'] == 'hapus_kategori') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'hapus_kategori.php';
                    } elseif ($_GET['halaman'] == 'pengarang_buku') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'pengarang_buku.php';
                    } elseif ($_GET['halaman'] == 'tambah_pengarang') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'tambah_pengarang.php';
                    } elseif ($_GET['halaman'] == 'ubah_pengarang') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'ubah_pengarang.php';
                    } elseif ($_GET['halaman'] == 'hapus_pengarang') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'hapus_pengarang.php';
                    } elseif ($_GET['halaman'] == 'penerbit_buku') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'penerbit_buku.php';
                    } elseif ($_GET['halaman'] == 'tambah_penerbit') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'tambah_penerbit.php';
                    } elseif ($_GET['halaman'] == 'ubah_penerbit') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'ubah_penerbit.php';
                    } elseif ($_GET['halaman'] == 'hapus_penerbit') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'hapus_penerbit.php';
                    } elseif ($_GET['halaman'] == 'kontak') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'kontak.php';
                    } elseif ($_GET['halaman'] == 'profil_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'profil_petugas.php';
                    } elseif ($_GET['halaman'] == 'chat') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'chat.php';
                    } elseif ($_GET['halaman'] == 'chart') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'chart.php';
                    } elseif ($_GET['halaman'] == 'data_pribadi') { //jika mendapatkan dengan nilai 'halaman' samadengan laporan_pembelian,
                        //pindahkan halaman ke pada halaman laporan_pembelian.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'data_pribadi.php';
                    } elseif ($_GET['halaman'] == 'edit_data_pribadi') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'edit_data_pribadi.php';
                    } elseif ($_GET['halaman'] == 'data_admin') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'data_admin.php';
                    } elseif ($_GET['halaman'] == 'ubah_admin') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'ubah_admin.php';
                    } elseif ($_GET['halaman'] == 'data_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'data_petugas.php';
                    } elseif ($_GET['halaman'] == 'tambah_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'tambah_petugas.php';
                    } elseif ($_GET['halaman'] == 'detail_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'detail_petugas.php';
                    } elseif ($_GET['halaman'] == 'ubah_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'ubah_petugas.php';
                    } elseif ($_GET['halaman'] == 'hapus_petugas') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'hapus_petugas.php';
                    } elseif ($_GET['halaman'] == 'data_peminjaman') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'data_peminjaman.php';
                    } elseif ($_GET['halaman'] == 'detail_peminjaman') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'detail_peminjaman.php';
                    } elseif ($_GET['halaman'] == 'tambah_peminjaman') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'tambah_peminjaman.php';
                    } elseif ($_GET['halaman'] == 'hapus_peminjaman') { //jika mendapatkan dengan nilai 'halaman' samadengan ubahproduk,
                        //pindahkan halaman ke pada halaman ubahproduk.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'hapus_peminjaman.php';
                    } elseif ($_GET['halaman'] == 'logout') { //jika mendapatkan dengan nilai 'halaman' samadengan logout,
                        //pindahkan halaman ke pada halaman logout.
                        //memindahkan halaman ke halaman ubah dari halaman index.
                        include 'logout.php';
                    }
                } else { //jika mendapatkan dengan nilai selain dari 'halaman',
                    //maka pindahkan ke pada halaman home.
                    //memindahkan halaman ke halaman ubah dari halaman index.
                    include 'home2.php';
                }
                ?>
                <!-- Isi Dashboard -->
                <?php include('footer.php'); ?>
                <!-- Isi Dashboard -->
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->
            <!-- jQuery -->
            <script src="../assets/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- DataTables -->
            <script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
            <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
            <!-- AdminLTE App -->
            <script src="../assets/dist/js/adminlte.min.js"></script>
            <!-- OPTIONAL SCRIPTS -->
            <script src="../assets/plugins/chart.js/Chart.min.js"></script>
            <!-- AREA DASHBOARD GRAFIK -->
            <script>
                $(function() {
                    'use strict'

                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                    }

                    var mode = 'index'
                    var intersect = true

                    var $salesChart = $('#sales-chart')
                    var salesChart = new Chart($salesChart, {
                        type: 'bar',
                        data: {
                            labels: [
                                'Komputer',
                                'Teknologi',
                                'Bahasa Dan Sastra',
                                'Pertanian',
                                'Kesehatan'
                            ],
                            datasets: [{
                                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                                borderColor: '#007bff',
                                data: [
                                    <?php
                                    $Jumlah_Komputer = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Komputer'");
                                    echo mysqli_num_rows($Jumlah_Komputer);
                                    ?>,
                                    <?php
                                    $Jumlah_Teknologi = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Teknologi'");
                                    echo mysqli_num_rows($Jumlah_Teknologi);
                                    ?>,
                                    <?php
                                    $Jumlah_Bahasa = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Bahasa Dan Sastra'");
                                    echo mysqli_num_rows($Jumlah_Bahasa);
                                    ?>,
                                    <?php
                                    $Jumlah_Pertanian = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Pertanian'");
                                    echo mysqli_num_rows($Jumlah_Pertanian);
                                    ?>,
                                    <?php
                                    $Jumlah_Kesehatan = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Kesehatan'");
                                    echo mysqli_num_rows($Jumlah_Kesehatan);
                                    ?>
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    // display: false,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,

                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            if (value >= 1000) {
                                                value /= 1000
                                                value += 'k'
                                            }
                                            return '' + value
                                        }
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })
                })
            </script>
            <!-- ChartJS -->
            <script src="../assets/chart.js/Chart.min.js"></script>
            <!-- page script -->
            <script>
                $(function() {
                    $("#example1").DataTable();
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                    });
                });
            </script>
            <!-- AREA GRAFIK DATA -->
            <script>
                $(function() {
                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                    var donutData = {
                        labels: [
                            'Komputer',
                            'Teknologi',
                            'Bahasa Dan Sastra'
                        ],
                        datasets: [{
                            data: [
                                <?php
                                $Jumlah_Komputer = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Komputer'");
                                echo mysqli_num_rows($Jumlah_Komputer);
                                ?>,
                                <?php
                                $Jumlah_Teknologi = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Teknologi'");
                                echo mysqli_num_rows($Jumlah_Teknologi);
                                ?>,
                                <?php
                                $Jumlah_Bahasa = $konek->query("SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori=kategori.id_kategori WHERE kategori.nama_kategori='Bahasa Dan Sastra'");
                                echo mysqli_num_rows($Jumlah_Bahasa);
                                ?>
                            ],
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }]
                    }
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var donutChart = new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                    })
                })
            </script>
            <!-- ChartJS -->

</body>

</html>