 <?php 
defined('APK') or exit('No Access');
$pesan5 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='5'"));
$pesan6 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='6'"));

?>

                        <div class="row">
                           <div class="col-md-6">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">NOTIF ESKUL SISWA MASUK</h5>
										</div>
                                    <div class="card-body">									 
                                       <form id="formsiswa" class="row g-1"> 
									    <div class="col-md-12">
										<label class="bold">Pesan Pembuka</label>									   
                                          <input type="text" class="form-control" name="pesan1" spellcheck="false" value="<?= $pesan5['pesan1'] ?>" >
										  </div>
                                        <div class="col-md-8">
										<label class="bold">Isi Pesan</label>									   
                                          <textarea class="form-control" name="pesan2" spellcheck="false" rows="4"><?= $pesan5['pesan2'] ?></textarea>
										  </div>
										  <div class="col-md-4">
										<label class="bold"></label>									   
                                          <textarea class="form-control" rows="4" readonly>Nama Siswa</textarea>
										  </div>
										 
										  <div class="col-md-8">
										<label class="bold"></label>									   
                                          <textarea class="form-control" name="pesan3" spellcheck="false" rows="4"><?= $pesan5['pesan3'] ?></textarea>
										  </div>
										   <div class="col-md-4">
										<label class="bold"></label>									   
                                          <textarea class="form-control" rows="4" readonly><?= date('d M Y H:i') ?></textarea>
										  </div>
										  <div class="col-md-12">
										<label class="bold">Pesan Penutup</label>									   
                                          <textarea class="form-control" name="pesan4" spellcheck="false" rows="4"><?= $pesan5['pesan4'] ?></textarea>
										  </div>
                                       <div class="col-md-12 mb-2">
											<button type="submit" class="btn btn-primary kanan">Simpan</button>										   
										</div>
                                       </form>										  
                                        </div>
                                    </div>
                                </div>
                         <script>
					$('#formsiswa').submit(function(e){
						e.preventDefault();
						var data = new FormData(this);
						$.ajax(
						{
							type: 'POST',
							 url: 'pesan/tsetting.php?pg=masukeksis',
							data: data,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function() {
							$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
							$('.progress-bar').animate({
							width: "30%"
							}, 500);
											},
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
                              <div class="col-md-6">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">NOTIF PULANG ESKUL SISWA</h5>
										</div>
                                    <div class="card-body">
									  <form id="formsiswa2" class="row g-1"> 
									    <div class="col-md-12">
										<label class="bold">Pesan Pembuka</label>									   
                                          <input type="text" class="form-control" name="pesan1" spellcheck="false" value="<?= $pesan6['pesan1'] ?>" >
										  </div>
                                        <div class="col-md-8">
										<label class="bold">Isi Pesan</label>									   
                                          <textarea class="form-control" name="pesan2" spellcheck="false" rows="4"><?= $pesan6['pesan2'] ?></textarea>
										  </div>
										  <div class="col-md-4">
										<label class="bold"></label>									   
                                          <textarea class="form-control" rows="4" readonly>Nama Siswa</textarea>
										  </div>
										 
										  <div class="col-md-8">
										<label class="bold"></label>									   
                                          <textarea class="form-control" name="pesan3" spellcheck="false" rows="4"><?= $pesan6['pesan3'] ?></textarea>
										  </div>
										   <div class="col-md-4">
										<label class="bold"></label>									   
                                          <textarea class="form-control" rows="4" readonly><?= date('d M Y H:i') ?></textarea>
										  </div>
										  <div class="col-md-12">
										<label class="bold">Pesan Penutup</label>									   
                                          <textarea class="form-control" name="pesan4" spellcheck="false" rows="4"><?= $pesan6['pesan4'] ?></textarea>
										  </div><p>
										   <div class="col-md-12 mb-2">
											<button type="submit" class="btn btn-primary kanan">Simpan</button>
										   
										</div>
                                       </form>										  
                                        </div>
                                    </div>
                                </div>
                         
                                    </div>
                                </div>
                           
                    <script>
					$('#formsiswa2').submit(function(e){
						e.preventDefault();
						var data = new FormData(this);
						$.ajax(
						{
							type: 'POST',
							 url: 'pesan/tsetting.php?pg=pulangeksis',
							data: data,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function() {
							$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
							$('.progress-bar').animate({
							width: "30%"
							}, 500);
											},
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