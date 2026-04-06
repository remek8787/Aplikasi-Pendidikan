<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$tgl = $_GET['tgl'];
	
	$mytoko = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM toko  WHERE idt='$_GET[idtoko]'"));
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>TRANSAKI <?= $tangal ?></title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>
</head>
<style>
@page { margin: 20px; }
body { margin: 20px; }
</style>
<body style="font-size: 13px;">	


<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='100'><img src='../../images/<?= $setting['logo'] ?>' width='70px'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                     <?= strtoupper($setting['sekolah']) ?><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        </strong>
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br>
		
		<center><h4>LAPORAN TRANSAKSI</h4></center>
		<br>
 
										<table width="100%">
										<tr>
										<td width="10%"></td>
										<td width='100px'>TOKO</td>
										<td width='10px'>:</td>
										<td><?= $mytoko['nama_toko'] ?></td>			
										</tr>
										<td width="10%"></td>
										<td>TANGGAL</td>
										<td width='10px'>:</td>
										<td><?= date('d-m-Y',strtotime($tgl)) ?></td>			
										</tr>		
										</table>

										 <br>
	 
									 <table  style="width:100%;" border='1'>       
									 
                                        <tr>
                                        <td width="5%">NO</td>                                               
                                        <td>NAMA PRODUK</td>
										<td>JML</td>
										<td>SUB TOTAL</td>
                                                </tr>
                                          
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin JOIN produk ON produk.produk_id=transaksi_kantin.idproduk WHERE produk.produk_toko='$_GET[idtoko]' AND transaksi_kantin.status='2' AND transaksi_kantin.tanggal='$tgl' GROUP BY transaksi_kantin.idproduk"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $trx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(jumlah) AS jml,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idproduk='$data[idproduk]' AND tanggal='$tgl'"));
											$subttl += $trx['total'];
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                     <td><?= $data['produk_nama'] ?></td>
													 <td><?= $trx['jml'] ?></td>
													 <td>RP <?= number_format($trx['total']) ?></td>
													 
                                                </tr>
												<?php endwhile; ?>
												
												<tr>
												<td colspan="3" style="text-align:right;">TOTAL</td>
												<td>RP <?= number_format($subttl) ?></td>
												</tr>
												<tr>
												<td colspan="3" style="text-align:right;">KASIR</td>
												<td></td>
												</tr>
                                                </table>
           
</div>
</body>

</html>
