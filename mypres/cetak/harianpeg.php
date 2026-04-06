<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	$tanggal = $_GET['tanggal'];
    $harix = date('D',strtotime($tanggal));
	$bl= date('m');
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);	
	 $hari = fetch ($koneksi, 'm_hari', ['inggris' =>$harix]);
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
                 <td width='10%'>Hari</td>
                <td width='2%'>:</td>
                <td width='15%'><?= $hari['hari'] ?></td>
				<td width='40%'></td>
				<td width='15%'>Semester</td>
                <td width='2%'>:</td>
                <td width='10%'><?= $setting['semester'] ?></td>
            </tr>
			
                <tr>
                <td>Tanggal</td>
                <td>:</td>
                 <td><?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= date('Y') ?></td>
				<td></td>
				 <td>Tahun Pelajaran</td>
                <td>:</td>
                <td> <?= $setting['tp'] ?></td>
				</tr>
				
			
    </table>

   <br>
		 <table class='it-grid it-cetak' width='100%' style="font-size:13px;">       
              <tr height='40px'>
                    <th width="5%">NO.</th>					
                    <th width="20%">N I P</th>
					 <th>NAMA PEGAWAI</th>
					
                    <th width="20%">JABATAN</th>
					<th width="5%" >KET</th>
                    <th width="30%">KETERANGAN</th>
                   </tr>
			              
			<?php
			$query = mysqli_query($koneksi,"select * from absensi where level='pegawai' and tanggal='$tanggal'");
            $no = 0;
            while ($data = mysqli_fetch_array($query)) {
				$peg = fetch($koneksi, 'users',array('id_user'=>$data['idpeg']));
			$no++;
			?>
			
							<tr>
                                    <td style="text-align:center"><?= $no; ?></td>
									<td style="text-align:center"><?= $peg['nip']; ?></td>
                                    <td>&nbsp;&nbsp;<?= ucwords(strtolower($peg['nama'])) ?></td>
									<td style="text-align:center"><?= $peg['jabatan']; ?></td>
									<td style="text-align:center"><?= $data['ket']; ?></td>
									<td style="text-align:center">
									<?php if($data['ket']=='H'){ ?>
									<?= $data['keterangan']; ?>
									<?php } ?>
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
							
					Kepala Sekolah
					
					<br/>
							<br/>
							<br/>
							<br/>
							
							<u><b><?= $setting['kepsek'] ?></b></u><br/>
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
$dompdf->setPaper('A4', 'Legal');
$dompdf->render();
$dompdf->stream("Absensi Harian Pegawai Tanggal ". date('d-m-Y'). ".pdf", array("Attachment" => false));
exit(0);
?>