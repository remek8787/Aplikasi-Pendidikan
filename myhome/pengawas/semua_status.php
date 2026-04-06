
<?php
include "../../konek/koneksi.php";
include "../../konek/function.php";
include "../../konek/crud.php";
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$_SESSION[id_user]'"));
$npsn = $user['npsn'];
$nilaiq = mysqli_query($koneksi, "SELECT * FROM nilai LEFT JOIN ujian ON nilai.id_ujian=ujian.id_ujian  where ujian.status='1' and nilai.id_siswa<>'' and nilai.id_ujian='$_GET[idu]'  ORDER BY nilai.id_nilai DESC");

$tglsekarang = date('Y-m-d');

 $uj = fetch($koneksi,'ujian',['id_ujian'=>$_GET['idu']]);
 $pk = $uj['pk'];
 ?>
 <?php 
if($pk=='semua'):
$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE NOT EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]') and sesi='$user[sesi]' and level='$uj[level]'  and kelas='$user[kelas]' and ruang='$user[ruang]'");
 else:
 $query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE NOT EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]') and sesi='$user[sesi]' and level='$uj[level]' and jurusan='$pk'  and kelas='$user[kelas]' and ruang='$user[ruang]'");
 endif;
$cek = mysqli_num_rows($query);
if($pk=='semua'):
$query2 = mysqli_query($koneksi,"SELECT * FROM siswa WHERE  EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]' and nilai.browser='0') and sesi='$user[sesi]' and level='$uj[level]'  and kelas='$user[kelas]' and ruang='$user[ruang]'");
 else:
 $query2 = mysqli_query($koneksi,"SELECT * FROM siswa WHERE  EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]' and nilai.browser='0') and sesi='$user[sesi]' and level='$uj[level]' and jurusan='$pk'  and kelas='$user[kelas]' and ruang='$user[ruang]'");
 endif;
$cek2 = mysqli_num_rows($query2);

