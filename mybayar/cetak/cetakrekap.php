<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$kelas = $_POST['kelas'];
	$idb = $_POST['jenis'];
	$bulan= $_POST['bulan'];
	
	$tahun = date('Y');
	$user = fetch($koneksi, 'users',array('walas'=>$kelas));
	$kode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$idb'"));
    $blth=$bulan.$tahun;
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bulan]);
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Rekap Pembayaran Bulan <?= $bulan ?>-<?= $tahun ?></title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
@page { margin: 80px; }
body { margin: 20px; }
</style>
<body style="font-size: 12px;">	


<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='100'><img src='../../images/<?= $setting['logo'] ?>' width='70'></td>
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
		
		<center><h4>DATA PEMBAYARAN</h4></center>
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
                <td><?= $bulane['ket'] ?> <?= $tahun ?></td>
            </tr>
			
                <tr>
				<td width="10%"></td>
                <td width='100px'>Kode</td>
                <td width='10px'>:</td>
                <td><?= $kode['kode'] ?></td>
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
                <th width="15%" class="text-center">BULAN</th>
                <th width="10%" class="text-center">KODE</th>
                <th class="text-center">NAMA PEMBAYARAN</th>
                <th width="15%" class="text-center">TOTAL RP</th>
                
            </tr>
                  <?php
				  $no = 0;
			$query = mysqli_query($koneksi,"select SUM(bayar)AS jumlah,idbayar,blth from trx_bayar WHERE blth='$blth' AND idbayar='$idb'");
              while ($data = mysqli_fetch_array($query)) {
		      
			  $no++;
			?>
			
							<tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td class="text-center"><?= $bulane['ket'] ?> <?= $tahun ?></td>
									<td class="text-center"><?= $kode['kode'] ?></td>
									<td><?= $kode['nama'] ?></td>
									<td class="text-right"><?= number_format($data['jumlah']) ?></td>
			                        
									 </tr>   
			  <?php } ?>
                    
								
            </table>
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