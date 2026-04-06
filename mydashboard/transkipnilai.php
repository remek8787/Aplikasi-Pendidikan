<?php ob_start();

require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$skl = fetch($koneksi, 'skl', ['id_skl' => 1]);
$ids = $_GET['ids'];
$siswa = fetch($koneksi, 'siswa', ['id_siswa' => $ids]);
$lvl = fetch($koneksi,'kelas',['kelas'=>$siswa['kelas']]);
$kuri = $lvl['kuri'];
$pk = $lvl['pk'];
$bk = $lvl['bk'];
$kk = $lvl['kk'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>TRANSKIP_<?= $lvl['kuri'] ?></title>

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
	margin-top: -20px;
margin-left: 20px;
margin-right: 20px;
    font-family: sans-serif;
    font-size: 1em;
    line-height: 1.2;
    color: #444;
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
    padding: 5px;
}



</style>   
<body>


      <table width='100%'>
                <tr>
                    <td width="70px"><img src="../../images/<?= $setting['logo'] ?>" width='70px'></td>
                    <td style="text-align:center">
                        <h3><?= strtoupper($setting['header']) ?></h3>
                     <h2 style="margin-top:-18px;"><?= strtoupper($setting['sekolah']) ?></h2>
					 <p style="margin-top:-20px;">Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></p>
                      
                    </td>
                    
                </tr>
            </table>
			
			 <hr style="margin:1px;background-color:black;margin-top:-7px">
		 <hr style="margin:2px;background-color:black">
		 <center>
        <h3>TRANSKIP NILAI</h3>
      
    </center>
  
   <div style="padding-left:10px;margin-right:0px ;">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini :
   </div>
   <br>
   <table style="margin-left:50px;margin-right:10px;"  width="100%">
	
			 <tr>
                <td width="150px">Nama</td>
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
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menerangkan bahwa :
   </div><br>
    <table style="margin-left:50px;margin-right:80px"  width="100%">
			 <tr>
                <td width="150px">Nama</td>
				<td width="10px">:</td>
				<td><?= $siswa['nama'] ?></td>
            </tr>
			  <tr>
                <td>Tempat, Tgl Lahir</td>
				<td>:</td>
				<td><?= $siswa['t_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
                <tr>
                <td>NIS / NISN</td>
				<td>:</td>
				<td><?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?></td>
            </tr>
			
               <?php if($setting['jenjang']=='SMK'): ?>
		      <tr>
                <td>Program Keahlian</td>
				<td>:</td>
                <td><?= $pk ?> </td>
            </tr>
			 <tr>
                <td>Bidang Keahlian</td>
				<td>:</td>
                <td><?= $bk ?> </td>
            </tr>
			 <tr>
                <td>Kompetensi Keahlian</td>
				<td>:</td>
                <td><?= $kk ?> </td>
            </tr>
			<?php endif; ?>
			
    </table>
	<br>
	<?php if($kuri==1) : ?>
 <table  class="table-siswa" width="90%" style="font-size:10px;">
		 <tr>
		 <td rowspan="3" class="tengah bold" width="2%">NO</td>
		 <td rowspan="3" class="tengah bold" width="20%">MATA PELAJARAN</td>
		 <td colspan="12" class="tengah bold">SEMESTER</td>
		  <td rowspan="2" class="tengah bold" colspan="2" width="5%">UJIAN SEKOLAH</td>
		   
		 </tr>
		 <tr>
		 <td class="tengah bold" width="4%" colspan="2">1</td>
		  <td class="tengah bold" width="4%" colspan="2">2</td>
		   <td class="tengah bold" width="4%" colspan="2">3</td>
		    <td class="tengah bold" width="4%" colspan="2">4</td>
			 <td class="tengah bold" width="4%" colspan="2">5</td>
			  <td class="tengah bold" width="4%" colspan="2">6</td>
			  </tr>
        <tr>
		 <td class="tengah bold">P</td>
		 <td class="tengah bold">K</td>
		 <td class="tengah bold">P</td>
		 <td class="tengah bold">K</td>
		 <td class="tengah bold">P</td>
		 <td class="tengah bold">K</td>
		 <td class="tengah bold">P</td>
		 <td class="tengah bold">K</td>
		 <td class="tengah bold">P</td>
		 <td class="tengah bold">K</td>
		 <td class="tengah bold">P</td>
		 <td class="tengah bold">K</td>
		  <td class="tengah bold">Teori</td>
		 <td class="tengah bold">Praktek</td>
		  </tr>
		   <?php
		$no=0;
		  $query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$siswa[level]' AND jurusan='$siswa[jurusan]'  ORDER BY nourut ASC");
		  while ($data = mysqli_fetch_assoc($query)) :
		  $pel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$data[idmapel]'"));
		  $no++;
		?>
		<tr>
        <td><?= $no; ?></td>
		<td><?= $pel['nama_mapel'] ?></td>
		<?php
		
		  $queryx = mysqli_query($koneksi, "SELECT idsiswa,mapel,ket,kode FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='SMT' GROUP BY kode");
		  while ($datax = mysqli_fetch_assoc($queryx)){
		  $nil3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' and kode='$datax[kode]' AND mapel='$data[idmapel]' and ket='SMT'  and ki='KI3'"));
		  $nil4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' and kode='$datax[kode]' AND mapel='$data[idmapel]' and ket='SMT' and ki='KI4'"));
		?>
		<td class="tengah"><?= $nil3['nilai'] ?></td>
		<td class="tengah"><?= $nil4['nilai'] ?></td>
		  <?php } ?>
		  <?php
		
		  $queryx = mysqli_query($koneksi, "SELECT idsiswa,mapel,ket,kode FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='US' GROUP BY ket");
		  while ($datax = mysqli_fetch_assoc($queryx)){
		  $nil3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='US' and kode='TEORI'"));
		  $nil4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='US' and kode='PRAKTEK'"));
		?>
		<td class="tengah"><?= $nil3['nilai'] ?></td>
		<td class="tengah"><?= $nil4['nilai'] ?></td>
		  <?php } ?>
		</tr>
		<?php endwhile; ?>
		
		</table>
		<?php endif; ?>
	<?php if($kuri=='2'): ?>
		<table  class="table-siswa" width="90%" style="font-size:12px;">
		 <tr>
		 <td rowspan="2" class="tengah bold" width="5%">NO</td>
		 <td rowspan="2" class="tengah bold" width="35%">MATA PELAJARAN</td>
		 <td colspan="6" class="tengah bold">SEMESTER</td>
		 <td colspan="2" class="tengah bold" width="6%">UJIAN SEKOLAH</td>
		 <tr>
		 <td class="tengah bold" width="3%">1</td>
		 <td class="tengah bold" width="3%">2</td>
		 <td class="tengah bold" width="3%">3</td>
		 <td class="tengah bold" width="3%">4</td>
		 <td class="tengah bold" width="3%">5</td>
		 <td class="tengah bold" width="3%">6</td>
		 <td class="tengah bold">Teori</td>
		 <td class="tengah bold">Praktek</td>
		<?php
		$no=0;
		  $query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$siswa[level]' AND jurusan='$siswa[jurusan]'  ORDER BY nourut ASC");
		  while ($data = mysqli_fetch_assoc($query)) :
		  $pel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$data[idmapel]'"));
		  $no++;
		?>
		<tr>
        <td><?= $no; ?></td>
		<td><?= $pel['nama_mapel'] ?></td>
			<?php
		
		  $queryx = mysqli_query($koneksi, "SELECT idsiswa,mapel,ket,nilai,kode FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='SMT' GROUP BY kode");
		  while ($datax = mysqli_fetch_assoc($queryx)){
		 
		?>
		<td class="tengah"><?= $datax['nilai'] ?></td>
		
		  <?php } ?> 
		 <?php
		
		  $queryx = mysqli_query($koneksi, "SELECT idsiswa,mapel,ket,kode FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='US' GROUP BY ket");
		  while ($datax = mysqli_fetch_assoc($queryx)){
		  $nil3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='US' and kode='TEORI'"));
		  $nil4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' AND mapel='$data[idmapel]' and ket='US' and kode='PRAKTEK'"));
		?>
		<td class="tengah"><?= $nil3['nilai'] ?></td>
		<td class="tengah"><?= $nil4['nilai'] ?></td>
		  <?php } ?>
			 </tr>
        
		<?php endwhile; ?>
		</table>
		


<?php endif; ?>
		<br><br>
		 <table width="100%">
            <tr>
                <td style="text-align: center" width="23%">
                  
                </td>
				 <td style="text-align: center" width="43%">
				 <br>
				 <?php if($siswa['foto']<>''){ ?>
                    <img class="img" src="../../images/fotosiswa/<?= $siswa['foto'] ?>" width="90px">
				 <?php }else{ ?>
				   <img class="img" src="../../images/polos.png" width="90px">
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
$dompdf->setPaper('Folio', 'portrait');
$dompdf->render();
$dompdf->stream("SKL_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>

