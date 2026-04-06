<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	
	$bl= $_GET['bulan'];
	$guru = $_GET['guru'];
	$kelas = $_GET['kelas'];
	$mapel = $_GET['mapel'];
	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$map = fetch ($koneksi, 'mapel', ['id' =>$mapel]);
	$usr = fetch ($koneksi, 'users', ['id_user' =>$guru]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>JURNAL GURU</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
@page { margin: 20px; }
body { margin: 20px; }
</style>
<body style="font-size: 14px;">	
<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='70px'><img src='../../images/<?= $setting['logo'] ?>' width='70px'></td>
                    <td style="text-align:center">
                        <strong class='f14'>
                          <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?></strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br>
		
		<center>
		<h3>AGENDA DAN JURNAL GURU</h3>
		<h3><?= strtoupper($map['nama_mapel']) ?></h3>
		</center>
		<br>
 
    <table width="100%">
	
            <tr>
			<td width="10%"></td>
                 <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas ?></td>
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
	
		 <table class='it-grid' width='100%' style="font-size:13px;">       
              <tr>
                <th width="3%" height="40px">NO</th>
                <th width="8%" class="text-center">TANGGAL</th>			
				<th class="text-center">MATERI</th>
				<th class="text-center">TUJUAN PEMBELAJARAN</th>
				<th class="text-center">HAMBATAN</th>
				<th class="text-center">PEMECAHAN</th>
               <th width="10%" class="text-center">PENCAPAIAN</th>
                <th width="10%" class="text-center">KEHADIRAN</th>
                 </tr>
				 <?php
				 $no=0;
                $query = mysqli_query($koneksi, "select * from agenda WHERE kelas='$kelas' AND mapel='$mapel' AND bulan='$bl' and guru='$guru'");				 
				while ($data = mysqli_fetch_array($query)) {
				$hari = fetch($koneksi,'m_hari',['inggris'=>$data['hari']]);
				if($data['hadir']<50){
						$capai ="Tidak Tercapai";
					}else{
						$capai ="Tercapai";
					}	
               $no++;
                ?>					
				<tr>
					<td style="text-align:center"><?= $no; ?></td>
					<td style="text-align:center"><?= $hari['hari'] ?><br><?= date('d-m-Y',strtotime($data['tanggal'])); ?></td>
					<td><?= $data['materi'] ?></td>
					<td><?= $data['tujuan'] ?></td>
					<td><?= $data['tujuan'] ?></td>
					<td><?= $data['tujuan'] ?></td>
					<td style="text-align:center"><?= $capai ?></td>
					<td style="text-align:center"><?= $data['hadir'] ?>%</td>
					</tr>
				<?php } ?>
            </table>
			
    <br>
	<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='50px'></td>
						<td>
							Mengetahui,<br>Kepala Sekolah
				
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
						<?= ucwords(strtolower($setting['kecamatan'])); ?>, <?php echo  date("t",time()); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Guru Pengampu
					<br/>
							<br/>
							<br/>
							<br/>
							
								<u><?= $usr['nama'] ?></u><br/>
							NIP. <?= $usr['nip'] ?>
							
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
$dompdf->stream("Jurnal Guru ".$usr['nama']. " Mapel ".$map['kode']." Kelas ".$kelas." Bulan ".$bl . ".pdf", array("Attachment" => true));
exit(0);
?>