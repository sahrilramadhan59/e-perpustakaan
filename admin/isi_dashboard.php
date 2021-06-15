<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Kategori Terbanyak Berdasarkan Buku Yang Digunakan</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-danger"></i> Komputer
                                </span>

                                <span class="mr-2">
                                    <i class="fas fa-square text-green"></i> Teknologi
                                </span>

                                <span class="mr-2">
                                    <i class="fas fa-square text-orange"></i> Bahasa Dan Sastra
                                </span>

                                <span class="mr-2">
                                    <i class="fas fa-square text-cyan"></i> Pertanian
                                </span>

                                <span>
                                    <i class="fas fa-square text-blue"></i> Kesehatan
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->