<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	

	$bl= date('m');
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Rekap Absen Pegawai</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
body { 
margin-left: 30px; 
margin-right: 30px;
margin-top: 50px;
margin-bottom: 20px;
}
</style>
<body style="font-size: 13px;">	

<p>LAMPIRAN : III</p>
<p>REKAPITULASI KEHADIRAN GURU/PEGAWAI </p>
<p>Keadaan pada Bulan <?= bulan_indo($tanggal) ?> <?= $tahun ?></p>		
     <br>
	 
		 <table class='it-grid it-cetak' width='100%'>       
              <tr>
                <th width="2%" height="40px">No</th>
                <th>Nama Pegawai</th>
				<th width="8%" style="text-align:center;">Jabatan</th>
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
			$query = mysqli_query($koneksi,"select id_user,level,nama from users where level<>'admin' GROUP BY id_user");
            $no = 0;
            while ($peg = mysqli_fetch_array($query)) {
			$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$peg[id_user]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun' "));
			$sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$peg[id_user]' AND ket='S' AND bulan='$bulan' AND tahun='$tahun' "));
			$izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$peg[id_user]' AND ket='I' AND bulan='$bulan' AND tahun='$tahun' "));
			$alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$peg[id_user]' AND ket='A' AND bulan='$bulan' AND tahun='$tahun' "));
			$no++;
			?>
			
			<tr>
             <td class="text-center"><?= $no; ?></td>
             <td>&nbsp;&nbsp;<?= ucwords(strtolower($peg['nama'])) ?></td>
	         <td>&nbsp;&nbsp;<?= ucwords(strtolower($peg['level'])) ?></td>
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
						$date2 = date("D",strtotime("$tahun-$bulan-$i"));
                        $cekabsen = fetch($koneksi, 'absensi', ['tanggal' => $tanggalbaru, 'idpeg' => $peg['id_user']]);
                       if ($cekabsen) { ?>
					 
                            <td class="text-center"><b><?= $cekabsen['ket'] ?></b></td>
                        <?php } else { ?>
						 <?php if($date2=='Sun'): ?>
                            <td style="color:white;background-color:red" class="text-center">X</td>
							<?php else: ?>
							<td></td>
							<?php endif; ?>
                        <?php } ?>
                    <?php } ?>
					
							  <td class="text-center"><?= $hadir; ?></td>
							  <td class="text-center"><?= $sakit; ?></td>
							 <td class="text-center"><?= $izin; ?></td>
							  <td class="text-center"><?= $alpha; ?></td>
							  
									 </tr>   
			  <?php } ?>
                    
								
            </table>
			
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
							<br/>
							
							<br/>
							
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
						<?= ucwords(strtolower($setting['kecamatan'])); ?>, <?php echo date("t",time());?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							
					Kepala Sekolah
				
					<br/>
							<br/>
							<br/>
							<br/>
							
								<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
					</tr>
				</table>

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
$dompdf->stream("Lampiran III ". $bl . ".pdf", array("Attachment" => false));
exit(0);
?>