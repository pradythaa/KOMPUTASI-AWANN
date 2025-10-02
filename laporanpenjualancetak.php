<html>
<title>Laporan Penjualan Kasir Apotek</title>
<style type="text/css">
    body {
        -webkit-print-color-adjust: exact;
        padding: 50px;
    }

    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 14px
    }

    #table td,
    #table th {
        padding: 8px;
        padding-top: 10px;
    }

    #table tr {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }

    .biru {
        background-color: #06bbcc;
        color: white;
    }

    @page {
        size: auto;
        margin: 0;
    }
</style>
<?php
include('koneksi.php');
function rupiah($angka)
{
    $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilrupiah;
}
if (isset($_GET['tahun'])) {
    $tahun = $_GET['tahun'];
    $bulan = $_GET['bulan'];
} else {
    $hariini = date('Y-m-d');
    $tahun = date('Y');
    $bulan = date('m');
}
if ($bulan == "01") {
    $namabulan = "Januari";
} elseif ($bulan == "02") {
    $namabulan = "Februari";
} elseif ($bulan == "03") {
    $namabulan = "Maret";
} elseif ($bulan == "04") {
    $namabulan = "April";
} elseif ($bulan == "05") {
    $namabulan = "Mei";
} elseif ($bulan == "06") {
    $namabulan = "Juni";
} elseif ($bulan == "07") {
    $namabulan = "Juli";
} elseif ($bulan == "08") {
    $namabulan = "Agustus";
} elseif ($bulan == "09") {
    $namabulan = "September";
} elseif ($bulan == "10") {
    $namabulan = "Oktober";
} elseif ($bulan == "11") {
    $namabulan = "November";
} elseif ($bulan == "12") {
    $namabulan = "Desember";
} else {
    $namabulan = "";
}
$cek = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[namabarang]'");
$datacek = $cek->fetch_assoc();
$namaproduk = isset($datacek['namaproduk']) ? $datacek['namaproduk'] : '';
?>

<body>
    <center>
        <!-- <img src="foto/koplogo.png" width="680px"> -->
        <h2>Kasir Apotek</h2>
        <h2>Laporan Penjualan</h2>
        <h4><?= $namabulan . ' ' . $tahun ?></h4>
    </center>
    <br>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">No. Nota</th>
                <th class="text-center">Tanggal</th>
                <th width="30%" class="text-center">Nama Barang</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1;
            $tahun = $_GET['tahun'];
            $bulan = $_GET['bulan'];
            $namabarang = $_GET['namabarang'];
            if ($namabarang == "") {
                $ambil = $koneksi->query("SELECT*FROM penjualan WHERE year(tanggalpenjualan) = '$tahun' and month(tanggalpenjualan) = '$bulan' order by tanggalpenjualan desc") or die(mysqli_error($koneksi));
            } else {
                $ambil = $koneksi->query("SELECT*FROM penjualan WHERE year(tanggalpenjualan) = '$tahun' and month(tanggalpenjualan) = '$bulan' and namabarang = '$namaproduk'  order by tanggalpenjualan desc") or die(mysqli_error($koneksi));
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
                        <center>
                            <?= $pecah['jumlah'] ?>
                        </center>
                    </td>
                    <td><?php echo rupiah($pecah['total']) ?></td>
                </tr>
                <?php
                $totalpemasukan += $pecah['total'];
                $nomor++; ?>
            <?php } ?>
        </tbody>
        <tr>
            <td colspan="5"></td>
            <td colspan="3" class="text-right" style="text-align:right"><em></em></td>
        </tr>
        <tfoot>
            <tr>
                <td colspan="5"></td>
                <td colspan="1" class="text-right biru" style="text-align:right"><em>Total Pemasukan :</em></td>
                <td colspan="3" class="biru"><?= rupiah($totalpemasukan) ?></td>
            </tr>
        </tfoot>
    </table>
</body>
<script>
    window.print();
</script>

</html>