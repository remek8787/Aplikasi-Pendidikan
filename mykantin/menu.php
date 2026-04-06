<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
 <li>
<a href="#"><i class="material-icons-two-tone">menu</i>Data Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
<li><a href="?pg=<?= enkripsi('toko') ?>">Data Kantin</a></li>						
<li><a href="?pg=<?= enkripsi('kategori') ?>">Kategori Produk</a></li>
<li><a href="?pg=<?= enkripsi('produk') ?>">Data Produk</a></li>  
  </ul>
    </li>


<li>
<a href="#"><i class="material-icons-two-tone">school</i>Data Konsumen<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('pelanggan') ?>">Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('pegawai') ?>">Pegawai</a></li>
   </ul>
</li>
<li>
<a href="#"><i class="material-icons-two-tone">workspaces</i>Registrasi Kartu<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('register') ?>">Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('regpegawai') ?>">Pegawai</a></li>
   </ul>
</li>

<li>
<a href="#"><i class="material-icons-two-tone">computer</i>Top Up Manual<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('topup') ?>">Siswa</a></li>
	<li><a href="?pg=<?= enkripsi('toppegawai') ?>">Pegawai</a></li>
   </ul>
</li>                     
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('trxtoko') ?>">Transaksi</a></li>
   </ul>
</li>
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
      