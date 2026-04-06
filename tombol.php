 <?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
require("konek/apk.php");
$id_siswa = $_SESSION['id_siswa'];
$nilsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa' AND browser='0'"));
 $renilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa' AND ujian_selesai<>'' AND browser='0' ORDER BY id_nilai DESC LIMIT 1"));

?>
 <?php if($renilai['hapus']==0 AND $nilsis==1): ?>
		  <button type="submit" id="reset" class="btn btn-danger btn-round btn-sm pull-right">Minta Reset</button>
<?php elseif($renilai['hapus']==1 AND $nilsis==1): ?>
		   <span  class="btn btn-success btn-round btn-sm pull-right"  >Di Proses</span>

<?php endif; ?>