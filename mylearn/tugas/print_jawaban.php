<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$id_tugas = $_GET['id'];

$tugas = fetch($koneksi, 'tugas', array('id_tugas' => $id_tugas));
$guru = fetch($koneksi, 'users', array('id_user' => $tugas['id_guru']));

$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
?>
		<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Nilai_Tugas</title>
<link rel='stylesheet' href='../../vendor/css/bootstrap.min.css' />

</head>

			<body style="font-size: 12px;">
		<center><h3><?= strtoupper($setting['header']) ?><br>	
		 <?= strtoupper($setting['sekolah']) ?></h3></center>
	   <center style="margin-top:-10px"> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	 <img src="../../images/<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-90px ;width: 70px;">
	 <hr style="margin:0px">
     	
				
				<div align='center' style="margin-top:5px">
					<h6>LAPORAN TUGAS TERSTRUKTUR<br/>
					MATA PELAJARAN <?=  strtoupper($tugas['mapel']) ?><br/>
					SEMESTER <?= $setting['semester'] ?>  TAHUN AJARAN  <?= $setting['tp'] ?></h6>
				</div>
				
			  <table style="font-size: 12px" class="table table-bordered table-sm">
					<thead>
						<tr>
							<th width='5px'>No</th>
							<th style="text-align:center">NIS</th>
							<th>Nama</th>
							<th width="5%">Kelas</th>
							<th width="10%">Nilai</th>
							
						</tr>
					</thead>
					<tbody>
<?php 
$tugasQ = select($koneksi, 'jawaban_tugas', array('id_tugas' => $id_tugas));
foreach ($tugasQ as $jtugas) {
	$no++;
	$siswa = fetch($koneksi, 'siswa', ['id_siswa' => $jtugas['id_siswa']]);
	?>
							<tr>
								<td align='center'><?= $no ?></td>
								<td align='center' width='100px'><?= $siswa[nis]  ?></td>
								<td><?= $siswa['nama']  ?></td>
								<td><?= $siswa['kelas']  ?></td>
								<td width='130px'><?= $jtugas['nilai']  ?></td>
								
							</tr>
<?php } ?>
					</tbody>
				</table>
				<br/>
				<table border='0' style="margin-left: 50px;margin-right:5px">>
					<tr>
					
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='300px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Guru Pengampu<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $guru['nama'] ?></u><br/>
							NIP. <?= $guru['nip'] ?>
						</td>
					</tr>
				</table>
		</body>
</html>
