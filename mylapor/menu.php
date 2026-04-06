<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>

<li><a href="?pg=<?= enkripsi('pegawai') ?>"><i class="material-icons-two-tone">people</i>Data Pegawai</a></li>
<?php if($setting['jenjang']=='SMK'): ?>
<li><a href="?pg=<?= enkripsi('produksi') ?>"><i class="material-icons-two-tone">shopping_cart</i>Unit Produksi</a></li>
<li><a href="?pg=<?= enkripsi('bursa') ?>"><i class="material-icons-two-tone">menu</i>Bursa Kerja Khusus</a></li>
<li><a href="?pg=<?= enkripsi('ujikom') ?>"><i class="material-icons-two-tone">star</i>Uji Kompetensi</a></li>
<?php endif; ?>
	  
<li>
<a href="#"><i class="material-icons-two-tone">select_all</i>Cetak Laporan<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">					
	<li><a href="cetak/cetak1.php" target="_blank">Cetak Cover</a></li>
	<li><a href="cetak/cetak2.php" target="_blank">Cetak Pengantar</a></li>
    <li><a href="cetak/cetak3.php" target="_blank">Cetak Profil</a></li>
    <li><a href="cetak/cetak4.php" target="_blank">Cetak Lampiran I</a></li>
    <li><a href="cetak/cetak5.php" target="_blank">Cetak Lampiran II</a></li>
    <li><a href="cetak/cetakpeg.php" target="_blank">Cetak Lampiran III</a></li>		
		</ul>
   </li>				

				 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      