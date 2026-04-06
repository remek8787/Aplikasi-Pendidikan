<?php
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));
?>
<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<?php if($user['level']=='admin'): ?>
<li>
   <a href="#"><i class="material-icons-two-tone">menu</i>Data Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('mapel') ?>">Impor Mapel</a></li>
    <li><a href="?pg=<?= enkripsi('imporsis') ?>">Impor Siswa</a></li>
	<?php if($setting['jenjang']=='SMK'): ?>
	 <li><a href="?pg=<?= enkripsi('pk') ?>">Program Keahlian</a></li>
	<?php endif; ?>
	 <li><a href="?pg=<?= enkripsi('kuri') ?>">Kurikulum</a></li>
	 <li><a href="?pg=<?= enkripsi('walas') ?>">Wali Kelas</a></li>
	 <li><a href="?pg=<?= enkripsi('eskul') ?>">Ekstrakurikuler</a></li>
    </ul>
</li>
<li>
   <a href="#"><i class="material-icons-two-tone">person</i>Data Users<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('admin') ?>">Admin Sekolah</a></li>
    <li><a href="?pg=<?= enkripsi('guru') ?>">Guru Mapel / Kelas</a></li>
	<li><a href="?pg=<?= enkripsi('staff') ?>">Staff / Tu</a></li>
    </ul>
	</li>	
<li><a href="?pg=<?= enkripsi('siswa') ?>"><i class="material-icons-two-tone">school</i>Data Siswa</a></li>	
<li>
   <a href="#"><i class="material-icons-two-tone">restart_alt</i>Mutasi Siswa<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('tamat') ?>">Keluar / Tamat</a></li>
    <li><a href="?pg=<?= enkripsi('naik') ?>">Naik Kelas</a></li>
	<li><a href="?pg=<?= enkripsi('pdb') ?>">Siswa Baru</a></li>
    </ul>
	</li>	

 <li><a href="?pg=<?= enkripsi('sekolah') ?>"><i class="material-icons-two-tone">settings</i>Pengaturan Sekolah</a></li>	
 <li><a href="?pg=<?= enkripsi('lampu') ?>"><i class="material-icons-two-tone">light</i>Internet Of Think</a></li>	
 
 <li class="sidebar-title">DATABASE</li>
<li>
	<a href="#"><i class="material-icons-two-tone">storage</i>Database<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('resetdata') ?>">Reset Database</a></li>
    <li><a href="?pg=<?= enkripsi('backup') ?>">Backup Database</a></li>
	<li><a href="?pg=<?= enkripsi('restore') ?>">Restore Database</a></li>
	</ul>
   </li>
	<?php endif; ?>
<?php if($user['level']=='guru'): ?>
<li>			
<a href="#"><i class="material-icons-two-tone">shopping_cart</i>E Kantin <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('kantin') ?>">Shopping</a></li>
	 <li><a href="?pg=<?= enkripsi('history') ?>">History Transaksi</a></li>
	  <li><a href="?pg=<?= enkripsi('saldoku') ?>">History Payment</a></li>
	</ul>
</li>	
<li><a href="../mykbm/"><i class="material-icons-two-tone">dataset</i>E - K B M</a></li>
<li><a href="../myhome/"><i class="material-icons-two-tone">open_with</i>E - Asesmen</a></li>
<li><a href="../mylearn/"><i class="material-icons-two-tone">menu</i>E - Learning</a></li>
<li><a href="../myrapor/"><i class="material-icons-two-tone">select_all</i>E - Rapor</a></li>
<li><a href="../mykonsel/"><i class="material-icons-two-tone">people</i>E - Konseling</a></li>
<?php if($setting['jenjang']=='SMK'): ?>
<?php $pmb = fetch($koneksi,'pkl_pembimbing',['idpeg'=>$user['id_user']]); ?>
<?php if($pmb['idpeg']==$user['id_user']): ?>
<li><a href="../mypkl/"><i class="material-icons-two-tone">star</i>E - Prakerin</a></li>
<?php endif; ?>
<?php endif; ?>
<li><a href="../buku/guru.php"><i class="material-icons-two-tone">book</i>Buku Digital</a></li>	
<?php
	$queryx = mysqli_query($koneksi, "SELECT * FROM kelas WHERE level='$skl[tingkat]' and kelas='$user[walas]'");
	while ($datax = mysqli_fetch_assoc($queryx)){
	?>
<li><a href="../myskl/"><i class="material-icons-two-tone">email</i>E - Kelulusan</a></li>
 <?php } ?> 

<?php endif; ?>
<?php if($user['level']=='staff'): ?>
<li>			
<a href="#"><i class="material-icons-two-tone">shopping_cart</i>E Kantin <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('kantin') ?>">Shopping</a></li>
	 <li><a href="?pg=<?= enkripsi('history') ?>">History Transaksi</a></li>
	  <li><a href="?pg=<?= enkripsi('saldoku') ?>">History Payment</a></li>
	</ul>
</li>	
<li>
   <a href="#"><i class="material-icons-two-tone">menu</i>Data Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('mapel') ?>">Impor Mapel</a></li>
    <li><a href="?pg=<?= enkripsi('imporsis') ?>">Impor Siswa</a></li>
	<?php if($setting['jenjang']=='SMK'): ?>
	 <li><a href="?pg=<?= enkripsi('pk') ?>">Program Keahlian</a></li>
	<?php endif; ?>
	 <li><a href="?pg=<?= enkripsi('kuri') ?>">Kurikulum</a></li>
	 <li><a href="?pg=<?= enkripsi('walas') ?>">Wali Kelas</a></li>
	 <li><a href="?pg=<?= enkripsi('eskul') ?>">Ekstrakurikuler</a></li>
    </ul>
</li>
<li><a href="?pg=<?= enkripsi('siswa') ?>"><i class="material-icons-two-tone">school</i>Data Siswa</a></li>	
<li>
   <a href="#"><i class="material-icons-two-tone">restart_alt</i>Mutasi Siswa<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('tamat') ?>">Keluar / Tamat</a></li>
    <li><a href="?pg=<?= enkripsi('naik') ?>">Naik Kelas</a></li>
	<li><a href="?pg=<?= enkripsi('pdb') ?>">Siswa Baru</a></li>
    </ul>
</li>	
<li><a href="../mypres/"><i class="material-icons-two-tone">person</i>E - Presensi</a></li>
<li><a href="../myadm/"><i class="material-icons-two-tone">select_all</i>E - Administrasi</a></li>
<li><a href="../myperpus/"><i class="material-icons-two-tone">open_with</i>E - Pustaka</a></li>
<li><a href="../mybayar/"><i class="material-icons-two-tone">menu</i>E - Payment</a></li>
<?php endif; ?>
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>	
 	
    </ul>
    </div>
      