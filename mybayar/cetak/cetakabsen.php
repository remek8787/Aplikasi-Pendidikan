<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$idpeg = $_GET['idpeg'];
	$bl = $_GET['b'];	
	$tahun = date('Y');
	$peg = fetch($koneksi, 'users',array('id_user'=>$idpeg));	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>

    <title>Rincian KBM <?= $bulane['ket'] ?>-<?= $tahun ?></title>

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
		
		<center><h3>RINCIAN KEGIATAN BELAJAR MENGAJAR<br> BULAN <?= strtoupper($bulane['ket']) ?> <?= $tahun ?></h3></center>
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
											<td><?= $peg['jabatan'] ?></td>
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
										<th  class="text-center">TANGGAL</th>
										<th  class="text-center">KELAS</th>
										<th  class="text-center">MATA PELAJARAN</th>
										<th class="text-center">JAM MASUK</th>
										<th class="text-center">JJM</th>
									</tr>
                                       <?php
					                    $no=0;
										$query = mysqli_query($koneksi, "SELECT * FROM absen_jjm WHERE idpeg='$idpeg' and bulan='$bl'"); 
										while ($data = mysqli_fetch_array($query)) :					
										$pel = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$no++;
									 ?>			
							       <tr>
                                    <td style="text-align:center"><?= $no; ?></td>
                                    <td style="text-align:center"><?= date('d-m-Y',strtotime($data['tanggal'])) ?></td>
									<td style="text-align:center"><?= $data['kelas'] ?></td>
									<td><?= $pel['nama_mapel'] ?></td>
									<td style="text-align:center"><?= $data['masuk'] ?></td>
									<td style="text-align:center"><?= $data['jjm'] ?></td>
									 </tr>   
							<?php endwhile ?>	
							<?php							
							$jumlah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(jjm) as jml,idpeg,bulan FROM absen_jjm  WHERE idpeg='$idpeg' and bulan='$bl'"));						   
							?>
							<tr>
							<td colspan="5" style="text-align:right;font-weight:bold">TOTAL&nbsp;</td>
							
							<td style="text-align:center;font-weight:bold"><?= $jumlah['jml'] ?></td>
							</tr>
						</table>
						<br>
			
			<table width='100%'>
					<tr>
					<td width="5%"></td>	
					<td width="40%">
					Mengetahui, <br/>							
					Kepala Sekolah
					<br/><br/><br/><br/>
					<u><?= $setting['kepsek'] ?></u><br/>
					NIP. <?= $setting['nip'] ?>
						</td>						
						<td width="15%">
							
							
							<br/><br/>
							
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