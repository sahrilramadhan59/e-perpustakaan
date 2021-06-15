<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aktivasi</title>
    <!-- Favicons -->
    <link href="../Template_Home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../Template_Home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Template_Home/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../Template_Home/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Template_Home/assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../Template_Home/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../Template_Home/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../Template_Home/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php include "../menu.php"; ?>
    <!-- Navbar -->

    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="about-content">
                        <br>
                        <h2>Verifikasi Capcha</h2>
                        <form action="validasiCapthca.php" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class=" control-label col-md-3">Kode Verifikasi</label>
                                <div class="col-md-7">
                                    <input type="text" name="aktivasi" placeholder="Masukan Kode Aktivasi Capcha Anda" maxlength="7" class="form-control" required autofocus>
                                    <img src="captcha.php" class="img-fluid col-md-offset-3">
                                </div>
                            </div>
                            <div class=" form-group">
                                <div class=" col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="kirim">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "../footer.php"; ?>
    <!-- Footer -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="../Template_Home/assets/vendor/jquery/jquery.min.js"></script>
    <script src="../Template_Home/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Template_Home/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="../Template_Home/assets/vendor/php-email-form/validate.js"></script>
    <script src="../Template_Home/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../Template_Home/assets/vendor/counterup/counterup.min.js"></script>
    <script src="../Template_Home/assets/vendor/venobox/venobox.min.js"></script>
    <script src="../Template_Home/assets/vendor/mobile-nav/mobile-nav.js"></script>
    <script src="../Template_Home/assets/vendor/wow/wow.min.js"></script>
    <script src="../Template_Home/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../Template_Home/assets/vendor/waypoints/jquery.waypoints.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../Template_Home/assets/js/main.js"></script>
</body>

</html>