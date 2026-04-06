<div class="app-menu">
<ul class="accordion-menu">

<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>

<li><a href="?pg=<?= enkripsi('proyek') ?>"><i class="material-icons-two-tone">settings</i>Master Proyek</a></li>
<li><a href="?pg=<?= enkripsi('inputproyek') ?>"><i class="material-icons-two-tone">attach_email</i>Dimensi Proyek</a></li>
<li><a href="?pg=<?= enkripsi('catatanproses') ?>"><i class="material-icons-two-tone">draw</i>Catatan Proses</a></li>
<li><a href="?pg=<?= enkripsi('raporproyek') ?>"><i class="material-icons-two-tone">print</i>Cetak Rapor</a></li>


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
      