<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	

	$bl= $_GET['bln'];
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
    $day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Rekap Absen Pembina Eskul</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
@page { margin: 80px; }
body { margin: 20px; }
</style>
<body style="font-size: 13px;">	


<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='100'><img src='../../images/<?= $setting['logo'] ?>' width='70'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                          <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?> </strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                       
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br>
		
		<center><h4>REKAPITULASI ABSENSI PEMBINA EKSTRAKURIKULER</h4></center>
		<br>
 
    <table width="100%">
	
            <tr>
			<td width="10%"></td>
                 <td width='100px'>Sekolah</td>
                <td width='10px'>:</td>
                <td><?= $setting['sekolah'] ?></td>
				<td width="70%"></td>
				<td width='100px'>Bulan</td>
                <td width='10px'>:</td>
                <td><?= $bulane['ket'] ?> <?= date('Y') ?></td>
            </tr>
			
                <tr>
				<td width="10%"></td>
                <td width='100px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $setting['semester'] ?></td>
				<td ></td>
				 <td width='100px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

     <br>
	 
		 <table class='it-grid it-cetak' width='100%'>       
              <tr>
                <th width="2%" height="40px">No</th>
                <th>Nama users</th>
				<th width="15%" style="text-align:center;">Eskul</th>
                <?php
				$bulan= $bl;
				$tahun=date('Y');
				
                	$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                    <?php
					$date1 = date("D",strtotime("$tahun-$bulan-$i"));
					?>
                    <th width="2%">
                    <?php if($date1=='Sun')	{ ?>				
					<b style="color:red"><?= $i ?></b>
					<?php }else{ ?>
					<?= $i ?>
					<?php } ?>
					</th>
                <?php } ?>
                <th width="1%">H</th>
                <th width="1%">S</th>
                <th width="1%">I</th>
                <th width="1%">A</th>
            </tr>
                  <?php
			$tahun = date('Y');
			$no=0; 
			$query = mysqli_query($koneksi, "SELECT * FROM m_eskul"); 
			 while ($data = mysqli_fetch_array($query)){
			$peg = fetch($koneksi, 'users',['id_user'=>$data['guru']]);
			$hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun'"));
			$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='I' AND bulan='$bulan' AND tahun='$tahun'"));
			$sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='S' AND bulan='$bulan' AND tahun='$tahun'"));
			$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='A' AND bulan='$bulan' AND tahun='$tahun'"));
											
			$no++;
			?>
			
							<tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td>&nbsp;&nbsp;<?= ucwords(strtolower($peg['nama'])) ?></td>
									 <td style="text-align:center;"><?= ucwords(strtolower($data['eskul'])) ?></td>
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
						$date2 = date("D",strtotime("$tahun-$bulan-$i"));
                        $cekabsen = fetch($koneksi, 'absensi_les', ['tanggal' => $tanggalbaru, 'idpeg' => $peg['id_user']]);
                       if ($cekabsen) { ?>
					 
                            <td class="text-center"><b><?= $cekabsen['ket'] ?></b></td>
                        <?php } else { ?>
						 <?php if($date2=='Sun'): ?>
                            <td style="color:white;background-color:red" class="text-center">X</td>
							<?php else: ?>
							<td></td>
							<?php endif; ?>
                        <?php } ?>
                    <?php } ?>
					
							  <td class="text-center"><?= $hadir; ?></td>
							  <td class="text-center"><?= $sakit; ?></td>
							 <td class="text-center"><?= $izin; ?></td>
							  <td class="text-center"><?= $alpha; ?></td>
							  
									 </tr>   
			  <?php } ?>
                    
								
            </table>
			
    <br>
	<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='50px'></td>
						<td>
							 <br/>
							<br/>
							<br/>
							<br/>
							<br/>
							
							<br/>
							
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
						<?= ucwords(strtolower($setting['kabupaten'])); ?>, <?= $day;?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							
					Kepala Sekolah
				
					<br/>
							<br/>
							<br/>
							<br/>
							
								<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
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
$dompdf->setPaper('A4', 'Landscape');
$dompdf->render();
$dompdf->stream("Rekap Absen Pembina Eskul ". $bl . ".pdf", array("Attachment" => false));
exit(0);
?>