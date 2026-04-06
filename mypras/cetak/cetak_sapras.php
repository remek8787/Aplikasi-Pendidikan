<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
   $jenis = $_GET['kate'];
  
	$bl= date('m');
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	?>

	<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>SARANA DAN PRASARANA SEKOLAH</title>

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
                     <?= strtoupper($setting['sekolah']) ?></strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
        <br>
		<center><h3>SARANA DAN RASARANA</h3></center>
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
                <td width='100px'>Kategori</td>
                <td width='10px'>:</td>
                <td><?= strtoupper($jenis); ?></td>
				<td width='200px'></td>
				 <td width='150px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td> <?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

   <br>
   
		<?php if($jenis=='it'): ?>
		 <table  width='100%' border="1" style="font-size:13px;">       
              <tr>
                   <th width="8%" rowspan="2" height="50px">NO.</th>					
                    <th rowspan="2">NAMA BARANG</th>
					 <th  colspan="2">KEADAAN</th>
					  <th rowspan="2" width="10%">TOTAL</th>
					  <th rowspan="2" width="15%">TAHUN PENGADAAN</th>
					 </tr>
					 <tr>
					 <th width="10%">BAIK</th>
					 <th width="10%">RUSAK</th>				 
                   </tr>
				              
					<?php
					$query = mysqli_query($koneksi,"SELECT * FROM sapras_ruang WHERE jenis='$jenis'");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;<?= $data['nama_barang']; ?></td>
					<td style="text-align:center"><?= $data['baik']; ?></td>
					<td style="text-align:center"><?= $data['rusak']; ?></td>
					<td style="text-align:center"><?= $data['baik']+$data['rusak']; ?></td>
					<td style="text-align:center"><?= $data['tahun']; ?></td>
					
					</tr>
			  <?php } ?>									
								
            </table>
			<?php endif; ?>
			<?php if($jenis=='penunjang'): ?>
		
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                   <th width="8%">NO.</th>					
                    <th>NAMA RUANG</th>
					 <th width="10%">JUMLAH</th>
					  <th width="18%">KELENGKAPAN</th>
					  <th width="15%">KEADAAN</th>
					 </tr>
					
			    <?php
					$query = mysqli_query($koneksi,"SELECT * FROM sapras_ruang WHERE jenis='$jenis'");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;Ruang <?= $data['ruang']; ?></td>
					<td style="text-align:center"><?= $data['jumlah']; ?></td>
					<td>
					<?php if($data['kelengkapan']=='L'): ?>&nbsp;&nbsp;Lengkap<?php endif; ?>
					<?php if($data['kelengkapan']=='KL'): ?>&nbsp;&nbsp;Kurang Lengkap<?php endif; ?>
					<?php if($data['kelengkapan']=='TL'): ?>&nbsp;&nbsp;Tidak Lengkap<?php endif; ?>
					</td>
					<td style="text-align:center">
					<?php if($data['keadaan']=='B'): ?>Baik<?php endif; ?>
					<?php if($data['keadaan']=='RR'): ?>Rusak Ringan<?php endif; ?>
					<?php if($data['keadaan']=='RB'): ?>Rusak Berat<?php endif; ?>
					</td>
				
					</tr>
			  <?php } ?>									
								
            </table>
			<?php endif; ?>
			<?php if($jenis=='umum'): ?>
		
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                   <th width="8%">NO.</th>					
                    <th>NAMA RUANG</th>
					 <th width="10%">JUMLAH</th>
					  <th width="18%">KELENGKAPAN</th>
					  <th width="15%">KEADAAN</th>
					 </tr>
					
			    <?php
					$query = mysqli_query($koneksi,"SELECT * FROM sapras_ruang WHERE jenis='$jenis'");
					$no = 0;
					while ($data = mysqli_fetch_array($query)) {
					
					$no++;
					?>
			
					<tr>
                    <td style="text-align:center"><?= $no; ?></td>
					<td>&nbsp;&nbsp;Ruang <?= $data['ruang']; ?></td>
					<td style="text-align:center"><?= $data['jumlah']; ?></td>
					<td>
					<?php if($data['kelengkapan']=='L'): ?>&nbsp;&nbsp;Lengkap<?php endif; ?>
					<?php if($data['kelengkapan']=='KL'): ?>&nbsp;&nbsp;Kurang Lengkap<?php endif; ?>
					<?php if($data['kelengkapan']=='TL'): ?>&nbsp;&nbsp;Tidak Lengkap<?php endif; ?>
					</td>
					<td style="text-align:center">
					<?php if($data['keadaan']=='B'): ?>Baik<?php endif; ?>
					<?php if($data['keadaan']=='RR'): ?>Rusak Ringan<?php endif; ?>
					<?php if($data['keadaan']=='RB'): ?>Rusak Berat<?php endif; ?>
					</td>
				
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
$dompdf->stream("Rekap Sapras Tanggal ". date('d-m-Y'). ".pdf", array("Attachment" => false));
exit(0);
?>