if($pk=='semua'):
$query3 = mysqli_query($koneksi,"SELECT * FROM siswa WHERE  EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]' and nilai.browser='1') and sesi='$user[sesi]' and level='$uj[level]'  and kelas='$user[kelas]' and ruang='$user[ruang]'");
else:
$query3 = mysqli_query($koneksi,"SELECT * FROM siswa WHERE  EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]' and nilai.browser='1') and sesi='$user[sesi]' and level='$uj[level]' and jurusan='$pk'  and kelas='$user[kelas]' and ruang='$user[ruang]'");
endif;
$cek3 = mysqli_num_rows($query3);
?>   
  <div class="row">
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">login</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">BELUM LOGIN</span>
												<a href="?pg=<?= enkripsi('siswas') ?>&ac=login&idu=<?= $_GET['idu'] ?>" class="btn btn-sm btn-success kanan">Lihat</a>
                                                <span class="widget-stats-amount"><?= $cek; ?></span>
                                                
                                            </div>
                                           
                                        </div>
										
                                    </div>
                                </div>
								
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">memory</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SEDANG UJIAN</span>
                                                <span class="widget-stats-amount"><?= $cek2; ?></span>
                                                
                                            </div>
                                            
                                        </div>
										
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-danger">
                                                <i class="material-icons-outlined">verified</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SELESAI UJIAN</span>
                                                <span class="widget-stats-amount"><?= $cek3 ?></span>
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<div class="col-xl-12">				   
<div class='table-responsive'>
    <table id='datab' class='table table-bordered edis2' width="100%">
        <thead>
            <tr>
                <th width='5px'>#</th>
                <th>Kelas - Nama Siswa</th>
                <th>IP Address</th>				
                <th>Jml Soal - Jml Jawab</th>
                <th>Status</th>
				
                <th>Action</th>
				
            </tr>
        </thead>
        <tbody id='logstatus'>
            <?php while ($nilai = mysqli_fetch_array($nilaiq)) {
                $tglx = strtotime($nilai['ujian_mulai']);
                $tgl = date('Y-m-d', $tglx);

                $no++;
                $ket = '';
                $lama = $jawaban = $skor = '--';
                $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$nilai[id_siswa]'  and kelas='$user[kelas]' and ruang='$user[ruang]' and sesi='$user[sesi]'"));
                
                $bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$nilai[id_bank]'"));
                $nilaiQ = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$siswa[id_siswa]'  ");
                $nilaiC = mysqli_num_rows($nilaiQ);
                 $totalsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$nilai[id_bank]'"));
                 $brows = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM reset WHERE idsiswa='$nilai[id_siswa]' AND idnilai='$nilai[id_nilai]'"));
                if ($nilaiC <> 0) {
                    $lama = '';
                    if ($nilai['ujian_mulai'] <> '' and $nilai['ujian_selesai'] <> '' and $nilai['ujian_berlangsung'] <> '' and $nilai['browser']=='1') {
                        $selisih = strtotime($nilai['ujian_selesai']) - strtotime($nilai['ujian_mulai']);
                        $ket = "<h5><span class='badge bg-success'>Ujian Selesai</span></h5>";
                        $btn = "<button class='btn btn-sm btn-icon btn-icon-only btn-light' disabled><i class='material-icons'>lock</i></button>";
						if($nilai['nilai'] < $setting['kkm']):
					     $btn2 = "<button data-id='$nilai[id_nilai]' class='ulangi btn btn-sm btn-icon btn-light' disabled><i class='material-icons'>lock</i></button>";
					    else:
						$btn2 = "<button class='btn btn-sm btn-icon btn-icon-only btn-light' disabled><i class='material-icons'>lock</i>Selesai</button>";
						endif;
						$totaljawaban = $nilai['jumjawab'];
						 
					} elseif ($nilai['ujian_mulai'] <> '' and $nilai['ujian_selesai'] <> '' and $nilai['ujian_berlangsung'] <> '' and $nilai['browser']=='0') {
						   $totaljawaban = $nilai['jumjawab'];
						$ket = "<label>Selesai - tidak terjawab semua</label>";
                       if($nilai['hapus']==1):
					   $btn = "<button data-id='$nilai[id_nilai]' class='reset btn btn-sm btn-icon btn-warning' ><i class='material-icons'>delete</i> Minta Reset</button>";                  					  
					   $minta = "<h5><span data-id='$nilai[id_nilai]' class='badge bg-danger'>Minta Reset</span></h5>";
					    else :
						$btn = "<button  class='btn btn-sm btn-icon btn-icon-only btn-light'><i class='material-icons'>lock</i></button>";
						endif;
					   $btn2 = "<button data-idp='$nilai[id_nilai]' class='selesai btn btn-sm btn-icon btn-icon btn-danger'><i class='material-icons'>edit</i>Selesai</button>";
					
					} elseif ($nilai['ujian_mulai'] <> '' and $nilai['ujian_selesai'] == '' and $nilai['ujian_berlangsung'] <> '' and $nilai['browser']=='0') {
                        $selisih = strtotime($nilai['ujian_berlangsung']) - strtotime($nilai['ujian_mulai']);
                          $totaljawaban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_bank='$nilai[id_bank]' AND id_siswa='$nilai[id_siswa]'"));
                        $ket = "<img src='../images/animasi.gif' width='30px'> Sedang dikerjakan";
                        $btn = "<button  class='btn btn-sm btn-icon btn-icon-only btn-light'><i class='material-icons'>lock</i></button>";
                    	$btn2 = "<button  class='btn btn-sm btn-icon btn-icon-only btn-light'><i class='material-icons'>lock</i></button>";
					
					} else{
						$ket = "<h5><span class='badge badge-danger'>Error</span></h5>";
                         $btn = "<button data-id='$nilai[id_nilai]' class='kosongkan btn btn-sm btn-icon btn-icon-only btn-danger' ><i class='material-icons'>delete</i>Reset</button>";                  
							$btn2 = "<button  class='btn btn-sm btn-icon btn-icon-only btn-light'><i class='material-icons'>lock</i></button>";
					}
                }
            ?>
                <tr>
                    <td><?= $no ?></td>
					<td>
                    <?= $siswa['kelas'] ?> | <?= $siswa['nama'] ?>
					</td>
                    <td>
                    <?= $nilai['ipaddress'] ?>
					</td>
                    <td><h5><span class="badge bg-primary">Soal <?= $totalsoal ?></span> <span class="badge bg-dark">Jawab <?= $totaljawaban ?></span> </h5></td>
                    <td><?= $ket ?> 
					<?php if($brows >=1): ?>
					<?= $minta ?>
					<?php endif; ?>
					</td>
					
                    <td>
					<?= $btn ?>
					<?= $btn2 ?>
					<?= $btn3 ?>
					</td>
                  
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
</div>
 </div>
  
     <script>
   
           $('#datab').on('click', '.reset', function() {
			var id = $(this).data('id');
			console.log(id);
				Swal.fire({
					title: 'Yakin Reset Data Ujian ?',
					text: "Informasi : Jangan khawatir Data Jawaban tidak terhapus saat di reset",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Reset!',
					cancelButtonText: "Batal"				  
					}).then((result) => {
					if (result.value) {
						$.ajax({
						url: 'pengawas/tsiswa.php?pg=hapus',
						method: "POST",
						data: 'id=' + id,
						success: function(data) {
						Swal.fire(
						'Deleted!',
						'Peserta berhasil direset.',
						'success'
						) 
						setTimeout(function() {
						window.location.reload();
								}, 1000);
							}
						});
					}
					return false;
					})
			});
     $('#datab').on('click', '.kosongkan', function() {
			var id = $(this).data('id');
			console.log(id);
				Swal.fire({
					title: 'Yakin Reset Data Ujian Error?',
					text: "Informasi : Data Jawaban akan ikut dihapus",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Reset!',
					cancelButtonText: "Batal"				  
					}).then((result) => {
					if (result.value) {
						$.ajax({
						url: 'pengawas/tsiswa.php?pg=reset',
						method: "POST",
						data: 'id=' + id,
						success: function(data) {
						Swal.fire(
						'Deleted!',
						'Data berhasil direset.',
						'success'
						) 
						setTimeout(function() {
						window.location.reload();
								}, 1000);
							}
						});
					}
					return false;
					})
			});
			$('#datab').on('click', '.selesai', function() {
			var idp = $(this).data('idp');
			console.log(idp);
				Swal.fire({
					title: 'Yakin Akan Selesai Paksa ?',
					text: "Informasi : Jka dipaksa selesai maka siswa sudah tidak dapat lanjut Ujian pada mapel ini",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Selesai !',
					cancelButtonText: "Batal"				  
					}).then((result) => {
					if (result.value) {
						$.ajax({
						url: 'pengawas/tsiswa.php?pg=selesai',
						method: "POST",
						data: 'idp=' + idp,
						success: function(data) {
						Swal.fire(
						'Deleted!',
						'Ujian telah diselesaikan.',
						'success'
						) 
						setTimeout(function() {
						window.location.reload();
								}, 1000);
							}
						});
					}
					return false;
					})
			});
			 $('#datab').on('click', '.ulangi', function() {
			var id = $(this).data('id');
			console.log(id);
				Swal.fire({
					title: 'Yakin Ulang Ujian',
					text: "Informasi : Data Nilai akan dihapus",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Ulang',
					cancelButtonText: "Batal"				  
					}).then((result) => {
					if (result.value) {
						$.ajax({
						url: 'pengawas/tsiswa.php?pg=ulang',
						method: "POST",
						data: 'id=' + id,
						success: function(data) {
						Swal.fire(
						'Deleted!',
						'Data berhasil direset.',
						'success'
						) 
						setTimeout(function() {
						window.location.reload();
								}, 1000);
							}
						});
					}
					return false;
					})
			});
			
			</script>
			 