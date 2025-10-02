<?php include('koneksi.php'); ?>
<?php
if ($_SESSION['admin']['level'] != "Admin") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
$koneksi->query("DELETE FROM produk WHERE idproduk='$_GET[id]'");
echo "<script>alert('Data Produk Berhasil Di Hapus');</script>";
echo "<script>location='daftarproduk.php';</script>";
