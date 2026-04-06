<div class="row">                   
<div class="col-md-3"></div>
<div class="col-md-6">
 <div class='box box-solid' style="box-shadow: 0 1px 15px 5px rgba(0, 0, 0, 0.25);">
   <div class='box-header with-border' >
   </div>
      <center>
	 	<div id='progressbox'></div>
	  <p>
	
<h4 style="color:red">PERMINTAAN RESET</h4>
 </center>
 
	<div class="box-body">
	<?php 
	$renilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_nilai='$_GET[idn]'")); 
	$rebank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$renilai[id_bank]'"));
 $remap = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode='$rebank[nama]'")); 	
	?>
		  <form id="formreset">
                 <input type="hidden" class="form-control" name="idu"  value="<?= $renilai['id_ujian'] ?>" readonly>
				 <input type="hidden" class="form-control" name="idn"  value="<?= $_GET['idn'] ?>" readonly>
                      <div class="form-group-sm">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" name="nama"  value="<?= $siswa['nama'] ?>" required >
                        </div> 
						 <div class="form-group-sm">
                            <label>Mapel Ujian</label>
                            <input type="text" class="form-control" name="mapel"  value="<?= $remap['nama_mapel'] ?>" required >
                        </div> 
                      
					
					<br>
					
		        <button type="submit" class="btn btn-primary btn-round form-control" id="submit" style="border-radius:20px" >KIRIM PERMINTAAN</button>
					
		
		</form> 
    </div>
	</div>
  </div> 
</div>
<script>
    $('#formreset').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax(
    {
        method: "POST",
        url: 'reset.php',
        enctype: 'multipart/form-data',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
       beforeSend: function() {
                $('#progressbox').html('<div><label class="kedip" style="color:blue;margin-left:10px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="images/animasi1.gif" ></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 1000);
            },
			success: function(data){ 
            setTimeout(function()
            {
                window.location.replace('?pg=cekreset&idn=<?= $_GET[idn] ?>');
            }, 2000);
		  
        }
    });
    return false;
});
</script>	