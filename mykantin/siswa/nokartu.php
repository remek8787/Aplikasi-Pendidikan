<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$sql = mysqli_query($koneksi, "select * from tmpreg");
	$data = mysqli_fetch_array($sql);
	$nokartu = $data['nokartu'];
?>
	 <div class="col-md-12 mb-1">
	  <label>RFID Card</label>
	<input type="text" name="nokartu" id="nokartu" placeholder="Tempelkan Kartu RFID Anda" class="form-control"  value="<?= $nokartu; ?>" required="true">
      </div>
	 <div class="col-md-12 mb-1">
		<label>Nama Lengkap</label>
         <input type='text' name='nama' class='form-control' value="<?= $siswa['nama'] ?>" readonly />
          </div>										
	<div class="col-md-12 mb-1">
	   <label>Rombel</label>
           <input type='text' name='kelas' class='form-control' value="<?= $siswa['kelas'] ?>" readonly />
        </div>