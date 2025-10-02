<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kasir Apotek </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="foto/logoo.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets_home/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/flaticon.css">
    <link rel="stylesheet" href="assets_home/assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets_home/assets/css/slicknav.css">
    <link rel="stylesheet" href="assets_home/assets/css/animate.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets_home/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets_home/assets/css/slick.css">
    <link rel="stylesheet" href="assets_home/assets/css/nice-select.css">
    <link rel="stylesheet" href="assets_home/assets/css/style.css">
    <style>
      #modalDaftar .btn:hover, 
      #modalDaftar .btn:focus, 
      #modalDaftar .btn:active {
        background-color: inherit !important;
        color: inherit !important;
        border-color: inherit !important;
        box-shadow: none !important;
        text-decoration: none !important;
        outline: none !important;
        filter: none !important;
      }
    </style>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="foto/logoo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-md-9">
                            <div class="logo">
                                <a href="home.php"><img style="height:100px;" src="foto/logoo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="menu-wrapper">
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="home.php">Home</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalDaftar">Daftar</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>

        <div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" data-background="assets_home/assets/img/hero/bgatas.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-10 text-center">
                                <div class="hero__caption">

                                    <h1>Selamat Datang Di Website<br> Kasir Apotek </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="our-services section-pad-t30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Kasir Apotek</span>
                            <h2>Silahkan Login </h2>
                        </div>

                    </div>
                </div>

            </div>
            <div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets_home/assets/img/gallery/how-applybg.png">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <form class="form-contact contact_form" method="post" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-2 text-white">Email</label>
                                            <input class="form-control valid" name="email" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Email'" placeholder="Masukkan Email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="mb-2 text-white">Password</label>
                                            <input class="form-control" name="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Password'" placeholder="Masukkan Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" name="login" value="login" class="button button-contactForm boxed-btn">Login</button>
                                </div>
                                <?php
                                include('koneksi.php');
                                if (isset($_POST["login"])) {
                                    $email = $_POST["email"];
                                    $password = $_POST["password"];
                                    $ambil = $koneksi->query("SELECT * FROM pengguna
		                WHERE email='$email' AND password='$password' limit 1");
                                    $akunyangcocok = $ambil->num_rows;
                                    if ($akunyangcocok == 1) {
                                        $akun = $ambil->fetch_assoc();
                                        $_SESSION['admin'] = $akun;
                                        echo "<script> alert('Login Berhasil');</script>";
                                        echo "<script> location ='index.php';</script>";
                                        print_r($_SESSION['admin']);
                                    } else {
                                        echo "<script> alert('Login Gagal, Email atau Password anda salah');</script>";
                                        echo "<script> location ='home.php';</script>";
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    


    <!-- All JS Custom Plugins Link Here here -->
    <script src="assets_home/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="assets_home/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets_home/assets/js/popper.min.js"></script>
    <script src="assets_home/assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="assets_home/assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="assets_home/assets/js/owl.carousel.min.js"></script>
    <script src="assets_home/assets/js/slick.min.js"></script>
    <script src="assets_home/assets/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="assets_home/assets/js/wow.min.js"></script>
    <script src="assets_home/assets/js/animated.headline.js"></script>
    <script src="assets_home/assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="assets_home/assets/js/jquery.scrollUp.min.js"></script>
    <script src="assets_home/assets/js/jquery.nice-select.min.js"></script>
    <script src="assets_home/assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="assets_home/assets/js/contact.js"></script>
    <script src="assets_home/assets/js/jquery.form.js"></script>
    <script src="assets_home/assets/js/jquery.validate.min.js"></script>
    <script src="assets_home/assets/js/mail-script.js"></script>
    <script src="assets_home/assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="assets_home/assets/js/plugins.js"></script>
    <script src="assets_home/assets/js/main.js"></script>

    <!-- Modal Daftar -->
    <div class="modal fade" id="modalDaftar" tabindex="-1" role="dialog" aria-labelledby="modalDaftarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDaftarLabel">Daftar Akun</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="">
            <div class="modal-body">
              <div class="form-group">
                <label for="namapengguna">Nama Pengguna</label>
                <input type="text" class="form-control" id="namapengguna" name="namapengguna" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="level">Role</label>
                <select class="form-control" id="level" name="level" required>
                  <option value="Admin">Admin</option>
                  <option value="Operator">Operator</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php
    if (isset($_POST['daftar'])) {
        $namapengguna = $_POST['namapengguna'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        // Cek apakah email sudah terdaftar
        $cek = $koneksi->query("SELECT * FROM pengguna WHERE email='$email'");
        if ($cek->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar!');</script>";
        } else {
            $simpan = $koneksi->query("INSERT INTO pengguna (namapengguna, email, password, level) VALUES ('$namapengguna', '$email', '$password', '$level')");
            if ($simpan) {
                echo "<script>alert('Pendaftaran berhasil! Silakan login.');</script>";
                echo "<script>location='home.php';</script>";
            } else {
                echo "<script>alert('Pendaftaran gagal!');</script>";
            }
        }
    }
    ?>

</body>

</html>