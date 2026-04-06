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
$ma = fetch($koneksi, 'nilai_sikap', ['idsiswa' => $ids,'ket'=>'SPI']);	
$ceklis=$ma['pred'];
	if($ceklis=='A'){
{$grades="Sangat Baik";}
}elseif($ceklis=='B'){
{$grades="Baik";}
}elseif($ceklis=='C'){
{$grades="Cukup";}
}elseif($ceklis=='D'){
{$grades="Kurang";}
}
$mas = fetch($koneksi, 'nilai_sikap', ['idsiswa' => $ids,'ket'=>'SOS']);
$cek=$mas['pred'];
if($cek=='A'){
{$gra="Sangat Baik";}
}elseif($cek=='B'){
{$gra="Baik";}
}elseif($cek=='C'){
{$gra="Cukup";}
}elseif($cek=='D'){
{$gra="Kurang";}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Raport_<?= $siswa['nama'] ?></title>
<link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
 
 <style>
    @page { margin: 15px 30px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -20px; right: 0px; height: 30px; background-color: white; }
    #footer .page:after { content: counter(page, upper-roman); }
	.right{
    float: right;
    display: block;
	margin-right:10px;
	}
	.bold{
	font-weight:bold;
}
  </style>
   
</head>
 
<body style="font-size: 11px;">
<center><h4>PENCAPAIAN KOMPETENSI PESERTA DIDIK</h4> </center>  
    <br>
  <div id="footer">
    <p class="page right"> &nbsp;&nbsp;&nbsp;&nbsp;<small><?= strtoupper($siswa['nama']) ?> - <?= strtoupper($siswa['kelas']) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=  strtoupper($setting['sekolah']) ?> - <?= date('Y') ?></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAGE </p>
  </div>
  
    <div class="col-md-14">
	
        <table style="margin-left: 10px;margin-right:10px"  width="100%">
            <tr>
                <td width="15%">Nama Sekolah</td>
                <td width="1%">:</td>
				<td width="40%"><?= $setting['sekolah'] ?></td>
				<td></td>
				<td width="17%">Kelas</td>
                <td width="1%">:</td>
				<td width="20%"><?= $siswa['kelas'] ?></td>
            </tr>
            <tr>
                <td >Alamat</td>
                <td>:</td>
				<td><?= $setting['alamat'] ?> </td>
				<td></td>
				<td>Semester</td>
                <td>:</td>
				<td><?= $setting['semester'] ?> <?= $smt ?></td>
            </tr>
			<tr>
                <td>Nama</td>
                <td>:</td>
				<td><?= $siswa['nama'] ?></td>
				<td></td>
				<td>Tahun Pelajaran</td>
                <td>:</td>
				<td><?= $setting['tp'] ?></td>
            </tr>
			<tr>
                <td>N I S</td>
                <td>:</td>
				<td><?= $siswa['nis'] ?></td>
				<td></td>
				<td>N I S N</td>
                <td>:</td>
				<td><?= $siswa['nisn'] ?></td>
            </tr>
        </table>
       
        <br>
 <b>A. SIKAP</b><p></p>
    <b>1. Sikap Spiritual</b>
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                        <th width="20%"><center>Predikat</center></th>
                        <th><center>Deskripsi</center></th>
                       
                    </tr>
                </thead>
                <tbody>
				 <?php if ($ma['idsiswa'] <> '') { ?>
                    <tr>
                        <td height="30px"><center> <?= $ma['pred'] ?> ( <?= $grades ?> )</center></td>
                  <td style="text-align:justify;">Selalu <?= $ma['desmax'] ?> sedangkan sikap <?= $ma['desmin'] ?> mulai berkembang</td>
				  </tr>
				   <?php } ?>
                </tbody>
            </table>
            <b>2. Sikap Sosial</b>
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                        <th width="20%"><center>Predikat</center></th>
                        <th><center>Deskripsi</center></th>
                       
                    </tr>
                </thead>
                <tbody>
				 <?php if ($mas['idsiswa'] <> '') { ?>
                    <tr>
                     <td height="30px"><center> <?= $mas['pred'] ?> ( <?= $gra ?> )</center></td>
                  <td style="text-align:justify;">Selalu menunjukan <?= $mas['desmax'] ?> sedangkan sikap <?= $mas['desmin'] ?> mengalami peningkatan</td>
				  </tr>
				    <?php } ?>
                </tbody>
            </table>
            <br>
			
			 <b>B. PENGETAHUAN</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="3%"><center>No</center></th>
                        <th width="32%"><center>Mata Pelajaran</center></th>
                       <th width="4%"><center>KKM</center></th>
					   <th width="4%"><center>Nilai</center></th>
					   <th width="4%"><center>Pred</center></th>
					   <th><center>Deskripsi</center></th>
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
                            <td colspan="6"><?= $kode['sub'] ?></td>
							 </tr>
							<?php endif; ?>	 
							 <tr>	 
							<td colspan="6" class="bold">&nbsp;<?= $kode['ket'] ?></td>	
                            </tr>
                           
						<?php
						  while ($mapel = mysqli_fetch_array($query)) {
						  $pelajaran = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$mapel[idmapel]'"));
			              $nilai3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,mapel,avg(nilai)as rata,smt,tp,ki FROM nilai_rapor  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel' and ki='KI-3'"));
			              $des = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_k13 WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel' and ket='KI-3'"));
			             
						 $rentang=round(100-$mapel['kkm'])/3;		
							$predD=round($mapel['kkm']-1);
							$nilC1=round($mapel['kkm']);
							$nilC2=round($rentang)+($mapel['kkm']);				 
							$nilB1=round($nilC2+1);
							$nilB2=round($nilC2)+round($rentang);
							$nilA1=round($nilB2+1);
							$nilA2=round($nilB2)+round($rentang);	
							
		                    $rerata=round($nilai3['rata']);
							
							if($rerata<=$predD){
							{$predikat="D";}
							}elseif($rerata>=$nilC1 && $rerata<=$nilC2){
							{$predikat="C";}
							}elseif($rerata>=$nilB1 && $rerata<=$nilB2){
							{$predikat="B";}
							}elseif($rerata>=$nilA1 && $rerata<=$nilA2){
							{$predikat="A";}
							}	
						    if($predikat=='A'){
							{$edis="sangat Baik";}
							}elseif($predikat=='B'){
							{$edis="baik";}
							}elseif($predikat=='C'){
							{$edis="cukup";}
							}elseif($predikat=='D'){
							{$edis="kurang";}
							}		
			
							 $no++;
							 
			  ?>
                                <tr>
                   <td style="text-align:center;"> <?= $mapel['nourut'] ?></td>
                  <td >&nbsp;<?= $pelajaran['nama_mapel'] ?> </td>
				  <td style="text-align:center;"><?= $mapel['kkm'] ?></td>
				  <td style="text-align:center;">
				  <?php if($nilai3['rata']!=0): ?>
				  <?= round($nilai3['rata']) ?> 
				  <?php endif; ?>
				  </td>
				  <td style="text-align:center;">
				  <?php if($nilai3['rata']!=0): ?>
				  <?= $predikat ?>
				   <?php endif; ?>
				  </td>
				  <td height="45px" style="text-align:justify;font-size: 10px;">
				   <?php if($des['desmin']!=''): ?>
				  <?= $siswa['nama'] ?> memiliki kemampuan <?= $edis ?> dalam <?= $des['desmax'] ?>, perlu dimaksimalkan dalam <?= $des['desmin'] ?>
				  <?php endif; ?>
				  </td>
				  </tr>
				
						<?php } } ?>	
                        
                   
                </tbody>
            </table>
			
        <br>
      
      <b>C. KETERAMPILAN</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                      <th width="3%"><center>No</center></th>
                        <th width="32%"><center>Mata Pelajaran</center></th>
                       <th width="4%"><center>KKM</center></th>
					   <th width="4%"><center>Nilai</center></th>
					   <th width="4%"><center>Pred</center></th>
					   <th><center>Deskripsi</center></th>
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
                            <td colspan="6"><?= $kode['sub'] ?></td>
							 </tr>
							<?php endif; ?>	 
							 <tr>	 
							<td colspan="6" class="bold">&nbsp;<?= $kode['ket'] ?></td>	
                            </tr>
                           
							<?php
							while ($mapel = mysqli_fetch_array($query)) {
							$pelajaran = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$mapel[idmapel]'"));
							$nilai4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,mapel,avg(nilai)as rata,smt,tp,ki FROM nilai_rapor  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel' and ki='KI-4'"));
			                 $des4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_k13 WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel' and ket='KI-4'"));
			             
						    $rentang=round(100-$mapel['kkm'])/3;		
							$predD=round($mapel['kkm']-1);
						    $nilC1=round($mapel['kkm']);
							$nilC2=round($rentang)+($mapel['kkm']);				 
							$nilB1=round($nilC2+1);
							$nilB2=round($nilC2)+round($rentang);
							$nilA1=round($nilB2+1);
							$nilA2=round($nilB2)+round($rentang);
							
		                    $rerata=$nilai4['rata'];
							
							if($rerata<=$predD){
							{$predikat="D";}
							}elseif($rerata>=$nilC1 && $rerata<=$nilC2){
							{$predikat="C";}
							}elseif($rerata>=$nilB1 && $rerata<=$nilB2){
							{$predikat="B";}
							}elseif($rerata>=$nilA1 && $rerata<=$nilA2){
							{$predikat="A";}
							}	
						    if($predikat=='A'){
							{$edis="sangat Baik";}
							}elseif($predikat=='B'){
							{$edis="baik";}
							}elseif($predikat=='C'){
							{$edis="cukup";}
							}elseif($predikat=='D'){
							{$edis="kurang";}
							}		
						
							 $no++;
							 
							?>
                                <tr>
                   <td style="text-align:center;"><?= $mapel['nourut'] ?> </td>
                   <td >&nbsp;<?= $pelajaran['nama_mapel'] ?> </td>
				  <td style="text-align:center;"><?= $mapel['kkm'] ?> </td>
				  <td style="text-align:center;">
				  <?php if($nilai4['rata']!=0): ?>
				  <?= $nilai4['rata'] ?> 
				  <?php endif; ?>
				  </td>
				  <td style="text-align:center;">
				   <?php if($nilai4['rata']!=0): ?>
				  <?= $predikat ?>
				  <?php endif; ?>
				  </td>
				  <td height="45px" style="text-align:justify;font-size: 9px;">
				  <?php if($des4['desmin']!=''): ?>
				  <?= $siswa['nama'] ?> memiliki keterampilan <?= $edis ?> dalam <?= $des4['desmax'] ?>, perlu dimaksimalkan keterampilan dalam <?= $des4['desmin'] ?>
				  <?php endif; ?>
				  </td>
				  </tr>
				
					<?php } }  ?>	
                </tbody>
            </table>
              <p style="page-break-before: always;"></p>
			<b>D. EKSTRAKURIKULER</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="4%"><center>No</center></th>
                        <th width="36%"><center>Kegiatan Ekstrakurikuler</center></th>
                       <th width="4%"><center>Nilai</center></th>
					   <th width="56%"><center>Keterangan</center></th>
					
                    </tr>
                </thead>
                <tbody>
				<?php
					$no=0;
					$queryx = mysqli_query($koneksi, "select * from m_eskul ");
                    while ($esk = mysqli_fetch_array($queryx)) {
					$eskuler = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM peskul  WHERE idsiswa='$ids' AND eskul='$esk[eskul]'"));
					$no++;
					?>
				<tr>
				<td style="text-align:center;"><?= $no ?> </td>
				<td>&nbsp;<?= $esk['eskul'] ?> </td>
				<td style="text-align:center;"><?= $eskuler['nilai'] ?></td>
				<td>&nbsp;<?= $eskuler['ket'] ?>  </td>
				</tr>
				<?php } ?>
				</tr>
				
				
	</tbody>
            </table>
         
			<b>E. PRESTASI</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="4%"><center>No</center></th>
                        <th width="40%"><center>Jenis Prestasi</center></th>
                       <th width="56%"><center>Keterangan</center></th>
					  
                    </tr>
                </thead>
                <tbody>
				<?php
				$no=0;
				$queryx = mysqli_query($koneksi, "select * from siswa WHERE id_siswa='$ids'");
                while ($pres = mysqli_fetch_array($queryx)) {
				$no++;
				?>
				<tr>
				<td style="text-align:center;"><?= $no ?> </td>
				<td>&nbsp;<?= $pres['prestasi'] ?> </td>
				<td>
				<?php if($pres['prestasi'] <>''): ?>
				&nbsp;Juara <?= $pres['juara'] ?> Tingkat <?= $pres['tingkat'] ?>
				<?php endif; ?>
				</td>			
				</tr>
				<?php } ?>
				<tr>
				<td height="15px"> </td>
				<td> </td>
				<td></td>			
				</tr>
	</tbody>
            </table>
            
			<br>
