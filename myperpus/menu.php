<div class="app-menu">
<ul class="accordion-menu">

<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>
<li>
<a href="#"><i class="material-icons-two-tone">menu</i>Data Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('kategori') ?>">Kategori</a></li>
    <li><a href="?pg=<?= enkripsi('buku') ?>">Data Buku</a> </li>
		</ul>
           </li>
<li><a href="?pg=<?= enkripsi('pinjam') ?>"><i class="material-icons-two-tone">shopping_cart</i>Peminjaman Buku</a></li>
<li><a href="?pg=<?= enkripsi('kembali') ?>"><i class="material-icons-two-tone">sync</i>Pengembalian Buku</a></li>
					
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Laporan Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">                      
	<li><a href="?pg=<?= enkripsi('cbuku') ?>">Data Buku</a></li>
	<li><a href="?pg=<?= enkripsi('cpinjam') ?>">Peminjam Buku</a></li>
       </ul>
          </li>
		  
<li>
<a href="#"><i class="material-icons-two-tone">book</i>Buku Digital<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">                      
	<li><a href="?pg=<?= enkripsi('inbuku') ?>">Input Buku</a></li>
	<li><a href="?pg=<?= enkripsi('baca') ?>">Pembaca Buku</a></li>
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
      