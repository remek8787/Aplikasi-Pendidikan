<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<?php if($user['level']=='admin'): ?>
<li>
<a href="#"><i class="material-icons-two-tone">select_all</i>Master Prakerin<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">	
	 <li><a href="?pg=<?= enkripsi('dudi') ?>" >Perusahaan</a></li>		
	<li><a href="?pg=<?= enkripsi('panitia') ?>" >Panitia Prakerin</a></li>	
	 <li><a href="?pg=<?= enkripsi('kompetensi') ?>" >Kompetensi Prakerin</a></li>
	  <li><a href="?pg=<?= enkripsi('sikap') ?>" >Master Penilaian</a></li>
		</ul>
   </li>
<li>
<a href="#"><i class="material-icons-two-tone">school</i>Data Prakerin<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">	
	 <li><a href="?pg=<?= enkripsi('siswa') ?>" >Input Peserta Prakerin</a></li>		
	<li><a href="?pg=<?= enkripsi('prakerin') ?>" >Data Peserta Prakerin</a></li>
   	
		</ul>
   </li>
   
  <li><a href="?pg=<?= enkripsi('guru') ?>"><i class="material-icons-two-tone">people</i>Pembimbing Prakerin</a></li>  
  
<?php endif; ?>

<li>
<a href="#"><i class="material-icons-two-tone">menu</i>Laporan Prakerin<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">	
	
	 <li><a href="?pg=<?= enkripsi('presensi') ?>" >Presensi Prakerin</a></li>
	<li><a href="?pg=<?= enkripsi('jurnal') ?>" >Jurnal Prakerin</a></li>
   
		</ul>
   </li>
   <li><a href="?pg=<?= enkripsi('monitor') ?>"><i class="material-icons-two-tone">computer</i>Monitoring Prakerin</a></li>  
  
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">	
	<li><a href="?pg=<?= enkripsi('jurnalharian') ?>" >Jurnal Harian</a></li>
	 <li><a href="?pg=<?= enkripsi('cetakpresensi') ?>" >Presensi Prakerin</a></li>
	<li><a href="?pg=<?= enkripsi('cetakjurnal') ?>" >Jurnal Prakerin</a></li>
	<li><a href="?pg=<?= enkripsi('cetakmonitor') ?>" >Evaluasi Prakerin</a></li>
    <li><a href="?pg=<?= enkripsi('sertifikat') ?>" >Sertifikat Prakerin</a></li>
		</ul>
   </li>   
<li>
<a href="#"><i class="material-icons-two-tone">edit</i>Penilaian Prakerin<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">	
	 <li><a href="?pg=<?= enkripsi('inputnilai') ?>" >Input Nilai Prakerin</a></li>		
	 <li><a href="?pg=<?= enkripsi('inputlaporan') ?>" >Input Nilai Laporan</a></li>
 <li><a href="?pg=<?= enkripsi('cetakhasil') ?>" >Cetak Nilai</a></li>	 
		</ul>
   </li>	   
 <?php if($user['level']=='admin'): ?>
	<li>
<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('resetpres') ?>">Reset Data Prakerin</a></li>
	</ul>
     </li>
<?php endif; ?>	 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      