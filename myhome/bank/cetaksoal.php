<?php
	require("../../konek/koneksi.php");
	require("../../konek/function.php");
	require("../../konek/crud.php");
	require("../../konek/dis.php");
	
	
	$id_bank = $_GET['id'];
	
	$user = fetch($koneksi, 'pegawai',array('id_pegawai'=>$id_pegawai));
	$mapel=mysqli_fetch_array(mysqli_query($koneksi, "select * from banksoal where id_bank='$id_bank'"));
	$guru = fetch($koneksi, 'pegawai',array('id_pegawai'=>$mapel['idguru']));
	
	if(date('m')>=7 AND date('m')<=12) {
		$ajaran = date('Y')."/".(date('Y')+1);
	}
	elseif(date('m')>=1 AND date('m')<=6) {
		$ajaran = (date('Y')-1)."/".date('Y');
	}
	?>
	
	
				<style>
		* {
			margin: auto;
			padding: 0;
			line-height: 100%;
		}

		td {
			padding: 1px 3px 1px 3px;
		}

		.garis {
			border: 1px solid #000;
			border-left: 0px;
			border-right: 0px;
			padding: 1px;
			margin-top: 5px;
			margin-bottom: 5px;
		}
	</style>
			
			<table width="100%">
			<tr>
			<td rowspan='5'>
				<img src="../../images/<?= $setting['logo'] ?>" width='90px'/>
			</td>
			<td width=200>Mata Pelajaran </td>
			<td width=200>: <?= $mapel['nama'] ?></td> 
			<td rowspan='5' width=400></td>					
			</tr>
			<tr>
				<td>Jenis Soal </td>
				<td>: <?= $mapel['groupsoal'] ?></td>
			</tr>
			<tr>
				<td>Tingkat | Jurusan </td>
				<td>: <?= $mapel['level'] ?> | <?= $mapel['pk'];  ?></td>
			</tr>
			<tr>
				<td>Pembuat Soal</td>
				<td>: <?= $guru['nama'] ?></td>
			</tr>
			<tr>
				<td>Satuan Pendidikan</td>
				<td width=400>: <?= $setting['sekolah'] ?></td>
			</tr>
			</table>
			<div class='garis'></div>
			
				        <br/>
				
			                        <table  class='table' width="100%">
                                        <tbody>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$id_bank'  order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>

                                                <tr>
                                                    <td style='width:30px'>
                                                        <?= $soal['nomor'] ?>
                                                    </td>
                                                    <td style="text-align:justify">
                                                        <?php
                                                        if ($soal['file'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-bottom: 5px'><img src='$baseurl/files/$soal[file]' style='max-width:100px;'/></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-bottom: 5px'><audio controls><source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
                                                        <?= $soal['soal']; ?>
                                                        <?php
                                                        if ($soal['file1'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file1']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-top: 5px'><img src='$baseurl/files/$soal[file1]' style='max-width:200px;' /></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-top: 5px'><audio controls><source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														<?php if ($soal['jenis'] == '1') : ?>
                                                        <table width="100%">
                                                            <tr>
                                                                <td style="padding: 3px;width: 2%; vertical-align: text-top;">A.</td>
                                                                <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                    <?php
                                                                    if ($soal['pilA'] <> '') {
                                                                        echo "$soal[pilA] ";
                                                                    }

                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileA]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
																 <?php if ($soal['pilC'] <>'') : ?>
                                                                <td style="padding: 3px;width: 2%; vertical-align: text-top;">C.</td>
                                                                <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                    <?php
                                                                    if (!$soal['pilC'] == "") {
                                                                        echo "$soal[pilC] ";
                                                                    }

                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileC]' style='max-width:100px;' />";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
																  <?php endif; ?>
                                                                <?php if ($soal['pilE'] <>'') : ?>
                                                                    <td style="padding: 3px;width: 2%; vertical-align: text-top;">E.</td>
                                                                    <td style="padding: 3px; vertical-align: text-top;">
                                                                        <?php
                                                                        if (!$soal['pilE'] == "") {
                                                                            echo "$soal[pilE] ";
                                                                        }

                                                                        if ($soal['fileE'] <> '') {
                                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                            $ext = explode(".", $soal['fileE']);
                                                                            $ext = end($ext);
                                                                            if (in_array($ext, $image)) {
                                                                                echo "<img src='$baseurl/files/$soal[fileE]' style='max-width:100px;' />";
                                                                            } elseif (in_array($ext, $audio)) {
                                                                                echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                            } else {
                                                                                echo "File tidak didukung!";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                <?php endif; ?>

                                                            </tr>

                                                            <tr>
															<?php if ($soal['pilB']<>'') : ?>
                                                                <td style="padding: 3px;width: 2%; vertical-align: text-top;">B.</td>
                                                                <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                    <?php
                                                                    if (!$soal['pilB'] == "") {
                                                                        echo "$soal[pilB] ";
                                                                    }

                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileB]' style='max-width:100px;' />";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
																 <?php endif; ?>
                                                                <?php if ($soal['pilD'] <>'') : ?>
                                                                    <td style="padding: 3px;width: 2%; vertical-align: text-top;">D.</td>
                                                                    <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                        <?php
                                                                        if (!$soal['pilD'] == "") {
                                                                            echo "$soal[pilD] ";
                                                                        }

                                                                        if ($soal['fileD'] <> '') {
                                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                            $ext = explode(".", $soal['fileD']);
                                                                            $ext = end($ext);
                                                                            if (in_array($ext, $image)) {
                                                                                echo "<img src='$baseurl/files/$soal[fileD]' style='max-width:100px;' />";
                                                                            } elseif (in_array($ext, $audio)) {
                                                                                echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                            } else {
                                                                                echo "File tidak didukung!";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                <?php endif; ?>

                                                            </tr>

                                                        </table>
                                                       														
														<?php endif; ?>
														
													
													<?php if ($soal['jenis'] == '3') : ?>
													 <table width="100%">
													 <tr>
														      <td style="padding: 3px;width: 2%; vertical-align: text-top;">A.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"><?= $soal['pilA'] ?></td>
															  <?php if ($soal['pilB'] <>''){ ?>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;">B.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"> <?= $soal['pilB'] ?></td>
															<?php } ?>
															</tr>
															 <tr>
															  <?php if ($soal['pilC'] <>''){ ?>
														      <td style="padding: 3px;width: 2%; vertical-align: text-top;">C.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"><?= $soal['pilC'] ?></td>
															 	<?php } ?>
															 <?php if ($soal['pilD'] <>''){ ?>
															<td style="padding: 3px;width: 2%; vertical-align: text-top;">D.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"> <?= $soal['pilD'] ?></td>
															<?php } ?>
															</tr>
															
															  <?php if ($soal['pilE'] <>''){ ?>
															<tr>
														      <td style="padding: 3px;width: 2%; vertical-align: text-top;">E.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"><?= $soal['pilE'] ?></td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"></td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"> </td>
															
															</tr>
															<?php } ?>
															</table>
															
                                                    <?php endif; ?>
													
													
													<?php if ($soal['jenis'] == '4' ) : ?>
													 <table width="100%" class='table'>
													  <?php if ($soal['pilA']<>''){ ?>
													 <tr>									 
															<td class="text-center" ><b>Pernyataan</b></td>
															<td class="text-center" width="5%" ><b>Benar</b></td>
															<td class="text-center" width="5%" ><b>Salah</b></td>														
															</tr>
                                                         <?php }else{ ?>
													 <tr>															
															<td class="text-center" width="5%" ><b>Benar</b></td>
															<td class="text-center" width="5%" ><b>Salah</b></td>															
															</tr>
													 <?php } ?>   
															<tr>
															<?php if ($soal['pilA']<>''){ ?>
															<td><?= $soal['pilA'] ?></td>
															<?php } ?>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>1"></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>1"></td>			
															</tr>
															
															<?php if ($soal['pilB']<>''){ ?>
															<tr>
														<?php if ($soal['pilB']<>''){ ?>
															<td><?= $soal['pilB'] ?></td>
															<?php } ?>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>2"></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>2"></td>											
															</tr>
															<?php } ?>
															<?php if ($soal['pilC']<>''){ ?>
															<tr>
															<?php if ($soal['pilC']<>''){ ?>
															<td><?= $soal['pilC'] ?></td>
															<?php } ?>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>3"></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>3"></td>
															</tr>
															<?php } ?>
															<?php if ($soal['pilD']<>''){ ?>
															<tr>
															<?php if ($soal['pilD']<>''){ ?>
															<td><?= $soal['pilD'] ?></td>
															<?php } ?>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>4"></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>4"></td>											
															</tr>
																<?php } ?>
														 <?php if ($soal['pilE']<>''){ ?>
															<tr>
															<?php if ($soal['pilE']<>''){ ?>
															<td><?= $soal['pilE'] ?></td>
															<?php } ?>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>5"></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>5"></td>
															
															</tr>
															<?php } ?>
															</table>
															
                                                    <?php endif; ?>
													<?php if ($soal['jenis'] == '5') : ?>
													 <table width="100%" class='table'>
													       <tr>
														  
															<td class="text-center" ><b>Pernyataan</b></td>	
															<td class="text-center" width="5%" ><b></b></td>	
															<td class="text-center" width="5%" ><b></b></td>	
                                                            <td class="text-center" ><b>Jawaban</b></td>	
																													
															</tr>
                                                           
															<tr>															
															<td><?= $soal['perA'] ?></td>															
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><?= $soal['pilA'] ?></td>															
															</tr>
															<?php if ($soal['pilB']<>''){ ?>
															<tr>															
															<td><?= $soal['perB'] ?></td>															
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><?= $soal['pilB'] ?></td>															
															</tr>
															<?php } ?>
															<?php if ($soal['pilC']<>''){ ?>
															<tr>															
															<td><?= $soal['perC'] ?></td>															
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><?= $soal['pilC'] ?></td>															
															</tr>
															<?php } ?>
															<?php if ($soal['pilD']<>''){ ?>
															<tr>															
															<td><?= $soal['perD'] ?></td>															
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><?= $soal['pilD'] ?></td>															
															</tr>
																<?php } ?>
															 <?php if ($soal['pilE']<>''){ ?>
															<tr>															
															<td><?= $soal['perE'] ?></td>															
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><input type="checkbox" name="<?= $soal['id_soal'] ?>1"></td>
															<td><?= $soal['pilE'] ?></td>															
															</tr>
															<?php } ?>
															</table>
                                                    <?php endif; ?>
													
                                                       
                                                    
													
                                                 
                                                
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
			                    