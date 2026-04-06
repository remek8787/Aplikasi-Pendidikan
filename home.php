           
			

			<div class='col-md-7'>		
			 <div class='box box-solid'>
				<div class='box-body'>
			  <div> 
			  <?php if($nilsis >= 1): ?>
		  <?php 
		  $renilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa' AND ujian_selesai<>'' AND browser='0' ORDER BY id_nilai DESC LIMIT 1"));
		  $rebank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$renilai[id_bank]'"));
         $remap = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE kode='$rebank[nama]'")); 
         $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE kelas='$siswa[kelas]'")); 		 
		  ?> 
		<form id="formreset">
		<input type="hidden" class="form-control" name="ids"  value="<?= $siswa['id_siswa'] ?>"  >
		<input type="hidden" class="form-control" name="idn"  value="<?= $renilai['id_nilai'] ?>"  >
		<input type="hidden" class="form-control" name="nama"  value="<?= $siswa['nama'] ?>"  >
		  <input type="hidden" class="form-control" name="mapel"  value="<?= $remap['nama_mapel'] ?>"  >
		  <input type="hidden" class="form-control" name="kode"  value="<?= $remap['kode'] ?>" required >
		    <input type="hidden" class="form-control" name="nowa"  value="<?= $peg['nowa'] ?>"  >
			<input type="hidden" class="form-control" name="kelas"  value="<?= $siswa['kelas'] ?>" >
			<?php if($setting['pelanggaran']<>0): ?>
			<div id='reset' ></div>
		   <?php endif; ?>
		</form>
		<script>
var autoRefresh = setInterval(
function() {
$('#reset').load('tombol.php');						
}, 2000
);
</script>
		<script>
    $('#formreset').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax(
    {
        method: "POST",
        url: '<?= $baseurl ?>/reset.php',
        enctype: 'multipart/form-data',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
		success: function(data){ 
        setTimeout(function()
            {
                window.location.reload();
            }, 2000);
		  
        }
    });
    return false;
});
</script>	
		 <?php endif; ?>
				 TOKEN </i>  <a href="#" class="btn btn-sm btn-default"><?= $token['token'] ?></a>
				
					</div>
				</div>
			</div>
			<div class='box box-solid'>
                <div class='box-header with-border'>
                     <h3 class='box-title'><i class="fas fa-bell"></i> Informasi</h3>
                         </div>
                 <div class='box-body'>
                    <div id='pengumuman'>
                      <?php $logC = 0;
                                        echo "<ul class='timeline'><br>";
                                        $logQ = mysqli_query($koneksi, "SELECT * FROM pesan_terkirim where ket='$siswa[kelas]' ORDER BY id DESC LIMIT 5");

                                        while ($log = mysqli_fetch_array($logQ)) {
                                            $logC++;
                                           
                                            if ($log['ket'] == 'siswa') {
                                                $bg = 'bg-green';
                                                $color = 'text-green';
                                            } else {
                                                $bg = 'bg-blue';
                                                $color = 'text-blue';
                                            }
                                            echo "
                                                        
                                                        
                                                        <!-- timeline time label -->
                                                        
                                                        <li><i class='fa fa-envelope $bg'></i>
                                                        <div class='timeline-item'>
                                                        <span class='time'> <i class='fa fa-calendar'></i> " . buat_tanggal('d-m-Y', $log['tanggal']) . " <i class='fa fa-clock-o'></i> " . buat_tanggal('H:i', $log['waktu']) . "</span>
                                                        <h3 class='timeline-header' style='background-color:#f9f0d5'><a href='#'>$log[sender]</a></h3>
                                                        <div class='timeline-body'>
                                                        " . ucfirst($log['isi']) . "	
                                                        </div>
                                                        
                                                        </div>
                                                        </li>
                                            
                                                        
                                                    ";
                                        }
                                        if ($logC == 0) {
                                            echo "<p class='text-center'>Tidak ada aktifitas.</p>";
                                        }
                                        echo "</ul>";?>
							 </div>
                         </div>
                        </div>
					</div>

	<div class="col-sm-5" >
	
	 <div class='box box-solid' >
       <div class='box-body' >
		<div class="edis">
		  <div style="font-size:20px"><i class="fas fa-graduation-cap"></i> Konfirmasi data Peserta</div>
		  <form id="konfir">
				<div class="form-group-sm">
					<label><b>Kode Peserta</b></label> 
					<input type="text" class="form-control"   value="<?= $siswa['nopes'] ?>" required="true" >
				</div>
				<div class="form-group-sm">
					<label><b>Nama Peserta</b></label> 
					<input type="text" class="form-control"  value="<?= $siswa['nama'] ?>" required="true" >
				</div>			
				<div class="form-group-sm">
					<label><b>Mata Ujian</b></label> 
					<input type="text" class="form-control" value="Literasi | Numerasi" required="true">
				</div>
				<div class="form-group-sm">
					<label><b>Token</b></label> 
					<input type="text" class="form-control" name="token"  value="<?= $token['token'] ?>" name="token" required="true">
				</div>
				<div class="form-group-sm">
					<label><b>Jenis Kelamin</b></label> 
					<select class="form-control" name="jenis_kelamin" required="true">
					        <option value=""></option>
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
				</div>
				
				<br>				
			  <button type="submit" class="btn btn-primary btn-round form-control mt-5"  name="btnsubmit">Submit</button>
			</form> 
			<br>
		</div>
    </div>
	 
  </div> 
</div>
 <script>
    $('#konfir').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'tkonfir.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){ 
           if (data == 'OK') {
			iziToast.info(
			{
			title: 'Sukses!',
			message: 'Data Terkonfirmasi',
			titleColor: '#FFFF00',
			messageColor: '#fff',
			backgroundColor: 'rgba(0, 0, 0, 0.5)',
			progressBarColor: '#FFFF00',
			position: 'topRight'	
			});			   
			setTimeout(function(){
			window.location.replace('?pg=jadwal');
			}, 2000);
			}else {
            setTimeout(function(){
            window.location.reload();
            }, 2000);	
           }		
         }		   
			});
			return false;
			});
		</script>