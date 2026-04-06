<?php 
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
require("../../konek/dis.php");

echo "<style> .str{ mso-number-format:\@; } </style>";

$idb = $_GET['idb'];
$sesi = $_GET['sesi'];
$kelas = $_GET['kls'];
$bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$idb'"));
           
$max = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(max_skor) as max,id_bank FROM soal WHERE id_bank='$idb'"));
$file = "JAWABAN MAPEL ".$bank['nama']." - " . $bank['level']." Sesi ".$sesi;
header("Content-type: application/octet-stream");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Disposition: attachment; filename=" . $file . ".xls");
?>
JAWABAN MAPEL <?= $bank['nama'] ?> | <?= $bank['level'] ?> 

<table border='1'>
	<thead>
		<tr>
		<th style="vertical-align:middle; width:5%" rowspan="4">#</th>
			<th style='text-align:center;vertical-align:middle' rowspan="4">NIS</th>
			<th style='text-align:center;vertical-align:middle' rowspan="4">Nama Peserta</th>
			<th style='text-align:center;vertical-align:middle' rowspan="4">Agama</th>
			<?php
		   
			$jum1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='1'"));
				echo "<th style='text-align:center' colspan='$jum1'>PG</th>";		
			?>
			<?php
			$jum3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='3'"));
			if($jum3<>0){
				echo "<th style='text-align:center' colspan='$jum3'>MULTI</th>";
			}
			?>
			<?php
			$jum4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='4'"));
			if($jum4<>0){
				echo "<th style='text-align:center' colspan='$jum4'>BS</th>";
			}
			?>
			<?php
			$jum5 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='5'"));
			if($jum5<>0){
				echo "<th style='text-align:center' colspan='$jum5'>JODOH</th>";
			}
			?>
			<?php
			$jum5 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='2'"));
			if($jum5<>0){
				echo "<th style='text-align:center' colspan='$jum5'>ESAI</th>";
			}
			?>
			<th style='text-align:center;vertical-align:middle' rowspan="4">Nilai</th>
			</tr>
			<tr>
			<tr>
			<?php
		    $no=0;
			$mapelQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='1'");
			while ($mapel = mysqli_fetch_array($mapelQ)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel[nomor]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelM = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='3'");
			while ($mapel3 = mysqli_fetch_array($mapelM)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel3[nomor]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelB = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='4'");
			while ($mapel4 = mysqli_fetch_array($mapelB)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel4[nomor]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelJ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='5'");
			while ($mapel5 = mysqli_fetch_array($mapelJ)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel5[nomor]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelJ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='2'");
			while ($mapel5 = mysqli_fetch_array($mapelJ)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel5[nomor]</th>";
			endwhile;
			?>
			</tr>
			
			
			
			
			<tr>
			<?php
		    $no=0;
			$mapelQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='1'");
			while ($mapel = mysqli_fetch_array($mapelQ)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel[jawaban]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelM = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='3'");
			while ($mapel3 = mysqli_fetch_array($mapelM)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel3[jawaban]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelB = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='4'");
			while ($mapel4 = mysqli_fetch_array($mapelB)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel4[jawaban]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelJ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='5'");
			while ($mapel5 = mysqli_fetch_array($mapelJ)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel5[jawaban]</th>";
			endwhile;
			?>
			<?php
		    $no=0;
			$mapelJ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb' and jenis='2'");
			while ($mapel5 = mysqli_fetch_array($mapelJ)) :
			$no++;
				echo "<th style='text-align:center;background-color:yellow'>$mapel5[jawaban]</th>";
			endwhile;
			?>
			
			</tr>
			</thead>
	       <tbody>
		   <?php 
		   $no=0;
		   if($bank['soal_agama']==''):
			$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE level='$bank[level]' and sesi='$sesi' and kelas='$kelas' ORDER BY id_siswa ASC"); 
			else:
			$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE level='$bank[level]' and sesi='$sesi'  and agama='$bank[soal_agama]' and kelas='$kelas' ORDER BY id_siswa ASC"); 
			endif;
		   ?>
		<?php while ($siswa = mysqli_fetch_array($query)) : ?>
			<?php
			$no++;
			 $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$siswa[id_siswa]' and id_bank='$idb'"));
                  
			?>
			<tr>
				<td><?= $no ?></td>
				<td style="text-align:center"><?= $siswa['nis'] ?></td>
				<td><?= $siswa['nama'] ?></td>
				<td><?= $siswa['agama'] ?></td>
				 <?php $jawaban = unserialize($nilai['jawaban_pg']); ?>
              <?php foreach ($jawaban as $key => $value) : ?>
			  <?php $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'")); ?>
			<?php if ($value == $soal['jawaban'] AND $soal['jenis']=='1') : ?>
			 <td style="background-color:green"><?= $value ?></td>
			 <?php else : ?>
			  <td><?= $value ?></td>
			 <?php endif; ?>
			    <?php endforeach; ?>
				
				<?php $jawaban = unserialize($nilai['jawaban_multi']); ?>
              <?php foreach ($jawaban as $key => $valuem) : ?>
			  <?php $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'")); ?>
			<?php if ($valuem == $soal['jawaban'] AND $soal['jenis']=='3') : ?>
			 <td style="background-color:green"><?= $valuem ?></td>
			 <?php else : ?>
			  <td><?= $valuem ?></td>
			 <?php endif; ?>
			    <?php endforeach; ?>
				
				<?php $jawaban = unserialize($nilai['jawaban_bs']); ?>
              <?php foreach ($jawaban as $key => $valueb) : ?>
			  <?php $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'")); ?>
			<?php if ($valueb == $soal['jawaban'] AND $soal['jenis']=='4') : ?>
			 <td style="background-color:green"><?= $valueb ?></td>
			 <?php else : ?>
			  <td><?= $valueb ?></td>
			 <?php endif; ?>
			    <?php endforeach; ?>
				
				<?php $jawaban = unserialize($nilai['jawaban_urut']); ?>
              <?php foreach ($jawaban as $key => $valuej) : ?>
			  <?php $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'")); ?>
			<?php if ($valuej == $soal['jawaban'] AND $soal['jenis']=='5') : ?>
			 <td style="background-color:green"><?= $valuej ?></td>
			 <?php else : ?>
			  <td><?= $valuej ?></td>
			 <?php endif; ?>
			    <?php endforeach; ?>
				
				<?php $jawaban = unserialize($nilai['jawaban_esai']); ?>
              <?php foreach ($jawaban as $key => $valuess) : ?>
			  <?php $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'")); ?>
			<?php if ($valuess == $soal['jawaban'] AND $soal['jenis']=='2') : ?>
			 <td style="background-color:green"><?= $valuess ?></td>
			 <?php else : ?>
			  <td><?= $valuess ?></td>
			 <?php endif; ?>
			    <?php endforeach; ?>
			  <td><?= $nilai['nilai'] ?></td>
				</tr>
		<?php endwhile; ?>
	</tbody>
</table>