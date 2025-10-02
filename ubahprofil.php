<?php include 'header.php';
include('koneksi.php');
$emailadmin = $_SESSION['admin']['email'];
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE email='$emailadmin'");
$pecah = $ambil->fetch_assoc();
?>

<!-- page content -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Ubah Profil</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">

                        <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Profil</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input value="<?= $pecah['email'] ?>" type="text" required class="form-control" name="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input value="<?= $pecah['password'] ?>" type="text" required class="form-control" name="password" placeholder="Password">
                                                    </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="ubah" onclick="return confirm('Apakah Anda Yakin Ingin Merubah Data Ini')">Simpan</button>
                                            </form>
                                            <?php
                                            // echo $_GET['id'];
                                            if (isset($_POST['ubah'])) {
                                                $koneksi->query("UPDATE pengguna SET email='$_POST[email]', password='$_POST[password]' WHERE email='$emailadmin'") or die(mysqli_error($koneksi));
                                                $ambil = $koneksi->query("SELECT * FROM pengguna
        WHERE email='$_POST[email]' limit 1");
                                                $akun = $ambil->fetch_assoc();
                                                $_SESSION['admin'] = $akun;
                                                echo "<script> alert('Data Berhasil Di Ubah');</script>";
                                                echo "<script> location ='ubahprofil.php';</script>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>