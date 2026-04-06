<?php
require("../../config/koneksi.php");
require("../../config/function.php");
require("../../config/crud.php");

$jmer = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa JOIN kelas ON kelas.kelas=siswa.kelas WHERE kelas.kurikulum='K-Merdeka'"));
$nil = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proyek GROUP BY idsiswa"));
$pros = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proses"));

?>
		
				
				
				
				 <ul class="widget-list-content list-unstyled">
                                            <li class="widget-list-item widget-list-item-green">
                                                <span class="widget-list-item-icon"><i class="material-icons-outlined">article</i></span>
                                                <span class="widget-list-item-description">
                                                    <a href="#" class="widget-list-item-description-title">
                                                        <p>Nilai Proyek </p> <?= $nil ?> dari <?= $jmer ?> data
                                                    </a>
                                                    <span class="widget-list-item-description-progress">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= ($nil/$jmer)*100; ?>%;" aria-valuenow=" <?= ($nil/$jmer)*100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </span>
                                                </span>
                                            </li>
											 <li class="widget-list-item widget-list-item-blue">
                                                <span class="widget-list-item-icon"><i class="material-icons-outlined">verified_user</i></span>
                                                <span class="widget-list-item-description">
                                                    <a href="#" class="widget-list-item-description-title">
                                                      <p> Catatan Proses </p> <?= $pros ?> dari <?= $jmer ?> data
                                                    </a>
                                                    <span class="widget-list-item-description-progress">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($pros/$jmer)*100; ?>%;" aria-valuenow="<?= ($pros/$jmer)*100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </span>
                                                </span>
                                            </li>
				
				
							