<b>F. KETIDAKHADIRAN</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="70%">
                
				<tr>
				<td width="50%">&nbsp;Sakit </td>
				<td> &nbsp;<?= $siswa['sakit'] ?> hari</td>
				</tr>
				<tr>
				<td>&nbsp;Izin </td>
				<td> &nbsp;<?= $siswa['izin'] ?> hari</td>
				</tr>
				<tr>
				<td>&nbsp;Tanpa Keterangan </td>
				<td> &nbsp;<?= $siswa['alpha'] ?> hari</td>
				</tr>
	
            </table>
            <br>
			 
			<b>G. CATATAN WALI KELAS</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                
				<tr>
				<td height="40">&nbsp;<?= $siswa['catatan'] ?></td>
				
				</tr>
				
            </table>
            <br>
			
			<b>H. TANGGAPAN ORANG TUA / WALI</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                
				<tr>
				<td height="40"></td>
				
				</tr>
				
            </table>
            <br>
			
			<?php if($setting['semester']==2){ ?>
       <table style="margin-left: 10px;margin-right:10px;" border ="1" width="50%">
                
				<tr>
				<td height="30">Berdasarkan pencapaian kompetensi pada semester ke-1<br>
				         dan ke-2, peserta didik ditetapkan *)<br>
						 <?php if($siswa['level']==6 OR $siswa['level']==9 OR $siswa['level']==12): ?>
						&nbsp;<b>LULUS</b>
						<?php else: ?>
						
						 naik ke kelas <b><?= $siswa['level'] + 1 ?></b>
						 <?php endif; ?>
						 <br><s><b>tinggal di kelas  <?= $siswa['level'] ?></b></s><br>*)Coret yang tidak perlu.					
                     </td>
				</tr>
            </table>
			
		
		<?php } ?>
        <table style="margin-left: 50px;" width="100%">
		    <tr>
              <td></td>
			   <td></td>
			   <td>
			  <?= ucwords(strtolower($setting['kecamatan'])) ?>, <?= $setting['tanggal_rapor'] ?>
			  </td>
            </tr>
			<tr>
              <td style="width:35%">Orang Tua/Wali</td>
			   <td style="width:30%">Mengetahui :</td>
			   <td>
			  Wali Kelas <?= $siswa['kelas'] ?>
			  </td>
            </tr>
			<tr>
              <td style="width:35%"></td>
			   <td style="width:30%">
			  
					Kepala Sekolah
				
			   </td>
			   <td></td>
            </tr>
			<tr>
              <td style="width:35%;height:50px"></td>
			   <td></td>
			   <td></td>
            </tr>
			<tr>
              <td style="width:35%">( ______________ )</td>
			   <td><b><?= $setting['kepsek'] ?></b></td>
			   <td><b><?= $peg['nama'] ?></b></td>
            </tr>
			<tr>
              <td style="width:35%"></td>
			   <td><b>NIP. <?= $setting['nip'] ?></b></td>
			   <td><b>NIP. <?= $peg['nip'] ?></b></td>
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