<?php 
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$tanggal = date('Y-m-d');
$tgl_lusa = date('Y-m-d', strtotime("-3 day", strtotime(date("Y-m-d"))));
$query = mysqli_query($koneksi,"SELECT id_siswa FROM siswa");
while ($data = mysqli_fetch_array($query)) :	
$jblok = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idsiswa='$data[id_siswa]' and ket='I' and tanggal between '$tgl_lusa' and '$tanggal'")); 
if($jblok==3):
mysqli_query($koneksi,"UPDATE siswa SET blokir='1' WHERE id_siswa='$data[id_siswa]'");											
endif;
endwhile;	
$jreg = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM datareg"));
$jsurat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM surat where status='0'"));
$jblok = mysqli_num_rows(mysqli_query($koneksi, "SELECT blok FROM siswa WHERE blokir='1'"));
?>
				<div class="row">
							<div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">								
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-danger">
                                                <i class="material-icons-outlined">close</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">BLOKIR PRESENSI</span>
                                                <span class="widget-stats-amount"><?= $jblok; ?></span>
                                            </div>  
											<a href="?pg=<?= enkripsi('blokir') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">workspaces</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">REGISTRASI</span>
                                                <span class="widget-stats-amount"><?= $jreg; ?> </span>
                                               
                                            </div>
											<?php if($setting['mesin']=='1'): ?>
                                            <a href="?pg=<?= enkripsi('rfid') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
											<?php endif; ?>
											<?php if($setting['mesin']=='2'): ?>
											<a href="?pg=<?= enkripsi('barkode') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
											<?php endif; ?>	
											<?php if($setting['mesin']=='3'): ?>
											<a href="?pg=<?= enkripsi('finger') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
											<?php endif; ?>	
											
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                           
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">email</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PERMOHONAN</span>
                                                <span class="widget-stats-amount"><?= $jsurat; ?></span>
                                               
                                            </div>
                                             <a href="?pg=<?= enkripsi('surat') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>