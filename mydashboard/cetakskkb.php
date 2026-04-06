<?php ob_start();

require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");


$ids = $_GET['ids'];
$siswa=fetch($koneksi,'siswa',['id_siswa' => $ids]);
if($siswa['jk']=='L'){
	$jkel='Laki-laki';
}else{
	$jkel='Perempuan';
}
$skl = fetch($koneksi, 'skl', ['id_skl' => 1]);
$skb=fetch($koneksi,'skkb',['id' =>1]);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>SKKB_<?= $siswa['nama'] ?></title>
<link rel="stylesheet" href="../vendor/bootstrap-4/css/bootstrap.min.css">
</head>
<style>


</style>
<style>

html {
   font-size: 13px;
}

body {
	margin-top: -20px;
margin-left: 30px;
margin-right: 30px;
    font-family: sans-serif;
    font-size: 1em;
    line-height: 1.4;
    color: #444;
}
</style>
<body>
  <?php if($skl['header']<>''): ?>
   <img src="../images/<?= $skl['header'] ?>" style="max-width:670px;">
  <?php else: ?>
  <table width='100%'>
                <tr>
                    <td width="70px"><img src="../images/<?= $setting['logo'] ?>" width='70px'></td>
                    <td style="text-align:center">
                        <h3><?= strtoupper($setting['header']) ?></h3>
                     <h2 style="margin-top:-18px;"><?= strtoupper($setting['sekolah']) ?></h2>
					 <p style="margin-top:-20px;">Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></p>
                      
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px;background-color:black;margin-top:-7px">
		 <hr style="margin:2px;background-color:black">
		 <?php endif; ?>
		 
  <center>
  <br><br>
        <h5><u>SURAT KETERANGAN KELAKUAN BAIK</u></h5>
        No. Surat : <?= $skb['nosurat'] ?>
    </center>
   <br><br>
   <div style="padding-left:10px;margin-right:0px ;">
   <p>Yang bertanda tangan dibawah ini :</p>
   </div>
   <table style="margin-left:50px;margin-right:10px;"  width="100%">
	
			 <tr>
                <td width="130px">Nama</td>
				<td width="10px">:</td>
				<td><?= $setting['kepsek'] ?></td>
            </tr>
			
                <tr>
                <td>NIP</td>
				<td>:</td>
				<td><?= $setting['nip'] ?></td>
            </tr>
			
                <tr>
                <td>Jabatan</td>
				<td>:</td>
				<td>Kepala <?= $setting['sekolah'] ?></td>
            </tr>
			</tbody>
    </table>
	<br/>
	 <div style="padding-left:10px;margin-right:0px ;">
   <p>Menerangkan bahwa :</p>
   </div>
   <table style="margin-left:50px;margin-right:80px"  width="100%">
			 <tr>
                <td width="130px">Nama</td>
				<td width="10px">:</td>
				<td><?= $siswa['nama'] ?></td>
            </tr>
                <tr>
                <td>NIS / NISN</td>
				<td>:</td>
				<td><?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?></td>
            </tr>
			
                <tr>
                <td>Tempat, Tgl Lahir</td>
				<td>:</td>
				<td><?= $siswa['t_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
			
                <tr>
                <td>Jenis Kelamin</td>
				<td>:</td>
				<td><?= $jkel ?></td>
            </tr>
			
                <tr>
                <td>Agama</td>
				<td>:</td>
				<td><?= $siswa['agama'] ?></td>
            </tr>
			
                <tr>
                <td>Alamat</td>
				<td>:</td>
				<td><?= $siswa['alamat'] ?></td>
            </tr>
			
                <tr>
                <td>Desa/Kelurahan</td>
				<td>:</td>
				<td><?= $siswa['desa'] ?></td>
            </tr>
			
                <tr>
                <td>Kecamatan</td>
				<td>:</td>
				<td><?= $siswa['kecamatan'] ?></td>
            </tr>
			
                <tr>
                <td>Kabupaten</td>
				<td>:</td>
				<td><?= $siswa['kabupaten'] ?></td>
            </tr>
			
    </table>
	<br>
	 <table style="margin-left: 10px;margin-right:0px"  width="100%">
			 <tr>
	<td style="text-align:justify" width="100%"><?= $skb['isi'] ?> </td></tr>
	<tr><td style="text-align:justify" width="100%"><?= $skb['foter'] ?> </td>
	</tr>
	</table>
    <br>
	<table border='0' style="margin-left: 50px;width:750">
					<tr>
					
						<td width='250px'>
							<br/>
							 <br/>
							<br/>
							<br/>
							<br/>
							
							<br/>
							
						</td>
						<td width='150px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= date('Y') ?><br/>
							Yang Membuat Pernyataan<br/>
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
require_once '../pdf/autoload.php';;

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('Folio', 'portrait');
$dompdf->render();
$dompdf->stream("SKKB_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>