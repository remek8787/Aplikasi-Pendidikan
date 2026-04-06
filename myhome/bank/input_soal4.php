<?php
if (!isset($_GET['id']) && !isset($_GET['no']) && !isset($_GET['jenis'])) :
	die("Anda tidak dizinkan mengakses langsung script ini!");
endif;
$nomor = $_GET['no'];
$jenis = $_GET['jenis'];
$id_bank = $_GET['id'];
$nom = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(nomor) AS nomer FROM soal WHERE id_bank='$id_bank'"));
if($nom['nomer']==''){
$nomor = 1;
}else{
$nomor =$nom['nomer'] + 1;
}
$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$id_bank'"));
$idmap=$mapel['kode'];
$jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank' AND  nomor='$nomor' AND jenis='$jenis'"));
$soalQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank' AND  nomor='$nomor' AND jenis='$jenis'");
$soal = mysqli_fetch_array($soalQ);
?>
<?php include"bank/radio.php"; ?>
<style>
  .form-container {
      display: none; /* All forms hidden by default */
    }
.kanane{
    float: right;
    display: block;
	margin-top:0px;
	
	  }
</style> 
 <div class="row"> 
	<form id='formsoal' action='' method='post' enctype='multipart/form-data'>
		<div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class='btn-group' style='margin-top:-5px'>
						<label class='btn btn-sm btn-outline-primary'>Mapel </label>
						<label class='btn btn-sm btn-outline-primary'><?= $mapel['nama'] ?> </label>
						<label class='btn btn-sm btn-outline-danger'>No Soal :<b class="sandik"> <?= $nomor ?></b></label>					
				</div>			
                <button type='submit' name='simpansoal' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-outline-primary kanan'> Simpan</button>
				<a href='?pg=<?= enkripsi('banksoal') ?>&ac=lihat&id=<?= $id_bank ?>' class='btn btn-sm btn-outline-danger kanan'> Kembali</a>
				</div>
			</div>
		</div>
								
 
					<input type='hidden' name='mapel' id="idbank" value='<?= $id_bank ?>'>
					<input type='hidden' name='jenis' value='<?= $jenis ?>'>
					<input type='hidden' name='nomor' id="nomor" value='<?= $nomor ?>'>
					
	<div class='row'>
		<div class="col-md-12">
		    <div class="card">
				<div class="card-header">
				<h5 class="card-title">SOAL MENJODOHKAN</h5>
				<div class="pull-right">
				 <div class="row mb-1">
					<label  class="col-md-5 col-form-label bold">Skor Jawaban Benar</label>
						<div class="col-md-4">
							<input type='number' name='skor' value="1" class='form-control' required="true" />
						</div>
					</div>
                </div>
			</div>
            <div class="card-body">
				<div class='form-group'>
					<textarea id='editor2' name='isi_soal' class='editor1'  style='width:100%;' required><?= $soal['soal'] ?></textarea>
				</div>		
			<div class="row">
				<div class='col-md-6'>						
					<div class='form-group'>
						<label>Gambar / Audio</label>
							<input type='file' class='form-control' name='file' type='file'>
						</div>
				</div>
				<div class='col-md-6'>
					<div class='form-group'>
						<label>Gambar / Audio</label>
							<input type='file' class='form-control' name='file1' type='file'>
						</div>
					</div>
				</div>						
			</div>	
		</div>	
	</div>
