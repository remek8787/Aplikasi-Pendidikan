<?php ob_start();
error_reporting(0);
require("../../config/koneksi.php");
require("../../config/function.php");
require("../../config/crud.php");
	(isset($_SESSION['id_user'])) ? $id_user = $_SESSION['id_user'] : $id_user = 0;
	($id_user==0) ? header('location:login.php'):null;
	$tgl = $_GET['tgl'];
	$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$id_user'"));
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
		
		<center><h4>LAPORAN STOK BARANG</h4></center>
		<br>
 
										<table width="100%">
										<tr>
										<td width="10%"></td>
										<td width='100px'>TOKO</td>
										<td width='10px'>:</td>
										<td><?= $mytoko['nama_toko'] ?></td>			
										</tr>
										<td width="10%"></td>
										<td>KETERANGAN</td>
										<td width='10px'>:</td>
										<td>HAMPIR HABIS / HABIS</td>			
										</tr>		
										</table>

										 <br>
	 
									 <table  style="width:100%;" border='1'>       
									 
                                        <tr>
                                        <td width="5%">NO</td>                                               
                                        <td>NAMA PRODUK</td>
										<td>JML SISA</td>
										
                                                </tr>
                                          <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_toko='$user[idtoko]' AND produk_jumlah < 6 "); 
											while ($data = mysqli_fetch_array($query)) :
											  
											$no++;
											   ?>
                                                <tr>
                                                   <td><?= $no; ?></td>
                                                     <td><?= $data['produk_nama'] ?></td>
													<td><?= $data['produk_jumlah'] ?></td> 
                                                </tr>
												<?php endwhile; ?>
												
												
												<td colspan="2" style="text-align:right;">KASIR</td>
												<td><?= $user['nama'] ?></td>
												</tr>
                                                </table>
           
</div>
</body>

</html>
