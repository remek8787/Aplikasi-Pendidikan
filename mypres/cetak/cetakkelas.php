<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$kelas = $_GET['kelas'];
	$bl= $_GET['bulan'];
	
	
	$peg = fetch($koneksi, 'users',['walas'=>$kelas]);
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Rekap Absen Kelas <?= $kelas ?></title>

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
		
		<center><h4>REKAPITULASI ABSENSI KELAS</h4></center>
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
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas ?></td>
				<td ></td>
				 <td width='100px'>Smt - TP</td>
                <td width='10px'>:</td>
                <td><?= $setting['semester'] ?> - <?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

     <br>
	 
		 <table class='it-grid it-cetak' width='100%'>       
              <tr>
                <th width="2%" height="40px">No</th>
                <th>Nama Siswa</th>
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
			$query = mysqli_query($koneksi,"select id_siswa,kelas,nama from siswa WHERE kelas='$kelas' GROUP BY id_siswa");
             $no = 0;
              while ($siswa = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idsiswa='$siswa[id_siswa]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun' "));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idsiswa='$siswa[id_siswa]' AND ket='S' AND bulan='$bulan' AND tahun='$tahun' "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idsiswa='$siswa[id_siswa]' AND ket='I' AND bulan='$bulan' AND tahun='$tahun' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idsiswa='$siswa[id_siswa]' AND ket='A' AND bulan='$bulan' AND tahun='$tahun' "));
			  $no++;
			?>
			
							<tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td>&nbsp;&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
						$date2 = date("D",strtotime("$tahun-$bulan-$i"));
                        $cekabsen = fetch($koneksi, 'absensi', ['tanggal' => $tanggalbaru, 'idsiswa' => $siswa['id_siswa']]);
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
			<p>H : HADIR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; S : SAKIT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I : IZIN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A : TANPA KETERANGAN</p>
    <br>
	
	<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='50px'></td>
						<td>
							Mengetahui, <br/>
							
					Kepala Sekolah
					<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
							<?= ucwords(strtolower($setting['kabupaten'])); ?>, <?= $day; ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Wali Kelas <?= $kelas ?><br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $peg['nama'] ?></u><br/>
							NIP. <?= $peg['nip'] ?>
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
$dompdf->stream("Absen Kelas ".$kelas." Bulan ". $bl . ".pdf", array("Attachment" => false));
exit(0);
?>