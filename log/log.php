<?php 
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$hari = date('D');
$jam = date('H:i');
$jjadwal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar WHERE hari='$hari' and dari < '$jam' and  sampai > '$jam'"));

?>
<style>
.responsives {
  width: 70px;
  height: 80px;
}
#imgs {
  border: 2px solid #fff;
 border-radius: 3px;
}
</style>
<?php if($jjadwal==0): ?>
<div class="widget-payment-request-container">
       
			<center>
			  <img src="images/animasi.gif" alt="" >
					</center>
                    </div>
					<div class="widget-payment-request-author">
					<center><b style="color:gold">MENUNGGU JADWAL</b></center>
				</div>	
<?php else: ?>
<table id="datata" class="table table-bordered" style="width:100%;font-size:10px;">
                                                             
 <?php    
$queryx = mysqli_query($koneksi,"SELECT * FROM jadwal_mengajar WHERE hari='$hari' and dari < '$jam' and  sampai > '$jam'");
while ($datax = mysqli_fetch_array($queryx)) :
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$datax[guru]'"));
$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id='$datax[mapel]'")); 
?> 
<tr>  
<td style="text-align:center">
 <?php if($peg['foto'] ==''): ?>
<img src="images/user.png" id="imgs" class="responsives">												
<?php else: ?>
<img src="images/fotoguru/<?= $peg['foto'] ?>" id="imgs" class="responsives">
<?php endif; ?>
 <br><?= $peg['nama'] ?>
 </td>
<td style="background-color:black;vertical-align:middle">
<span style="font-size:12px">JADWAL MENGAJAR</span><br><br>
KELAS : <?= $datax['kelas'] ?><br>
MAPEL : <?= $mapel['kode'] ?><br>
WAKTU : <?= $datax['dari'] ?> s/d <?= $datax['sampai'] ?>
 </td>
</tr>

<?php endwhile; ?> 

</table>      
<?php endif; ?>