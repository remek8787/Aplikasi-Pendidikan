<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	$idj = $_GET['idjadwal'];
    $kelas = $_GET['kelas'];
	$bl= date('m');
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);	
	$jadwal = fetch($koneksi, 'jadwal_mengajar',['id_jadwal'=>$idj]);
	$peg = fetch($koneksi, 'users',['id_user'=>$jadwal['guru']]);
	$mpl = fetch($koneksi, 'mapel',['id'=>$jadwal['mapel']]);	
	?>

	<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>PRESENSI HARIAN</title>

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
                    <td width='70px'><img src="../../images/<?= $setting['logo'] ?>" width='70px'></td>
                    <td style="text-align:center">
                        <strong class='f14'>
                          <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?></strong>
					 <br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
        <br>
		<center><h3>REKAPITULASI PRESENSI HARIAN</h3></center>
		<br>
 
    <table width="100%">
	
            <tr>
                 <td width='100px'>Mata Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $mpl['kode'] ?></td>
				<td width='200px'></td>
				<td width='150px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $setting['semester'] ?></td>
            </tr>
			
                <tr>
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas ?></td>
				<td width='200px'></td>
				 <td width='150px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td> <?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

   <br>
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                    <th width="5%">NO.</th>					
                    <th width="15%">N I S</th>
					 <th>NAMA SISWA</th>
					
                    <th width="10%">JK</th>
					<th width="10%" >KET</th>
                    <th width="20%">KETERANGAN</th>
                   </tr>
			              
			<?php
			$query = mysqli_query($koneksi,"select id_siswa,nis,jk,kelas,nama from siswa WHERE kelas='$kelas' GROUP BY id_siswa");
            $no = 0;
            while ($siswa = mysqli_fetch_array($query)) {
				$absen = fetch($koneksi, 'absensi',array('idsiswa'=>$siswa['id_siswa'],'tanggal'=>date('Y-m-d')));
			$no++;
			?>
			
							<tr>
                                    <td style="text-align:center"><?= $no; ?></td>
									<td style="text-align:center"><?= $siswa['nis']; ?></td>
                                    <td>&nbsp;&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>
									<td style="text-align:center"><?= $siswa['jk']; ?></td>
									<td style="text-align:center"><?= $absen['ket']; ?></td>
									<td style="text-align:center">
									
									</td>
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
							
							<br/>
							<br/>
							<br/>
							
							<br/>
							
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
							<?= $setting['kabupaten'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							
					Guru Mapel <?= $mpl['kode'] ?>
					
					<br/>
							<br/>
							<br/>
							<br/>
							
							<u><b><?= $peg['nama'] ?></b></u><br/>
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
$dompdf->setPaper('A4', 'Legal');
$dompdf->render();
$dompdf->stream("Absensi Harian Kelas ". $kelas . " Tanggal ". date('d-m-Y'). ".pdf", array("Attachment" => false));
exit(0);
?>