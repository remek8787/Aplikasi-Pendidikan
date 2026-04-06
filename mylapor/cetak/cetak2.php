<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
		function getRomawi($bln){
               switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>PENGANTAR</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
@page { margin: 50px; }
body { 
margin-left: 50px; 
margin-right: 50px;
margin-top: 50px;
margin-bottom: 50px;
}
</style>
<style>
.bold{
	font-weight:bold;
}
.tengah{
	text-align:center;
}
</style>
<body>	
<table width='100%'>
                <tr>
                    <td width='100px' style="text-align:center">
					<img src='../../images/<?= $setting['pemda'] ?>' width='70px'>
					</td>
                    <td style="text-align:center">
                      <?php if($setting['jenjang']=='SMK'): ?>
						<h4 class="bold">PEMERINTAH PROPINSI <?= strtoupper($setting['propinsi']) ?></h4>
						<h4 class="bold">DINAS PENDIDIKAN PROPINSI <?= strtoupper($setting['propinsi']) ?></h4>
						<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
						<?php endif; ?>  
						 <?php if($setting['jenjang']=='SMA'): ?>
						<h4 class="bold">PEMERINTAH PROPINSI <?= strtoupper($setting['propinsi']) ?></h4>
						<h4 class="bold">DINAS PENDIDIKAN PROPINSI <?= strtoupper($setting['propinsi']) ?></h4>
						<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
						<?php endif; ?>  
						 <?php if($setting['jenjang']=='SMP'): ?>
						<h4 class="bold">PEMERINTAH KABUPATEN <?= strtoupper($setting['kabupaten']) ?></h4>
						<h4 class="bold">DINAS PENDIDIKAN KABUPATEN <?= strtoupper($setting['kabupaten']) ?></h4>
						<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
						<?php endif; ?> 
							 <?php if($setting['jenjang']=='SD'): ?>
						<h4 class="bold">PEMERINTAH KABUPATEN <?= strtoupper($setting['kabupaten']) ?></h4>
						<h4 class="bold">DINAS PENDIDIKAN KABUPATEN <?= strtoupper($setting['kabupaten']) ?></h4>
						<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
						<?php endif; ?> 
							<p class="bold">TERAKREDITASI <?= $setting['akreditasi'] ?></p>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                       
                    </td>
                     <td width='100px' style="text-align:center">
					 <img src='../../images/<?= $setting['logo'] ?>' width='70px'>
					 </td>
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br><br>
   <table width="100%">
   <tr>
   <td width="60%"></td>
   <td>
   <?= $setting['kecamatan'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?><br>
   Kepada Yth<br>
   Kepala Dinas Pendidikan 
    <?php if($setting['jenjang']=='SMK' OR $setting['jenjang']=='SMA'): ?>
   <?= $setting['propinsi'] ?>
   <?php endif; ?> 
   <?php if($setting['jenjang']=='SMP' OR $setting['jenjang']=='SD'): ?>
   <?= $setting['kabupaten'] ?>
   <?php endif; ?>    
   <br>di-<br>Tempat
   </td>
   </tr>   
   </table>
   <br> <br> <br>
   <h4 class="bold tengah"><u>SURAT PENGANTAR</u></h4>
   <p class="tengah">Nomor : <?= $bulan ?>/SP/<?= $romawi ?>/<?= $tahun ?></p>
   <br><br>
   <table width="100%" border="1">
   <tr>
   <td class="bold tengah" height="30px" width="8%">NO</td>
   <td class="bold tengah">JENIS YANG DIKIRIM</td>
   <td class="bold tengah" width="20%">BANYAKNYA</td>
   <td class="bold tengah" width="40%">KETERANGAN</td>
   </tr>
    <tr style="vertical-align:top">
   <td class="tengah">1</td>
   <td> Laporan Bulanan<br><?= $setting['sekolah'] ?><br>Bulan <?= bulan_indo($tanggal) ?> <?= $tahun ?> </td>
   <td class="tengah"><br>1 (satu ) Berkas</td>
   <td>Dengan hormat,<br>Kami kirimkan kepada Bapak sebagai laporan dan dapat dipergunakan seperlunya. Terima Kasih.<br><br><br></td>
   </tr>     
   </table>
   <br><br>
   <table width="100%" style="margin-left:50px">
   <tr>
   <td>Diterima Tanggal<br>Penerima
   <br><br><br><br><br>______________________
   </td>
   <td></td>
   <td><br>Kepala Sekolah<br>
    <br><br><br><br>
	<u><?= $setting['kepsek'] ?></u><br>
	NIP.<?= $setting['nip'] ?>
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
$dompdf->setPaper('A4', 'Potrait');
$dompdf->render();
$dompdf->stream("Pengantar Laporan.pdf", array("Attachment" => false));
exit(0);
?>