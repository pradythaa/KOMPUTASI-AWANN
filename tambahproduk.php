<?php include 'header.php';
include('koneksi.php');
if ($_SESSION['admin']['level'] == "Operator") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
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
                                <h5 class="m-b-10">Tambah Obat</h5>
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
                                                        <input type="text" class="form-control" name="namaproduk" placeholder="Nama Obat">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Satuan</label>
                                                    <div class="col-sm-10">
                                                        <select required class="form-control" name="satuan">
                                                            <option value="Strip">Strip</option>
                                                            <option value="Box">Box</option>
                                                            <option value="Tube">Tube</option>
                                                            <option value="Pcs">Pcs</option>
                                                            <option value="Botol">Botol</option>
                                                            <option value="Tablet">Tablet</option>
                                                            <option value="Dos">Dos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Stok</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" required class="form-control" name="stok" placeholder="Stok">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Harga Jual</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" required class="form-control" name="hargajual" placeholder="Harga Jual">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Expired</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" required class="form-control" id="exampleFormControlInput1" name="expired" required>
                                                    </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="tambah">Simpan</button>
                                            </form>
                                            <?php
                                            if (isset($_POST['tambah'])) {
                                                $namaproduk = $_POST["namaproduk"];
                                                $stok = $_POST["stok"];
                                                $satuan = $_POST["satuan"];
                                                $hargajual = $_POST["hargajual"];
                                                $expired = $_POST["expired"];
                                                $koneksi->query("INSERT INTO produk(namaproduk,hargajual,satuan,stok,expired)
		VALUES ('$namaproduk','$hargajual','$satuan','$stok','$expired')") or die(mysqli_error($koneksi));
                                                echo "<script> alert('Produk Sudah Disimpan');</script>";
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