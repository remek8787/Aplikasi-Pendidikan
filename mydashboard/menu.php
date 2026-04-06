
<div class="app-menu">
<ul class="accordion-menu">
<li class="sidebar-title">DAHSBOARD UTAMA SISWA</li>

<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../"><i class="material-icons-two-tone">apps</i>E Asessmen</a></li>
<li><a href="?pg=profile"><i class="material-icons-two-tone">person</i>My Profile</a></li>

<?php if($setting['jenjang']=='SMK'): ?>
<li><a href="?pg=pkl"><i class="material-icons-two-tone">move_up</i>E Prakerin</a></li>
<?php endif; ?>
<li>			
<a href="#"><i class="material-icons-two-tone">menu</i>K B M <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=nilai">Nilai Harian</a></li>
	<li><a href="?pg=absensi">Absensi</a></li>
	</ul>
</li>
<li><a href="?pg=refleksi"><i class="material-icons-two-tone">favorite</i>Refleksi</a></li>

<li>			
<a href="#"><i class="material-icons-two-tone">edit</i>Nilai Asesmen<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=nilaiujian">Nilai Asesmen</a></li>
	</ul>
</li>	
<li>			
<a href="#"><i class="material-icons-two-tone">star</i>E Konseling <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=konsel">My Konseling</a></li>
	
	</ul>
</li>	
<?php  $skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));
if($siswa['level']==$skl['tingkat']): 
?>
	<li><a href='?pg=skl'><i class="material-icons" style="vertical-align:middle;">mail</i><span> Kelulusan</span></a></li>
<?php endif; ?>



<li>			
<a href="#"><i class="material-icons-two-tone">select_all</i>E Learning <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=materi">Materi Belajar</a></li>
	<li><a href="?pg=tugas">Tugas Belajar</a></li>
	</ul>
</li>
<li><a href="../buku/"><i class="material-icons-two-tone">book</i>Buku Digital</a></li>	
<li>			
<a href="#"><i class="material-icons-two-tone">shopping_cart</i>E Kantin <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=kantin">Shopping</a></li>
	 <li><a href="?pg=history">History</a></li>
	 <li><a href="?pg=saldo">My Saldo</a></li>
	</ul>
</li>	

<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>	
    </ul>
    </div>
      