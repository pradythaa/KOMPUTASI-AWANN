<?php include 'header.php';
if ($_SESSION['admin']['level'] != "Admin") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
include('koneksi.php');
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE idpengguna='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>


<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Ubah Pengguna</h5>
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
                                            <h5>Data Pengguna</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nama Pengguna</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?= $pecah['namapengguna'] ?>" class="form-control" name="namapengguna" placeholder="Nama Pengguna">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?= $pecah['email'] ?>" required class="form-control" name="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input value="<?= $pecah['password'] ?>" type="text" required class="form-control" name="password" placeholder="Password">
                                                        <span class="text-danger">Kosongkan jika tidak ingin mengubah Password</span>
                                                        <input value="<?= $pecah['password'] ?>" type="hidden" required class="form-control" name="passwordlama" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Hak Akses<< /label>
                                                            <div class="col-sm-10">
                                                                <select required class="form-control" name="level">
                                                                    <option <?php if ($pecah['level'] == 'Admin') echo 'selected'; ?> value="Admin">Admin</option>
                                                                    <option <?php if ($pecah['level'] == 'Operator') echo 'selected'; ?> value="Operator">Operator</option>
                                                                </select>
                                                            </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="tambah">Simpan</button>
                                            </form>
                                            <?php

                                            if (isset($_POST['tambah'])) {
                                                $password = $_POST['password'];
                                                if ($password != "") {
                                                    $passwordfix = $_POST['password'];
                                                } else {
                                                    $passwordfix = $_POST['passwordlama'];
                                                }
                                                $koneksi->query("UPDATE pengguna SET namapengguna='$_POST[namapengguna]', email='$_POST[email]', password='$password', level='$_POST[level]' WHERE idpengguna='$_GET[id]'") or die(mysqli_error($koneksi));
                                                echo "<script> alert('Pengguna Berhasil Di Ubah');</script>";
                                                echo "<script> location ='penggunadaftar.php';</script>";
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
<?php

if (isset($_POST['tambah'])) {
    $password = $_POST['password'];
    if ($password != "") {
        $passwordfix = $_POST['password'];
    } else {
        $passwordfix = $_POST['passwordlama'];
    }
    $koneksi->query("UPDATE pengguna SET namapengguna='$_POST[namapengguna]', email='$_POST[email]', password='$password', level='$_POST[level]' WHERE idpengguna='$_GET[id]'") or die(mysqli_error($koneksi));
    echo "<script> alert('Pengguna Berhasil Di Ubah');</script>";
    echo "<script> location ='penggunadaftar.php';</script>";
}
?>
</div>


<?php include 'footer.php'; ?>