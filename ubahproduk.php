<?php include 'header.php';
include('koneksi.php');
if ($_SESSION['admin']['level'] == "Operator") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<!-- page content -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Ubah Produk</h5>
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
                                            <h5>Data Obat</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nama Obat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?= $pecah['namaproduk'] ?>" class="form-control" name="namaproduk" placeholder="Nama Obat">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Satuan</label>
                                                    <div class="col-sm-10">
                                                        <select required class="form-control" name="satuan">
                                                            <option <?php if ($pecah['satuan'] == 'Strip') echo 'selected'; ?> value="Strip">Strip</option>
                                                            <option <?php if ($pecah['satuan'] == 'Box') echo 'selected'; ?> value="Box">Box</option>
                                                            <option <?php if ($pecah['satuan'] == 'Tube') echo 'selected'; ?> value="Tube">Tube</option>
                                                            <option <?php if ($pecah['satuan'] == 'Pcs') echo 'selected'; ?> value="Pcs">Pcs</option>
                                                            <option <?php if ($pecah['satuan'] == 'Botol') echo 'selected'; ?> value="Botol">Botol</option>
                                                            <option <?php if ($pecah['satuan'] == 'Tablet') echo 'selected'; ?> value="Tablet">Tablet</option>
                                                            <option <?php if ($pecah['satuan'] == 'Dos') echo 'selected'; ?> value="Dos">Dos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Stok</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" value="<?= $pecah['stok'] ?>" required class="form-control" name="stok" placeholder="Stok">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Harga Jual</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" value="<?= $pecah['hargajual'] ?>" required class="form-control" name="hargajual" placeholder="Harga Jual">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Expired</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" value="<?= $pecah['expired'] ?>" required class="form-control" id="exampleFormControlInput1" name="expired" required>
                                                    </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="tambah">Simpan</button>
                                            </form>
                                            <?php
                                            if (isset($_POST['tambah'])) {
                                                $koneksi->query("UPDATE produk SET namaproduk='$_POST[namaproduk]',satuan='$_POST[satuan]', stok='$_POST[stok]', hargajual='$_POST[hargajual]', expired='$_POST[expired]' WHERE idproduk='$_GET[id]'") or die(mysqli_error($koneksi));
                                                echo "<script> alert('Produk Sudah Diupdate');</script>";
                                                echo "<script> location ='daftarproduk.php';</script>";
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


<?php include 'footer.php'; ?>