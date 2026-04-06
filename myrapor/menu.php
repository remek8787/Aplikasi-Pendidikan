<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<?php if($user['level']=='admin'): ?>
<li>
<a href="#"><i class="material-icons-two-tone">webhook</i>Master Rapor<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('kelompok') ?>">Kelompok Mapel</a></li>
	<li><a href="?pg=<?= enkripsi('mapel') ?>">Mapel Rapor</a></li>
	
    </ul>
  </li>
 <?php endif; ?> 
<li><a href="?pg=<?= enkripsi('menu13') ?>"><i class="material-icons-two-tone">star</i>Rapor K-2013</a></li>
<li><a href="?pg=<?= enkripsi('menu23') ?>"><i class="material-icons-two-tone">file_copy</i>Rapor K-Merdeka</a></li>

 <li>
<a href="#"><i class="material-icons-two-tone">select_all</i>Ekstrakurikuler<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('peskul') ?>">Peserta Eskul</a></li>
	<li><a href="?pg=<?= enkripsi('nileskul') ?>">Nilai Eskul</a></li>									
		</ul>
   </li>
  <?php if($user['level']=='admin' OR $user['walas']<>''): ?> 
<li>
<a href="#"><i class="material-icons-two-tone">people</i>Wali Kelas<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('absensi') ?>">Input Absensi</a></li>
	
	<li><a href="?pg=<?= enkripsi('prestasi') ?>">Input Prestasi</a></li>  
	<li><a href="?pg=<?= enkripsi('catatan') ?>">Input Catatan</a></li> 				
      </ul>
      </li>
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Rapor<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('rappts') ?>">Rapor PTS</a></li>
	<?php if($setting['semester']==1): ?>
	<li><a href="?pg=<?= enkripsi('rapor') ?>">Rapor PAS</a></li>
	<?php else: ?>
	<li><a href="?pg=<?= enkripsi('rapor') ?>">Rapor PAT</a></li>	
	<?php endif; ?>	
<li><a href="?pg=<?= enkripsi('leger') ?>">Leger Nilai</a></li>	
	</ul>
 </li>
 
 
 <?php endif; ?> 
	
						 
<?php if ($user['level']=='admin'): ?>
 <li class="sidebar-title">DATABASE</li>
					 <li>
					 <a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
                        <ul class="sub-menu">
                          <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset E Rapor</a></li>
                        </ul>
                    </li>
					 <?php endif; ?>						 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      