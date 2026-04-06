<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>

 <li>
<a href="#"><i class="material-icons-two-tone">settings</i>Master Sapras<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('rumum') ?>">Ruang Pembelajaran</a></li>
	<li><a href="?pg=<?= enkripsi('rlab') ?>">Ruang Laboratorium</a></li>
	<li><a href="?pg=<?= enkripsi('rtunjang') ?>">Ruang Penunjang</a></li>
	<li><a href="?pg=<?= enkripsi('barang') ?>">Peralatan IT</a></li>	
     </ul>
  </li>
					

<li class="sidebar-title">ASET SEKOLAH</li>
<li>
<a href="#"><i class="material-icons-two-tone">shopping_cart</i> Aset Sekolah<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('aset') ?>">Input Data Aset</a></li>
	<li><a href="?pg=<?= enkripsi('kondisi') ?>">Input Kondisi Aset</a></li>
      </ul>
         </li>
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('csapras') ?>">Sapras</a></li>
    <li><a href="?pg=<?= enkripsi('caset') ?>">Aset</a></li>
					
    </ul>
    </li>
					
<li>
<?php if ($user['level']=='admin'): ?>
 <li class="sidebar-title">DATABASE</li>
					 <li>
					 <a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
                        <ul class="sub-menu">
                          <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset Database</a></li>
                        </ul>
                    </li>
					 <?php endif; ?>						 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>	
    </ul>
    </div>
      