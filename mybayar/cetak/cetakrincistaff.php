<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	$honor = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_tu  WHERE id='1'"));
	$idpeg = $_GET['idpeg'];
	$bl = $_GET['b'];
	$tgl = $_GET['t'];	
	$tahun = date('Y');
	$peg = fetch($koneksi, 'users',array('id_user'=>$idpeg));	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>

    <title>Rincian <?= $bulane['ket'] ?>-<?= $tahun ?></title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { margin: 50px; }
</style>
<body style="font-size:14px;">	

<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='70px'><img src='../../images/<?= $setting['logo'] ?>' width='70px'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                        <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?>  </strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                      
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br>
		
		<center><h3>RINCIAN HONOR STAFF<br> BULAN <?= strtoupper($bulane['ket']) ?> <?= $tahun ?></h3></center>
		<br>
     <br>
								  <table width="100%">								
										<tr>
										<td width="10%"></td>
											 <td width='100px'>Nama Lengkap</td>
											<td width='10px'>:</td>
											<td><?= $peg['nama'] ?></td>
											<td width="70%"></td>
											<td width='100px'>Bulan</td>
											<td width='10px'>:</td>
											<td><?= $bulane['ket'] ?> <?= $tahun ?></td>
										</tr>
										
											<tr>
											<td width="10%"></td>
											<td width='100px'>Jabatan</td>
											<td width='10px'>:</td>
											<td>Staff</td>
											<td ></td>
											 <td width='100px'>Smt - TP</td>
											<td width='10px'>:</td>
											<td><?= $setting['semester'] ?> - <?= $setting['tp'] ?></td>
											</tr>										
										</table>
									 <br>
	 
								 <table class='it-grid it-cetak' width='100%'>       
									  <tr>
										<th width="5%" height="40px" class="text-center">NO</th>
										<th   class="text-center">JABATAN</th>
										<th  width="15%"  class="text-center">HONOR</th>
										<th  width="15%"  class="text-center">PIKET</th>
										<th width="10%" class="text-center">PPH</th>
										<th width="15%" class="text-center">DITERIMA</th>
									</tr>
                                         <?php
					                    
					                       $no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$idpeg'"); 
											while ($data = mysqli_fetch_array($query)) :
											$jsiang = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$idpeg' and bulan='$bl' and tahun='$tahun' and ket='siang'"));
											$jumbayar = $jsiang * $honor['siang'];
								            $jmalam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$idpeg' and bulan='$bl' and tahun='$tahun' and ket='malam'"));
											$jumbayar2 = $jmalam * $honor['malam'];
											$total = $jumbayar + $jumbayar2;
											$no++;
											   ?>
											  
							       <tr>
                                    <td style="text-align:center"><?= $no; ?></td>
                                   
									<td style="text-align:center">Staff</td>
									<td style="text-align:right">Rp. <?= number_format($jumbayar) ?>&nbsp;</td>
									<td style="text-align:right">Rp. <?= number_format($jumbayar2) ?>&nbsp;</td>
									<td  style="text-align:center">0</td>
									<td style="text-align:right">Rp. <?= number_format($total) ?>&nbsp;</td>
			                        
									 </tr>   
							<?php endwhile ?>	
							<?php
							$jsiang = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE bulan='$bl' and tahun='$tahun' and ket='siang' and idpeg='$idpeg'"));
							$jbayar = $jsiang * $honor['siang'];
						    $jmalam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE  bulan='$bl' and tahun='$tahun' and ket='malam' and idpeg='$idpeg'"));
							$jbayar2 = $jmalam * $honor['malam'];
							$total2 = $jbayar + $jbayar2;
							
							?>
							<tr>
							<td colspan="4" style="text-align:right;font-weight:bold">TOTAL&nbsp;</td>
							<td  style="text-align:center;font-weight:bold">0</td>
							<td style="text-align:right;font-weight:bold">Rp. <?= number_format($total2) ?>&nbsp;</td>
							</tr>
						</table>
						<br>
			
			<table width='100%'>
					<tr>
					<td width="1%"></td>	
					<td width="40%">
					Mengetahui, <br/>							
					Kepala Sekolah
					<br/><br/><br/><br/>
					<u><?= $setting['kepsek'] ?></u><br/>
					NIP. <?= $setting['nip'] ?>
						</td>						
						<td width="25%">
							Lunas Bayar<br/>
							<?= date('d',strtotime($tgl)) ?> <?= $bulane['ket'] ?> <?= date('Y') ?>
							<br/><br/>
							Rp. <?= number_format($jumbayar) ?>
							<br/><br/><br/><br/>							
						</td>						
						<td>
							<?= ucwords(strtolower($setting['kecamatan'])); ?>, <?= $day; ?>  <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Bendahara Sekolah<br/>
							<br/>
							<br/>
							<br/>
							
							<u>.................................................</u><br/>
							NIP. 
						</td>
					</tr>
				</table>
</div>
</body>

</html>
<?php

$html = ob_get_clean();
require_once '../../pdf/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'Potrait');
$dompdf->render();
$dompdf->stream("Rekap Pembayaran Bulan ". $bulane['ket'] . ".pdf", array("Attachment" => false));
exit(0);
?>