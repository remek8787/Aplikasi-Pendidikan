<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
    $ids = $_GET['ids'];
	$bl= $_GET['bulan'];
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	

	$user = fetch($koneksi, 'users',array('id_user'=>$ids));
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

	<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Detail Absen Pegawai</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>

<style type="text/css">
	@page { margin: 80px; }
body { margin: 20px; }
</style>
<body style="font-size: 12px;">	
<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='100'><img src="../../images/<?= $setting['logo'] ?>" width='70'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                          <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        </strong>
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
         <br>
		<center><h4>RINCIAN ABSENSI PEGAWAI</h4></center>
		<br>
 
    <table width="100%">
	
            <tr>
                 <td width='100px'>Nama</td>
                <td width='10px'>:</td>
                <td><?= $user['nama'] ?></td>
				<td width='200px'></td>
				<td width='150px'>Bulan</td>
                <td width='10px'>:</td>
                <td><?= $bulane['ket'] ?> <?= date('Y') ?></td>
            </tr>
			
                <tr>
                <td width='100px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $setting['semester'] ?></td>
				<td width='200px'></td>
				 <td width='150px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td> <?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

   
		 <table class='it-grid it-cetak' width='100%'>       
              <tr height='40px'>
                    <th width="5%">No.</th>					
                    <th width="15%">Tangggal</th>
					 <th colspan="2">Jam Absen</th>
					
                    <th width="10%">Kehadiran</th>
					<th width="15%" >Keterangan</th>
                    <th width="20%">Paraf</th>
                   </tr>
			              
			
			         <?php
					$bulan= $bl;
					$tahun=date('Y');
					
                	$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { 
				    $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
					$date2 = date("D",strtotime("$tahun-$bulan-$i"));
                    $absen = fetch($koneksi, 'absensi', ['tanggal' => $tanggalbaru, 'idpeg' => $ids]);
					$tg=date('d',strtotime($absen['tanggal']));					
					$date1 = date("D",strtotime("$tahun-$bulan-$i"));
					$jam_start = date('H',strtotime($absen['masuk']));
					$menit_start = date('i',strtotime($absen['masuk']));
					$jam_end = date('H',strtotime($setting['max_masuk']));
					$menit_end = date('i',strtotime($setting['max_masuk']));
					  
					$hasil = (intVal($jam_end) - intVal($jam_start)) * 60 + (intVal($menit_end) - intVal($menit_start));
					$hasil = $hasil / 60;
					$hasil = number_format($hasil,2);
					?>
                   
					<tr>
                    <td  style="text-align:center">
                    <?php if($date1=='Sun')	{ ?>				
					<b style="color:red"><?= $i ?></b>
					<?php }else{ ?>
					<?= $i ?>
					<?php } ?>
					 <?php if($i == $tg)	{ ?>
					 
					<td style="text-align:center"><?= $i ?>-<?= $bulan ?>-<?= $tahun ?></td>
						<td style="text-align:center">
						<?php if($absen['ket']=='H'): ?>
						Masuk <?= $absen['masuk'] ?>
						<?PHP endif; ?>
						</td>
						<td style="text-align:center">
						<?php if($absen['ket']=='H'): ?>
						Pulang <?= $absen['pulang'] ?>
						<?PHP endif; ?>
						</td>
					<td style="text-align:center"><?= $absen['ket'] ?></td>
				    <td>
					<?php if($absen['ket']=='H'): ?>
					<?= $absen['keterangan'] ?>
					<?php endif; ?>
					</td>
					
					<td></td>
					
					<?php }else{ ?>
					<td style="text-align:center"><?= $i ?>-<?= $bulan ?>-<?= $tahun ?></td>
					<td></td>
					<td style="text-align:center"></td>
					<td style="text-align:center;color:red"></td>
					<td></td>
					<td></td>
					 <?php } ?>
					</tr>
                        <?php } ?>
						    
								
            </table>
			
			
			<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='50px'></td>
						<td>
							
							<br/>
							<br/>
							<br/>
							
							<br/>
							
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
							<?= $setting['kabupaten'] ?>, <?= $day; ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							
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
$dompdf->setPaper('Legal', 'Potrait');
$dompdf->render();
$dompdf->stream("Absen Pegawai ".$user['nama']." Bulan ". $bl . ".pdf", array("Attachment" => false));
exit(0);
?>