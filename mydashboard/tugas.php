<?php
defined('APK') or exit('No access');
?>

				<div class="row">
                <?php         
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM tugas");
				while ($mapel = mysqli_fetch_array($mapelQ)) : ?>
                
                     
                        <?php  
						$datakelas = unserialize($mapel['kelas']);
                        $guru = fetch($koneksi, 'users', ['id_user' => $mapel['guru']]);
						$mpl = fetch($koneksi, 'mapel', ['id' => $mapel['mapel']]);
                       ?>
					 <?php  if (in_array($siswa['kelas'], $datakelas) or in_array('semua', $datakelas)) : ?>
					           <?php
							 $where = array(
								 'idsiswa' => $_SESSION['id_siswa'],
								 'tanggal' => $tanggal
								  );
							$datax = array(
								'idsiswa' => $_SESSION['id_siswa'],
								'kelas' => $siswa['kelas'],
								'tanggal' => date('Y-m-d'),
								'jam' => date('H:i:s'),
								'bulan'=> date('m'),
								'ket' => 'H',
								'tahun'=> date('Y')
								);			
							$cek = rowcount($koneksi, 'absensi_daring', $where);
							if ($cek == 0) {
							  insert($koneksi, 'absensi_daring', $datax);
								}
							?>          
                        <div class="col-xl-4">
					<?php if ($mapel['tgl_mulai'] > date('Y-m-d H:i:s') and $mapel['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
                           <div class="card">
						   <div class="card-body text-center">
						   TUGAS BELUM MULAI<br>
						    <img src="<?= $baseurl ?>/images/animasi.gif" class="responsive" alt="thumb" />
						     </div>
							  </div>
                    <?php } elseif ($mapel['tgl_mulai'] < date('Y-m-d H:i:s') and $mapel['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
				 <a href="?pg=bukatugas&id=<?= $mapel['id_tugas'] ?>" style="text-decoration:none">
					<div class="card">
						<div class="card-body text-center">
						    <div class="d-flex align-items-center flex-column mb-0">
							<div class="d-flex align-items-center flex-column">
							<div class="sw-13 position-relative mb-0">
                    <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
                    </div>
                <span style="font-size: 20px"> <b><?= $mpl['kode']; ?></b></span>
                      <p>Guru : <?= $guru['nama'] ?></p>
					   <?= $mapel['tgl_mulai'] ?> - <?= $mapel['tgl_selesai'] ?>
					     <span><?= $mapel['judul'] ?></span>
                    </div>
                      </div>  
                        </div>  
						 </div> 
                                </a>
                            </div>
                           
                                     
                    <?php } ?>
					
					 <?php endif; ?>
						
                <?php endwhile; ?>
 
            </div>
       