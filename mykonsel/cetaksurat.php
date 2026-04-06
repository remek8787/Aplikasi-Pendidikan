<?php ob_start();
error_reporting(0);
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

$id=$_GET['id'];
$surat=fetch($koneksi,'bk_surat',['idsp'=>$id]);
$siswa=fetch($koneksi,'siswa',['nis'=>$surat['nis']]);
$bl=date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>SP2</title>
	<link rel='stylesheet' href='../vendor/bootstrap-4/css/bootstrap.min.css'>

</head>
<style>
@page { margin: 30px; }
body { margin: 30px; }
</style>
<body style="font-size: 13px;">

<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='100'><img src='../images/<?= $setting['logo'] ?>' width='70'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                        <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?> </strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                       
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px;background-color:black">
		 <hr style="margin:2px;background-color:black">
   <br>
    <table>
	<tbody>
     <tr>
       <td width='100px'>Nomor Surat</td>
        <td width='10px'>:</td>
         <td><?= $surat['nosurat'] ?></td>
	    </tr>
		<tr>
		<td>Lampiran</td>	
         <td>:</td>   
		<td>-</td>
		</tr>
		<tr>
		<td>Perihal</td>	
         <td>:</td>   
		<td>Peringatan (SP1)</td>
		</tr>
			</tbody>
    </table>
	 <table>
	<tbody>
     <tr>
	  <td width='450px'></td>
       <td width='200px'>
	   Kepada Yth.<br>
	   Bapak/Ibu Orang Tua Siswa dari<br>
	   <b><?= $siswa['nama'] ?></b><br>
		di<br>
		Tempat
	   </td>        
		</tr>
			</tbody>
    </table>
	
	 <table>
	<tbody>
     <tr>
	  <td width='650px'>
       Dengan hormat,<br><br>
	   <p style="text-align:justify; text-indent:0.5in;">Bersamaan surat ini kami sampaikan bahwa ananda <b><?= $siswa['nama'] ?></b> sudah melakukan pelanggaran aturan sekolah <?= $setting['sekolah'] ?>, yakni tidak mengikuti aturan tata tertib yang berlaku diantaranya:</p>
	   </td>        
		</tr>
		
		 <?php
		 $no=0;
          $query = mysqli_query($koneksi, "select * from bk_siswa WHERE nis='$siswa[nis]' AND sts='SP1'");                          
           while ($bk = mysqli_fetch_array($query)) {
			   $sp = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_pelanggaran WHERE id='$bk[idpel]'"));   
			$no++;   
			   ?>
			   <tr>
			   <td style="text-align:justify; text-indent:0.5in;">
			   <?= $no ?>. <?= $sp['pelanggaran'] ?>
			   </td>
			   </tr>
		   <?php } ?>
		
		<tr>
		<td>
		<br>
		 <p style="text-align:justify; text-indent:0.5in;">
		 Kami memberikan kesempatan pada <b><?= $siswa['nama'] ?></b> untuk tidak mengulangi hal tersebut lagi sejak surat ini diterbitkan. Apabila terbukti melanggar aturan tersebut kembali maka teguran SP 1 akan kami lanjutkan dengan SP 2.
		 </p>
		 <p style="text-align:justify; text-indent:0.5in;">
		 Untuk itu kami memberikan sanksi berupa : <?= $surat['sanksi'] ?>
		 </p>
		  <p style="text-align:justify; text-indent:0.5in;">
		 Demikian Surat Peringatan kami sampaikan kepada Bapak/Ibu Orang Tua Siswa. Mohon perhatian dan pendampingannya dari Bapak/Ibu. Terima kasih.
		  </p>
		</td>
		</tr>
			</tbody>
    </table>
	
	 <table>
	<tbody>
     <tr>
						<td>
							 <br/>
							 <br/>
							<br/>
							<br/>
							<br/>
							
							<u></u><br/>
							 
						</td>
						<td width='450px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?= date('d') ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Kepala Sekolah<br/>
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
require_once '../pdf/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream("SP1 $siswa[nama].pdf", array("Attachment" => false));

exit(0);
?>