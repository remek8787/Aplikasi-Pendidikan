<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$kelas = $_GET['kls'];
	$bl= $_GET['b'];
	$dudi = $_GET['d'];
	$walas = fetch($koneksi, 'walas',['kelas'=>$kelas]);
	$walas = fetch($koneksi, 'pkl_pembimbing',['kelas'=>$kelas,'dudi'=>$dudi]);
	$peg = fetch($koneksi, 'users',['id_user'=>$walas['idpeg']]);
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	$dudix = fetch($koneksi,'pkl_dudi',['id'=>$dudi]);	
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
		
		<center><h4 style="font-size:14px;font-weight:bold">REKAPITULASI PRESENSI PRAKERIN</h4></center>
		<br>
 
    <table width="100%">
	
            <tr>
			<td width="10%"></td>
                 <td width='100px'>Lokasi</td>
                <td width='10px'>:</td>
                <td><?= $dudix['nama_dudi'] ?></td>
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
				 <th width="7%">Jurusan</th>
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
			$query = mysqli_query($koneksi,"select idsiswa,kelas,dudi from pkl_siswa WHERE kelas='$kelas' and dudi='$dudi' GROUP BY idsiswa");
             $no = 0;
              while ($siswa = mysqli_fetch_array($query)) {
			$siswax = fetch($koneksi,'siswa',['id_siswa'=>$siswa['idsiswa']]);
			  
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$siswax[id_siswa]' AND ket='H' AND bulan='$bulan' "));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$siswax[id_siswa]' AND ket='S' AND bulan='$bulan'  "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$siswax[id_siswa]' AND ket='I' AND bulan='$bulan' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$siswax[id_siswa]' AND ket='A' AND bulan='$bulan'  "));
			  $no++;
			?>
			
							<tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td> <?= ucwords(strtolower($siswax['nama'])) ?></td>
									<td style="text-align:center"> <?= $siswax['jurusan'] ?></td>
									
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
						$date2 = date("D",strtotime("$tahun-$bulan-$i"));
                        $cekabsen = fetch($koneksi, 'pkl_kegiatan', ['tanggal' => $tanggalbaru, 'idsiswa' => $siswax['id_siswa'],'dudi'=>$dudi]);
                       if ($cekabsen) { ?>
					 
                            <td style="text-align:center"><b><?= $cekabsen['ket'] ?></b></td>
                        <?php } else { ?>
						 <?php if($date2=='Sun'): ?>
                            <td style="color:white;background-color:red" class="text-center">X</td>
							<?php else: ?>
							<td></td>
							<?php endif; ?>
                        <?php } ?>
                    <?php } ?>
					
							  <td style="text-align:center"><?= $hadir; ?></td>
							  <td style="text-align:center"><?= $sakit; ?></td>
							 <td style="text-align:center"><?= $izin; ?></td>
							  <td style="text-align:center"><?= $alpha; ?></td>
							  
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
							<?= ucwords(strtolower($setting['kecamatan'])); ?>, <?php echo date("t",time()); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Pembimbimg Prakerin<br> Kelas <?= $kelas ?><br/>
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