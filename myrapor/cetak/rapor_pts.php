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
$klas=$siswa['kelas'];
$idsiswa=$siswa['id_siswa'];
$jurusan = $siswa['jurusan'];
$level = $siswa['level'];
$kuri = fetch($koneksi, 'kelas', ['kelas' => $klas]);
$walas = fetch($koneksi, 'users', ['walas' => $klas]);

	if($setting['semester']=='1'){
{$smt="Ganjil";}
}elseif($setting['semester']=='2'){
{$smt="Genap";}
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Raport_<?= $siswa['nama'] ?></title>
 <link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
</head>
<style>
@page { margin: 10px; }
body { margin: 40px; }
.bold{
	font-weight:bold;
}
.tengah{
	text-align:center;
}
</style>
<body style="font-size: 13px;">
    
   
    <center>
        <h4>LAPORAN  HASIL PENILAIAN TENGAH SEMESTER</h4>
    </center>
    <br>
    
    <div class="col-md-14">
	
        <table style="margin-left: 30px;margin-right:10px"  width="100%">
           <?php if($setting['jenjang']=='SMK'): ?> 
			<tr>
                <td width="24%">Nama Siswa</td>
                <td width="1%">:</td>
				<td width="50%" class="bold"><?= $siswa['nama'] ?></td>
				<td></td>
				<td width="17%">Tahun Pelajaran</td>
                <td width="1%">:</td>
				<td width="20%" class="bold"><?= $setting['tp'] ?></td>
            </tr>
            <tr>
                <td >NIS / NISN</td>
                <td>:</td>
				<td class="bold"><?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?> </td>
				<td></td>
				<td>Kelas</td>
                <td>:</td>
				<td class="bold"><?= $siswa['kelas'] ?></td>
            </tr>
			
			<tr>
                <td>Bidang Keahlian</td>
                <td>:</td>
				<td class="bold"><?= $siswa['bk'] ?></td>
				<td></td>
				<td>Semester</td>
                <td>:</td>
				<td class="bold"><?= $smt ?></td>
            </tr>
			<tr>
                <td>Program Keahlian</td>
                <td>:</td>
				<td class="bold"><?= $siswa['pk'] ?></td>
				<td></td>
				<td></td>
                <td></td>
				<td></td>
            </tr>
			<tr>
                <td>Kompetensi Keahlian</td>
                <td>:</td>
				<td class="bold"><?= $siswa['kk'] ?></td>
				<td></td>
				<td></td>
                <td></td>
				<td></td>
            </tr>
			<?php else: ?>
			<tr>
                <td width="15%">Nama Sekolah</td>
                <td width="1%">:</td>
				<td width="60%"><?= $setting['sekolah'] ?></td>
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
				<td><?= $setting['semester'] ?> (<?= $smt ?>)</td>
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
			<?php endif; ?>
        </table>
       <br>
      
         <?php if($kuri['kuri']=='1'): ?>
            <table style="margin-left: 30px;margin-right:10px;" border ="1" width="100%">
               <?php else : ?>
			    <table style="margin-left: 50px;margin-right:10px;" border ="1" width="90%">
			    <?php endif; ?>
			   <thead>
                   
					   <tr>
					   <th width="5%" style="text-align:center">NO</th>
					   <th  height="40px" style="text-align:center">MATA PELAJARAN</th>
					   <?php if($kuri['kuri']=='1'): ?>
					   <th width="10%" style="text-align:center">KKM</th>
					    <th width="10%" style="text-align:center">NILAI</th>
					   <?php else : ?>
					   <th width="10%" style="text-align:center">NILAI</th>
					   <?php endif; ?>
					   </tr>
					   
                </thead>
               <tbody>
			    <?php
                        $q1 = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$level' and jurusan='$jurusan' group by kelompok order by kelompok");
                        $no = 0;
                        while ($kelompok = mysqli_fetch_array($q1)) {
						$kode = fetch($koneksi,'kode',['kd'=>$kelompok['kelompok'],'jenjang'=>$setting['jenjang'],'jenis'=>$setting['jenis']]);
                        $query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor where kelompok='$kelompok[kelompok]'  AND jurusan='$jurusan' and level='$siswa[level]' order by nourut ");                         
                        ?>
				<?php if($kode['sub']<>''): ?>
				<tr>
				 <?php if($kuri['kuri']=='1'): ?>
                <td colspan="4" class="bold"><?= $kode['sub'] ?></td>
				<?php else : ?>
					 <td colspan="3" class="bold"><?= $kode['sub'] ?></td>
						 <?php endif; ?>	
                </tr>
                <?php endif; ?>				
			    <tr>
				 <?php if($kuri['kuri']=='1'): ?>
                <td colspan="4" class="bold">&nbsp;<?= $kode['ket'] ?></td>	
					<?php else : ?>
					 <td colspan="3" class="bold">&nbsp;<?= $kode['ket'] ?></td>
					   <?php endif; ?>
                </tr>
				
			    <?php
				while ($mapel = mysqli_fetch_array($query)) {
					if($kuri['kuri']=='1'):
					$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,avg(nilai) as rata,mapel,smt,tp FROM nilai_rapor  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel'"));
					else:
					$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,avg(nilai) as rata,mapel,smt,tp FROM nilai_sumatif  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and smt='$semester' and tp='$tapel'"));
					endif;
					$pel = fetch($koneksi,'mapel',['id'=>$mapel['idmapel']]);
			   ?>
					<tr>
                    <td class="tengah"> <?= $mapel['nourut'] ?></td>
                  <td> &nbsp;&nbsp; <?= $pel['nama_mapel'] ?> </td>
				  <?php if($kuri['kuri']=='1'): ?>
				  <td class="tengah"><?= $mapel['kkm'] ?> </td>
				  <td class="tengah"><?= round($nilai['rata']) ?> </td>
				  <?php else : ?>
				    <td class="tengah"><?= round($nilai['rata']) ?></td>
					 <?php endif; ?>
					 </tr>
				<?php }} ?>
				<?php 
				if($kuri['kuri']=='1'):
				$hasil = mysqli_fetch_array(mysqli_query($koneksi, "SELECT avg(nilai)as rata,idsiswa FROM nilai_rapor  WHERE  idsiswa='$ids' and smt='$semester' and tp='$tapel'")); 
				$total += round($hasil['rata']); 
				else :
				$hasil = mysqli_fetch_array(mysqli_query($koneksi, "SELECT avg(nilai)as rata,idsiswa FROM nilai_sumatif  WHERE  idsiswa='$ids' and smt='$semester' and tp='$tapel'")); 
				$total += round($hasil['rata']); 
				endif;
				?>
				 <?php if($kuri['kuri']=='1'): ?>
				 <tr>
                <td colspan="3" class="bold tengah">JUMLAH NILAI</td>
					 <td class="bold tengah"><?= $total ?></td>
						</tr>
						<tr>
						 <td colspan="3" class="bold tengah">RATA-RATA NILAI
                      </td>
					 <td class="bold tengah"><?= round($hasil['rata']) ?></td>
					 </tr>
					<?php else : ?>
					 <tr>
					 <td colspan="2" class="bold tengah">JUMLAH NILAI</td>
					 <td class="bold tengah"><?= $total ?></td>					  
                </tr>
				 <tr>
					 <td colspan="2" class="bold tengah">RATA-RATA NILAI
                </td>
					 <td class="bold tengah"><?= round($hasil['rata']) ?></td>					  
                </tr>
				 <?php endif; ?>
            </table>
			
            <br>
     <table style="margin-left: 80px;" width="100%">
		<tr>
               <td style="text-align: left" width="33.3%">Mengetahui,</td>
                 <td style="text-align: left" width="30.3%"></td>
                <td  style="text-align:left"><?= $setting['kecamatan'] ?>, <?= $setting['tgl_rapor'] ?></td>
            </tr>
			<tr>
               <td style="text-align: left" width="33.3%">
			   Orang Tua Siswa
			   <br><br><br><br> <br>
			   _____________________
			   </td>
                 <td style="text-align: left" width="30.3%"></td>
                <td   style="text-align:left">Wali Kelas <?= $klas ?>
				 <br><br><br><br> <br>
				 <b><?= $walas['nama'] ?></b><br>
				  NIP. <?= $walas['nip'] ?>
				</td>
            </tr>
          <tr>
               <td style="text-align: left" width="33.3%"></td>
                 <td style="text-align: left" width="30.3%">Mengetahui,
				 <br>
				 Kepala Sekolah
				  <br><br><br><br> <br>
				 <b><?= $setting['kepsek'] ?></b>
				 <br>
				 NIP. <?= $setting['nip'] ?>
				 </td>
                <td   style="text-align:left"></td>
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
$dompdf->setPaper('Folio', 'portrait');
$dompdf->render();
$dompdf->stream("Raport_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>