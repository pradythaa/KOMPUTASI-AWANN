<?php session_start();
include('koneksi.php');
if (!isset($_SESSION['admin'])) {
  echo "<script>alert('Anda Harus Login');</script>";
  echo "<script>location='home.php';</script>";
  exit();
}
function rupiah($angka)
{
  $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
  return $hasilrupiah;
}
function tanggal($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = bulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function bulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Kasir Apotek</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
  <meta name="author" content="Codedthemes" />
  <!-- Favicon icon -->
  <link rel="icon" href="foto/logoo.png" type="image/x-icon">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  <!-- waves.css -->
  <link rel="stylesheet" href="assets_admin/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
  <!-- Required Fremwork -->
  <link rel="stylesheet" type="text/css" href="assets_admin/assets/css/bootstrap/css/bootstrap.min.css">
  <!-- waves.css -->
  <link rel="stylesheet" href="assets_admin/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
  <!-- themify icon -->
  <link rel="stylesheet" type="text/css" href="assets_admin/assets/icon/themify-icons/themify-icons.css">
  <!-- font-awesome-n -->
  <link rel="stylesheet" type="text/css" href="assets_admin/assets/css/font-awesome-n.min.css">
  <link rel="stylesheet" type="text/css" href="assets_admin/assets/css/font-awesome.min.css">
  <!-- scrollbar.css -->
  <link rel="stylesheet" type="text/css" href="assets_admin/assets/css/jquery.mCustomScrollbar.css">
  <!-- Style.css -->
  <link rel="stylesheet" type="text/css" href="assets_admin/assets/css/style.css">
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    .navbar.header-navbar.pcoded-header {
      background-color: #28a745 !important;
    }
    .navbar.header-navbar.pcoded-header .navbar-logo a p {
      color: white !important;
    }
    .navbar.header-navbar.pcoded-header .nav-left a,
    .navbar.header-navbar.pcoded-header .nav-right a {
      color: white !important;
    }
    .navbar.header-navbar.pcoded-header .user-profile span {
      color: white !important;
    }
    .profile-notification,
    .profile-notification * {
      color: #222 !important;
      text-shadow: none !important;
      -webkit-text-fill-color: #222 !important;
    }
  </style>
</head>

<body>
  <!-- Pre-loader start -->
  <div class="theme-loader">
    <div class="loader-track">
      <div class="preloader-wrapper">
        <div class="spinner-layer spinner-blue">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
        <div class="spinner-layer spinner-red">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>

        <div class="spinner-layer spinner-yellow">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>

        <div class="spinner-layer spinner-green">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <nav class="navbar header-navbar pcoded-header">
        <div class="navbar-wrapper">
          <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
              <i class="ti-menu"></i>
            </a>
            <div class="mobile-search waves-effect waves-light">
              <div class="header-search morphsearch-search">
                <div class="input-group">
                  <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                  <input type="text" class="form-control" placeholder="Enter Keyword">
                  <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                </div>
              </div>
            </div>
            <a href="index.php">
              <p style="font-size: 13px;text-align:left;padding-top:5%;">Kasir Apotek</p>
            </a>
            <a class="mobile-options waves-effect waves-light">
              <i class="ti-more"></i>
            </a>
          </div>
          <div class="navbar-container container-fluid">
            <ul class="nav-left">
              <li>
                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
              </li>
              <li>
                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                  <i class="ti-fullscreen"></i>
                </a>
              </li>
            </ul>
            <ul class="nav-right">
              <li class="user-profile header-notification">
                <a href="#!" class="waves-effect waves-light">
                  <img src="images/admin.png" class="img-radius" alt="User-Profile-Image">
                  <span><?= $_SESSION['admin']['namapengguna'] ?></span>
                  <i class="ti-angle-down"></i>
                </a>
                <ul class="show-notification profile-notification">
                  <li class="waves-effect waves-light">
                    <a href="ubahprofil.php">
                      <i class="ti-user"></i> Ubah Profil
                    </a>
                  </li>
                  <li class="waves-effect waves-light">
                    <a href="logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Keluar')">
                      <i class="ti-layout-sidebar-left"></i> Logout
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
              <div class="">
                <div class="main-menu-header">
                  <img class="img-80 img-radius" src="images/admin.png" alt="User-Profile-Image">
                  <div class="user-details">
                    <span id="more-details"><?= $_SESSION['admin']['namapengguna'] ?></span>
                  </div>
                </div>
              </div>
              <div class="pcoded-navigation-label">Halaman</div>
              <ul class="pcoded-item pcoded-left-item">
                <li>
                  <a href="index.php" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                  </a>
                </li>
              </ul>
              <?php if ($_SESSION['admin']['level'] == 'Admin') { ?>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                      <span class="pcoded-mtext">Data Obat</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class=" ">
                        <a href="tambahproduk.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Tambah Obat</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="daftarproduk.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Persediaan Obat</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-id-badge"></i><b>A</b></span>
                      <span class="pcoded-mtext">Pembelian</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class="">
                        <a href="pembeliantambah.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Tambah Pembelian</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class="">
                        <a href="pembeliandaftar.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Daftar Pembelian</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-map-alt"></i><b>A</b></span>
                      <span class="pcoded-mtext">Penjualan</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class="">
                        <a href="penjualantambah.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Tambah Penjualan</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class="">
                        <a href="penjualandaftar.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Daftar Penjualan</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-receipt"></i><b>A</b></span>
                      <span class="pcoded-mtext">Laporan Transaksi</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class="">
                        <a href="laporanpembelian.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Laporan Pembelian</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class="">
                        <a href="laporanpenjualan.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Laporan Penjualan</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
      
                  </li>
                </ul>
              <?php } ?>
              <?php if ($_SESSION['admin']['level'] == 'Operator') { ?>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="">
                    <a href="daftarproduk.php" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                      <span class="pcoded-mtext">Daftar Obat</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                  </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-map-alt"></i><b>A</b></span>
                      <span class="pcoded-mtext">Penjualan</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class="">
                        <a href="penjualantambah.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Tambah Penjualan</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class="">
                        <a href="penjualandaftar.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Daftar Penjualan</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              <?php
              }
              if ($_SESSION['admin']['level'] == 'Dapur') { ?>
                <ul class="pcoded-item pcoded-left-item">
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                      <span class="pcoded-mtext">Data Obat</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class=" ">
                        <a href="tambahproduk.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Tambah Obat</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="daftarproduk.php" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                          <span class="pcoded-mtext">Persediaan Obat</span>
                          <span class="pcoded-mcaret"></span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              <?php } ?>
            </div>
          </nav>