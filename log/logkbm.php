<?php 
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$tanggal = date('Y-m-d');
$jluar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_jjm WHERE tanggal='$tanggal'"));
 
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absen_jjm WHERE tanggal='$tanggal'  ORDER BY id DESC LIMIT 1")); 
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[idpeg]'"));
$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$data[mapel]'"));

?>
<style>
.responsives {
  width: 100px;
  height: 120px;
}
#imgs {
  border: 2px solid #fff;
 border-radius: 3px;
}
</style>
                         <?php if($jluar==0): ?>
						<div class="widget-payment-request-container">
                           <center>
										  <img src="images/animasi.gif" alt="" >
												</center>
												</div>
												<div class="widget-payment-request-author">
												<center><b style="color:red">TIDAK ADA AKTIVITAS</b></center>
											</div>					
                                      <?php else: ?>	
										<table id="datata" class="table table-bordered" style="width:100%;font-size:10px;">
											 <tr>
                                                  <td style="text-align:center; vertical-align:middle;">
													<?php if($peg['foto'] ==''): ?>
														<img src="images/user.png" id="imgs" class="responsives">											
													<?php else: ?>
												    <img src="images/fotoguru/<?= $peg['foto'] ?>" id="imgs" class="responsives">
													<?php endif; ?>
												  <br><?= $peg['nama'] ?> 
												
						                           </td>
							                    <td style="background-color:black;vertical-align:middle">
												<span style="font-size:12px">PRESENSI KBM</span><br><br>
												<span style="font-size:12px">Masuk : <?= $data['masuk'] ?></span><br>
												<span style="font-size:12px">Kelas : <?= $data['kelas'] ?></span><br>
												<span style="font-size:12px">Mapel : <?= $mapel['kode'] ?></span>
                                                 </td>
												 </tr>
												 </table>
												  <?php endif; ?>