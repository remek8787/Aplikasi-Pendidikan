<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$id= $_GET['iduser'];
$user = fetch ($koneksi, 'users', ['id_user' =>$id]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>AKUN GTK</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>
</head>
<style>
@page { margin: 50px; }
body { margin: 50px; }
</style>
<body>	
<div style='background:#fff; width:97%; margin: auto; height:90%;'>
     <table width='100%'>
        <tr>
          <td width='70px'><img src='../../images/<?= $setting['logo'] ?>' width='70px'></td>
          <td style="text-align:center">
          <h3><?= strtoupper($setting['header']) ?></h3>
          <h4> <?= strtoupper($setting['sekolah']) ?></h4>
	      <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?> </small>  
          </td>
         </tr>
     </table>
			 
   <br>
		
    <table width="100%" border="1" >
        <tr>
          <td>SURAT PEMBERITAHUAN AKSES LAYANAN<br>
          SANDIK (SISTEM APLIKASI PENDIDIK) <?= strtoupper($setting['sekolah']); ?></td>  
        </tr>		  
    </table>

     <br>
	  <table width="100%" >
            <tr>
           <td>Kepada yth,<br>
                <?= strtoupper($user['nama']); ?><br>
				<?= strtoupper($setting['sekolah']); ?>
				</td> 
				<td width="20%"></td>
                <td>Tanggal : <?= date('d M Y') ?><br>
				    Perihal &nbsp;&nbsp;&nbsp;: Surat Akun Login Aplikasi<br>
                    Sifat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: SANGAT RAHASIA
				</td>				
            </tr>		  
    </table>
	<br><br><br>
        <p>Dengan hormat,</p>
		<br>
		<p style="text-align:justify;">Pengembangan Sistem Aplikasi Pendidik merupakan Layanan secara online maupun offline bagi Guru dan Tenaga Kependidikan di <?= $setting['sekolah'] ?>. Layanan ini diselenggarakan oleh <?= $setting['sekolah'] ?> dalam rangka meningkatkan kualitas GTK di <?= $setting['sekolah'] ?>. Melalui surat ini, kami memberitahukan bahwa Anda RESMI TERCATAT di SISTEM APLIKASI PENDIDIK <?= $setting['sekolah'] ?>.
		<br>dengan akun sebagai berikut :
		</p>			
    <br>
	<br>
	  <table width="80%" border="1" style="margin-left:100px;">
        <tr>
          <td width="30%"> &nbsp;Username</td>
          <td> &nbsp;<?= $user['username'] ?></td>			
        </tr>	
        <tr>
          <td> &nbsp;Password</td>
          <td> &nbsp;<?= $user['password'] ?></td>			
        </tr>		
    </table>
	 <br>
  <p>Gunakan informasi diatas untuk melakukan login pada alamat berikut: <?= $setting['server'] ?>/myhome/</p>
	 <br> <br>
	<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='20px'></td>
						<td>
							<br/>
							<br/>
							<br/>
							<br/>
							<br/>							
							<br/>
							
						</td>
						<td width='30%'></td>
						<td width="5%"></td>
						<td>
							<?= $setting['kabupaten'] ?>, <?= date('d M Y') ?> <br/>
							
					Kepala <?= $setting['sekolah'] ?>
				
					<br><br><br><br><br>
								<u><?= $setting['kepsek'] ?></u>
							<br>
							
						<p>NIP. <?= $setting['nip'] ?></p>
						</td>
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
				$dompdf->stream("Akun Pegawai ". $user['nama'] . ".pdf", array("Attachment" => true));
				exit(0);
				?>