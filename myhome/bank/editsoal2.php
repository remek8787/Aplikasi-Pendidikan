<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php
$id_soal = $_GET['id_soal'];

$nomor = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal'"));

$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$nomor[id_bank]'"));
$idmap=$mapel['kode'];
$jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$mapel[id_bank]' AND  nomor='$nomor[nomor]' AND jenis='3'"));
$soalQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal' ");
$soal = mysqli_fetch_array($soalQ);
 
?>
<?php if ($ac == '') : ?>
 <div class="row"> 
	<form id='formsoal' action='' method='post' enctype='multipart/form-data'>
              <div class="col-md-12">
                    <div class="card">
                         <div class="card-header">
					
					<div class='btn-group' style='margin-top:-5px'>
						<label class='btn btn-sm btn-outline-primary'>Mapel </label>
						<label class='btn btn-sm btn-outline-primary'><?= $mapel['nama'] ?> </label>
						<label class='btn btn-sm btn-outline-danger'>No Soal :<b class="sandik"> <?= $nomor['nomor'] ?></b></label>
					</div>			
                     <button type='submit' name='simpansoal' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-outline-primary kanan'> Simpan</button>
						<a href='?pg=<?= enkripsi('banksoal') ?>&ac=lihat&id=<?= $mapel['id_bank'] ?>' class='btn btn-sm btn-outline-danger kanan'> Kembali</a>
					
						</div>
							</div>
								</div>
									</div>
					<input type='hidden' name='idsoal' value='<?= $_GET['id_soal'] ?>'>
					<input type='hidden' name='mapel' value='<?= $nomor['id_bank'] ?>'>
					<input type='hidden' name='jenis' value='<?= $nomor['jenis'] ?>'>
					<input type='hidden' name='nomor' value='<?= $nomor['nomor'] ?>'>
				<div class='row'>
			<div class="col-md-6">
		      <div class="card">
				<div class="card-header">
						  <h5 class="card-title">
                    SOAL ESAI / URAIAN SINGKAT
					</h5>
                   
                  </div>
                    <div class="card-body">
					<textarea id='editor2' name='isi_soal' class='editor1' rows='10' cols='80' style='width:100%;' required><?= $soal['soal'] ?></textarea>
							
								<div class="row">
							<div class='col-md-6'>
							
								<div class='form-group'>
									<?php
									if ($soal['file'] <> '') {
										$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
										$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
										$ext = explode(".", $soal['file']);
										$ext = end($ext);
										if (in_array($ext, $image)) {
											echo "
										<label>Gambar</label><br />
										<img src='$baseurl/files/$soal[file]' style='max-width:100px;' />
										";
										} elseif (in_array($ext, $audio)) {
											echo "
										<label>Audio</label><br />
										<audio controls>
											<source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
										";
										} else {
											echo "File tidak didukung!";
										}
									echo "<a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=file' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
									} else {
										echo "
										<label>Gambar / Audio</label>
										<input type='file' class='form-control' name='file' type='file'>
										";
									}
									?>
								</div>
							</div>
							<div class='col-md-6'>
								<div class='form-group'>
									<?php
									if ($soal['file1'] <> '') {
										$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
										$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
										$ext = explode(".", $soal['file1']);
										$ext = end($ext);
										if (in_array($ext, $image)) {
											echo "
										<label>Gambar</label><br />
										<img src='$baseurl/files/$soal[file1]' style='max-width:100px;' />
										";
										} elseif (in_array($ext, $audio)) {
											echo "
										<label>Audio</label><br />
										<audio controls>
											<source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
										";
										} else {
											echo "File tidak didukung!";
										}
											echo "<a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=file1' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
									} else {
										echo "
										<label>Gambar / Audio</label>
										<input type='file' class='form-control' name='file1' type='file'>
										";
									}
									?>
								</div>
							 </div>
							</div>						
						 </div>	
					</div>	
				</div>	
				<div class="col-md-6">
						 <div class="card">
						 <div class="card-header">
						  <h5 class="card-title">OPSI DAN KUNCI JAWABAN </h5>
						  </div>
                   <div class="card-body">
				    <div class="row">
				  <div class='col-md-6'>
				  <label>Maximal Skor</label>
				  <input type="number" name="skor" class="form-control" value="<?= $soal['max_skor'] ?>" required="true">
				  </div>
				  <div class='col-md-6'>
				  <label>Jenis Jawaban</label>
				 <select name='jenisjawab' class='form-select' required='true' style="width: 100%">
				 <option value="<?= $soal['jenisjawab'] ?>"><?= $soal['jenisjawab'] ?></option>
					<option value=''>Pilih Jenis Jawaban</option>
						<option value='Angka'>Angka</option>
						<option value='Teks'>Teks</option>
					</select>
				  </div>
				  </div>
				  <p>
				<div class='form-group'>
                     <textarea id='jawabesai' name='pilA' rows='10' cols='80' class='form-control' required ><?= $soal['jawaban'] ?></textarea>
                           </div>
							</div>
							
						</form>
						
						</div>
					</div>
				</div>
			
	
				<?php elseif ($ac == 'hapusfile') : ?>
    <?php
    $id = $_GET['id'];
    $file = $_GET['file'];
    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id'"));
    (file_exists("../files/" . $soal[$file])) ? unlink("../files/" . $soal[$file]) : null;
    mysqli_query($koneksi, "UPDATE soal SET $file='' WHERE id_soal='$id'");
    jump("?pg=$pg&id_soal=$id");
    ?>		

<?php endif; ?>						   
						     
							
						
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
$('#formsoal').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
             url: 'bank/tbanksoal2.php?pg=simpan_soal',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
           beforeSend: function() {
                $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 500);
            },
            success: function(data) {
               
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        })
        return false;
    });
	</script>
