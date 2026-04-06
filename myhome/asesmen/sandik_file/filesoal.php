 <?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jfile = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM file_pendukung"));
?>

 <div class='row'>
    <div class='col-md-8'>
        <div class="card">
             <div class="card card-header">
                 <h5 class="card-title">FILE SOAL</h5>
            </div>
         <div class="card-body">
	<div class='row'>
        <?php
        $ektensi = ['jpg', 'png', 'JPG', 'PNG', 'JPEG', 'jpeg'];
        $folder = "../files/"; 
        if (!($buka_folder = opendir($folder))) die("eRorr... Tidak bisa membuka Folder");
        $file_array = array();
        while ($baca_folder = readdir($buka_folder)) :
            $file_array[] = $baca_folder;
        endwhile;
        $jumlah_array = count($file_array);
        for ($i = 2; $i < $jumlah_array; $i++) :
            $nama_file = $file_array;
            $nomor = $i - 1;
            $ext = explode('.', $nama_file[$i]);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) { ?>
               
		<div class="avatar avatar-xxl status status-online">
    <img src="<?= $folder.$nama_file[$i] ?>" alt="">&nbsp;&nbsp;
</div>
                            
          <?php  } ?>
       <?php endfor;
        closedir($buka_folder);
        ?>
    </div>
	  </div>
          </div>
             </div>
			<div class="col-xl-4 mb-4">
				<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center flex-column mb-4">
					<div class="d-flex align-items-center flex-column">
						<div class="sw-13 position-relative mb-3">
							<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
							</div>
						<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
					<div class="text-muted">HIGH SCHOOL</div>
						</div>
					</div>
                    <div class="mb-4">
                    <p class="text-small text-muted mb-2">DESKRIPSI</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">home</i>
                        </div>
                      </div>
                      <div class="col text-alternate">Digunakan untuk sinkron data</div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">star</i>
                        </div>
                      </div>
                      <div class="col text-alternate">Digunakan untuk Restore File</div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">sync</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= date('d M Y') ?></div>
                    </div>
                  </div>
                                            <div class="d-grid gap-2" id="data">
                                                <button  class="hapus btn btn-danger"> Hapus File</button> 
											</div>	
											<p></p>
												<form id="formzip">
												<div class="d-grid gap-2" id="data">
                                               <button name="submit3" type="submit"  class="btn btn-success"> Buat Zip</button>  
                                            </div>
											</form>
											<p></p>
											 <div class="d-grid gap-2">
                                                <a href="<?= $baseurl ?>/files.zip"  class="btn btn-primary"> Download File</a> 
											</div>	
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
 <script>
 
    $('#formzip').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?= $baseurl ?>/zip.php',
            data: $(this).serialize(),
			beforeSend: function() {
                $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" ></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 500);
            },
            success: function(data) {
               
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                

            }
        });
        return false;
    });
	
        
</script>
<script>
 $("#data").on('click', '.hapus', function() {
        var id = $(this).data('id');
        swal({
            title: 'Konfirmasi ',
            text: 'Apakah kamu yakin akan menghapus soal ??',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'asesmen/sandik_file/hapus_file.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                 iziToast.info({
			title: 'Sukses!',
			message: 'File berhasil dihapus',
			titleColor: '#FFFF00',
			messageColor: '#fff',
			backgroundColor: 'rgba(0, 0, 0, 0.5)',
			progressBarColor: '#FFFF00',
			position: 'topRight'					  
                });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
            return false;
        })

    });
</script>

