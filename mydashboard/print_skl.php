<?php ob_start();

require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
include "../vendor/phpqrcode/qrlib.php";

$ids = $_GET['ids'];
$siswa = fetch($koneksi, 'siswa', ['id_siswa' => $ids]);
$lvl = fetch($koneksi,'kelas',['kelas'=>$siswa['kelas']]);
$kuri = $lvl['kuri'];
$pk = $lvl['pk'];
$bk = $lvl['bk'];
$kk = $lvl['kk'];
$jurusan = $siswa['jurusan'];
$skl = fetch($koneksi, 'skl', ['id_skl' => 1]);
$tempdir = "../qrkode/"; 
if (!file_exists($tempdir)) 
    mkdir($tempdir);

$codeContents = $ids . '-' . $siswa['nama'];

QRcode::png($codeContents, $tempdir . $ids . '.png', QR_ECLEVEL_M, 4);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>SKL_<?= $siswa['nama'] ?></title>

</head>
<style>
.bold{
	font-weight:bold;
}
.tengah{
	text-align:center;
}
</style>
<style>

html {
   font-size: 14px;
}

body {
	margin-top: 20px;
margin-left: 30px;
margin-right: 30px;
margin-bottom: 10px;
    font-family: sans-serif;
    font-size: 1em;
    line-height: 1.1;
  
}
.table-wrapper {
    overflow: auto;
}

.text-center {
    text-align: center;
}

.table-siswa {
    border-collapse: collapse;
    width: 100%;
    margin: 0;
    padding: 0;
}

