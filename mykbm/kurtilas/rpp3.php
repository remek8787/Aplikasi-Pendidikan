<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
    $id= $_GET['id'];
	$kelas= $_GET['kelas'];
	$dt = fetch ($koneksi, 'rpp', ['id' =>$id]);	
	$map = fetch ($koneksi, 'mapel', ['id' =>$dt['mapel']]);
	$usr = fetch ($koneksi, 'users', ['id_user' =>$dt['guru']]);
	
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>RPP-3</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px;
 margin-right: 50px;
 margin-top: 40px;
 margin-bottom: 40px;
}
.bold{font-weight : bold;}
</style>
<body style="font-size: 14px;">	


<div style='background:#fff;'>
            <table width='100%'>
                <tr>
                    <td width='60px'><img src='../../images/<?= $setting['logo'] ?>' width='60px'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                          <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?></strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
        <br>
		<center><h3>RENCANA PELAKSANAAN PEMBELAJARAN (RPP)</h3></center>
		<br>
 
    <table width="100%">
	
            <tr>
			 <td width='2%'></td>
			<td width="30%">Nama Sekolah</td>
            <td width='5px'>:</td>
            <td><?= $setting['sekolah'] ?></td>
            </tr>
			
			<tr>
			 <td></td>
			<td>Mata Pelajaran</td>
            <td width='5px'>:</td>
            <td><?= $map['nama_mapel'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Kelas / Semester</td>
            <td width='5px'>:</td>
            <td><?= $kelas ?> / <?= $dt['smt'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Materi Pokok</td>
            <td width='5px'>:</td>
            <td><?= $dt['materi'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Tahun Pelajaran</td>
            <td width='5px'>:</td>
            <td><?= $setting['tp'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Alokasi Waktu</td>
            <td width='5px'>:</td>
            <td><?= $dt['alokasi'] ?> JP @<?= $setting['jjm'] ?> Menit</td>
            </tr>
			
			<tr style="vertical-align:top">
            <td></td>
			<td>Kompetensi Dasar</td>
            <td width='5px'>:</td>
            <td>3.<?= $dt['kd'] ?> <?= $dt['des3'] ?><br>
			    4.<?= $dt['kd'] ?> <?= $dt['des4'] ?></td>
            </tr>
			
			
    </table>
	<br><br>
 <b>1. TUJUAN PEMBELAJARAN</b>
    <table width="100%">
	<tr>
    <td width='2%'></td>
	<td>Setelah melakukan kegiatan diskusi dan menggali informasi, peserta didik dapat memahami konsep, menganalisis dan menyelesaikan masalah kontekstual yang berkaitan
	<i><?= $dt['sisipan'] ?></i>  dengan cermat, memiliki karakter (religiositas, integritas, nasionalisme, gotong royong dan kemandirian), dan memiliki kemampuan literasi (baca tulis, numerasi, sains, digital, financial, budaya dan kewargaan) untuk membiasakan siswa dalam berfikir kritis, kreativitas, komunikasi dan kolaborasi
	</td>										
	</tr>
    </table>
   <br>   
 <b>2. MEDIA/ALAT, BAHAN DAN SUMBER BELAJAR</b>
	 <table width="100%">
	<tr>
    <td width='2%'></td>
	<td width='1%'>1.</td>	
	<td width='15%'>Media</td>
	<td>: Worksheet atau lembar kerja (peserta didik), Lembar penilaian</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%'>2.</td>	
	<td width='10%'>Alat/Bahan</td>
	<td>: Spidol, papan tulis, Laptop dan Infocus</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%'>3.</td>	
	<td width='10%'>Sumber Belajar</td>
	<td>: Buku Panduan Guru, buku siswa kelas <?= $kelas?> / <?= $dt['smt'] ?></td>	
	</tr>
    </table>
   <br>   

<br>   
 <b>3. KEGIATAN PEMBELAJARAN</b>											
	 <table width="100%">
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold">a.</td>
	<td class="bold">Kegiatan Pendahuluan</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'>*</td>
	<td>Sebelumnya siswa diarahkan literasi sebelum pembelajaran. Untuk menguatkan karakter, guru mengucapkan salam dan membiasakan siswa untuk berdoa, cek kebersihan kelas, menanamkan cinta tanah air dan kejujuran dilanjutkan apersepsi tentang <i><?= $dt['sisipan'] ?></i>
	dalam menyelesaikan masalah dengan memberikan stimulus melalui media pembelajaran (PPT) menyampaikan tujuan pembelajaran
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold">b.</td>
	<td class="bold">Kegiatan Inti</td>	
	</tr>
    </table>
	<table width="90%" style="margin-left:20px">
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'>1.</td>
	<td>Guru menyampaikan masalah yang akan dipecahkan secara kelompok dan tiap kelompok mengamati dan memahami masalah yang disampaikan guru atau yang diperoleh dari bahan bacaan yang disarankan. (orientasi peserta didik pada masalah)i</td>
	</tr>
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'>2</td>
	<td>Peserta berdiskusi dan membagi tugas untuk mencari data/bahan/alat yang diperlukan untuk menyelesaikan masalah dan guru memastikan setiap anggota memahami tugas masing – masing. (mengorganisasikan peserta didik untuk belajar)</td>
	</tr>
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'>3</td>
    <td>Peserta melakukan penyelidikan untuk bahan diskusi kelompok dan guru memantau keterlibatan peserta didik selama proses penyelidikan. (membimbing penyelidikan individu maupun kelompok)</td>	
	</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'>4</td>
    <td>Kelompok melakukan diskusi untuk menghasilkan solusi pemecahan masalah dan hasilnya dipresentasikan, sedangkan guru memantau diskusi dan membimbing pembuatan laporan sehingga tiap kelompok siap untuk dipresentasikan. (mengembangkan dan menyajikan hasil karya)</td>	
	</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'>5</td>
    <td>Setiap kelompok melakukan presentasi, guru membimbing presentasi dan mendorong kelompok lain memberikan apresiasi serta masukan pada kelompok lain. (menganalisis dan mengevaluasi proses pemecahan masalah)</td>	
	</td>	
	</tr>
	</table>
	<p style="page-break-before: always;"></p>
	 <table width="100%">
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold">c.</td>
	<td class="bold">Kegiatan Penutup</td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='2%'></td>
	<td width='1%'></td>
    <td>Membuat simpulan, refleksi, umpan balik, penugasan, pesan – pesan moral, dan menyampaikan informasi kegiatan pembelajaran yang akan datang dan berdoa.</td>	
	</td>	
	</tr>
	
	</table>
 <br>
<b>4. PENILAIAN (ASSESMENT)</b>											
	 <table width="100%">
	<tr style="vertical-align:top">
	 <td width='2%'></td>
	<td colspan="2" width="1%">1.</td>
	<td>Penilaian Pengetahuan : berupa tes tertulis pilihan ganda & tertulis uraian, tes lisan / observasi terhadap diskusi tanya jawab dan percakapan serta penugasan									
	</td>	
	</tr>
	<tr style="vertical-align:top">
	 <td width='2%'></td>
	<td colspan="2" width="1%">2.</td>
	<td>Penilaian Keterampilan : berupa penilaian unjuk kerja, penilaian proyek, penilaian produk dan penilaian portofolio									
	</td>	
	</tr>
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
							<?= ucwords(strtolower($setting['kabupaten'])); ?>, <?= date('d'); ?> <?= bulan_indo($tanggal); ?> <?= date('Y') ?><br/>
							Guru Mapel<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $usr['nama'] ?></u><br/>
							NIP. <?= $usr['nip'] ?>
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
$dompdf->stream("RPP MODEL 3 SMT-".$dt['smt']." ". $kelas ." - ".$map['kode'].".pdf", array("Attachment" => false));
exit(0);
?>