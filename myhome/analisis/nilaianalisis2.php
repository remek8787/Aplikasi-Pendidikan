<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>


    <?php

    if (empty($_GET['kelas'])) {
        $id_kelas = "";
        $sqlkelas = "";
    } else {
        $id_kelas = $_GET['kelas'];
        $sqlkelas = " and a.kelas ='" . $_GET['kelas'] . "'";
    }
    if (empty($_GET['id'])) {
        $id_bank = "";
    } else {
        $id_bank = $_GET['id'];
    }
 $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal where id_bank='$id_bank' "));
 $jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban_dup where id_bank='$id_bank' "));					
    ?>
     <div class='row'>
            <div class="col-md-12">
                <div class="card">
                      <div class="card-header">
                          <h5 class="card-title">ANALISIS BUTIR SOAL</h5>
							</div>
					 <div class="card-body">
					 <div class="row">
                        <div class="col-md-3">
                      
                            <select class="form-select kelas">
                                <?php $level = mysqli_query($koneksi, "select siswa.id_siswa,siswa.kelas,nilai.id_siswa from siswa  join nilai  on siswa.id_siswa=nilai.id_siswa group by siswa.kelas"); ?>
                                <option value=''> Pilih Kelas</option>
                                <?php while ($kls = mysqli_fetch_array($level)) : ?>
                                    <option <?php if ($id_kelas == $kls['kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select ujian">
							
                     <?php $ujian = mysqli_query($koneksi, "select banksoal.id_bank,banksoal.kode,banksoal.nama,nilai.id_bank FROM banksoal join nilai  ON banksoal.id_bank=nilai.id_bank group by banksoal.id_bank"); ?>

								<option> Pilih Mata Pelajaran</option>
                                <?php while ($uj = mysqli_fetch_array($ujian)) : ?>
                                    <option <?php if ($id_bank == $uj['id_bank']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $uj['id_bank'] ?>"><?= $uj['kode'] ?> - <?= $uj['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
						
                        <div class="col-md-3">
                          <?php if($jumlah<>0){ ?>
                            <button id="cari_nilai" class="btn btn-success"><i class='material-icons'>search</i>Cari Analisis</button>
						 <a href="analisis/cetakanalisis.php?m=<?= $id_bank ?>&k=<?= $id_kelas ?>" target="_blank" class='btn btn-danger'  data-bs-placement="top" data-bs-toggle="tooltip" title="Cetak"><i class='material-icons'>print</i> </a>
						  <?php }else{ ?>
						  <button id="cari_nilai" class="btn btn-success"><i class='material-icons'>search</i>Cari Analisis</button>
						  <?php } ?>
						
                            <script type="text/javascript">
                                $('#cari_nilai').click(function() {
                                    var kelas = $('.kelas').val();
                                    var ujian = $('.ujian').val();
                                    location.replace("?pg=<?= enkripsi('analisis') ?>&kelas=" + kelas + "&id=" + ujian);
                                }); 
                            </script>

                        </div>
                      
					  <div class="col-md-3">
						<form id="formambil">
						<input type="hidden" name="idb" value="<?= $id_bank ?>" >
						<input type="hidden" name="k" value="<?= $id_kelas ?>" >
						<?php if($jumlah<>0){ ?>
						 <button  class="btn btn-default" disabled><i class='material-icons'>lock</i>Ambil Jawaban</button>
						 <?php }else{ ?>
						 <button type="submit" id="ambil" class="btn btn-primary"><i class='material-icons'>download</i>Ambil Jawaban</button>
						 <?php } ?>
						</form>
						</div>
                    </div>
					
					<script>
			 $('#formambil').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'analisis/ambil.php',
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
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
 
			</script>
                <br>    
    <?php
    $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_bank='$id_bank'"));
    ?>
   
				 <?php 
				
				 $jumlah_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$id_kelas'"));
				 ?>
				 
				  <?php 
				 
				 $jumlah_soal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank'  "));
				 
				 ?>
                
                    <table  class='table table-bordered table-striped'>
                        <tr>
                            <th>Kelas/Rombel</th>
                            <td width='10'>:</td>
                            <td><?= $id_kelas ?></td>
                             <td width='50'></td>
                            <th>Jml Siswa</th>
                            <td width='10'></td>
                            <td><b><?= $jumlah_siswa ?></b></td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['kode'] ?></td>
                           <td width='50'></td>
                            <th>Kelompok Soal</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['groupsoal'] ?></td>
                        </tr>
						 <tr>
                            <th>
							Jumlah Soal 
							
							</th>
                            <td width='10'>:</td>
                            <td><?= $jumlah_soal ?></td>
							<td width='50'></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                    </table>
					<br>
					 <div class='row'>
            <div class="col-md-12">
                     <h5>Soal Pilihan Ganda</h5>
                 
                        <table id="datatable1" class='table table-bordered' style="width:100%;font-size:12px">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jawab A</th>
							<th width="5%">Jawab B</th>
							<th width="5%">Jawab C</th>
							<th width="5%">Jawab D</th>
							<th width="5%">Jawab E</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
								
                            </thead>
							 	
							 <?php
							 
                               $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='1' ");                 
							   while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='$jawab' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban<>'$jawab' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								$A=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='A' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$B=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='B' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$C=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='C' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$D=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='D' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$E=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup
								WHERE jawaban='E' AND jenis='1' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
									
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
									if($sulit < 0.30){
									{$status="Soal Sukar";}
									}elseif($sulit >= 0.30 && $sulit <= 0.70){
									{$status="Soal Sedang";}
									}elseif($sulit >= 0.70){
									{$status="Soal Mudah";}
									}	
									if($sulit < 0.30){
									{$dp="Jelek, soal dirombak ";}
									}elseif($sulit >= 0.30 && $sulit <= 0.50){
									{$dp="Kurang baik (perlu direvisi)";}
									}elseif($sulit >= 0.51 && $sulit <= 0.69){
									{$dp="Kurang baik (perlu direvisi)";}
									}elseif($sulit >= 0.70){
									{$dp="Baik";}
									}	
									if($benar > $salah){
									{$kecoh="Efektif";}
									}elseif($benar < $salah){
									{$kecoh="Menyesatkan";}
									}elseif($benar = $salah){
									{$kecoh="Tidak efektif";}
									}																		
										 ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        
                                        <td> <?= $mp['jawaban'] ?> </td>
										 <td> <?= $A ?> </td>
										  <td> <?= $B ?> </td>
										   <td> <?= $C ?> </td>
										    <td> <?= $D ?> </td>
											 <td> <?= $E ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									  <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									 <td> <?= $status ?> </td>
									 
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						
						<br>
				 <?php if($mapel['model']=='1'): ?>
                     <h5>Soal PG Komplek (Multi Coice)</h5>
                   
                         <table id="datatable1" class='table table-bordered' style="width:100%;font-size:12px">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='3' ");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabmulti='$jawab' AND jenis='3' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabmulti<>'$jawab' AND jenis='3' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
															   $sulit=$benar / $bagi;
							if($sulit < 0.30){
							{$status="Soal Sukar";}
							}elseif($sulit >= 0.30 && $sulit <= 0.70){
							{$status="Soal Sedang";}
							}elseif($sulit >= 0.70){
							{$status="Soal Mudah";}
							}	
							if($sulit < 0.30){
							{$dp="Jelek, soal dirombak ";}
							}elseif($sulit >= 0.30 && $sulit <= 0.50){
							{$dp="Kurang baik (perlu direvisi)";}
							}elseif($sulit >= 0.51 && $sulit <= 0.69){
							{$dp="Kurang baik (perlu direvisi)";}
							}elseif($sulit >= 0.70){
							{$dp="Baik";}
							}	
							if($benar > $salah){
							{$kecoh="Efektif";}
							}elseif($benar < $salah){
							{$kecoh="Menyesatkan";}
							}elseif($benar = $salah){
							{$kecoh="Tidak efektif";}
							}
					    ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td><?= $tidakjawab ?> </td>
									 	 <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									  <td> <?= $status ?> </td>
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						
						<br>
                     <h5>Soal PG Komplek (Benar Salah)</h5>
                     <table id="datatable1" class='table table-bordered' style="width:100%;font-size:12px">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
								
                            </thead>
							 	
							 <?php
							 
							        
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='4'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs='$jawab' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs<>'$jawab' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								$A=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs='A' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$B=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawabbs='B' AND jenis='4' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
								if($sulit < 0.30){
								{$status="Soal Sukar";}
								}elseif($sulit >= 0.30 && $sulit <= 0.70){
								{$status="Soal Sedang";}
								}elseif($sulit >= 0.70){
								{$status="Soal Mudah";}
								}	
								if($sulit < 0.30){
								{$dp="Jelek, soal dirombak ";}
								}elseif($sulit >= 0.30 && $sulit <= 0.50){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.51 && $sulit <= 0.69){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.70){
								{$dp="Baik";}
								}	
								if($benar > $salah){
								{$kecoh="Efektif";}
								}elseif($benar < $salah){
								{$kecoh="Menyesatkan";}
								}elseif($benar = $salah){
								{$kecoh="Tidak efektif";}
								}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        
                                        <td> <?= $mp['jawaban'] ?> </td>
										 
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									 <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									  <td> <?= $status ?> </td>
									 
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						
						<br>
                     <h5>Soal Menjodohkan</h5>
                     <table id="datatable1" class='table table-bordered' style="width:100%;font-size:12px">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='5'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawaburut='$jawab' AND jenis='5' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE jawaburut<>'$jawab' AND jenis='5' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
								if($sulit < 0.30){
								{$status="Soal Sukar";}
								}elseif($sulit >= 0.30 && $sulit <= 0.70){
								{$status="Soal Sedang";}
								}elseif($sulit >= 0.70){
								{$status="Soal Mudah";}
								}	
								if($sulit < 0.30){
								{$dp="Jelek, soal dirombak ";}
								}elseif($sulit >= 0.30 && $sulit <= 0.50){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.51 && $sulit <= 0.69){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.70){
								{$dp="Baik";}
								}	
								if($benar > $salah){
								{$kecoh="Efektif";}
								}elseif($benar < $salah){
								{$kecoh="Menyesatkan";}
								}elseif($benar = $salah){
								{$kecoh="Tidak efektif";}
								}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									   <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									 <td> <?= $status ?> </td>
									
                                    <?php } ?>	
									</tr>	
                            </tbody>
                        </table>
						
						<br>
						<?php endif; ?>
                     <h5>Soal Uraian Singkat</h5>
                     <table id="datatable1" class='table table-bordered' style="width:100%;font-size:12px">
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								  
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_bank='$id_bank' AND jenis='2'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE esai='$jawab' AND jenis='2' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban_dup 
								WHERE esai<>'$jawab' AND jenis='2' AND id_bank='$mp[id_bank]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
								if($sulit < 0.30){
								{$status="Soal Sukar";}
								}elseif($sulit >= 0.30 && $sulit <= 0.70){
								{$status="Soal Sedang";}
								}elseif($sulit >= 0.70){
								{$status="Soal Mudah";}
								}	
								if($sulit < 0.30){
								{$dp="Jelek, soal dirombak ";}
								}elseif($sulit >= 0.30 && $sulit <= 0.50){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.51 && $sulit <= 0.69){
								{$dp="Kurang baik (perlu direvisi)";}
								}elseif($sulit >= 0.70){
								{$dp="Baik";}
								}	

							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									   <td> <?= $dp ?> </td>
									  <td> <?= $status ?> </td>
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						
					
	   </div>
</div>