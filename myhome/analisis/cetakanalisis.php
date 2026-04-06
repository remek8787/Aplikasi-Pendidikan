
<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$id_bank = $_GET['m'];	
$id_kelas = $_GET['k'];
$mapelQ = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal JOIN mapel ON mapel.kode=banksoal.nama where id_bank='$id_bank' "));
$walas = fetch($koneksi, 'banksoal',['id_bank'=>$id_bank]);
$peg = fetch($koneksi, 'pegawai',['id_pegawai'=>$walas['idguru']]);
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bulan]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>
</head>
<style>
@page { margin: 50px; }
body { margin: 50px; }
</style>
<body style="font-size: 14px;">

   <center><h3><?= strtoupper($setting['header']) ?><br><?= strtoupper($setting['sekolah']) ?></h3></center>
   <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
   <img src="../../images/<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-30px ;width: 60px;">
   <center><h3 style="margin-top:-10px;">ANALISIS BUTIR SOAL</h3></center>
 
  <br>
      <?php
    $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_bank='$_GET[m]'"));
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal where id_bank='$id_bank' "));
	 
    ?>
   
				 <?php 
				
				 $jumlah_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$id_kelas'"));
				 ?>
				 
				  <?php 
				 
				 $jumlah_soal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank'  "));
				  
				 ?>
                <div class='box-body'>
				  
                    <table   width="100%">
                        <tr>
                            <th>Kelas</th>
                            <td width='10'>:</td>
                            <td><?= $id_kelas ?></td>
                             <td width='50'></td>
                            <th>Jml Siswa</th>
                            <td width='10'>:</td>
                            <td><b><?= $jumlah_siswa ?></b></td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td width='10'>:</td>
                            <td><?= $mapelQ['nama_mapel'] ?></td>
                           <td width='50'></td>
                            <th>Kelompok Soal</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['groupsoal'] ?></td>
                        </tr>
						 <tr>
                            <th>
						
							Jumlah Soal
							
							</th>
                            <td width='10'>:</td>
                            <td><?= $jumlah_soal ?></td>
							<td width='50'></td>
							<th>Semester / TP</th>
                            <td width='10'>:</td>
                            <td><?= $setting['semester'] ?> / <?= $setting['tp'] ?></td>
                        </tr>
						
                    </table>
					
                     <h3>Soal Pilihan Ganda</h3>
                  
                        <table class='it-grid it-cetak' style="width:100%">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jawab A</th>
							<th width="5%">Jawab B</th>
							<th width="5%">Jawab C</th>
							<th width="5%">Jawab D</th>
							<th width="5%">Jawab E</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
								
                            </thead>
							 	
							 <?php
							 
                               $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='1' ");                 
							   while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='$jawab' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban<>'$jawab' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								$A=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='A' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$B=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='B' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$C=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='C' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$D=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='D' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$E=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='E' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
									
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
									if($sulit < 0.30){
									{$status="Soal Sukar";}
									}elseif($sulit >= 0.30 && $sulit <= 0.70){
									{$status="Soal Sedang";}
									}elseif($sulit >= 0.70){
									{$status="Soal Mudah";}
									}	
									if($sulit < 0.30){
									{$dp="Jelek, soal dirombak ";}
									}elseif($sulit >= 0.30 && $sulit <= 0.50){
									{$dp="Kurang baik (perlu direvisi)";}
									}elseif($sulit >= 0.51 && $sulit <= 0.69){
									{$dp="Kurang baik (perlu direvisi)";}
									}elseif($sulit >= 0.70){
									{$dp="Baik";}
									}	
									if($benar > $salah){
									{$kecoh="Efektif";}
									}elseif($benar < $salah){
									{$kecoh="Menyesatkan";}
									}elseif($benar = $salah){
									{$kecoh="Tidak efektif";}
									}																		
										 ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        
                                        <td> <?= $mp['jawaban'] ?> </td>
										 <td> <?= $A ?> </td>
										  <td> <?= $B ?> </td>
										   <td> <?= $C ?> </td>
										    <td> <?= $D ?> </td>
											 <td> <?= $E ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									  <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									 <td> <?= $status ?> </td>
									 
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						<br>
						<?php if($mapelQ['model']=='1'): ?>
                     <h3>Soal PG Komplek (Multi Coice)</h3>
                   
                        <table class='it-grid it-cetak' style="width:100%">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='3' ");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabmulti='$jawab' AND jenis='3' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabmulti<>'$jawab' AND jenis='3' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
															   $sulit=$benar / $bagi;
							if($sulit < 0.30){
							{$status="Soal Sukar";}
							}elseif($sulit >= 0.30 && $sulit <= 0.70){
							{$status="Soal Sedang";}
							}elseif($sulit >= 0.70){
							{$status="Soal Mudah";}
							}	
							if($sulit < 0.30){
							{$dp="Jelek, soal dirombak ";}
							}elseif($sulit >= 0.30 && $sulit <= 0.50){
							{$dp="Kurang baik (perlu direvisi)";}
							}elseif($sulit >= 0.51 && $sulit <= 0.69){
							{$dp="Kurang baik (perlu direvisi)";}
							}elseif($sulit >= 0.70){
							{$dp="Baik";}
							}	
							if($benar > $salah){
							{$kecoh="Efektif";}
							}elseif($benar < $salah){
							{$kecoh="Menyesatkan";}
							}elseif($benar = $salah){
							{$kecoh="Tidak efektif";}
							}
					    ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td><?= $tidakjawab ?> </td>
									 	 <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									  <td> <?= $status ?> </td>
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
					<br>
                     <h3>Soal PG Komplek (Benar Salah)</h3>
                   
                        <table class='it-grid it-cetak' style="width:100%">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
								
                            </thead>
							 	
							 <?php
							 
							        
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='4'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs='$jawab' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs<>'$jawab' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								$A=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs='A' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$B=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs='B' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
								if($sulit < 0.30){
								{$status="Soal Sukar";}
								}elseif($sulit >= 0.30 && $sulit <= 0.70){
								{$status="Soal Sedang";}
								}elseif($sulit >= 0.70){
								{$status="Soal Mudah";}
								}	
								if($sulit < 0.30){
								{$dp="Jelek, soal dirombak ";}
								}elseif($sulit >= 0.30 && $sulit <= 0.50){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.51 && $sulit <= 0.69){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.70){
								{$dp="Baik";}
								}	
								if($benar > $salah){
								{$kecoh="Efektif";}
								}elseif($benar < $salah){
								{$kecoh="Menyesatkan";}
								}elseif($benar = $salah){
								{$kecoh="Tidak efektif";}
								}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        
                                        <td> <?= $mp['jawaban'] ?> </td>
										 
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									 <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									  <td> <?= $status ?> </td>
									 
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						<br>
                     <h3>Soal Menjodohkan</h3>
                   
                        <table class='it-grid it-cetak' style="width:100%">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='5'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawaburut='$jawab' AND jenis='5' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawaburut<>'$jawab' AND jenis='5' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
								if($sulit < 0.30){
								{$status="Soal Sukar";}
								}elseif($sulit >= 0.30 && $sulit <= 0.70){
								{$status="Soal Sedang";}
								}elseif($sulit >= 0.70){
								{$status="Soal Mudah";}
								}	
								if($sulit < 0.30){
								{$dp="Jelek, soal dirombak ";}
								}elseif($sulit >= 0.30 && $sulit <= 0.50){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.51 && $sulit <= 0.69){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.70){
								{$dp="Baik";}
								}	
								if($benar > $salah){
								{$kecoh="Efektif";}
								}elseif($benar < $salah){
								{$kecoh="Menyesatkan";}
								}elseif($benar = $salah){
								{$kecoh="Tidak efektif";}
								}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									   <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									 <td> <?= $status ?> </td>
									
                                    <?php } ?>	
									</tr>	
                            </tbody>
                        </table>
					<br>
					<?php endif; ?>
                     <h3>Soal Uraian Singkat</h3>
                   
                        <table class='it-grid it-cetak' style="width:100%">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								  
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='2'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE esai='$jawab' AND jenis='2' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE esai<>'$jawab' AND jenis='2' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
								if($sulit < 0.30){
								{$status="Soal Sukar";}
								}elseif($sulit >= 0.30 && $sulit <= 0.70){
								{$status="Soal Sedang";}
								}elseif($sulit >= 0.70){
								{$status="Soal Mudah";}
								}	
								if($sulit < 0.30){
								{$dp="Jelek, soal dirombak ";}
								}elseif($sulit >= 0.30 && $sulit <= 0.50){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.51 && $sulit <= 0.69){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.70){
								{$dp="Baik";}
								}	

							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									   <td> <?= $dp ?> </td>
									  <td> <?= $status ?> </td>
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
			  <br>
	
	<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='50px'></td>
						<td>
							Mengetahui, <br/>
							
					Kepala Sekolah
					<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
							<?= ucwords(strtolower($setting['kabupaten'])); ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Guru Pengampu<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $peg['nama'] ?></u><br/>
							NIP. <?= $peg['nip'] ?>
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
$dompdf->setPaper('A4', 'Landscape');
$dompdf->render();
$dompdf->stream("Anbuso Kelas ".$id_kelas.".pdf", array("Attachment" => true));
exit(0);
?>