</div>	
			
			<div class='row'>
				<div class="col-md-6">
					<div class="card">
						 <div class="card-header" id="row1-5-1">
						 <div class='form-group mb-2'   onClick="pilih1('5','1','#00BCD4','1')">PERNYATAAN 1
						<label class="checkbox kanane"><input type="radio" name="rp1" id="P51" value="#00BCD4" onclick="PR51()" required="true">
						<span class="check"></span> 1</label>
							</div>
						  </div>
                   <div class="card-body">				   
					<div class='form-group mb-2'>
						<textarea name='perA' rows="5" class='editor1 pilihan form-control'></textarea>                                   
					</div>
					<div class='form-group mb-3 kanan'>
						<button id="A" type="button" class="btn btn-sm btn-icon btn-success"><i class="material-icons">add</i></button>										
						<button type="button" onClick="haper()" class="btn btn-sm btn-icon btn-danger" ><i class="material-icons">delete</i> Reset</button>							
					</div>
				</div>
			</div>
		</div>
                <div class="col-md-6">
					<div class="card">
						<div class="card-header" id="row2-5-1">
						  <div class='form-group mb-1' onCLick="pilih2('5','1',2,'1','18','2')">
				   <label  class="checkbox"> <input type="radio" name="rj1" value="A" id="J51" onclick="JW51()"> 
						<span class="check"></span> A</label> 
						<label class="pull-right">JAWABAN</label>
						</div>
						  </div>
                   <div class="card-body"> 
					
						<div class='form-group mb-1'>
							<textarea name='pilA' class='editor1 pilihan form-control'></textarea>
						</div>
						<div class='form-group mb-1'>
							<label>Gambar / Audio Pil A</label>
							<input type='file' name='fileA' class='form-control' />
						</div>                           
					</div>
				</div>						
			</div>	
		</div>
		
			
		<div class="form-container" id="formB">				
			<div class='row'>
				<div class="col-md-6">
					<div class="card">
						 <div class="card-header" id="row1-5-2">
						 <div class='form-group mb-2'   onClick="pilih1('5','2','#F44336','2')">PERNYATAAN 2
						<label class="checkbox kanane"><input type="radio" name="rp2" value="#F44336" id="P52"  onclick="PR52()">
						<span class="check"></span> 2</label>
							</div>
						  </div>
                   <div class="card-body">				   
					<div class='form-group mb-2'>
						<textarea name='perB'  class='editor1 pilihan form-control'></textarea>                                   
					</div>
					<div class='form-group mb-4 kanan'>
						<button id="B" type="button" class="btn btn-sm btn-icon btn-success"><i class="material-icons">add</i></button>										
						<button id="Btutup" type="button" class="btn btn-sm btn-icon btn-dark" ><i class="material-icons">close</i> </button>							
					</div>
				</div>
			</div>
		</div>
                <div class="col-md-6">
					<div class="card">
						<div class="card-header" id="row2-5-2">
						  <div class='form-group mb-0' onCLick="pilih2('5','2',2,'2','18','2')">
				   <label  class="checkbox"> <input type="radio" name="rj2" value="B" id="J52" onclick="JW52()"> 
						<span class="check"></span> B</label> 
						<label class="pull-right">JAWABAN</label>
						</div>
						  </div>
                   <div class="card-body"> 
					
						<div class='form-group mb-1'>
							<textarea name='pilB' class='editor1 pilihan form-control'></textarea>
						</div>
						<div class='form-group mb-0'>
							<label>Gambar / Audio Pil B</label>
							<input type='file' name='fileB' class='form-control' />
						</div>                           
					</div>
				</div>						
			</div>	
		</div>
	</div>


	<div class="form-container" id="formC">				
			<div class='row'>
				<div class="col-md-6">
					<div class="card">
						 <div class="card-header" id="row1-5-3">
						 <div class='form-group mb-2' onClick="pilih1('5','3','#4CAF50','3')">PERNYATAAN 3
						<label class="checkbox kanane"><input type="radio" name="rp3" value="#4CAF50" id="P53"  onclick="PR53()">
						<span class="check"></span> 3</label>
							</div>
						  </div>
                   <div class="card-body">				   
					<div class='form-group mb-2'>
						<textarea name='perC'  class='editor1 pilihan form-control'></textarea>                                   
					</div>
					<div class='form-group mb-4 kanan'>
						<button id="C" type="button" class="btn btn-sm btn-icon btn-success"><i class="material-icons">add</i></button>										
						<button id="Ctutup" type="button" class="btn btn-sm btn-icon btn-dark" ><i class="material-icons">close</i> </button>							
					</div>
				</div>
			</div>
		</div>
                <div class="col-md-6">
					<div class="card">
						<div class="card-header" id="row2-5-3">
						  <div class='form-group mb-0' onCLick="pilih2('5','3',2,'3','18','2')">
				   <label  class="checkbox"> <input type="radio" name="rj3" value="C" id="J53" onclick="JW53()"> 
						<span class="check"></span> C</label> 
						<label class="pull-right">JAWABAN</label>
						</div>
						  </div>
                   <div class="card-body"> 
					
						<div class='form-group mb-1'>
							<textarea name='pilC' class='editor1 pilihan form-control'></textarea>
						</div>
						<div class='form-group mb-0'>
							<label>Gambar / Audio Pil C</label>
							<input type='file' name='fileC' class='form-control' />
						</div>                           
					</div>
				</div>						
			</div>	
		</div>
	</div>

	<div class="form-container" id="formD">				
			<div class='row'>
				<div class="col-md-6">
					<div class="card">
						 <div class="card-header" id="row1-5-4">
						 <div class='form-group mb-2' onClick="pilih1('5','4','#FF9800','4')">PERNYATAAN 4
						<label class="checkbox kanane"><input type="radio" name="rp4" value="#FF9800" id="P54"  onclick="PR54()">
						<span class="check"></span> 4</label>
							</div>
						  </div>
                   <div class="card-body">				   
					<div class='form-group mb-2'>
						<textarea name='perD'  class='editor1 pilihan form-control'></textarea>                                   
					</div>
					<div class='form-group mb-4 kanan'>
						<button id="D" type="button" class="btn btn-sm btn-icon btn-success"><i class="material-icons">add</i></button>										
						<button id="Dtutup" type="button" class="btn btn-sm btn-icon btn-dark" ><i class="material-icons">close</i> </button>							
					</div>
				</div>
			</div>
		</div>
                <div class="col-md-6">
					<div class="card">
						<div class="card-header" id="row2-5-4">
						  <div class='form-group mb-0' onCLick="pilih2('5','4',2,'4','18','2')">
				   <label  class="checkbox"> <input type="radio" name="rj4" value="D" id="J54" onclick="JW54()"> 
						<span class="check"></span> D</label> 
						<label class="pull-right">JAWABAN</label>
						</div>
						  </div>
                   <div class="card-body"> 
					
						<div class='form-group mb-1'>
							<textarea name='pilD' class='editor1 pilihan form-control'></textarea>
						</div>
						<div class='form-group mb-0'>
							<label>Gambar / Audio Pil D</label>
							<input type='file' name='fileD' class='form-control' />
						</div>                           
					</div>
				</div>						
			</div>	
		</div>
	</div>

	<div class="form-container" id="formE">				
			<div class='row'>
				<div class="col-md-6">
					<div class="card">
						 <div class="card-header" id="row1-5-5">
						 <div class='form-group mb-2' onClick="pilih1('5','5','#0277BD','5')">PERNYATAAN 5
						<label class="checkbox kanane"><input type="radio" name="rp5" value="#0277BD" id="P55"  onclick="PR55()">
						<span class="check"></span> 5</label>
							</div>
						  </div>
                   <div class="card-body">				   
					<div class='form-group mb-2'>
						<textarea name='perE'  class='editor1 pilihan form-control'></textarea>                                   
					</div>
					<div class='form-group mb-4 kanan'>
						<button  class="btn btn-sm btn-icon btn-light" disabled><i class="material-icons">add</i></button>										
						<button id="Etutup" type="button" class="btn btn-sm btn-icon btn-dark" ><i class="material-icons">close</i> </button>							
					</div>
				</div>
			</div>
		</div>
                <div class="col-md-6">
					<div class="card">
						<div class="card-header" id="row2-5-5">
						  <div class='form-group mb-0' onCLick="pilih2('5','5',2,'4','18','2')">
				   <label  class="checkbox"> <input type="radio" name="rj5" value="E" id="J55" onclick="JW55()"> 
						<span class="check"></span> E</label> 
						<label class="pull-right">JAWABAN</label>
						</div>
						  </div>
                   <div class="card-body"> 
					
						<div class='form-group mb-1'>
							<textarea name='pilE' class='editor1 pilihan form-control'></textarea>
						</div>
						<div class='form-group mb-0'>
							<label>Gambar / Audio Pil E</label>
							<input type='file' name='fileE' class='form-control' />
						</div>                           
					</div>
				</div>						
			</div>	
		</div>
	</div>

	
