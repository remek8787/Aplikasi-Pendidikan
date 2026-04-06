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
$nis=$_GET['nis'];

$siswa = fetch($koneksi, 'siswa', ['nis' => $nis]);
$klas=$siswa['kelas'];
$tingkat=$siswa['level'];
$fase=$siswa['fase'];
$ids = $siswa['id_siswa'];
$walas = fetch($koneksi, 'users', ['walas' => $klas]);
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
</head>
<style>
@page { margin: 20px; }
body { margin: 20px; }

</style>
<body style="font-size: 12px;">
    <center>
        <h5>RAPOR PROYEK PENGUATAN<br>PROFIL PELAJAR PANCASILA</h5>
    </center>
    <br>
    
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
			    <td>N I S N</td>
                <td>:</td>
				<td><?= $siswa['nisn'] ?></td>
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
				<td><?= $setting['semester'] ?> ( <?= $smt ?> )</td>
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
	   <?php $query = mysqli_query($koneksi, "select * FROM m_proyek WHERE kelas='$klas' "); ?>
	   <?php while ($prj = mysqli_fetch_array($query)) : ?>
	   <b>&nbsp;&nbsp;&nbsp;<?= $prj['ke'] ?> <?= $prj['judul'] ?></b>			
            <table style="margin-left: 10px;margin-right:11px;" border ="1" width="100%">
				<tr>
				<td  style="text-align: justify;">&nbsp;&nbsp;&nbsp;<?= $prj['deskripsi'] ?></td>				
				</tr>				
            </table>
            <br>
       <?php endwhile; ?>
	 
        
	 
			 <?php $queryq = mysqli_query($koneksi, "select * FROM m_proyek WHERE kelas='$klas' "); ?>
	   <?php while ($prjk = mysqli_fetch_array($queryq)) : ?>
			<table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th>&nbsp;&nbsp;&nbsp;<?= $prjk['judul'] ?></th>
                        <th width="7%" style="text-align: center;">BB</th>
					   <th width="7%" style="text-align: center;">MB</th>
					   <th width="7%" style="text-align: center;">BSH</th>
					    <th width="7%" style="text-align: center;">SB</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
							
								$query = mysqli_query($koneksi, "select * FROM proyek WHERE kelas='$klas' AND p_proyek='$prjk[id]' ");
								 while ($p = mysqli_fetch_array($query)) {
									$dim=fetch($koneksi,'m_dimensi',['id_dimensi'=>$p['p_dimensi']]);
									$sub=fetch($koneksi,'m_sub_elemen',['id_sub'=>$p['p_sub']]);
									$nilai=fetch($koneksi,'nilai_proyek',['idsiswa'=>$ids,'idproyek'=>$p['idp']]);
                                ?>
								<tr>
                                    <td colspan="5" style="text-align: justify;background-color:#DCDCDC;"><?= $dim['dimensi'] ?></td>
								</tr>
								<tr>
								<td  style="text-align: justify;"><?= $sub['sub_elemen'] ?> - 
								<?php if($fase=='A'){ ?>
								<?= $sub['A'] ?>
								<?php }elseif($fase=='B'){ ?>
								<?= $sub['B'] ?>
								<?php }elseif($fase=='C'){ ?>
								<?= $sub['C'] ?>
								<?php }elseif($fase=='D'){ ?>
								<?= $sub['D'] ?>
								<?php }elseif($fase=='E'){ ?>
								<?= $sub['E'] ?>
								<?php }elseif($fase=='F'){ ?>
								<?= $sub['F'] ?>
								<?php } ?>
								</td>
								<td style="text-align: center;"><?php if($nilai['nilai']=='BB'){ ?>V<?php } ?></td>
								<td style="text-align: center;"><?php if($nilai['nilai']=='MB'){ ?>V<?php } ?></td>
								<td style="text-align: center;"><?php if($nilai['nilai']=='BSH'){ ?>V<?php } ?></td>
								<td style="text-align: center;"><?php if($nilai['nilai']=='SB'){ ?>V<?php } ?></td>
								</tr>
                                 <?php } ?>
                       
                </tbody>
            </table>
            <br>
              
	   <b>&nbsp;&nbsp;&nbsp;Catatan Proses</b>	
        <?php
		$que = mysqli_query($koneksi, "select * FROM nilai_proses WHERE idsiswa='$ids' AND proyek_ke='$prjk[ke]' AND semester='$setting[semester]'");
		while ($pros = mysqli_fetch_array($que)) {
									
                                ?>	   
            <table style="margin-left: 10px;margin-right:11px;" border ="1" width="100%">
				<tr>
				<td height="40" style="text-align: justify;">&nbsp;&nbsp;&nbsp;<?= $pros['catatan'] ?></td>				
				</tr>				
            </table>
		<?php } ?>
            <br> 
      <?php endwhile; ?>
	 
     
            <br>
              <center><b>KETERANGAN TINGKAT PENCAPAIAN SISWA</b></center>
			<table style="margin-left: 50px;" border ="1" width="90%">
				<tr>
				 <th width="25%" style="text-align: center;">BB</th>
					   <th width="25%" style="text-align: center;">MB</th>
					   <th width="25%" style="text-align: center;">BSH</th>
					    <th width="25%" style="text-align: center;">SB</th>				
				</tr>
                  <tr>
                  <td style="text-align: center;">Belum Berkembang</td>
				  <td style="text-align: center;">Mulai Berkembang</td>
				  <td style="text-align: center;">Berkembang sesuai harapan</td>
				  <td style="text-align: center;">Sangat Berkembang</td>
            </tr>		
             <tr>
                  <td style="text-align: center;">Siswa masih membutuhkan bimbingan dalam mengembangkan kemampuan</td>
				  <td style="text-align: center;">Siswa mulai mengembangkan kemampuan namun masih belum ajek</td>
				  <td style="text-align: center;">Siswa telah mengembangkan kemampuan hingga berada dalam tahap ajek</td>
				  <td style="text-align: center;">Siswa mengembangkan kemampuannya melampaui harapan</td>
            </tr>					
            </table>
            <br> 
           
       <table style="margin-left:50px;" width="100%">
		<tr>
               <td style="text-align: center" width="33.3%"></td>
                 <td style="text-align: center" width="33.3%"></td>
                <td width="33.3%"><?= ucwords(strtolower($setting['kecamatan'])) ?>, <?= $setting['tanggal_rapor'] ?></td>
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
                 <td  width="33.3%"> Kepala Sekolah</td>
                <td  width="33.3%"></td>
            </tr>
			</table>
			
			<br><br><br>
			
			<table style="margin-left:50px;" width="100%">
		<tr>
               <td width="33.3%">______________</td>
                 <td width="33.3%"> <?= $setting['kepsek'] ?></td>
                <td  width="33.3%"><?= $walas['nama'] ?></td>
            </tr>
			<tr>
               <td style="text-align: center" width="33.3%"></td>
                 <td width="33.3%"> NIP. <?= $setting['nip'] ?></td>
				 
                <td  width="33.3%">NIP. <?= $walas['nip'] ?></td>
				 
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