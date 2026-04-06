<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
    $bulanmu = $_GET['b'];
	$idpeg = $_GET['idpeg'];
	$bl = $_GET['b'];
	$tgl = $_GET['t'];	
	$tahun = date('Y');
	$peg = fetch($koneksi, 'users',array('id_user'=>$idpeg));	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$day =  cal_days_in_month(CAL_GREGORIAN, $bl, $tahun);
   
	?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>

    <title>Rincian <?= $bulane['ket'] ?>-<?= $tahun ?></title>

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
		
		<center><h3>RINCIAN HONOR<br> BULAN <?= strtoupper($bulane['ket']) ?> <?= $tahun ?></h3></center>
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
											
											<tr>
											<td width="10%"></td>
											<td width='100px'>Nama Bank</td>
											<td width='10px'>:</td>
											<td><?= $peg['bank'] ?></td>
											<td ></td>
											 <td width='100px'>No Rekening</td>
											<td width='10px'>:</td>
											<td><?= $peg['norek'] ?></td>
											</tr>	
										</table>
									 <br>
	 
								 <table class='it-grid it-cetak' width='100%'>       
									  <tr>
										<th width="5%" height="40px" class="text-center">NO</th>
										<th  class="text-center">NAMA TUGAS</th>
										<th  width="12%"  class="text-center">KET</th>
										<th  width="15%"  class="text-center">JUMLAH</th>
										<th width="15%" class="text-center">PPH</th>
										<th width="15%" class="text-center">DITERIMA</th>
										
									</tr>
                                         <?php
					                       $no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg'"); 
											while ($data = mysqli_fetch_array($query)) :
											
											if($setting['jam']=='2'):
											$dt1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='1'")); 
												$jjm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,bulan,tahun,sum(jjm) as jml FROM absen_jjm  WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun'"));
												$ajar = $jjm['jml'] * $dt1['besar'];
											$dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='2'"));
                                                 $jsiang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun,sum(honor) as total,sum(jumlah) as jml FROM absen_tu WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='siang'"));
												$bayarstaf = $jsiang['total'];
											$dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='3'"));
                                                 $jmalam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun' and ket='malam'"));
											     $bayarmalam = $jmalam * $dt3['besar'];
											$dt4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='4'"));
                                                 $jeskul = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun' and ket='H'"));
											     $bayareskul = $jeskul * $dt4['besar'];
											$dt5 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$data[idpeg]' and kode='5'"));
											$jumbayar = ($ajar + $bayarstaf + $bayarmalam + $bayareskul + $dt5['besar']);
											else :
											$bayar = $data['besar'];
											endif;
											$no++;
											   ?>
			
							       <tr>
                                    <td style="text-align:center"><?= $no; ?></td>
                                    <td><?= $data['tugas'] ?></td>
									<td style="text-align:center">
									<?php if($data['kode']=='1'): ?>
									<?= $jjm['jml'] ?> Jjm
									<?php endif; ?>
									<?php if($data['kode']=='2'): ?>
									<?= $jsiang['jml'] ?> Jam
									<?php endif; ?>
									<?php if($data['kode']=='3'): ?>
									<?= $jmalam ?> Jp
									<?php endif; ?>
									<?php if($data['kode']=='4'): ?>
									<?= $jeskul?> Jp
									<?php endif; ?>
									<?php if($data['kode']=='5'): ?>
									1 Bln
									<?php endif; ?>
									</td>
									<td style="text-align:right">
									<?php if($setting['jam']=='2'): ?>
									<?php if($data['kode']=='1'){ ?>
										Rp. <?= number_format($ajar) ?>&nbsp;
									<?php }elseif($data['kode']=='2'){ ?>
									Rp. <?= number_format($bayarstaf) ?>&nbsp;
									<?php }elseif($data['kode']=='3'){ ?>
									Rp. <?= number_format($bayarmalam) ?>&nbsp;
									<?php }elseif($data['kode']=='4'){ ?>
									Rp. <?= number_format($bayareskul) ?>&nbsp;
									<?php }elseif($data['kode']=='5'){ ?>
									Rp. <?= number_format($data['besar']) ?>&nbsp;
									<?php } ?>
									<?php else: ?>
									Rp. <?= number_format($bayar) ?>&nbsp;
									<?php endif; ?>
									</td>
									<td  style="text-align:center">0</td>
									<td style="text-align:right">
									<?php if($setting['jam']=='2'): ?>
									<?php if($data['kode']=='1'){ ?>
										Rp. <?= number_format($ajar) ?>&nbsp;
									<?php }elseif($data['kode']=='2'){ ?>
									Rp. <?= number_format($bayarstaf) ?>&nbsp;
									<?php }elseif($data['kode']=='3'){ ?>
									Rp. <?= number_format($bayarmalam) ?>&nbsp;
									<?php }elseif($data['kode']=='4'){ ?>
									Rp. <?= number_format($bayareskul) ?>&nbsp;
									<?php }elseif($data['kode']=='5'){ ?>
									Rp. <?= number_format($data['besar']) ?>&nbsp;
									<?php } ?>
									<?php else: ?>
									Rp. <?= number_format($bayar) ?>&nbsp;
									<?php endif; ?>
									</td>
			                        
									 </tr>   
							<?php endwhile ?>	
							<?php
							if($setting['jam']=='2'):
							$dt1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='1'")); 
												$jjm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,bulan,tahun,sum(jjm) as jml FROM absen_jjm  WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun'"));
												$ajar = $jjm['jml'] * $dt1['besar'];
											$dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='2'"));
                                                $jsiang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun,sum(jumlah) as jjm FROM absen_tu WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun' and ket='siang'"));
												$bayarstaf = $jsiang['jjm'] * $dt2['besar'];
											$dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='3'"));
                                                 $jmalam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun' and ket='malam'"));
											     $bayarmalam = $jmalam * $dt3['besar'];
											$dt4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$idpeg' and kode='4'"));
                                                 $jeskul = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$idpeg' and bulan='$bulanmu' and tahun='$tahun' and ket='H'"));
											     $bayareskul = $jeskul * $dt4['besar'];
											$dt5 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,kode,sum(besar) as totl  FROM gaji WHERE idpeg='$idpeg' and kode='5'"));
											$jumbayar = ($ajar + $bayarstaf + $bayarmalam + $bayareskul + $dt5['totl']);
							else:
							$jbyr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(besar) as jml FROM gaji WHERE idpeg='$idpeg'"));
							$jumbayar = $jbyr['jml'];
							endif;
							?>
							<tr>
							<td colspan="4" style="text-align:right;font-weight:bold">TOTAL&nbsp;</td>
							<td  style="text-align:center;font-weight:bold">0</td>
							<td style="text-align:right;font-weight:bold">Rp. <?= number_format($jumbayar) ?>&nbsp;</td>
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
							Rp. <?= number_format($jumbayar) ?>
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