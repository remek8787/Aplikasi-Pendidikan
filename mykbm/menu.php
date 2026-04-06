<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<?php if($user['level']=='admin'): ?>
<li>
<a href="#"><i class="material-icons-two-tone">settings</i>Master KBM<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('notif') ?>">Notif Pengingat</a></li>
	<li><a href="?pg=<?= enkripsi('jjm') ?>">Setting JJM</a></li>
	<li><a href="?pg=<?= enkripsi('mjadwal') ?>">Jadwal Mengajar</a></li>
    </ul>
  </li>
	<?php endif; ?>
<li>
<a href="#"><i class="material-icons-two-tone">star</i>Administrasi Guru<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('cp') ?>">Input CP Fase</a></li>
	<li><a href="?pg=<?= enkripsi('cpel') ?>">Input CP Elemen</a></li>
	<li><a href="?pg=<?= enkripsi('intp') ?>">Input TP</a></li>
    <li><a href="?pg=<?= enkripsi('atp') ?>">Input ATP</a></li>
   <li><a href="?pg=<?= enkripsi('konten') ?>">Input Konten</a></li>	
</ul>
 </li>

<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Administrasi<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('cmodul1') ?>">Modul Ajar Project Based Learning</a></li>
	<li><a href="?pg=<?= enkripsi('cmodul2') ?>">Modul Ajar Discovery Learning</a></li>
	<li><a href="?pg=<?= enkripsi('cmodul3') ?>">Modul Ajar Diffrensiasi</a></li>
	 <li><a href="?pg=<?= enkripsi('crpp') ?>">Rencana Pelaksanaan Pembelajaran</a></li>	
    <li><a href="?pg=<?= enkripsi('cprota') ?>">Program Tahunan</a></li>
   <li><a href="?pg=<?= enkripsi('cpromes') ?>">Program Semester</a></li>	
</ul>
 </li>
 
 <li>
<a href="#"><i class="material-icons-two-tone">star</i>Administrasi K-13<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('kikd') ?>">Input RPP</a></li>
	
</ul>
 </li>

<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Administrasi K-13<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('crpp1') ?>">Cetak RPP Model 1</a></li>
	<li><a href="?pg=<?= enkripsi('crpp2') ?>">Cetak RPP Model 2</a></li>
	<li><a href="?pg=<?= enkripsi('crpp3') ?>">Cetak RPP Model 3</a></li>
	 <li><a href="?pg=<?= enkripsi('cprota13') ?>">Program Tahunan</a></li>
   <li><a href="?pg=<?= enkripsi('cpromes13') ?>">Program Semester</a></li>	
</ul>
 </li>
 
<li>
<a href="#"><i class="material-icons-two-tone">people</i>Agenda dan Jurnal<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('agenda') ?>">Agenda Guru</a></li>
	<li><a href="?pg=<?= enkripsi('ctkagenda') ?>">Cetak Agenda</a></li>				
      </ul>
      </li>
<li>
<a href="#"><i class="material-icons-two-tone">favorite</i>Refleksi<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">		
	<li><a href="?pg=<?= enkripsi('jadref') ?>">Jadwal Refleksi</a></li>
									
		</ul>
   </li>	  
	<li>
<a href="#"><i class="material-icons-two-tone">select_all</i>Penilaian Harian<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('nilai') ?>">Input PH</a></li>
	<li><a href="?pg=<?= enkripsi('cnil') ?>">Cetak PH</a></li>									
		</ul>
   </li>				

		
						 
<?php if ($user['level']=='admin'): ?>
 <li class="sidebar-title">DATABASE</li>
		<li>
		<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
         <ul class="sub-menu">
       <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset KBM</a></li>
        </ul>
      </li>
<?php endif; ?>						 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      