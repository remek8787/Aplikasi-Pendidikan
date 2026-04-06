<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
 <?php if($setting['mesin']<>'4'): ?>
<li><a href="<?= $baseurl ?>/live" target="_blank"><i class="material-icons-two-tone">wifi</i>Live Presensi</a></li>
<?php else: ?>
<li><a href="<?= $baseurl ?>/lives" target="_blank"><i class="material-icons-two-tone">wifi</i>Live Presensi</a></li>
<?php endif; ?>

<?php if($user['level']=='admin'): ?>
<li>
<a href="#"><i class="material-icons-two-tone">settings</i>Pengaturan<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('mesin') ?>">Mesin Presensi</a></li>
	<li><a href="?pg=<?= enkripsi('waktu') ?>">Setting Waktu</a></li>
    <li><a href="?pg=<?= enkripsi('psis') ?>">Pesan Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('ppeg') ?>">Pesan Pegawai</a></li>
	<li><a href="?pg=<?= enkripsi('esis') ?>">Pesan Eskul Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('epeg') ?>">Pesan Eskul Pembina</a></li>
	
    </ul>
    </li>
	
<li>
<a href="#"><i class="material-icons-two-tone">workspaces</i>Registrasi<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<?php if($setting['mesin']=='1'): ?>
	<li><a href="?pg=<?= enkripsi('rfid') ?>">Registrasi RFID</a></li>
	<?php endif; ?>
    <?php if($setting['mesin']=='2'): ?>
	<li><a href="?pg=<?= enkripsi('barkode') ?>">Registrasi Barcode</a></li>
	<?php endif; ?>	
	<?php if($setting['mesin']=='3'): ?>
	<li><a href="?pg=<?= enkripsi('finger') ?>">Registrasi Finger Print</a></li>
	<?php endif; ?>	
    <?php if($setting['mesin']=='4'): ?>
	<li><a href="?pg=<?= enkripsi('face') ?>">Registrasi Face Pegawai</a></li>
	<li><a href="?pg=<?= enkripsi('faces') ?>">Registrasi Face Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset Registrasi Face</a></li>
	<?php endif; ?>								
    </ul>
	</li> 
	<?php endif; ?>

<li><a href="?pg=<?= enkripsi('luar') ?>"><i class="material-icons-two-tone">wifi</i>Presensi Luar</a></li>	
<li>
<a href="#"><i class="material-icons-two-tone">sync</i>Data Presensi<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('presis') ?>">Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('prespeg') ?>">Pegawai</a></li>	
    </ul>
 </li>
<li>
<a href="#"><i class="material-icons-two-tone">edit</i>Input Tidak Hadir<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('insis') ?>">Siswa</a></li>
	
	<li><a href="?pg=<?= enkripsi('inpeg') ?>">Pegawai</a></li>	
	
    </ul>
    </li>
<?php if($user['level']=='admin'): ?>


<li>
<a href="#"><i class="material-icons-two-tone">select_all</i>Cetak Kartu<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('cetak') ?>">Kartu Siswa</a></li>
    </ul>
      </li>

<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('abpeg') ?>">Rekapitulasi Pegawai</a></li>
    <li><a href="?pg=<?= enkripsi('absis') ?>">Rekapitulasi Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('abpeg2') ?>">Rekap Pembina Eskul</a></li>
    <li><a href="?pg=<?= enkripsi('absis2') ?>">Rekap Eskul Siswa</a></li> 						
    </ul>
    </li>

<li>
 <a href="#"><i class="material-icons-two-tone">delete</i>Hapus Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
  <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('hapres') ?>">Hapus Presensi</a></li>
	<li><a href="?pg=<?= enkripsi('haples') ?>">Hapus Presensi Eskul</a></li>
     </ul>
       </li>
<li class="sidebar-title">DATABASE</li>

<li>
<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('resetpres') ?>">Reset Data Presensi</a></li>
</ul>
 </li>
	 
<?php endif; ?>				 
					 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>	
   
   </ul>
    </div>
      