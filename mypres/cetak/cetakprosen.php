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

    <title>Rekap Prosentase Absen Pegawai</title>
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
                     <?= strtoupper($setting['sekolah']) ?>
					  </strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                       
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br>
		
		<center><h4>REKAPITULASI PROSENTASE ABSENSI PEGAWAI</h4></center>
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
                <th width="5%" height="40px">No</th>
                <th>Nama Pegawai</th>
				<th width="15%" style="text-align:center;">Jabatan</th>
                
                <th width="5%" style="text-align:center;">H</th>
                <th width="5%" style="text-align:center;">S</th>
                <th width="5%" style="text-align:center;">I</th>
                <th width="5%" style="text-align:center;">A</th>
				<th width="8%" style="text-align:center;">Tepat Waktu</th>
				<th width="8%" style="text-align:center;">Terlambat</th>
            </tr>
                  <?php
			$bulan= $bl;
			$tahun=date('Y');
			$no = 0;
			$query = mysqli_query($koneksi,"select id_user,jabatan,nama from users where jabatan<>'' GROUP BY id_user");         
              while ($peg = mysqli_fetch_array($query)) {
			$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun FROM absensi WHERE idpeg='$peg[id_user]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun' "));
			 $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun FROM absensi WHERE idpeg='$peg[id_user]' AND ket='S' AND bulan='$bulan' AND tahun='$tahun' "));
			 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun FROM absensi WHERE idpeg='$peg[id_user]' AND ket='I' AND bulan='$bulan' AND tahun='$tahun' "));
			 $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun FROM absensi WHERE idpeg='$peg[id_user]' AND ket='A' AND bulan='$bulan' AND tahun='$tahun' "));
			 $tepat= mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun,keterangan FROM absensi WHERE idpeg='$peg[id_user]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun' AND keterangan='Tepat Waktu' "));
			$telat= mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun,keterangan FROM absensi WHERE idpeg='$peg[id_user]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun' AND keterangan !='Tepat Waktu' "));
			
		$no++;
			?>
			
							<tr>
                                    <td style="text-align:center"><?= $no; ?></td>
                                    <td>&nbsp;&nbsp;<?= ucwords(strtolower($peg['nama'])) ?></td>
									 <td>&nbsp;&nbsp;<?= ucwords(strtolower($peg['jabatan'])) ?></td>
				
					
							  <td style="text-align:center"><?= $hadir; ?></td>
							  <td style="text-align:center"><?= $sakit; ?></td>
							 <td style="text-align:center"><?= $izin; ?></td>
							  <td style="text-align:center"><?= $alpha; ?></td>
							   <td style="text-align:center">
							   <?php if($hadir >0): ?>
							   <?= round(($tepat/$hadir)*100); ?>%
							   <?php endif; ?>
							   </td>
							   <td style="text-align:center">
							    <?php if($hadir >0): ?>
							   <?= round(($telat/$hadir)*100); ?>%
							    <?php endif; ?>
							   </td>
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
						<?= ucwords(strtolower($setting['kabupaten'])); ?>, <?= $day; ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							
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
$dompdf->setPaper('A4', 'Potrait');
$dompdf->render();
$dompdf->stream("Prosentase Absen Pegawai ". $bl . ".pdf", array("Attachment" => true));
exit(0);
?>