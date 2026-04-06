                  <div class='row'>
                        <div class='col-md-12'>
                        </div>
                        <div id="boxtampil" class='col-md-12'>
                            <div id='formjadwalujian' class='box box-solid'>
                                <div class='box-header with-border'>
                                    <h3 class='box-title'><i class="fas fa-calendar-alt"></i> Jadwal Asesmen Hari ini</h3>
                               <div class='box-tools'>
                                        <h3 style="color:red;font-weight:bold;" id='waktu'> </h3>
                                    </div> 
                                </div>
                                <div class='box-body'>
                                    <?php

                                    $mapelQ = mysqli_query($koneksi, "SELECT * FROM ujian WHERE level='$level'  AND sesi='$idsesi' AND status='1'  ORDER BY tgl_ujian ");

                                    ?>
                                    <?php while ($mapelx = mysqli_fetch_array($mapelQ)) : ?>
                                        <?php if (date('Y-m-d', strtotime($mapelx['tgl_selesai'])) >= date('Y-m-d') and date('Y-m-d', strtotime($mapelx['tgl_ujian'])) <= date('Y-m-d')) : ?>
                                        <?php $datalevel = $mapelx['level']; ?>
                                           <?php $datajurusan = $mapelx['pk']; ?>	   
                                                <?php if ($siswa['level']==$datalevel) : ?>   
                                                <?php if ($datajurusan == $siswa['jurusan'] or $datajurusan=='semua') : ?> 
                                                    <?php
                                                    $no++;                                                   
                                                    $where = array(                                                     
                                                        'id_bank' => $mapelx['id_bank'],
                                                        'id_siswa' => $id_siswa                                                     
                                                    );
                                                    $nilai = fetch($koneksi, 'nilai', $where);
                                                    $ceknilai = rowcount($koneksi, 'nilai', $where);
                                                    if ($ceknilai == '0') :
                                                        if (strtotime($mapelx['tgl_ujian']) <= time() and time() <= strtotime($mapelx['tgl_selesai'])) :
                                                            $status = '<label class="label label-success">Tersedia </label>';
                                                            $btntest = "<button data-id='$mapelx[id_ujian]' data-ids='$id_siswa' class='btnmulaitest btn btn-block btn-sm btn-primary'><i class='fa fa-edit'></i> MULAI</button>";
                                                        elseif (strtotime($mapelx['tgl_ujian']) >= time() and time() <= strtotime($mapelx['tgl_selesai'])) :
                                                            $status = '<label class="label label-danger">Belum Waktunya</label>';
                                                            $btntest = "<button' class='btn btn-block btn-sm btn-danger disabled'> BELUM UJIAN</button>";
                                                        else :
                                                            $status = '<label class="label label-danger">Telat Ujian</label>';
                                                            $btntest = "<button' class='btn btn-block btn-sm btn-danger disabled'> Telat Ujian</button>";
                                                        endif;
                                                    else :
                                                        if ($nilai['ujian_mulai'] <> '' and $nilai['ujian_berlangsung'] <> '' and $nilai['ujian_selesai'] == '') :
                                                            
                                                            if ($mapelx['reset'] == 1) {
                                                                if($nilai['online']==0){
                                                                $status = '<label class="label label-warning">Berlangsung</label>';
                                                                $btntest = "<button data-id='$mapelx[id_ujian]' data-ids='$id_siswa' class='btn-lanjut btn btn-block btn-sm btn-success'><i class='fas fa-edit'></i> LANJUTKAN</button>";
                                                                }else{
                                                                $status = '<label class="label label-warning">Siswa sedang aktif</label>';
                                                                $btntest = "<button  class=' btn btn-block btn-danger'><i class='fas fa-edit'></i> Minta Reset</button>";
                                                                }
                                                            } else {
																
                                                                $status = '<label class="label label-warning">Berlangsung</label>';
                                                                $btntest = "<button data-id='$mapelx[id_ujian]' data-ids='$id_siswa' class='btn-lanjut btn btn-block btn-sm btn-success'><i class='fas fa-edit'></i> LANJUTKAN</button>";
																
                                                            } 
                                                         else :
                                                            if ($nilai['ujian_mulai'] <> '' and $nilai['ujian_berlangsung'] <> '' and $nilai['ujian_selesai'] <> '') {
                                                                if($mapelx['ulang_kkm']==0){
                                                                $status = '<label class="label label-primary">Selesai</label>';
                                                                $btntest = "<button class='btn btn-block btn-success btn-sm disabled'> Sudah Ujian</button>";
                                                                }else{
                                                                    if($nilai['skor']>=$mapelx['kkm']){
                                                                        $btntest = "<button class='btn btn-success btn-block btn-sm '>Kamu Lulus - Skor : ".$nilai['skor']."</button>";  
                                                                    } else{
                                                                        $btntest = "<button data-id='".$nilai['id_nilai']."' class='btn btn-ulang btn-warning btn-block btn-sm '>Belum Lulus - Skor : ".$nilai['skor']."</button>";   
                                                                    }
                                                                }
                                                            } else {
                                                                $btntest = "<button class='btn btn-block btn-danger btn-sm disabled'> Error</button>";
                                                            }
                                                        endif;
                                                    endif;
                                                    ?>
                                                     <?php if ($mapelx['soal_agama'] <> null) : ?>
                                                        <?php if ($mapelx['soal_agama'] == $siswa['agama']) : ?>
                                                             <?php $pel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE kode='$mapelx[nama]'")); ?>
                                                            <div class="col-md-4 animated tada" >
                                                                <div class="box box-widget widget-user-2">
                                                                   
                                                                   <div class="widget-user-header" style="padding: 6px">
                                                                    <div class="widget-user-image">
                                                                        <img src="images/<?=$setting['logo'] ?>" alt="" width="65">
                                                                    </div>
                                                                   
                                                                    <h5 class="widget-user-usernam">
																	<?= $pel['nama_mapel'];?>
																    </h5>
                                                                      
                                                                    <h5 class="widget-user-desc">
                                                                        <i class="fa fa-tag"></i> <?= $mapelx['kode_ujian'] ?> &nbsp;
                                                                        <i class="fa fa-user"></i> <?= $mapelx['level'] ?> &nbsp;
                                                                        <i class="fa fa-wrench"></i>  <?= $mapelx['kode_nama'] ?> &nbsp;
                                                                    </h5>
                                                                    </div>
                                                                    <div class="box-footer no-padding" style="background-color:white">
                                                                        <ul class="nav nav-stacked">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <i class='fa fa-clock-o'></i> Ujian Dimulai
                                                                                    <span class="pull-right"><?= $mapelx['tgl_ujian'] ?></span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <i class='fa fa-clock-o'></i> Ujian Ditutup
                                                                                    <span class="pull-right"><?= $mapelx['tgl_selesai'] ?></span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <i class='fa  fa-hourglass-1'></i> Durasi Ujian
                                                                                    <span class="pull-right"><?= $mapelx['tampil_pg'] + $mapelx['tampil_esai'] + $mapelx['tampil_multi'] + $mapelx['tampil_bs'] + $mapelx['tampil_urut'];  ?> Soal / <?= $mapelx['lama_ujian'] ?> menit</span>
                                                                                </a>
                                                                            </li>
                                                                            <li><a href="#"><i class='fa fa-feed'></i> Status Ujian <span class="pull-right">
                                                                                        <?php
                                                                                        if ($mapelx['status'] == 1) {
                                                                                            echo "<i class='fa fa-spinner fa-spin'></i> <label>Sedang Aktif</label> <label class='badge bg-red'>Sesi $mapelx[sesi]</label>";
                                                                                        } elseif ($mapelx['status'] == 0) {
                                                                                            echo "<label class='badge bg-red'>Tidak Aktif</label>";
                                                                                        }
                                                                                        ?>
                                                                                    </span></a></li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <i class='fa  fa-hourglass-1'></i> Status Test
                                                                                    <span class="pull-right"><?= $status ?></span>
                                                                                </a>
                                                                            </li>
																			
                                                                        </ul>
                                                                        <center style="padding: 8px">
                                                                            <?= $btntest ?>
                                                                        </center>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else : ?>
													<?php $pel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE kode='$mapelx[nama]'")); ?>
                                                        <div class="col-md-4 animated tada">

                                                            <div class="box box-widget widget-user-2">
                                                            
                                                                <div class="widget-user-header" style="padding: 6px">
                                                                    <div class="widget-user-image">
                                                                        <img src="images/<?=$setting['logo'] ?>" alt="" width="65">
                                                                    </div>
                                                                   
                                                                    <h5 class="widget-user-usernam">
																	<?= $pel['nama_mapel'];?>
																    </h5>
                                                                      
                                                                    <h5 class="widget-user-desc">
                                                                        <i class="fa fa-tag"></i> <?= $mapelx['kode_ujian'] ?> &nbsp;
                                                                        <i class="fa fa-user"></i> <?= $mapelx['level'] ?> &nbsp;
                                                                        <i class="fa fa-wrench"></i>  <?= $mapelx['kode_nama'] ?> &nbsp;
                                                                    </h5>
															  
                                                                      
                                                                   	
                                                                </div>
                                                                <div class="box-footer no-padding" style="background-color:white">
                                                                    <ul class="nav nav-stacked" style="background-color:white">
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class='fa fa-clock-o'></i> Ujian Dimulai
                                                                                <span class="pull-right"><?= $mapelx['tgl_ujian'] ?></span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class='fa fa-clock-o'></i> Ujian Ditutup
                                                                                <span class="pull-right"><?= $mapelx['tgl_selesai'] ?></span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class='fa  fa-hourglass-1'></i> Durasi Ujian
                                                                                <span class="pull-right"><?= $mapelx['tampil_pg'] + $mapelx['tampil_esai'] + $mapelx['tampil_multi'] + $mapelx['tampil_bs'] + $mapelx['tampil_urut'];  ?> Soal / <?= $mapelx['lama_ujian'] ?> menit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li><a href="#"><i class='fa fa-feed'></i> Status Ujian <span class="pull-right">
                                                                                    <?php
                                                                                    if ($mapelx['status'] == 1) {
                                                                                        echo "<i class='fa fa-spinner fa-spin'></i> <label>Sedang Aktif</label> <label class='badge bg-red'>Sesi $mapelx[sesi]</label>";
                                                                                    } elseif ($mapelx['status'] == 0) {
                                                                                        echo "<label class='badge bg-red'>Tidak Aktif</label>";
                                                                                    }
                                                                                    ?>
                                                                                </span></a></li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class='fa  fa-hourglass-1'></i> Status Test
                                                                                <span class="pull-right"><?= $status ?></span>
                                                                            </a>
                                                                        </li>                                                                
														                 
                                                                    </ul>
                                                                    <center style="padding: 8px">
                                                                        <?= $btntest ?>
                                                                    </center>			
																	
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                           <?php endif; ?>
										   <?php else: ?>
										   <div class="col-md-4">
                                            <div class="box box-widget widget-user-2">
                                               <div class="widget-user-header" style="padding: 6px">
                                                  <div class="widget-user-image">
                                                     <img src="images/icon/ujian.png" alt="">
                                                          </div>
										        <h5 class="widget-user" style="color:red;font-weight:bold;">
												BELUM ADA JADWAL ASESMEN </h5>
                                                  <img style="display: block;;float:right;margin-top:-33px;" src="images/<?=$setting['logo'] ?>" alt="" width="65">
									            
												 </div>
                                    <div class='alert alert-info alert-dismissible'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
										<i class='icon fa fa-info'></i>
										Tombol ujian akan aktif bila waktu sudah sama dengan jadwal ujian,
										Refresh browser atau tekan F5 jika waktu ujian belum aktif
										</div>
										 <div class="modal-footer">
										 <a href="logout.php" class="btn btn-danger">Log Out</a>
										  <a href="." class="btn btn-primary">Kembali</a>
										  <a href="?pg=jadwal" class="btn btn-success">Refresh</a>
										</div>       
                                            </div>
                                              </div>
                                              
                                          <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
				
                    <script>
                        $(document).on('click', '.btnmulaitest', function() {
                            var idm = $(this).data('id');
                            var ids = $(this).data('ids');
                            console.log(idm + '-' + ids);

                            $.ajax({
                                type: 'POST',
                                url: 'konfirmasi.php',
                                data: 'idm=' + idm + '&ids=' + ids,
                                success: function(response) {
                                    $('#formjadwalujian').hide();
                                    $('#boxtampil').html(response).slideDown();

                                }
                            });

                        });
						$(document).on('click', '.btn-lanjut', function() {
                            var idn = $(this).data('id');
                             var ids = $(this).data('ids');
                            console.log(idn);
                                swal({
                                    title: 'Lanjut Ujian ?',
                                    html: 'Anda telah keluar dari Aplikasi Jawaban akan dihapus semua oleh sistem !',
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Iya'
                                }).then((result) => {
                                    if (result.value) {
                                        $.ajax({
                                            type: 'POST',
                                            url: 'status.php?pg=ulangujian',
                                            data: 'id=' + idn + '&ids=' + ids,
                                            success: function(response) {
                                               location.reload();
                                            }
                                        });
                                    }
                                })
                           

                        });
						
                    </script>
					