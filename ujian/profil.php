                        <style>
							.responsive {
							width: 50%;
							height: auto;
							}
							</style>
							 <div class='row'>
									<div class='col-md-8'>
										<div class='box box-solid' >
											<div class='box-body'>
                                                <table class='table table-bordered'>
                                                    <thead>
                                                        <tr>
                                                            <th width='5px'>#</th>
                                                            <th>Mapel</th>
                                                            <th>Ujian Selesai</th>
                                                            <th>Status</th>
															<th>Nilai</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $nilaix = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa' AND ujian_selesai <>'' ORDER BY ujian_selesai ASC "); ?>
                                                        <?php while ($nilai = mysqli_fetch_array($nilaix)) : ?>
                                                            <?php
                                                            $no++;
                                                            $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$nilai[id_bank]'"));
                                                            $namamapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE kode='$mapel[nama]'"));
                                                            ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $namamapel['nama_mapel'] ?></td>
                                                                <td><?= $nilai['ujian_selesai'] ?></td>
                                                                <td><label class='label label-primary'>Selesai</label></td>
																<td><?= $nilai['nilai'] ?></td>
                                                                <td>
                                                                   
																</td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                   
	<div class="col-sm-4" >
		<div class='box box-solid' >
			<div class='box-body' >
			<div class="text-center">
			<?php if($siswa['foto']==''){ ?>
                 <img src="images/user.png" alt="" class="responsive">
					<?php }else{ ?>
				<img src="images/fotosiswa/<?= $siswa['foto'] ?>" alt="" class="responsive">
			<?php } ?>
				</div>
			<div class="text-center"><?= $siswa['nama'] ?></div>
				<div class="text-center">HIGH SCHOOL</div>
									 
		<div class="edis">
		  <form id="formprofil">
		  <input type='hidden' name='ids' value="<?= $siswa['id_siswa'] ?>" class='form-control' />
				<div class="form-group-sm">
					<label><b>Username</b></label> 
					<input type="text" name='username' class="form-control"   value="<?= $siswa['username'] ?>" readonly >
				</div>
				<div class="form-group-sm">
					<label><b>Password</b></label> 
					<input type="text" name='password' class="form-control"  value="<?= $siswa['password'] ?>" required >
				</div>			
				
				<div class="form-group-sm">
					<label><b>Agama</b></label> 
					<select class="form-control" name="agama" required style="width: 100%">
							<option value="<?= $siswa['agama'] ?>"><?= $siswa['agama'] ?></option>
							   <option value='' disabled>-- Pilih Agama --</option>
							      <option value='Islam'>Islam</option>
								  <option value='Kristen'>Kristen</option>
								   <option value='Katholik'>Katholik</option>
								  <option value='Hindu'>Hindu</option>
								   <option value='Budha'>Budha</option>
								  <option value='Konghucu'>Konghucu</option>
							</select>
				</div>
				
				<div class="form-group-sm">
					<label><b>FOTO ( Jika Ada )</b></label> 
                   <input type='file' name='file' class='form-control' />
				   </div>
				<br>
				
			  <button type="submit" class="btn btn-primary btn-round form-control mt-5"  name="btnsubmit">Simpan</button>
			</form> 
			<br><br>
		</div>
    </div>
	 
  </div> 
</div>
						<script>
							$('#formprofil').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'ujian/simpanprofil.php',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									success: function(data) {
									iziToast.info(
										{
											 title: 'Sukses!',
											message: 'Data berhasil disimpan',
											titleColor: '#FFFF00',
											messageColor: '#fff',
											backgroundColor: 'rgba(0, 0, 0, 0.5)',
											 progressBarColor: '#FFFF00',
											  position: 'topRight'				  
											});
											setTimeout(function() {
											window.location.replace('?pg=profil');
										}, 2000);
										}
									});
								return false;
							});
						</script>	 
						 