<script type="text/javascript" src="<?= $baseurl ?>/assets/js/signature.js"></script>
	 <link href="<?= $baseurl ?>/assets/libs/css/bootstrap.v3.3.6.css" rel="stylesheet">
<?php
defined('APK') or exit('No Access');
$jjurnal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_jurnal where idsiswa ='$id_siswa' and tanggal='$tanggal'"));
$pkl = fetch($koneksi,'pkl_siswa',['idsiswa'=>$id_siswa]);
$gp = fetch($koneksi,'pkl_pembimbing',['kelas'=>$siswa['kelas'],'dudi'=>$pkl['dudi']]);
$guru = $gp['instruktur'];
$kegiatan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$id_siswa' and tanggal='$tanggal'"));
?>      
  
	
	
	<?php if ($ac == '') : ?>
		<div class="row">
		 <div class="col-xl-4">
        <div class="card">
		<div class="card-body">
			<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/jurnal.png" class="responsive" alt="thumb" />
                    </div>
					<div class="h5" style="color:blue;">JURNAL PRAKERIN HARI INI</div>
                <div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                     <div class="h5 mb-0">Tanda Tangan Instruktur</div>
					 <div class="h5 mb-0"> ( <?= strtoupper($guru); ?> )</div>
                    </div>
                  </div>
				  
                 <form id="formguru" class="row g-1" >	
                  <input type="hidden" name="id" value="<?= $kegiatan['id'] ?>" >
				  <input type="hidden" name="guru" value="<?= $guru; ?>" >
				<div id="signature-pad">
					<div style="border:solid 1px teal; width:auto;height:110px;padding:3px;position:relative;">
						<div id="note" onmouseover="my_function();">The signature should be inside box</div>
						<canvas id="the_canvas" width="auto" height="100px"></canvas>
					</div>
					<div style="margin:10px;">
						<input type="hidden" id="signature" name="signature">
						<button type="button" id="clear_btn" class="btn btn-danger" data-action="clear"><span class="glyphicon glyphicon-remove"></span> Hapus</button>
						<button type="submit" id="save_btn" class="btn btn-primary" data-action="save-png"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
					</div>
				</div>
			<form>
			
                </div>
              </div>             
            </div>
               <div class="col-xl-8">
               <div class="card edis2">
                 <div class="card-body">
					<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
				 <?php if($siswa['foto']==''): ?>
                    <img src="<?= $baseurl ?>/images/siswa.png" class="responsive" alt="thumb" />
					<?php else: ?>
					 <img src="<?= $baseurl ?>/images/fotosiswa/<?= $siswa['foto'] ?>" class="responsive" alt="thumb" />
					 <?php endif; ?>
                    </div>
					<div class="h5" style="color:blue;">JURNAL PRAKERIN</div>
                <div class="h5 mb-0"><?= $siswa['nama'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
			        <table  class="table table-bordered table-hover" style="width:100%;font-size:12px">
                        <thead>
                        <tr style="vertical-align:middle">
                       <th width="18%">TANGGAL</th>
                       <th>ASPEK KOMPETENSI</th>
                      <th>PROSES</th>
					 
                          </tr>
                         </thead>
                        <tbody>
                          <?php
							$no=0;
							$query = mysqli_query($koneksi, "SELECT * FROM pkl_jurnal where idsiswa='$id_siswa'"); 
							while ($data = mysqli_fetch_assoc($query)) :
							$des = fetch($koneksi,'pkl_kompetensi',['id'=>$data['idkompetensi']]);
							$no++;
							?>
                            <tr style="vertical-align:middle">
                             <td><?= $data['tanggal'] ?></td>
                            <td><?= $des['deskrip'] ?></td>
                              <td><?= $data['proses'] ?></td> 
                             		  
                              </tr>
							<?php endwhile; ?>
							</tbody>
                          </table>
			        </div>
				</div>
			</div>
	    </div>
               			
 </div>				
	<script>
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/buatttd.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			
			}, 500);
			},			
			success: function(data){  			
			setTimeout(function()
				{
				window.location.replace("?pg=pkl");
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
             

        <?php endif; ?>		 
			
<script>
var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var canvas = wrapper.querySelector("canvas");
var el_note = document.getElementById("note");
var signaturePad;
signaturePad = new SignaturePad(canvas);

clearButton.addEventListener("click", function (event) {
	document.getElementById("note").innerHTML="The signature should be inside box";
	signaturePad.clear();
});
savePNGButton.addEventListener("click", function (event){
	if (signaturePad.isEmpty()){
		alert("Please provide signature first.");
		event.preventDefault();
	}else{
		var canvas  = document.getElementById("the_canvas");
		var dataUrl = canvas.toDataURL();
		document.getElementById("signature").value = dataUrl;
	}
});
function my_function(){
	document.getElementById("note").innerHTML="";
}
</script>