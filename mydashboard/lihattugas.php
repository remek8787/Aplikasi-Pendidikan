<?php
$tanggal = date('Y-m-d');
$id = $_GET['id'];
$tugas = mysqli_fetch_array(mysqli_query($koneksi, "select * from tugas where id_tugas='$id'"));
$pel = mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id='$tugas[mapel]'"));
$where = array(
     'idsiswa' => $_SESSION['id_siswa'],
     'mapel' => $tugas['mapel']
      );
$datax = array(
	'mapel'=> $tugas['mapel'],
    'idsiswa' => $_SESSION['id_siswa'],
	'kelas' => $siswa['kelas'],
    'tanggal' => date('Y-m-d'),
	'jam' => date('H:i:s'),
	'bulan'=> date('m'),
	'ket' => 'H',
    'guru'=> $tugas['guru'],
	'tahun'=> date('Y')
    );			
$cek = rowcount($koneksi, 'absen_mapel', $where);
if ($cek == 0) {
  insert($koneksi, 'absen_mapel', $datax);
	}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-header">
                <h5 class='card-title'>TUGAS SISWA</h5>
            </div>
            <div class='card-body'>		
                <table class='table table-bordered table-striped'>
                    <tr>
                        <th width='150'>Mata Pelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $pel['nama_mapel'] ?></td>

                    </tr>
                    <tr>
                        <th>Tgl Mulai</th>
                        <td width='10'>:</td>
                        <td><?= $tugas['tgl_mulai'] ?></td>
                    </tr>
                    <tr>
                        <th>Tgl Selesai</th>
                        <td width='10'>:</td>
                        <td><?= $tugas['tgl_selesai'] ?></td>
                    </tr>
					<?php if($tugas['file']<>''){ ?>
					 <tr>
                        <th>Download</th>
                        <td width='10'>:</td>
                        <td> <a href="<?= $baseurl . '/tugas/' . $tugas['file'] ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fas fa-download fa-fw"></i> Download Tugas</a></td>
                    </tr>
					<?php } ?>
                </table>
                                
                    <?php if ($tugas['file'] <> null) {
					$pecah=explode('.',$tugas['file']);
					$ekstensi=$pecah[1];
					?>
					<?php if($ekstensi=='mp4'){ ?>
					<video src="<?= $baseurl ?>/tugas/<?= $tugas['file'] ?>" controls autoplay width="100%" height="315"></video>
					 <?php } ?>
					 <?php if($ekstensi=='jpg' OR $ekstensi=='png'){ ?>
					<img src="<?= $baseurl ?>/tugas/<?= $tugas['file'] ?>" controls autoplay width="100%" height="315">
					 <?php } ?>
					 <?php if($ekstensi=='pdf'){ ?>
					<iframe  src="<?= $baseurl ?>/tugas/<?= $tugas['file'] ?>" controls autoplay width="100%" height="315"></iframe>
					 <?php } ?>
                     <?php } ?>
					 
				<div class="col-md-12">	 
				<label class="bold"><?= $tugas['judul'] ?></label>
                  </div> 
                    <div class="col-md-12">					  
                       <p><?= $tugas['tugas'] ?></p>
                        </div>
                        <hr>
						
						
                            <?php
                            $kondisi = array(
                                'id_siswa' => $_SESSION['id_siswa'],
                                'id_tugas' => $tugas['id_tugas']
                            );
                            $jawab_tugas = fetch($koneksi, 'jawaban_tugas', $kondisi);
                            if ($jawab_tugas) {
                                $jawaban = $jawab_tugas['jawaban'];
                            } else {
                                $jawaban = "";
                            }
                            ?>
                            <?php if ($jawab_tugas['nilai'] <> '') { ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Jawaban telah dikoreksi dan dinilai</strong>
                                </div>
                                <h4>Nilai Tugas <?= $tugas['mapel'] ?> : <?= $jawab_tugas['nilai'] ?></h4>
                            <?php } else { ?>
                                

                                <form id='formjawaban' class="row g-2">
                                    <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas'] ?>">
                                        <div class="col-md-12">	
                                        <label class="bold">Lembar Jawaban</label>
                                        <textarea class="form-control" name="jawaban" id="txtjawaban" rows="5"><?= $jawaban ?></textarea>
                                    </div>
                                   <?php if ($jawab_tugas['file'] == '') { ?>
                                      <div class="col-md-12">	
                                           <label class="bold">Upload Jawaban</label>
                                            <input type="file" class="form-control" name="file" >                                           
                                        </div>
                                    <?php  } ?>

                                       <div class="col-md-12">	
									 <?php if ($jawab_tugas['nilai'] == '') { ?>
                                        <button type="submit" class="btn btn-primary kanan">Simpan</button>
										<?php  } ?>
                                    </div>
                                </form>
                            <?php  } ?>
							
                        </div>
                    </div>
                </div>
            </div>
       
 <script>
        $('#formjawaban').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
        type: 'POST',
        url: 'simpantugas.php',
        enctype: 'multipart/form-data',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data) {
		$('#progressbox').html('<div><img src="<?= $baseurl; ?>/images/animasi.gif" style="width:50px;"></div>');
		$('.progress-bar').animate({
				width: "30%"
				}, 500);
			setTimeout(function() {
			window.location.reload();
					}, 2000);

				}
			});
			return false;
			});
 
      </script>
	   
<script>
    tinymce.init({
        selector: '#txtjawaban',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste'
        ],

        toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | emoticons code | imagetools link image paste ',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        paste_data_images: true,
        paste_as_text: true,
        images_upload_handler: function(blobInfo, success, failure) {
            success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
        },
        image_class_list: [{
            title: 'Responsive',
            value: 'img-responsive'
        }],
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
</script>