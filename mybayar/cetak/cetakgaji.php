<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	$bulanmu = $_GET['bulan'];
	$bl = $_GET['bulan'];
	$tgl = $_GET['tanggal'];	
	$tahun = date('Y');
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
	?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>

    <title>Rekap Bulan <?= $bulane['ket'] ?>-<?= $tahun ?></title>

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
		
		<center><h3>DAFTAR PENERIMA HONOR<br> BULAN <?= strtoupper($bulane['ket']) ?> <?= $tahun ?></h3></center>
		<br>
     <br>
	 
								 <table class='it-grid it-cetak' width='100%'>       
									  <tr>
										<th width="5%" height="40px" class="text-center">NO</th>
										<th  class="text-center">NAMA LENGKAP</th>
										<th  width="10%"  class="text-center">JABATAN</th>
										<th  width="10%"  class="text-center">BANK</th>
										<th  width="15%"  class="text-center">NO. REK</th>
										<th  width="12%"  class="text-center">JUMLAH</th>
										<th width="8%" class="text-center">PPH</th>
										<th width="12%" class="text-center">DITERIMA</th>
										
									</tr>
                                         <?php
					                       $no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level<>'admin' and level<>'awas'"); 
											while ($peg = mysqli_fetch_array($query)) :
											$dt1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='1'")); 
												$jjm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,bulan,tahun,sum(jjm) as jml FROM absen_jjm  WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun'"));
												$ajar = $jjm['jml'] * $dt1['besar'];
											$dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='2'"));
                                                $jsiang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun,sum(honor) as total FROM absen_tu WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='siang'"));
												$bayarstaf = $jsiang['total'];
											$dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='3'"));
                                                 $jmalam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='malam'"));
											     $bayarmalam = $jmalam * $dt3['besar'];
											$dt4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='4'"));
                                                 $jeskul = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='H'"));
											     $bayareskul = $jeskul * $dt4['besar'];
											$dt5 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,kode,sum(besar) as totl FROM gaji WHERE idpeg='$peg[id_user]' and kode='5'"));
											$jumbayar = ($ajar + $bayarstaf + $bayarmalam + $bayareskul + $dt5['totl']);
											$no++;
											   ?>
											
			
							       <tr>
                                    <td style="text-align:center"><?= $no; ?></td>
                                    <td><?= $peg['nama'] ?></td>
									<td style="text-align:center"><?= $peg['jabatan'] ?></td>
									<td style="text-align:center"><?= $peg['bank'] ?></td>
									<td><?= $peg['norek'] ?></td>
										<td style="text-align:right">Rp. <?= number_format($jumbayar) ?>&nbsp;</td>
									<td  style="text-align:center">0</td>
									<td style="text-align:right">Rp. <?= number_format($jumbayar) ?>&nbsp;</td>
			                        
									 </tr>   
							<?php endwhile ?>	
							<?php
							if($setting['jam']=='2'):
											$dt11 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE  kode='1'")); 
												$jjm1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT bulan,tahun,sum(jjm) as jml FROM absen_jjm  WHERE  bulan='$bulanmu' and tahun='$tahun'"));
												$ajar1 = $jjm1['jml'] * $dt11['besar'];
											$dt21 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE  kode='2'"));
                                                $jsiang1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT ket,bulan,tahun,sum(jumlah) as jjm FROM absen_tu WHERE  bulan='$bulanmu' and tahun='$tahun' and ket='siang'"));
												$bayarstaf1 = $jsiang1['jjm'] * $dt21['besar'];
											$dt31 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE kode='3'"));
                                                 $jmalam1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE bulan='$bulanmu' and tahun='$tahun' and ket='malam'"));
											     $bayarmalam1 = $jmalam1 * $dt31['besar'];
											$dt41 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE kode='4'"));
                                                 $jeskul1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE  bulan='$bulanmu' and tahun='$tahun' and ket='H'"));
											     $bayareskul1 = $jeskul1 * $dt41['besar'];
											$dt51 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT kode,sum(besar) as ttl FROM gaji WHERE kode='5'"));
											$jumbayar1 = ($ajar1 + $bayarstaf1 + $bayarmalam1 + $bayareskul1 + $dt51['ttl']);
							else:
							$jbyr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(besar) as jml FROM gaji"));
							$jumbayar1 = $jbyr['jml'];
							endif;
							?>
							<tr>
							<td colspan="6" style="text-align:right;font-weight:bold">TOTAL&nbsp;</td>
							<td  style="text-align:center;font-weight:bold">0</td>
							<td style="text-align:right;font-weight:bold">Rp. <?= number_format($jumbayar1) ?>&nbsp;</td>
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
							Rp. <?= number_format($jumbayar1) ?>
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
$dompdf->setPaper('A4', 'Landscape');
$dompdf->render();
$dompdf->stream("Rekap Pembayaran Bulan ". $bulane['ket'] . ".pdf", array("Attachment" => false));
exit(0);
?>