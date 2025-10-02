<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'header.php';
include 'koneksi.php';
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tambah Pembelian</h5>
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
                                            <h5>Form Pembelian</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" name="tanggalpembelian" type="date" required value="<?= date('Y-m-d') ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Supplier</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" name="supplier" type="text" required>
                                                    </div>
                                                </div>

                                                <table class="table table-bordered" id="dynamic_field">
                                                    <tr>
                                                        <td width="30%">
                                                            <label>Nama Obat</label>
                                                            <select name="namabarang[]" class="form-control namabarang" required>
                                                                <option value="">Pilih Obat</option>
                                                                <?php
                                                                $ambil = $koneksi->query("SELECT * FROM produk");
                                                                while ($pecah = $ambil->fetch_assoc()) {
                                                                    echo "<option value='{$pecah['namaproduk']}' data-price='{$pecah['hargajual']}'>{$pecah['namaproduk']}</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label>Harga</label>
                                                            <input type="number" name="harga[]" class="form-control harga" required>
                                                        </td>
                                                        <td width="15%">
                                                            <label>Jumlah</label>
                                                            <input type="number" name="jumlah[]" class="form-control jumlah" value="1" required>
                                                        </td>
                                                        <td>
                                                            <label>Total</label>
                                                            <input type="number" name="total[]" class="form-control total" value="0" readonly>
                                                        </td>
                                                        <td>
                                                            <label>&nbsp;</label><br>
                                                            <button type="button" name="add" id="addkegiatan" class="btn btn-success">+</button>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Grand Total</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="grandtotal" name="grandtotal" type="number" readonly>
                                                        <input class="form-control" id="grandtotalnon" name="grandtotalnon" type="hidden">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                                            </form>
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
if (isset($_POST['simpan'])) {
    $tanggalpembelian = $_POST['tanggalpembelian'];
    $supplier = $_POST['supplier'];
    $grandtotal = $_POST['grandtotalnon'];
    $notabeli = date("YmdHis");
    $waktuinputbeli = date("Y-m-d H:i:s");

    $jumlahItem = count($_POST['namabarang']);
    for ($i = 0; $i < $jumlahItem; $i++) {
        $namabarang = $_POST['namabarang'][$i];
        $harga = $_POST['harga'][$i];
        $jumlah = $_POST['jumlah'][$i];
        $total = $_POST['total'][$i];

        $koneksi->query("INSERT INTO pembelian (
            notabeli, namabarang, harga, jumlah, total, grandtotal, tanggalpembelian, supplier, waktuinputbeli
        ) VALUES (
            '$notabeli', '$namabarang', '$harga', '$jumlah', '$total', '$grandtotal', '$tanggalpembelian', '$supplier', '$waktuinputbeli'
        )") or die("Gagal insert: " . mysqli_error($koneksi));

        $koneksi->query("UPDATE produk SET stok = stok + $jumlah WHERE namaproduk = '$namabarang'") or die("Gagal update stok: " . mysqli_error($koneksi));
    }

    echo "<script>alert('Pembelian berhasil disimpan!');</script>";
    echo "<script>location='pembeliandaftar.php';</script>";
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let i = 1;

function updateTotal() {
    let grand = 0;
    $('#dynamic_field tr').each(function() {
        const harga = parseFloat($(this).find('.harga').val()) || 0;
        const jumlah = parseFloat($(this).find('.jumlah').val()) || 0;
        const total = harga * jumlah;
        $(this).find('.total').val(total);
        grand += total;
    });
    $('#grandtotal').val(grand);
    $('#grandtotalnon').val(grand);
}

$(document).on('input change', '.harga, .jumlah', updateTotal);

$(document).on('change', '.namabarang', function() {
    const harga = $(this).find(':selected').data('price');
    $(this).closest('tr').find('.harga').val(harga);
    updateTotal();
});

$('#addkegiatan').click(function() {
    i++;
    const row = `
        <tr id="row${i}">
            <td>
                <select name="namabarang[]" class="form-control namabarang" required>
                    <option value="">Pilih Obat</option>
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM produk");
                    while ($pecah = $ambil->fetch_assoc()) {
                        echo "<option value='{$pecah['namaproduk']}' data-price='{$pecah['hargajual']}'>{$pecah['namaproduk']}</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input type="number" name="harga[]" class="form-control harga" required></td>
            <td><input type="number" name="jumlah[]" class="form-control jumlah" value="1" required></td>
            <td><input type="number" name="total[]" class="form-control total" value="0" readonly></td>
            <td><button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">X</button></td>
        </tr>`;
    $('#dynamic_field').append(row);
});

$(document).on('click', '.btn_remove', function() {
    $(this).closest('tr').remove();
    updateTotal();
});
</script>

<?php include 'footer.php'; ?>
