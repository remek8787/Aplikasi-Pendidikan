<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");


$kelas=$_GET['kelas'];
$ket=$_GET['ket'];
$kls = fetch($koneksi,'kelas',['kelas'=>$kelas]);
$kuri = $kls['kuri'];
$level = $kls['level'];
$jurusan = $kls['jurusan'];

$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$peg = fetch($koneksi, 'users', ['walas' => $kelas]);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

 <title>LEGER_<?= $kelas ?></title>
 <link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
</head>
<?php
    
	if($setting['semester']=='1'){
{$smt="(Satu)";}
}elseif($setting['semester']=='2'){
{$smt="(Dua)";}
}
  ?>
<body style="font-size: 12px;">
    
   
    <center>
        <h5>DAFTAR KUMPULAN NILAI <?= $ket ?></h5>	
    </center>
    <br>
    
    <div class="col-md-14">
	
        <table style="margin-left: 80px;margin-right:60px"  width="100%" >
            <tr>
                <td width="15%">Satuan Pendidikan</td>
                <td width="1%">:</td>
				<td width="40%"><?= $setting['sekolah'] ?></td>
				<td></td>
				<td width="17%">Kelas</td>
                <td width="1%">:</td>
				<td width="20%"><?= $kelas ?></td>
            </tr>
            <tr>
                <td >Alamat</td>
                <td>:</td>
				<td><?= $ms['alamat'] ?> Kec. <?= $setting['kecamatan'] ?></td>
				<td></td>
				<td>Semester</td>
                <td>:</td>
				<td> <?= $setting['semester'] ?> <?= $smt ?></td>
            </tr>
			<tr>
                <td>Wali Kelas</td>
                <td>:</td>
				<td><?= $peg['nama'] ?></td>
				<td></td>
				<td>Tahun Pelajaran</td>
                <td>:</td>
				<td><?= $setting['tp'] ?></td>
            </tr>
			
        </table>
       
        <br>
		           <?php if($kuri=='2'): ?>
							 <table style="margin-left: 10px;margin-right:10px"  width="100%" border='1'>
										<tr>
										<td width="3%" style="text-align: center">NO</td>                                               
										<td style="text-align: center" width="10%">NIS</td>
										<td style="text-align: center">NAMA LENGKAP</td>
										
										<?php																				
											 $queryx = mysqli_query($koneksi,"SELECT * FROM mapel_rapor WHERE level='$level' and jurusan='$jurusan'");  
											 while ($datax = mysqli_fetch_array($queryx)) :
											 $pel = fetch($koneksi,'mapel',['id'=>$datax['idmapel']]);
											   ?>
										   <th style="text-align: center" width="6%"><?= $pel['kode'] ?></th>
                                           <?php endwhile; ?>										
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$no=0;										
											$query = mysqli_query($koneksi,"SELECT * FROM siswa where kelas='$kelas' and jurusan='$jurusan'");                                       
											while ($siswa = mysqli_fetch_array($query)) :									
											$no++;
											?>
                                            <tr>
											 <td style="text-align: center"><?= $no; ?></td>
											 <td style="text-align: center"><?= $siswa['nis'] ?></td>
											 <td>&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>						
											<?php																				
											$querys = mysqli_query($koneksi,"SELECT * FROM mapel_rapor WHERE level='$level' and jurusan='$jurusan'");                                       
											while ($datas = mysqli_fetch_array($querys)){
											$nilai = mysqli_fetch_array(mysqli_query($koneksi,"SELECT idsiswa,avg(nilai) as rata,mapel,smt,tp FROM nilai_sumatif WHERE idsiswa='$siswa[id_siswa]' AND mapel='$datas[idmapel]' and smt='$semester' and tp='$tapel' GROUP BY mapel"));
											?>
											<td style="text-align: center"><?= round($nilai['rata']) ?></td>
											<?php } ?>
											   </tr>
											<?php endwhile; ?>
			
		                             </table>
                              <?php else : ?>
                              <table style="margin-left: 10px;margin-right:10px"  width="100%" border='1'>
								<tr>
								<td width="3%" style="text-align: center" rowspan="2">NO</td>                                               
								<td style="text-align: center" rowspan="2">NAMA LENGKAP</td>
							<?php																				
								$queryx = mysqli_query($koneksi,"SELECT * FROM mapel_rapor WHERE level='$level' and jurusan='$jurusan'");  
								while ($datax = mysqli_fetch_array($queryx)) :
								$pel = fetch($koneksi,'mapel',['id'=>$datax['idmapel']]);
								?>
								<td style="text-align: center" width="6%" colspan="2"><?= $pel['kode'] ?></td>
								<?php endwhile; ?>										
                                 </tr>
								<tr>
								<?php																				
								$queryx = mysqli_query($koneksi,"SELECT * FROM mapel_rapor WHERE level='$level' and jurusan='$jurusan'");  
								while ($datax = mysqli_fetch_array($queryx)) :
								$pel = fetch($koneksi,'mapel',['id'=>$datax['idmapel']]);
								?>
								<td style="text-align: center">KI-3</td>
								<td style="text-align: center">KI-4</td>
								<?php endwhile; ?>										
                                 </tr>
								 <?php											
									$no=0;										
									$query = mysqli_query($koneksi,"SELECT * FROM siswa where kelas='$kelas' and jurusan='$jurusan'");                                       
									while ($siswa = mysqli_fetch_array($query)) :									
									$no++;
									?>
                                    <tr>
									<td style="text-align: center"><?= $no; ?></td>
									<td>&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>	
								     <?php																				
									$querys = mysqli_query($koneksi,"SELECT * FROM mapel_rapor WHERE level='$level' and jurusan='$jurusan'");                                       
									while ($datas = mysqli_fetch_array($querys)){
									$nilai3 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT idsiswa,avg(nilai) as rata,mapel,smt,tp FROM nilai_rapor WHERE idsiswa='$siswa[id_siswa]' AND mapel='$datas[idmapel]' and smt='$semester' and tp='$tapel' and ki='KI-3' GROUP BY mapel"));
									$nilai4 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT idsiswa,avg(nilai) as rata,mapel,smt,tp FROM nilai_rapor WHERE idsiswa='$siswa[id_siswa]' AND mapel='$datas[idmapel]' and smt='$semester' and tp='$tapel' and ki='KI-4' GROUP BY mapel"));
									
									?>
									<td style="text-align: center"><?= round($nilai3['rata']) ?></td>
									<td style="text-align: center"><?= round($nilai4['rata']) ?></td>
									<?php } ?>
								 
								  </tr>
								 <?php endwhile; ?>
                             <?php endif; ?>							  
		<br/>
	<table border='0' style="margin-left: 80px;width:850">
					<tr>
					
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='400px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Wali Kelas <?= $kelas ?><br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $peg['nama'] ?></u><br/>
							NIP. <?= $peg['nip'] ?>
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
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Leger_KI-3. Kelas " .$kelas. " .pdf", array("Attachment" => false));
exit(0);
?>