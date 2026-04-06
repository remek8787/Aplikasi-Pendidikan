<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
require("../../konek/dis.php");
	

$id_bank = $_GET['m'];	
$npsn = $_GET['n'];
$level = $_GET['k'];

$mapel = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT banksoal.*, mapel.nama_mapel FROM banksoal INNER JOIN mapel ON banksoal.nama=mapel.kode WHERE id_bank='$id_bank'"));
$jenis = mysqli_fetch_array(mysqli_query($koneksi, "select * from jenis where status='aktif'"));
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>NILAI <?= $mapel['kode'] ?></title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>
<link rel='stylesheet' href='../../vendor/css/bootstrap.min.css' />
<style>
@page { margin: 50px; }
body { 
margin-left: 50px; 
margin-right: 50px;
margin-top: 60px;
margin-bottom: 80px;
}
</style>
</head>

<body>	
<?php

if (date('m') >= 7 and date('m') <= 12) {
	$ajaran = date('Y') . "/" . (date('Y') + 1);
} elseif (date('m') >= 1 and date('m') <= 6) {
	$ajaran = (date('Y') - 1) . "/" . date('Y');
}
$tglsekarang = buat_tanggal('d M Y');
?>
 
				<table width='100%'>
					<tr>
						<td width='100'><img src='../../images/kemdikbud.png' height='75'></td>
						<td>
							<CENTER>
								<strong class='f12'>
									REKAPITULASI NILAI <br>
									<?= strtoupper($jenis['nama']) ?> <br>TAHUN PELAJARAN <?= $ajaran ?>
								</strong>
							</CENTER></td>
							<td width='100'><img src="../../images/<?= $setting['logo'] ?>" height='75'></td>
					</tr>
				</table>
				<hr>
				<table class='detail'>
					<tr>
						<td>SEKOLAH / MADRASAH</td><td>:</td><td><span style='width:450px;'>&nbsp;<?= $setting['sekolah'] ?></span></td>
					</tr>
					<tr>
						<td>UJIAN / TINGKAT</td><td>:</td><td><span style='width:450px;'>&nbsp;<?= $jenis['id_jenis'] ?> / <?= $level ?></span></td>
					</tr>
					<tr>
						<td>MATA PELAJARAN</td><td>:</td><td colspan='4'><span style='width:450px;'>&nbsp;<?= strtoupper($mapel['nama_mapel']) ?> (<?= strtoupper($mapel['kode']) ?>)</span></td>
					</tr>
				</table>
				<table class='it-grid it-cetak' style="width:100%;font-size:12px">
				<tr>
					<th width='5%' height="30px" class="text-center">NO</th>
					<th width="25%" class="text-center">NO PESERTA</th>
					<th width="10%" class="text-center">N I S</th>
					<th  class="text-center">NAMA PESERTA</th>
					<th width="10%" class="text-center">KELAMIN</th>
					<th width="7%" class="text-center">AGAMA</th>					
					<th width="7%" class="text-center">ROMBEL</th>
					<th width="7%" class="text-center">NILAI</th>
					
				</tr>


		 <?php 
		 if($mapel['soal_agama']==''):
		 $sQ = mysqli_query($koneksi, "SELECT * FROM siswa WHERE level='$level' ORDER BY id_siswa ASC"); 
		 else:
		 $sQ = mysqli_query($koneksi, "SELECT * FROM siswa WHERE level='$level' and agama='$mapel[soal_agama]' ORDER BY id_siswa ASC"); 
		 endif;
		 ?>
                                <?php while ($siswa = mysqli_fetch_assoc($sQ)) : ?>
                                    <?php
									$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai  WHERE id_siswa='$siswa[id_siswa]' and id_bank='$id_bank'"));
                                    $no++;
                                    ?>
						<tr>
							<td align='center'><?= $no ?></td>
							<td align='center'><?= $siswa['no_peserta'] ?></td>
							<td align='center'><?= $siswa['nis'] ?></td>
							<td><?= ucwords(strtolower($siswa['nama'])) ?></td>
							<td><?= $siswa['jk'] ?></td>
							<td><?= $siswa['agama'] ?></td>
							<td align='center'><?= $siswa['kelas'] ?></td>
							<td align='center'><?php if($nilai['total'] !=''): ?>
										<?= number_format($nilai['total'],2) ?>
										<?php endif; ?>
										</td>
							
						</tr>
						 <?php endwhile; ?>
		
				</table>
				<br>
				<p> Catatan : </p>
				<p>1. Jika pada kolom Mapel <b>kosong</b> artinya siswa tidak mengikuti ujian.</p>
				<p>2. Jika pada kolom Mapel, <b>nilai 0</b> artinya jawaban siswa tidak ada yang benar.</p>
				<br>
				<table width='100%'>
					<tr>
						<td width='50%'>&nbsp;</td>
						<td width='30%'><?= $setting['kabupaten'] ?>, <?= $tglsekarang ?></td>
					</tr>
					<tr>
						<td width='50%'>&nbsp;</td>
						<td width='30%'>Kepala Sekolah,</td>
					</tr>
					<tr>
						<td width='50%'>&nbsp;</td>
						<td width='30%'><br><br><br><br><strong><?= $setting['kepsek'] ?></strong></td>
					</tr>
					<tr>
						<td width='50%'>&nbsp;</td>
						<td width='30%'>NIP. <?= $setting['nip'] ?></td>
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
$dompdf->stream("Nilai ". $mapel['kode'].".pdf", array("Attachment" => false));
exit(0);
?>