.table-siswa td {
    border: 1px solid black;
    position: relative;
    padding: 2px;
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
       <h3 style="margin-top:-15px"><u><?= $skl['nama_surat'] ?></u></h3>
        No. Surat : <?= $skl['no_surat'] ?>
    </center>
 
      <div style='width:100%;text-align:justify'>
	  <?= $skl['pembuka'] ?>
	  </div>
		
		
        <table style="margin-left:60px;margin-right:60px"  width="100%">
            <tr>
                <td style="width:200px">&nbsp;Nama</td>
                <td>&nbsp;: <?= $siswa['nama'] ?></td>
            </tr>
            <tr>
                <td>&nbsp;Tempat, Tgl Lahir</td>
                <td>&nbsp;: <?= $siswa['t_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
            <tr>
                <td>&nbsp;Nomor Induk Peserta Didik</td>
                <td>&nbsp;: <?= $siswa['nis'] ?> </td>
            </tr>
			 <tr>
                <td>&nbsp;Nomor Induk Siswa Nasional</td>
                <td>&nbsp;: <?= $siswa['nisn'] ?> </td>
            </tr>
          <?php if($setting['jenjang']=='SMK'): ?>
		  <tr>
                <td>&nbsp;Bidang Keahlian</td>
                <td>&nbsp;: <?= $bk ?> </td>
            </tr>
			 <tr>
                <td>&nbsp;Program Keahlian</td>
                <td>&nbsp;: <?= $pk ?> </td>
            </tr>
			 <tr>
                <td>&nbsp;Kompetensi Keahlian</td>
                <td>&nbsp;: <?= $kk ?> </td>
            </tr>
			<?php endif; ?>
        </table>
		
		 <div style='width:100%;text-align:justify'>
       <?= $skl['isi_surat'] ?> 
	   </div>
        <center>
            <?php if ($siswa['ket'] == 1) { ?>
                <h3><b>LULUS</b></h3>
            <?php } elseif ($siswa['ket'] == 2) { ?>
                <h3><b>LULUS BERSYARAT</b></h3>
            <?php } else { ?>
                <h3><b>TIDAK LULUS</b></h3>
            <?php } ?>
        </center>

       Dengan hasil sebagai berikut:<br><br>
            <table style="margin-left: 30px;margin-right:30px;" class="table-siswa" width="100%">
              
                     <tr>
					   <td colspan="2" height="30px" class="text-center">MATA PELAJARAN</td>
					   <td width="10%" class="text-center">NILAI</td>
					    
					   </tr>
                     
			  <?php
                        $q1 = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$siswa[level]' AND jurusan='$siswa[jurusan]' group by kelompok order by kelompok");
                        $no = 0;
                        while ($kelompok = mysqli_fetch_array($q1)) {
						$query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$siswa[level]' AND jurusan='$siswa[jurusan]' AND kelompok='$kelompok[kelompok]' ORDER BY nourut ASC");
                        $kode = fetch($koneksi,'kode',['kd'=>$kelompok['kelompok'],'jenjang'=>$setting['jenjang'],'jenis'=>$setting['jenis']]);
                        ?>
							<?php if($kode['sub']<>''): ?>
                            <tr>
                            <td colspan="3"><?= $kode['sub'] ?></td>
							 </tr>
							<?php endif; ?>	 
							 <tr>	 
							<td colspan="3" class="bold">&nbsp;<?= $kode['ket'] ?></td>	
                            </tr>
                           
						<?php
						  while ($mapel = mysqli_fetch_array($query)) {
						  $pelajaran = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$mapel[idmapel]'"));
			             if($kuri=='2'):
						 $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,mapel,avg(nilai)as rata FROM nilai_skl  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]'"));
						else:
							 $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,mapel,avg(nilai)as rata,ki FROM nilai_skl  WHERE idsiswa='$ids' and mapel='$mapel[idmapel]' and ki='KI3'"));
                         endif;						
							$no++;
							 
							?>
				<tr>
                   <td style="text-align:center;" width="5%"> <?= $mapel['nourut'] ?></td>
                  <td >&nbsp;<?= $pelajaran['nama_mapel'] ?> </td>
				   <td style="text-align:center"><?= number_format($nilai['rata'],2) ?> </td>
				   
				</tr>
				
						<?php } } ?>	
				<?php
				 if($kuri=='2'):
				$hasil = mysqli_fetch_array(mysqli_query($koneksi, "SELECT avg(nilai)as ratax,idsiswa FROM nilai_skl  WHERE idsiswa='$ids'"));
                 else:
				 $hasil = mysqli_fetch_array(mysqli_query($koneksi, "SELECT avg(nilai)as ratax,idsiswa,ki FROM nilai_skl  WHERE idsiswa='$ids' and ki='KI3'"));
				  endif;	
				?>
				<tr>
						 <td colspan="2" class="bold tengah">RATA-RATA NILAI
                      </td>
					 <td class="bold tengah"><?= number_format($hasil['ratax'],2) ?></td>
					 
					 </tr>
            </table>
			
           
      
		<div style='width:100%; margin:5px;text-align:justify'>
        <?= $skl['penutup'] ?>
        </div>
		
  <img src="../images/<?= $setting['logo'] ?>" style="z-index: 800;position:absolute;margin-top:-370;margin-left:200px;width:300px;opacity:0.08;">
         <table width="100%">
            <tr>
                <td style="text-align: center" width="33%">
                    <img class="img" src="../qrkode/<?= $siswa['id_siswa'] ?>.png" width="120px">
                </td>
				 <td style="text-align: center" width="33%">
				 <br>
				 <?php if($siswa['foto']<>''){ ?>
                    <img class="img" src="../images/fotosiswa/<?= $siswa['foto'] ?>" width="90px">
				 <?php }else{ ?>
				   <img class="img" src="../images/polos.png" width="90px">
				  <?php } ?>
				<p style="margin-top:-10px;">
				  <?= $siswa['nama'] ?></p>
				  </td>
                
                <td style="text-align: left">
                    <?= $setting['kecamatan'] ?>, <?= $skl['tgl_surat'] ?>
                    <br>Kepala Sekolah,					
                    <br><br><br><br><br>
                    <b><u><?= $setting['kepsek'] ?></u></b>
                    <br>NIP. <?= $setting['nip'] ?>
					<br>
                   <?php if ($setting['pk_ttd'] == 1) { ?>
                        <img style="z-index: 800;position:absolute;margin-top:-74px;margin-left:30px" class="img" src="../images/<?= $setting['ttd'] ?>" width="160">
                    <?php } ?>
                    <?php if ($setting['pk_stempel'] == 1) { ?>
                        <img style="z-index: 900;position:relative;margin-top:-130px;margin-left:-15px;opacity:0.7" class="img" src="../images/<?= $setting['stempel'] ?>" width="140px">
                    <?php } ?>
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
$dompdf->setPaper('Legal', 'portrait');
$dompdf->render();
$dompdf->stream("SKL_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>