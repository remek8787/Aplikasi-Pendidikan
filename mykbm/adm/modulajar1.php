<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
    $smt= $_GET['smt'];
	$idel= $_GET['elemen'];
	$mapel= $_GET['mapel'];
	$kelas= $_GET['kelas'];
	$guru= $_GET['guru'];
	$level = fetch ($koneksi, 'kelas', ['kelas' =>$kelas]);
	$tingkat = $level['level'];
	$map = fetch ($koneksi, 'mapel', ['id' =>$mapel]);
	$usr = fetch ($koneksi, 'users', ['id_user' =>$guru]);
	$cp = fetch ($koneksi, 'cp', ['mapel' =>$mapel,'guru'=>$guru,'tingkat'=>$tingkat,'smt'=>$smt]);
	$el = fetch ($koneksi, 'cp_elemen', ['idcp' =>$cp['id'],'id_elemen'=>$idel]);
	$tp = fetch ($koneksi, 'tp', ['idcp' =>$cp['id'],'idelemen'=>$idel]);
	$atp = fetch ($koneksi, 'atp', ['idcp' =>$cp['id'],'idel'=>$idel]);
	$konten = fetch ($koneksi, 'konten', ['idcp' =>$cp['id'],'idel'=>$idel,'idtp'=>$tp['id_tp']]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>MODUL-1</title>
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
  
		<center><h3>MODUL AJAR<br><?= strtoupper($setting['sekolah']) ?></h3></center>
		<br>
 <b>A. INFORMASI UMUM</b>
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
            <td><?= $kelas ?> / <?= $cp['smt'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Materi Pokok</td>
            <td width='5px'>:</td>
            <td><?= $tp['lingkup'] ?></td>
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
            <td><?= $atp['waktu'] ?> JP X <?= $setting['jjm'] ?> Menit</td>
            </tr>
			
			<tr>
            <td></td>
			<td>Pertemuan Ke</td>
            <td width='5px'>:</td>
            <td><?= $atp['ke'] ?></td>
            </tr>
			
			<tr style="vertical-align:top">
            <td></td>
			<td>Capaian Pembelajaran Fase</td>
            <td width='5px'>:</td>
            <td><?= $cp['capaian'] ?></td>
            </tr>
			
			<tr style="vertical-align:top">
            <td></td>
			<td>Capaian Pembelajaran Elemen</td>
            <td width='5px'>:</td>
            <td><?= $el['capaian'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Tujuan Pembelajaran</td>
            <td width='5px'>:</td>
            <td><?= $tp['tujuan'] ?></td>
            </tr>
    </table>
	<br>
 <b>B. MODEL PEMBELAJARAN</b>
    <table width="100%">
	<tr>
    <td width='2%'></td>
	<td>Project Based Learning (PjBL)</td>										
	</tr>
    </table>
   <br>   
 <b>C. SARANA DAN PRASARANA (MEDIA DAN SUMBER BELAJAR)</b>
	 <table width="100%">
	<tr>
    <td width='2%'></td>
	<td width='1%'>1.</td>	
	<td width='15%'>Media</td>
	<td>: <?= $konten['media'] ?></td>	
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
	<td>: Buku Panduan Guru, buku siswa, <?= $konten['sumber'] ?></td>	
	</tr>
    </table>
   <br>   
 <b>D. PROFIL PELAJAR PANCASILA</b>											
	 <table width="100%">
	<tr>
    <td width='2%'></td>
	<td><?= $atp['p5'] ?></td>	
	</tr>
 </table>
<br>   
 <b>E. KEGIATAN PEMBELAJARAN</b>											
	 <table width="100%">
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold">a.</td>
	<td class="bold">Kegiatan Pendahuluan</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%'></td>
	<td>* Guru dan peserta didik menyampaikan salam dan berdoa.<br>
	* Guru melakukan presensi kehadiran peserta didik. Guru mempersiapkan pembelajaran peserta didik.<br>									
	* Guru membuat kesepakatan Kelas.<br>
	* Apersepsi:<br>
    * Guru memberikan pertanyaan pemantik seputar tentang :<br>
	&nbsp;&nbsp;&nbsp;  <?= $tp['lingkup'] ?><br>
   * Guru menginformasikan tujuan pembelajaran mengenai :<br>	
	&nbsp;&nbsp;&nbsp;  <?= $tp['tujuan'] ?><br>
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold">b.</td>
	<td class="bold">Kegiatan Inti</td>	
	</tr>	
	<tr>
    <td width='2%'></td>
	<td width='1%'></td>
	<td>* Guru membagi siswa dalam 3 kelompok berdasarkan profil belajar siswa dengan gaya belajar kelompok visual, &nbsp;&nbsp;&nbsp;auditori dan kinestetik. (Diferensiasi Proses)<br>
	* Masing-masing kelompok mengerjakan LKPD dengan aktivitas yang berbeda.									
	</td>	
	</tr>
	<tr>
	<td colspan="2"></td>
	<td  class="bold">Sintak Project Based Learning (PjBL)</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold"></td>
	<td><b>1. Pertanyaan Mendasar</b><br>Guru menyampaikan topik dan mengajukan pertanyaan mendasar bagaimana memecahkan masalah terkait :<br>
	<?= $konten['sub'] ?><br>
	Peserta didik mendengarkan dengan seksama penyampaikan topik dan berupaya menjawab pertanyaan guru. (Communication, Critical Thinking, Creativity)<br>
    <b>(Diferensiasi Konten)</b>										
	</td>	
	</tr>
	
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold"></td>
	<td><b>2. Mendesain Perencanaan Produk</b><br>Guru memastikan setiap peserta didik dalam kelompok, memilih dan mengetahui prosedur pembuatan proyek/produk yang akan dibuat. Peserta didik berdiskusi menyusun rencana pembuatan proyek pemecahan masalah meliputi pembagian tugas, persiapan alat, bahan, media, dan sumber yang dibutuhkan. (Collaboration, Communication, Critical Thinking)										
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold"></td>
	<td><b>3. Menyusun Jadwal Pembuatan</b><br>Guru dan peserta didik membuat kesepakatan tentang jadwal pembuatan proyek (tahapan-tahapan dan pengumpulan). Peserta didik menyusun jadwal penyelesaian proyek dengan memperhatikan batas waktu yang telah ditentukan bersama. (Communication, Collaboration, Creativity)									
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold"></td>
	<td><b>4. Memonitor Keaktifan dan Perkembangan Proyek</b><br>Guru memantau keaktifan peserta didik selama melaksanakan proyek, memantau realisasi perkembangan dan membimbing jika mengalami kesulitan. Peserta didik melakukan pembuatan proyek sesuai jadwal, mencatat setiap tahapan, mendiskusikan masalah yang muncul selama penyelesaian proyek dengan guru. (Creativity, Collaboration, Communication, Critical Thinking). (Diferensiasi Produk)								
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold"></td>
	<td><b>5. Menguji Hasil</b><br>Guru berdiskusi tentang prototipe proyek, memantau keterlibatan peserta didik, dan mengukur ketercapaian standar. Peserta didik membahas kelayakan proyek yang telah dibuat dan membuat laporan produk/ karya untuk dipaparkan kepada orang lain. (Collaboration, Communication, Creativity, Critical Thinking)							
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold"></td>
	<td><b>6. Evaluasi Pengalaman Belajar</b><br>Guru membimbing proses pemaparan proyek, menanggapi hasil, selanjutnya guru dan peserta didik merefleksi/kesimpulan. Peserta didik/kelompok memaparkan laporan, sedangkan yang lain memberikan tanggapan, dan bersama guru menyimpulkan hasil proyek. 							
	</td>	
	</tr>
	<tr>
    <td width='2%'></td>
	<td width='1%' class="bold">c.</td>
	<td class="bold">Kegiatan Penutup</td>	
	</tr>	
	<tr>
    <td width='2%'></td>
	<td width='1%'></td>
	<td>* Guru memfasilitasi peserta didik menemukan simpulan pembelajaran. Guru memberikan kesempatan ke peserta didik untuk mengajukan pendapat atau pertanyaan<br>
	* Peserta didik melakukan refleksi pembelajaran berkaitan dengan sikap, pengetahuan, dan keterampilan.<br>									
	* Kemudian menyampaikan rencana pembelajaran pada pertemuan berikutnya.<br>
	* Berdoa/salam penutup<br>
	</td>	
	</tr>
 </table>
 <br>
<b>F. PENILAIAN (ASSESMENT)</b>											
	 <table width="100%">
	<tr>
	<td colspan="2" width="1%"></td>
	<td>1. Penilaian Pengetahuan : berupa Tes Tulis dan penugasan<br>
	2. Penilaian Keterampilan : berupa penilaian proyek, penilaian produk, penilaian unjuk kerja											
	</td>	
	</tr>
 </table>
  <br>
<b>G. REMIDIAL</b>											
	 <table width="100%">
	<tr>
	<td></td>
	<td>Siswa menambah pemahamannya tentang: <?= $konten['sub'] ?>											
	</td>	
	</tr>
 </table>
 <br>
 <b>H. PENGAYAAN</b>											
	 <table width="100%">
	<tr>
	<td></td>
	<td>Bagi peserta didik yang sudah mampu menguasai materi keseluruhan akan diberi penugasan baru: <?= $tp['lingkup'] ?>											
	</td>	
	</tr>
 </table>
  <br>
 <b>I. RINGKASAN MATERI</b>											
	 <table width="100%">
	<tr>
	<td width="2%"></td>
	<td><?= $konten['ringkasan'] ?></td>	
	</tr>
 </table>
 <br>
 <b>J. SUMBER</b>											
	 <table width="100%">
	<tr>
	<td width="2%"></td>
	<td><?= $konten['sumber'] ?></td>	
	</tr>
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
$dompdf->stream("MODUL PBL ".$smt." ". $kelas ." - ".$map['kode'].".pdf", array("Attachment" => false));
exit(0);
?>