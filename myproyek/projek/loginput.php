                         <?php
							require("../../config/koneksi.php");
								require("../../config/function.php");
								require("../../config/crud.php");
								  ?>
								  <div class="row">
								<?php
								
						
							$query = mysqli_query($koneksi, "SELECT * FROM nilai_proyek GROUP BY kelas"); 
						while ($data = mysqli_fetch_array($query)) :												 
						$nil = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proyek WHERE kelas='$data[kelas]' GROUP BY idsiswa"));
								$jmer = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$data[kelas]' "));			  

												  ?>
						 <div class="col-xl-6">
                               
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/user.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">NILAI PROYEK</span>
                                                    <span class="widget-payment-request-author-about">WALI KELAS <?= $data['kelas'] ?></span>
                                                 <span class="badge badge-secondary">KELAS <?= $data['kelas'] ?></span>
														
														
												</div>
                                            </div>
                                              
                                        <div class="widget widget-list">
                                        <ul class="widget-list-content list-unstyled">
                                            <li class="widget-list-item widget-list-item-green">
                                                
                                                <span class="widget-list-item-description">
                                                  
												   <a href="#" class="widget-list-item-description-title">
                                                      <?= $nil ?>  dari <?= $jmer ?> data
                                                    </a>
                                                    <span class="widget-list-item-description-progress">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($nil/$jmer)*100; ?>%;" aria-valuenow="<?= ($nil/$jmer)*100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
														
                                                </span>
												 </span>	
                                            </li>
                                           
                                        </ul>
                                   </div>
								   </div>
                                  
                                </div>
                            </div>
                       <?php endwhile; ?>
					    </div>