<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>

<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>

<li>					
<a href="#"><i class="material-icons-two-tone">menu</i>Data Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
<ul class="sub-menu">
<li><a href="?pg=<?= enkripsi('jenis') ?>">Jenis Pembayaran</a></li>

   </ul>
     </li>

	<li>					
<a href="#"><i class="material-icons-two-tone">shopping_cart</i>Transaksi<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('transaksi') ?>">Input Pembayaran</a></li>
   </ul>
 </li>	 
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('trx') ?>">Transaksi Pembayaran</a></li>
       </ul>
      </li>
	<hr>
 <label style="width:70px;display: inline-block;"></label>PAYMENT PEGAWAI
<hr>	
<li>					
<a href="#"><i class="material-icons-two-tone">menu</i>Data Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
<ul class="sub-menu">
<li><a href="?pg=<?= enkripsi('gaji') ?>">Gaji Pegawai</a></li>
<li><a href="?pg=<?= enkripsi('jadwaltu') ?>">Jadwal TU</a></li>

   </ul>
     </li> 
<li>
<a href="#"><i class="material-icons-two-tone">print</i>Cetak Data<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
    <ul class="sub-menu">
	<li><a href="?pg=<?= enkripsi('trxpeg') ?>">Pembayaran Pegawai</a></li>
	
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
      