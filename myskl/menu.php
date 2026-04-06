<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<?php if($user['level']=='admin'): ?>
<li>
<a href="#"><i class="material-icons-two-tone">webhook</i>Master SKL<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('skl') ?>">Setting SKL</a></li>
	<li><a href="?pg=<?= enkripsi('skb') ?>">Setting SKKB</a></li>
    </ul>
  </li>
 <?php endif; ?> 

 <li>
<a href="#"><i class="material-icons-two-tone">select_all</i>Nilai<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('nilai') ?>">Nilai Semester</a></li>
	<li><a href="?pg=<?= enkripsi('ujian') ?>">Nilai Ujian</a></li>									
	</ul>
   </li>
  <?php if($user['level']=='admin' OR $user['walas']<>''): ?> 

<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="?pg=<?= enkripsi('cskl') ?>">S K L</a></li>	
	<li><a href="?pg=<?= enkripsi('cskb') ?>">S K K B</a></li>	
	<li><a href="?pg=<?= enkripsi('ctrp') ?>">Transkip</a></li>	
	
	</ul>
 </li>
 
 
 <?php endif; ?> 
	
						 
<?php if ($user['level']=='admin'): ?>
 <li class="sidebar-title">DATABASE</li>
					 <li>
					 <a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
                        <ul class="sub-menu">
                          <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset E Kelulusan</a></li>
                        </ul>
                    </li>
					 <?php endif; ?>						 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>	
	
    </ul>
    </div>
      