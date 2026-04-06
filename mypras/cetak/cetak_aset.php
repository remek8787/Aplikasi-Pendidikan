<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
   $kondisi = $_POST['kondisi'];
	$bl= date('m');
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	?>

	<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>ASET SEKOLAH</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>

<style type="text/css">
	@page { margin: 50px; }
body { margin: 50px; }
</style>
<body style="font-size: 13px;">	
<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='70'><img src="../../images/<?= $setting['logo'] ?>" width='70px'></td>
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
		<center><h3>ASET SEKOLAH</h3></center>
		<br>
 
    <table width="100%">
	
            <tr>
                 <td width='100px'>Tanggal</td>
                <td width='10px'>:</td>
                <td><?= date('d-m-Y') ?></td>
				<td width='200px'></td>
				<td width='150px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $setting['semester'] ?></td>
            </tr>
			
                <tr>
                <td width='100px'>Kondisi</td>
                <td width='10px'>:</td>
                <td><?= ucwords(strtolower($kondisi)); ?></td>
				<td width='200px'></td>
				 <td width='150px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td> <?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

   <br>
   <?php if($kondisi=='semua'): ?>
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                    <th width="8%" rowspan="2">NO.</th>					
                    <th rowspan="2">NAMA BARANG</th>
					 <th width="10%" rowspan="2">JML</th>
					 <th width="10%" rowspan="2">BAIK</th>
					 <th colspan="2">KONDISI KERUSAKAN</th>
					 </tr><tr>                  
					<th width="10%" >RINGAN</th>
                    <th width="10%">BERAT</th>
                   </tr>
				              
					<?php
					$query = mysqli_query($koneksi,"SELECT * FROM aset");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;<?= $data['nama_barang']; ?></td>
					<td style="text-align:center"><?= $data['jumlah']; ?></td>
					<td style="text-align:center"><?= $data['baik']; ?></td>
					<td style="text-align:center"><?= $data['ringan']; ?></td>
					<td style="text-align:center"><?= $data['berat']; ?></td>
					</tr>
			  <?php } ?>									
								
            </table>
			<?php endif; ?>	  
			
			<?php if($kondisi=='baik'): ?>
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                    <th width="8%">NO.</th>					
                    <th>NAMA BARANG</th>
					 <th width="10%">JML</th>
					 <th width="10%">BAIK</th>
					 
                   </tr>
				              
					<?php
					$query = mysqli_query($koneksi,"SELECT * FROM aset where baik<>'0'");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;<?= $data['nama_barang']; ?></td>
					<td style="text-align:center"><?= $data['jumlah']; ?></td>
					<td style="text-align:center"><?= $data['baik']; ?></td>
					
					</tr>
			  <?php } ?>									
								
            </table>
			<?php endif; ?>	  
			<?php if($kondisi=='ringan'): ?>
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                    <th width="8%">NO.</th>					
                    <th>NAMA BARANG</th>
					 <th width="10%">JML</th>
					 <th width="10%">RUSAK RINGAN</th>
					 
                   </tr>
				              
					<?php
					$query = mysqli_query($koneksi,"SELECT * FROM aset where ringan<>'0'");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;<?= $data['nama_barang']; ?></td>
					<td style="text-align:center"><?= $data['jumlah']; ?></td>
					<td style="text-align:center"><?= $data['ringan']; ?></td>
					
					</tr>
			  <?php } ?>									
								
            </table>
			<?php endif; ?>	  
			<?php if($kondisi=='berat'): ?>
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                    <th width="8%">NO.</th>					
                    <th>NAMA BARANG</th>
					 <th width="10%">JML</th>
					 <th width="10%">RUSAK BERAT</th>
					 
                   </tr>
				              
					<?php
					$query = mysqli_query($koneksi,"SELECT * FROM aset where berat<>'0'");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;<?= $data['nama_barang']; ?></td>
					<td style="text-align:center"><?= $data['jumlah']; ?></td>
					<td style="text-align:center"><?= $data['berat']; ?></td>
					
					</tr>
			  <?php } ?>									
								
            </table>
			<?php endif; ?>	  
			<br>
			
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
							
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
							<?= $setting['kabupaten'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							
					Bendahara Barang
					
					<br/>
							<br/>
							<br/>
							<br/>
							
								<u>................................................</u><br/>
							NIP. .
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
$dompdf->setPaper('A4', 'Legal');
$dompdf->render();
$dompdf->stream("Rekap Aset Sekolah Tanggal ". date('d-m-Y'). ".pdf", array("Attachment" => true));
exit(0);
?>