</form>			
</div>
<script>
	function PR51() {

	var warna = $('#P51').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=JDH1',
	data: 'warna=' + warna + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>
<script>
	function JW51() {

	var jawab = $('#J51').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=UPJDH1',
	data: 'jawab=' + jawab + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>	
<script>
	function PR52() {

	var warna = $('#P52').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=JDH2',
	data: 'warna=' + warna + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>

<script>
	function JW52() {
		
	var jawab = $('#J52').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=UPJDH1',
	data: 'jawab=' + jawab + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>
<script>
	function PR53() {

	var warna = $('#P53').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=JDH3',
	data: 'warna=' + warna + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>	
<script>
	function JW53() {
		
	var jawab = $('#J53').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=UPJDH1',
	data: 'jawab=' + jawab + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>
<script>
	function PR54() {

	var warna = $('#P54').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=JDH4',
	data: 'warna=' + warna + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>

<script>
	function JW54() {
		
	var jawab = $('#J54').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=UPJDH1',
	data: 'jawab=' + jawab + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>	
<script>
	function PR55() {

	var warna = $('#P55').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=JDH5',
	data: 'warna=' + warna + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>

<script>
	function JW55() {
		
	var jawab = $('#J55').val();
	var idbank = $('#idbank').val();
	var nomor = $('#nomor').val();
	$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=UPJDH1',
	data: 'jawab=' + jawab + "&idbank=" + idbank + "&nomor=" + nomor,
	success: function(response) {
					 
	}
	});
	}
</script>					
 <script>
$("#A").click(function() {$("#formB").show(); });
$("#Btutup").click(function() {$("#formB").hide();}); 
$("#B").click(function() {$("#formC").show(); });
$("#Ctutup").click(function() {$("#formC").hide();}); 
$("#C").click(function() {$("#formD").show(); });
$("#Dtutup").click(function() {$("#formD").hide();});
$("#D").click(function() {$("#formE").show(); });
$("#Etutup").click(function() {$("#formE").hide();});  
</script>					
<script>
function haper() {
  document.getElementById("P51").checked = false;
  document.getElementById("J51").checked = false; 
  document.getElementById("row1-5-1").style.backgroundColor = 'white';
  document.getElementById("row2-5-1").style.backgroundColor = 'white';
 
  document.getElementById("P52").checked = false;
  document.getElementById("J52").checked = false; 
  document.getElementById("row1-5-2").style.backgroundColor = 'white';
  document.getElementById("row2-5-2").style.backgroundColor = 'white';
  
  document.getElementById("P53").checked = false;
  document.getElementById("J53").checked = false; 
  document.getElementById("row1-5-3").style.backgroundColor = 'white';
  document.getElementById("row2-5-3").style.backgroundColor = 'white';
  
  document.getElementById("P54").checked = false;
  document.getElementById("J54").checked = false; 
  document.getElementById("row1-5-4").style.backgroundColor = 'white';
  document.getElementById("row2-5-4").style.backgroundColor = 'white';
  
  document.getElementById("P55").checked = false;
  document.getElementById("J55").checked = false; 
  document.getElementById("row1-5-5").style.backgroundColor = 'white';
  document.getElementById("row2-5-5").style.backgroundColor = 'white';
var idbank = $('#idbank').val();
var nomor = $('#nomor').val();
$.ajax({
	type: 'POST',
	url: 'bank/tjodoh.php?pg=RESET',
	data: 'idbank=' + idbank + "&nomor=" + nomor,
	success: function(response) {
						 
	}
	});
}
</script>
		
	  


<script>
	tinymce.init({
		selector: '.editor1',
		
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
		],

		toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		paste_data_images: true,

		images_upload_handler: function(blobInfo, success, failure) {
			success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
		},
		image_class_list: [{
			title: 'Responsive',
			value: 'img-responsive'
		}],
	});
</script>
<script>
	
			var left = '';
			eval('var right_5' + '= "";');
			eval('var warna1_5' + '= "";');
			eval('var id1_5' + '= "";');
			eval('var pos1_5' + '= "";');
			eval('var pos11_5' + '= "";');
			eval('var dipilih1_5' + '= [];');
			eval('var dipilih2_5' + '= [];');
			eval('var order1_5' + '= "";');
			eval('var free1_5' + '= true;');
			eval('var free_5' + '= true;');
			
			
	function pilih1(no, id, warna, order) {
		
			if (window['free1_'+no]) {
				window['free1_'+no] = true;
				
				$('#row1-'+no+'-'+id).css('background',warna);
				window['pos1_'+no] = $('#r_left_'+no+'_'+id).offset();
				window['pos11_'+no] = $('#r_left_'+no+'_'+id).position();
				window['warna1_'+no] = warna;
				window['id1_'+no] = id;
				window['order1_'+no] = order;
				window['dipilih1_'+no].push(id);
				
			}	
	}
	
	function pilih2(no, id,tipe,order,s, ps) {
	$('#row2-'+no+'-'+id).css('background',window['warna1_'+no]);
	$('#r_right_'+no+'_'+id).val(window['id1_'+no]+';'+id);
	}
	
</script>
