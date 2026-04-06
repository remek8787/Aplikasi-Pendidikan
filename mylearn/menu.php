<div class="app-menu">
<ul class="accordion-menu">

<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<li>
   <a href="#"><i class="material-icons-two-tone">menu</i>Data Materi<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('materi') ?>">Materi Belajar</a></li>
    </ul>
	</li>
	
<li>
  <a href="#"><i class="material-icons-two-tone">select_all</i>Data Tugas<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('tugas') ?>">Tugas Belajar</a></li>
     </ul>
    </li>	
  
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
   <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('absensi') ?>">Absen Daring</a></li>			
    </ul>
  </li>

<?php if($user['level']=='admin'): ?>
 <li class="sidebar-title">DATABASE</li>
<li>
	<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset E Learn</a></li>
	</ul>
   </li>
	<?php endif; ?>

<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      