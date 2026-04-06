<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<?php if($user['level']=='admin'): ?>

<li>
<a href="#"><i class="material-icons-two-tone">settings</i>Setting Surat<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('master') ?>">Master Surat</a></li>
	<li><a href="?pg=<?= enkripsi('setcetak') ?>">Setting Cetak</a></li>
	
    </ul>
  </li>
 <li>
<a href="#"><i class="material-icons-two-tone">menu</i>Master Surat<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('sk') ?>">SK GTT / GTY</a></li>
	<li><a href="?pg=<?= enkripsi('tugas') ?>">Pembagian Tugas</a></li>
	
    </ul>
  </li>
	<?php endif; ?>
<li>
<a href="#"><i class="material-icons-two-tone">person</i>Input Data Surat<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('guru') ?>">SK Pegawai</a></li>
	<li><a href="?pg=<?= enkripsi('bagi') ?>">SK Pembagian Tugas</a></li>
	<li><a href="?pg=<?= enkripsi('sppd') ?>">Surat Tugas / SPPD</a></li>
    </ul>
  </li>	


<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('cetak1') ?>">SK GTT / GTY</a></li>
	<li><a href="?pg=<?= enkripsi('cetak2') ?>">SK Pembagian Tugas</a></li>
	<li><a href="?pg=<?= enkripsi('cetak3') ?>">Ket Aktif Mengajar</a></li>
	<li><a href="?pg=<?= enkripsi('cetak4') ?>">Surat Tugas / SPPD</a></li>
</ul>
 </li>
 

		
						 
<?php if ($user['level']=='admin'): ?>
 <li class="sidebar-title">DATABASE</li>
		<li>
		<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
         <ul class="sub-menu">
       <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset Data</a></li>
        </ul>
      </li>
<?php endif; ?>						 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      