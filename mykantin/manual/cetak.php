
<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
include "../../vendor/phpqrcode/qrlib.php";

?>

<link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">

<style>
@page { margin: 20px; }
body { margin: 20px; }
</style>
<body style="font-size: 12px;">
<h4>NOTA PEMBAYARAN</h4>
<h5>REFF : <?= date('YmdHis') ?></h5>
<table width='100%' class="table table-bordered" cellpadding='10'>
    <thead>
	<tr>
	 <th width="8%">NO</th>                                               
     <th width="8%">JML</th>
     <th>NAMA PRODUK</th>
	<th>HARGA</th>
	<th>TOTAL</th>
      </tr>
	  </thead>
        <tbody>
        <?php 
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM kantin_bayar WHERE tanggal='$tanggal' AND status='0'"); 
		while ($data = mysqli_fetch_array($query)) :
		$produk = fetch($koneksi,'produk',['produk_id'=>$data['idproduk']]);
		$no++;
            ?>
			
        <tr>
         <td><?= $no; ?></td>
        <td><?= $data['jumlah'] ?></td>
		<td><?= $produk['produk_nama'] ?></td>
        <td><?= number_format($data['harga']) ?></td>
		<td><?= number_format($data['total']) ?></td>
           </tr>
<?php endwhile; ?>
   <?php
$total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total) AS tot FROM kantin_bayar WHERE tanggal='$tanggal' AND status='0'"));
	?>
	<tr>
												
	<td colspan="4" style="text-align:right;">SUB TOTAL</td>
	<td><?= number_format($total['tot']) ?></td>
	</tr>
	</tbody>
  </table>
  <?php mysqli_query($koneksi,"UPDATE kantin_bayar SET status='1'"); ?>