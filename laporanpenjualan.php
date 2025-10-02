<?php include('header.php');
if (isset($_POST['submit'])) {
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];
    $namabarang = $_POST['namabarang'];
    $cek = $koneksi->query("SELECT * FROM produk WHERE namaproduk='$namabarang'");
    $datacek = $cek->fetch_assoc();
    $idbarang = $datacek['idproduk'];
} else {
    $hariini = date('Y-m-d');
    $tahun = date('Y');
    $bulan = date('m');
    $namabarang = "";
    $idbarang = "";
}
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
                                <h5 class="m-b-10">Laporan Penjualan</h5>
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
                                            <h5>Data Laporan Penjualan</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post">
                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>Pilih Tahun</label>
                                                            <select name="tahun" class="form-control" id="tahun" required>
                                                                <option value="">Pilih Tahun</option>
                                                                <?php
                                                                $tahunselect = 2021;
                                                                while ($tahunselect <= 2025) { ?>
                                                                    <option <?php if ($tahun == $tahunselect) echo 'selected'; ?> value="<?= $tahunselect ?>"><?= $tahunselect ?></option>
                                                                <?php
                                                                    $tahunselect++;
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Pilih Bulan</label>
                                                            <select name="bulan" class="form-control" id="" required>
                                                                <option value="">Pilih Bulan</option>
                                                                <option <?php if ($bulan == '01') echo 'selected'; ?> value="01">Januari</option>
                                                                <option <?php if ($bulan == '02') echo 'selected'; ?> value="02">Februari</option>
                                                                <option <?php if ($bulan == '03') echo 'selected'; ?> value="03">Maret</option>
                                                                <option <?php if ($bulan == '04') echo 'selected'; ?> value="04">April</option>
                                                                <option <?php if ($bulan == '05') echo 'selected'; ?> value="05">Mei</option>
                                                                <option <?php if ($bulan == '06') echo 'selected'; ?> value="06">Juni</option>
                                                                <option <?php if ($bulan == '07') echo 'selected'; ?> value="07">Juli</option>
                                                                <option <?php if ($bulan == '08') echo 'selected'; ?> value="08">Agustus</option>
                                                                <option <?php if ($bulan == '09') echo 'selected'; ?> value="09">September</option>
                                                                <option <?php if ($bulan == '10') echo 'selected'; ?> value="10">Oktober</option>
                                                                <option <?php if ($bulan == '11') echo 'selected'; ?> value="11">November</option>
                                                                <option <?php if ($bulan == '12') echo 'selected'; ?> value="12">Desember</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Pilih Nama Obat</label>
                                                            <select name="namabarang" class="form-control">
                                                                <option value="">Pilih Produk</option>
                                                                <?php $ambil = $koneksi->query("SELECT*FROM produk"); ?>
                                                                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                                                    <option <?php if ($namabarang == $pecah['namaproduk']) echo 'selected'; ?> value="<?= $pecah['namaproduk'] ?>"><?= $pecah['namaproduk'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <button type="submit" name="submit" value="submit" class="btn btn-primary text-white" style="margin-top:30px">Cari</button>
                                                            <a target="_blank" href="laporanpenjualancetak.php?tahun=<?= $tahun ?>&bulan=<?= $bulan ?>&namabarang=<?= $idbarang ?>" class="btn btn-success text-white" style="margin-top:30px">Cetak</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <table class="table table-bordered table-striped" id="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">No. Nota</th>
                                                        <th class="text-center">Tanggal Penjualan</th>
                                                        <th width="30%" class="text-center">Nama Obat</th>
                                                        <th class="text-center">Harga</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th width="15%" class="text-center">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    if (isset($_POST['submit'])) {
                                                        $tahun = $_POST['tahun'];
                                                        $bulan = $_POST['bulan'];
                                                        $namabarang = $_POST['namabarang'];
                                                        if ($namabarang == "") {
                                                            $ambil = $koneksi->query("SELECT*FROM penjualan WHERE year(tanggalpenjualan) = '$tahun' and month(tanggalpenjualan) = '$bulan' order by tanggalpenjualan desc") or die(mysqli_error($koneksi));
                                                        } else {
                                                            $ambil = $koneksi->query("SELECT*FROM penjualan WHERE year(tanggalpenjualan) = '$tahun' and month(tanggalpenjualan) = '$bulan' and namabarang = '$namabarang'  order by tanggalpenjualan desc") or die(mysqli_error($koneksi));
                                                        }
                                                    } else {
                                                        $ambil = $koneksi->query("SELECT*FROM penjualan WHERE year(tanggalpenjualan) = '$tahun' and month(tanggalpenjualan) = '$bulan' order by tanggalpenjualan desc") or die(mysqli_error($koneksi));
                                                    }
                                                    $totalpemasukan = 0;
                                                    ?>
                                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?php echo $nomor; ?></td>
                                                            <td><?php echo $pecah['kodenota'] ?></td>
                                                            <td><?php echo date("d-m-Y", strtotime($pecah['tanggalpenjualan'])) ?></td>
                                                            <td>
                                                                <?= $pecah['namabarang'] ?>
                                                            </td>
                                                            <td>
                                                                <?= rupiah($pecah['harga']) ?>
                                                            </td>
                                                            <td>
                                                                <?= $pecah['jumlah'] ?>
                                                            </td>
                                                            <td><?php echo rupiah($pecah['total']) ?></td>
                                                        </tr>
                                                        <?php
                                                        $totalpemasukan += $pecah['total'];
                                                        $nomor++; ?>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="6" class="text-right"><em>Total Penjualan :</em></th>
                                                        <th colspan="3"><?= rupiah($totalpemasukan) ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
    <?php include('footer.php'); ?>