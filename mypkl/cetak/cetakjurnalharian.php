<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$ids = $_GET['ids'];
	$bl= $_GET['b'];
	$d = $_GET['d'];
	$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);

	$kelas = fetch($koneksi,'kelas',['kelas'=>$siswa['kelas']]);
	$pkl = fetch($koneksi,'pkl_siswa',['idsiswa'=>$ids]);
	$dudi = fetch($koneksi,'pkl_dudi',['id'=>$pkl['dudi']]);
	$walas = fetch($koneksi, 'pkl_pembimbing',['kelas'=>$siswa['kelas'],'dudi'=>$pkl['dudi']]);
	$peg = fetch($koneksi, 'users',['id_user'=>$walas['idpeg']]);
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>KEGIATAN HARIAN</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px; 
margin-right: 80px; 
margin-top: 80px;
margin-bottom: 20px;  
}
.tengah{
	text-align:center;
}
}
.bold{
	font-weight:bold;
}
</style>
<body>	



		<center><h4 style="font-size:16px;font-weight:bold">LAPORAN KEGIATAN HARIAN PESERTA DIDIK PADA PELAKSANAAN PKL</h4></center>
		<br>
 
    <table width="100%">
	
            <tr>
			<td width='250px'>Nama Siswa</td>
                <td width='10px'>:</td>
                <td><?= $siswa['nama'] ?></td>
            </tr>
			 <tr>
			<td width='250px'>Program Study/Keahlian</td>
                <td width='10px'>:</td>
                <td><?= $kelas['pk'] ?></td>
            </tr>
               <tr>
			<td width='250px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $setting['tp'] ?></td>
            </tr>
			 <tr>
			<td width='250px'>Tempat Prakerin</td>
                <td width='10px'>:</td>
                <td><?= $dudi['nama_dudi'] ?></td>
            </tr>
			 <tr>
			<td width='250px'>Nama Instruktur(pembimbing PKL) </td>
                <td width='10px'>:</td>
                <td><?= $walas['instruktur'] ?></td>
            </tr>
			 <tr>
			<td width='250px'>Jabatan </td>
                <td width='10px'>:</td>
                <td>Karyawan </td>
            </tr>
    </table>

     <br>
	 
		 <table  width='100%' border="1">       
              <tr>
                <th width="5%" height="40px">No</th>
                <th>Aktivitas PKL</th>
				 <th width="12%">Hari/Tgl<br>pelaksanaan</th>
                <th>Divisi/Dept</th>
				<th width="5%">Mulai<br>Pukul</th>
				<th width="5%">Selesai<br>Pukul</th>
				<th>Catatan Pembimbing</th>
				<th width="5%">Paraf<br>instruktur</th>
            </tr>
			<?php
			$no=0;
			$query = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$ids' and bulan='$bl' and dudi='$d'");
			while ($data = mysqli_fetch_array($query)) :
			$jurnal = fetch($koneksi,'pkl_jurnal',['idsiswa'=>$ids,'tanggal'=>$data['tanggal']]);		
			$harix = date('D',strtotime($data['tanggal']));
			$tanggalmu = date('d-m-Y',strtotime($data['tanggal']));
				$hari = fetch($koneksi,'m_hari',['inggris'=>$harix]);	
			$no++;
			 ?>
             <tr>
            <td><?= $no; ?></td>
			<td><?= $data['kegiatan'] ?></td>
			<td class="tengah"><?= $hari['hari'] ?><br><?= $tanggalmu ?></td>
			<td><?= $dudi['nama_dudi'] ?></td>
			<td><?= $data['jam'] ?></td>
			<td><?= $jurnal['pulang'] ?></td>
			<td><?= $data['catatan'] ?></td>
			<td class="tengah"><img src="../../images/ttd/<?= $data['ttd'] ?>" width="100px"></td>
			</tr>
			<?php endwhile; ?>
            </table>
			<br>
			
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
							<?= ucwords(strtolower($setting['kecamatan'])); ?>, <?php echo date("t",time()); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Pembimbimg Prakerin<br> Kelas <?= $siswa['kelas'] ?><br/>
							
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
$dompdf->stream("Jurnal Harian ".$siswa['nama']." Bulan ". $bl . ".pdf", array("Attachment" => false));
exit(0);
?>