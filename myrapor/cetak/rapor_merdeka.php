<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$tahun=date('Y');
$ids=$_GET['ids'];
$siswa = fetch($koneksi, 'siswa', ['id_siswa' => $ids]);
$klas = $siswa['kelas'];
$level = $siswa['level'];

$peg = fetch($koneksi, 'users', ['walas' => $klas]);

	if($setting['semester']=='1'){
{$smt="(Satu)";}
}elseif($setting['semester']=='2'){
{$smt="(Dua)";}
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Raport_<?= $siswa['nama'] ?></title>
<link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
<style>
    @page { margin: 30px 30px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -20px; right: 0px; height: 30px; background-color: white; }
    #footer .page:after { content: counter(page, upper-roman); }
	.right{
    float: right;
    display: block;
	margin-right:10px;
	}
  </style>
</head>

<body style="font-size: 12px;">
    <center>
        <h5>LAPORAN HASIL BELAJAR<br>(RAPOR)</h5>
    </center>
    <br>
    <br>
	<div id="footer">
    <p class="page right"> &nbsp;&nbsp;&nbsp;&nbsp;<small><?= strtoupper($siswa['nama']) ?> - <?= strtoupper($siswa['kelas']) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=  strtoupper($setting['sekolah']) ?> - <?= date('Y') ?></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAGE </p>
  </div>
    <div class="col-md-14">
        <table style="margin-left: 10px;margin-right:10px"  width="100%">
            <tr>
			 <td width="18%">Nama Peserta Didik</td>
                <td width="1%">:</td>
				<td width="45%"><?= $siswa['nama'] ?></td>
				<td></td>
                
				<td width="17%">Kelas</td>
                <td width="1%">:</td>
				<td width="20%"><?= $siswa['kelas'] ?></td>
            </tr>
            <tr>
			    <td>N I S</td>
                <td>:</td>
				<td><?= $siswa['nis'] ?></td>
				<td></td>
				<td>Fase</td>
                <td>:</td>
				<td><?= $siswa['fase'] ?></td>
            </tr>
			<tr>
				<td>Sekolah</td>
                <td>:</td>
				<td><?= $setting['sekolah'] ?></td>
				<td></td>
				<td>Semester</td>
                <td>:</td>
				<td><?= $setting['semester'] ?> <?= $smt ?></td>
            </tr>
			<tr>
                <td>Alamat</td>
                <td>:</td>
				<td><?= $setting['alamat'] ?></td>
				<td></td>
				<td>Tahun Pelajaran</td>
                <td>:</td>
				<td><?= $setting['tp'] ?></td>
            </tr>
        </table>
       
        <br>
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="4%"><center>No</center></th>
                        <th width="35%"><center>Muatan Pelajaran</center></th>
					   <th width="7%"><center>Nilai Akhir</center></th>
					   <th><center>Capaian Kompetensi</center></th>
                    </tr>
                </thead>
                <tbody>
                    
                   <?php
                        $q1 = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$level' AND jurusan='$siswa[jurusan]' group by kelompok order by kelompok");
                        $no = 0;
                        while ($kelompok = mysqli_fetch_array($q1)) {
						$query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$level' AND jurusan='$siswa[jurusan]' AND kelompok='$kelompok[kelompok]' ORDER BY nourut ASC");
                        $kode = fetch($koneksi,'kode',['kd'=>$kelompok['kelompok'],'jenjang'=>$setting['jenjang'],'jenis'=>$setting['jenis']]);
                        ?>
							<?php if($kode['sub']<>''): ?>
                            <tr>
                            <td colspan="4"><?= $kode['sub'] ?></td>
							 </tr>
							<?php endif; ?>	 
							 <tr>	 
							<td colspan="4" class="bold">&nbsp;<?= $kode['ket'] ?></td>	
                            </tr>
                           
						<?php
						  while ($mapel = mysqli_fetch_array($query)) {
						  $pelajaran = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$mapel[idmapel]'"));
						  $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,mapel,avg(nilai)as rata,smt,tp FROM nilai_sumatif  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel'"));
							$des = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_formatif  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel'"));
							
							?>
                                <tr>
							  <td rowspan="2"> <center><?= $mapel['nourut'] ?></center></td>
							  <td  rowspan="2">&nbsp;<?= $pelajaran['nama_mapel'] ?> </td>
							  <td rowspan="2"><center>
							  <?php if($nilai['rata']!=0): ?>
							  <?= round($nilai['rata']) ?></center> 
							   <?php endif; ?>
							  </td>
							  <td style="text-align:justify;font-size:10px;height:auto">
							  <?php if($nilai['rata']!=0): ?>
							 <?= $siswa['nama'] ?> menunjukan pemahaman dalam <?= strtolower($des['tinggi']) ?>
							  <?php endif; ?>
							  </td>
							  </tr>
							 <tr>
							 <td style="text-align:justify;font-size:10px;height:auto">
							  <?php if($nilai['rata']!=0): ?>
							 <?= $siswa['nama'] ?> membutuhkan bimbingan dalam <?= strtolower($des['rendah']) ?>
							  <?php endif; ?>
							  </td>
							  
							  </tr>
							  
									<?php } } ?>	
									
							   
							</tbody>
						</table>
           
           <div style='page-break-before:always;'></div>
            <br>
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="2%"><center>No</center></th>
                        <th width="32%"><center>Kegiatan Ekstrakurikuler</center></th>
					   <th><center>Keterangan</center></th>
					
                    </tr>
                </thead>
                <tbody>
				 <?php
					$no=0;
					$queryx = mysqli_query($koneksi, "select * from m_eskul ");
                    while ($esk = mysqli_fetch_array($queryx)) {
					$eskuler = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM peskul  WHERE nis='$nis' AND eskul='$esk[eskul]'"));
				$no++;
				?>
				<tr>
				<td><center><?= $no ?></center> </td>
				<td>&nbsp;<?= $esk['eskul'] ?> </td>
				<td style="text-align:justify;font-size:10px">&nbsp;
				<?php if($eskuler['eskul']== NULL){ ?><?php }else{ ?>
				
               <?php				
				if($eskuler['nilai']=='A'){
				{$grades="Sangat Baik";}
				}elseif($eskuler['nilai']=='B'){
				{$grades="Baik";}
				}elseif($eskuler['nilai']=='C'){
				{$grades="Cukup Baik";}
				}elseif($eskuler['nilai']=='D'){
				{$grades="Kurang";}
				}
				?>
				<?= $grades ?> dan <?= $eskuler['ket'] ?>  dalam mengikuti kegiatan Ekstrakurikuler <?= $esk['eskul'] ?>
				<?php } ?>
				</td>
				</tr>
				 <?php } ?>
				
	</tbody>
            </table>
           
            <br>
	
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="60%">
                <tr>
				<td colspan="2" style="text-align:center"><b>Ketidakhadiran</b> </td>
				</tr>
				<tr>
				<td width="50%">&nbsp;Sakit </td>
				<td style="text-align:center"> <?= $siswa['sakit'] ?> hari</td>
				</tr>
				<tr>
				<td>&nbsp;Izin </td>
				<td style="text-align:center"> <?= $siswa['izin'] ?> hari</td>
				</tr>
				<tr>
				<td>&nbsp;Tanpa Keterangan </td>
				<td style="text-align:center"> <?= $siswa['alpha'] ?> hari</td>
				</tr>
	
            </table>
            <br>
			
			<?php if($setting['semester']==2){ ?>
       <table style="margin-left: 10px;margin-right:10px;" border ="1" width="60%">
                
				<tr>
				<td height="30">&nbsp;Berdasarkan hasil belajar pada semester ke - 1<br>
				         &nbsp;dan ke - 2, peserta didik ditetapkan *)<br>&nbsp;naik ke kelas ......................................</b>
						 <br><s><b>&nbsp;tinggal di kelas  <?= $siswa['kelas'] ?></b></s><br>&nbsp;*) Coret yang tidak perlu.					
                     </td>
				</tr>
            </table>
			
		<br>
		<?php } ?>
       <table style="margin-left:50px;;" width="100%">
		<tr>
               <td style="text-align: center" width="33.3%"></td>
                 <td style="text-align: center" width="33.3%"></td>
                <td width="33.3%"> <?= ucwords(strtolower($setting['kecamatan'])) ?>, <?= $setting['tanggal_rapor'] ?></td>
            </tr>
			</table>
			<table style="margin-left:50px;" width="100%">
            <tr>
                <td>Mengetahui  :</td>
			<td>Mengetahui  :</td>
				 <td>Wali Kelas <?= $siswa['kelas'] ?></td>
            </tr>
			
		<tr>
               <td width="33.3%">Orang Tua/Wali</td>
                 <td  width="33.3%">
				
					Kepala Sekolah
					
				 </td>
                <td  width="33.3%"></td>
            </tr>
			</table>
			
			<br><br><br>
			
			<table style="margin-left:50px;" width="100%">
		<tr>
               <td width="33.3%">______________</td>
                 <td width="33.3%"> <b><?= $setting['kepsek'] ?></b</td>
                <td  width="33.3%"><b><?= $peg['nama'] ?></b></td>
            </tr>
			<tr>
               <td style="text-align: center" width="33.3%"></td>
                 <td width="33.3%"> NIP. <?= $setting['nip'] ?></td>
				 
                <td  width="33.3%">NIP. <?= $peg['nip'] ?></td>
				 
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
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Raport_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>