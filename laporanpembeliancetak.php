<html>
<title>Laporan Pembelian Kasir Apotek</title>
<style type="text/css">
    body {
        -webkit-print-color-adjust: exact;
        padding: 50px;
    }

    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
    }

    #table td,
    #table th {
        padding: 8px;
        padding-top: 15px;
    }

    #table tr {
        padding-top: 15px;
        padding-bottom: 15px; 
    }

    /* #table tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 15px;
        padding-bottom: 15px;
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
if (isset($_POST['tanggalawalfix'])) {
    $tanggalawal = $_POST['tanggalawalfix'];
    $tanggalakhir = $_POST['tanggalakhirfix'];
} else {
    $hariini = date('Y-m-d');
    $tanggalawal = date('Y-m-01', strtotime($hariini));
    $tanggalakhir = date('Y-m-t', strtotime($hariini));
}
?>

<body>
    <center>
        <!-- <img src="foto/koplogo.png" width="680px"> -->
        <h2>Kasir Apotek</h2>
        <h2>Laporan Pembelian </h2>
        <h4><?= date("d-m-Y", strtotime($tanggalawal)) . ' - ' . date("d-m-Y", strtotime($tanggalakhir)) ?></h4>
    </center>
    <br>
    <table class="table table-bordered table-striped" id="table" width="670px">
        <thead>
            <tr>
                <th width="10%" class="text-center">No</th>
                <!-- <th>Nomor Nota</th> -->
                <th class="text-center">Tanggal</th>
                <th width="30%" class="text-center">Nama Obat</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1;
            if (isset($_POST['tanggalawalfix'])) {
                $tanggalawal = $_POST['tanggalawalfix'];
                $tanggalakhir = $_POST['tanggalakhirfix'];
                $ambil = $koneksi->query("SELECT*FROM pembelian WHERE (tanggalpembelian >= '$tanggalawal' and tanggalpembelian <= '$tanggalakhir')");
            } else {
                $ambil = $koneksi->query("SELECT*FROM pembelian WHERE (tanggalpembelian >= '$tanggalawal' and tanggalpembelian <= '$tanggalakhir')");
            }
            $totalpengeluaran = 0;
            ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <!-- <td><?php echo substr($pecah['notabeli'], 0, 4) . '' . $pecah['idpembelian'] ?></td> -->
                    <td><?php echo date("d-m-Y", strtotime($pecah['tanggalpembelian'])) ?></td>
                    <td><?php echo $pecah['namabarang'] ?></td>
                    <td>
                        <?= rupiah($pecah['harga']) ?>
                    </td>
                    <td>
                        <center>
                            <?= $pecah['jumlah'] ?>
                        </center>
                    </td>
                    <td><?php echo rupiah($pecah['total'])  ?></td>
                </tr>
                <?php
                    $totalpengeluaran += $pecah['total'];
                    $nomor++; ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="biru" colspan="2" style="align-items: right" align="right"><em>Total Pengeluaran :</em></td>
                <td class="biru" colspan="3"><?= rupiah($totalpengeluaran) ?></td>
            <tr>
        </tfoot>
    </table>
</body>
<script>
    window.print();
</script>

</html>