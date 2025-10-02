<?php include('header.php'); ?>

<!-- page content -->
<div class="pcoded-content">
   <!-- Page-header start -->
   <div class="page-header">
      <div class="page-block">
         <div class="row align-items-center">
            <div class="col-md-8">
               <div class="page-header-title">
                  <h5 class="m-b-10">Persediaan Obat</h5>
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
                     <h5>Daftar Obat</h5>
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
                        <table class="table" id="daftarproduk">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Nama Obat</th>
                                 <th>Stok</th>
                                 <th>Harga Jual</th>
                                 <th>Expired</th>
                                 <?php if ($_SESSION['admin']['level'] != "Operator") { ?>
                                    <th>Aksi</th>
                                 <?php } ?>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $nomor = 1; ?>
                              <?php $ambil = $koneksi->query("SELECT*FROM produk"); ?>
                              <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                 <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['namaproduk'] ?></td>
                                    <td><?php echo $pecah['stok'] ?></td>
                                    <td><?php echo rupiah($pecah['hargajual']) ?></td>
                                    <td><?php echo tanggal($pecah['expired']) ?></td>
                                    <?php if ($_SESSION['admin']['level'] != "Operator") { ?>
                                       <td>
                                          <a href="ubahproduk.php?id=<?php echo $pecah['idproduk']; ?>" class="btn btn-success m-1">Edit</a>
                                          <a href="hapusproduk.php?id=<?php echo $pecah['idproduk']; ?>" class="btn btn-danger m-1" onclick="return confirm('Yakin Mau di Hapus?')">Hapus</a>
                                       </td>
                                    <?php } ?>
                                 </tr>
                                 <?php $nomor++; ?>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include('footer.php'); ?>