<?php include('header.php'); ?>


<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Daftar Pembelian</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Daftar Pembelian</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-trash close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">No. Nota</th>
                                            <th class="text-center">Tanggal Pembelian</th>
                                            <th width="30%" class="text-center">Daftar</th>
                                            <th class="text-center">Total Belanja</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php $ambil = $koneksi->query("SELECT*FROM pembelian group by notabeli order by tanggalpembelian desc");
                                        $totalpengeluaran = 0;
                                        ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo $pecah['notabeli'] ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($pecah['tanggalpembelian'])) ?></td>
                                                <td width="40%">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <th>Produk</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <!-- <th>Total</th> -->
                                                        </tr>
                                                        <?php
                                                        $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelian where notabeli = '$pecah[notabeli]'");
                                                        while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                                                            <tr>
                                                                <td width="40%"><?= $daftarbarang['namabarang'] ?></td>
                                                                <td width="10%"><?= $daftarbarang['jumlah'] ?></td>
                                                                <td width="30%"><?= rupiah($daftarbarang['harga']) ?></td>
                                                                <!-- <td width="25%"><?= $daftarbarang['total'] ?></td> -->
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </td>
                                                <td><?php echo rupiah($pecah['grandtotal']) ?></td>
                                                <td>
                                                    <!-- <a class="btn btn-success text-white mb-1" data-toggle="modal" data-target="#detail<?= $nomor ?>">Detail</a> -->
                                                    <a href="pembelianhapus.php?id=<?php echo $pecah['notabeli']; ?>" class="btn btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php
                                            $totalpengeluaran += $pecah['grandtotal'];
                                            $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="4" class="text-right"><em>Total Pengeluaran :</em></th>
                                        <th colspan="3"><?= rupiah($totalpengeluaran) ?></th>
                                    </tfoot>
                                </table>
                                <?php $no = 1; ?>
                                <?php $ambil = $koneksi->query("SELECT*FROM pembelian group by notabeli order by tanggalpembelian desc"); ?>
                                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                    <div class="modal fade" id="detail<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Daftar Belanja</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered table-striped" id="table2">
                                                        <thead class="bg-primary text-white">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $nobelanja = 1;
                                                            $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelian where notabeli = '$pecah[notabeli]'");
                                                            while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                                                                <tr>
                                                                    <td><?php echo $nobelanja; ?></td>
                                                                    <td><?php echo $daftarbarang['namabarang'] ?></td>
                                                                    <td><?php echo rupiah($daftarbarang['harga']) ?></td>
                                                                    <td><?php echo $daftarbarang['jumlah'] ?></td>
                                                                    <td><?php echo rupiah($daftarbarang['total']) ?></td>
                                                                </tr>
                                                            <?php
                                                                $nobelanja++;
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="status<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Status Pembelian</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label>Status Pembelian</label>
                                                            <input type="hidden" name="notabeli" value="<?= $pecah['notabeli'] ?>">
                                                            <select class="form-control" name="statuspembelian" required>
                                                                <option value="">Pilih Status</option>
                                                                <option <?php if ($pecah['statuspembelian'] == 'Belum Di Proses') echo 'selected'; ?> value="Belum Di Proses">Belum Di Proses</option>
                                                                <option <?php if ($pecah['statuspembelian'] == 'Proses Pengiriman') echo 'selected'; ?> value="Proses Pengiriman">Proses Pengiriman</option>
                                                                <option <?php if ($pecah['statuspembelian'] == 'Sudah Di Terima') echo 'selected'; ?> value="Sudah Di Terima">Sudah Di Terima</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $no++; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['simpan'])) {
    $notabeli = $_POST['notabeli'];
    $statuspembelian = $_POST['statuspembelian'];
    $koneksi->query("UPDATE pembelian SET statuspembelian='$statuspembelian' WHERE notabeli='$notabeli'") or die(mysqli_error($koneksi));
    echo "<script> alert('Status Pembelian Berhasil Disimpan');</script>";
    echo "<script> location ='pembeliandaftar.php';</script>";
}
?>
<?php include('footer.php'); ?>