 


			 <div class="row">
                <?php
				
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM jadwal_refleksi WHERE tanggal='$tanggal' and kelas='$siswa[kelas]'");              
                while ($mapel = mysqli_fetch_array($mapelQ)) : 
				$pel = fetch($koneksi,'mapel',['id'=>$mapel['idmapel']]);
				?>
                    
				<div class="col-xl-4">
				 <a href="?pg=bukarefleksi&m=<?= $mapel['idmapel'] ?>&k=<?= $siswa['kelas'] ?>" style="text-decoration:none">
					<div class="card">
						<div class="card-body text-center">
						    <div class="d-flex align-items-center flex-column mb-0">
							<div class="d-flex align-items-center flex-column">
							<div class="sw-13 position-relative mb-0">
                    <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
                 
                    </div>
					<span style="font-size: 20px"> <b>REFLEKSI <?= $pel['kode']; ?></b></span>
                      <p>KELAS : <?= $siswa['kelas'] ?></p>
					     <span><?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?></span>
                      </div>  
                        </div>  
						 </div> 
                           </a>  
                            </div>
                       
                    
                <?php endwhile; ?>
				                           
          
            </div>
      