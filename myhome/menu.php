<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<?php if($user['level']=='admin'): ?>
<li><a href="?pg=<?= enkripsi('siswa') ?>"><i class="material-icons-two-tone">school</i>Peserta Asessmen</a></li>
<li>
   <a href="#"><i class="material-icons-two-tone">person</i>Data Users<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('pengawas') ?>">Pengawas Asessmen</a></li>
    <li><a href="?pg=<?= enkripsi('guru') ?>">Guru Mapel / Kelas</a></li>
	
    </ul>
</li>	
<li>
<a href="#"><i class="material-icons-two-tone">wifi</i>Master Ujian<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
  <ul class="sub-menu">
  <?php if ($user['level']=='admin'): ?>
	<li><a href="?pg=<?= enkripsi('pengaturan') ?>">Pengaturan Ujian</a></li>
	<li><a href="?pg=<?= enkripsi('jenis') ?>">Jenis Ujian</a></li>
	<?php endif; ?>
    <li><a href="?pg=<?= enkripsi('jadwal') ?>">Jadwal Ujian</a></li>
    </ul>
  </li>	
  
<li>
  <a href="#"><i class="material-icons-two-tone">select_all</i>Bank Soal<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('banksoal') ?>">Bank Soal</a></li>
    <li><a href="?pg=<?= enkripsi('file') ?>">File Soal</a></li> 
	<li><a href="?pg=<?= enkripsi('bacsoal') ?>">Backup Soal</a></li>  	
     </ul>
    </li>	
  
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
   <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('karpes') ?>">Kartu Peserta</a></li>
    <li> <a href="?pg=<?= enkripsi('absen') ?>">Daftar Hadir</a></li>
    <li> <a href="?pg=<?= enkripsi('berita') ?>">Berita Acara</a></li> 						
    </ul>
  </li>

<li><a href="?pg=<?= enkripsi('status') ?>"><i class="material-icons-two-tone">sync</i>Status Peserta</a></li>
<li>
    <a href="#"><i class="material-icons-two-tone">mark_chat_read</i>Data Jawab & Nilai<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('nilai') ?>">Nilai Per Mapel</a></li> 
	<li><a href="?pg=<?= enkripsi('analisis') ?>">Analisis Butir Soal</a></li> 
    </ul>
  </li>
<li>
    <a href="#"><i class="material-icons-two-tone">restart_alt</i>Katrol Nilai<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('katrol') ?>">Katrol Nilai</a></li>
	<li><a href="?pg=<?= enkripsi('ckatrol') ?>">Cetak Nilai Katrol</a></li>									
	</ul>
  </li>

 <li class="sidebar-title">DATABASE</li>
<li>
	<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	 <li><a href="?pg=<?= enkripsi('optimal') ?>">Optimize Database</a></li>
    <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset Database</a></li>
    <li><a href="?pg=<?= enkripsi('backup') ?>">Backup Database</a></li>
	<li><a href="?pg=<?= enkripsi('restore') ?>">Restore Database</a></li>
	</ul>
   </li>
	<?php endif; ?>
<?php if ($user['level']=='guru'): ?>	
<li><a href="?pg=<?= enkripsi('siswa') ?>"><i class="material-icons-two-tone">school</i>Peserta Asesmen</a></li>
<li>
  <a href="#"><i class="material-icons-two-tone">select_all</i>Bank Soal<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('banksoal') ?>">Bank Soal</a></li>
    <li><a href="?pg=<?= enkripsi('file') ?>">File Soal</a></li>   
     </ul>
    </li>	
	
<li>
    <a href="#"><i class="material-icons-two-tone">mark_chat_read</i>Data Jawab & Nilai<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('nilai') ?>">Nilai Per Mapel</a></li> 
	<li><a href="?pg=<?= enkripsi('analisis') ?>">Analisis Butir Soal</a></li> 
    </ul>
  </li>
<li>
    <a href="#"><i class="material-icons-two-tone">restart_alt</i>Katrol Nilai<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('katrol') ?>">Katrol Nilai</a></li>
	<li><a href="?pg=<?= enkripsi('ckatrol') ?>">Cetak Nilai Katrol</a></li>									
	</ul>
   </li>  	 
	 <?php endif; ?>
<?php if ($user['level']=='awas'): ?>	
<li><a href="?pg=<?= enkripsi('siswa') ?>"><i class="material-icons-two-tone">school</i>Peserta Asesmen</a></li>
 <li><a href="?pg=<?= enkripsi('stawas') ?>"><i class="material-icons-two-tone">sync</i>Status Peserta</a></li>
 <?php endif; ?>
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
	
    </ul>
	
    </div>
      