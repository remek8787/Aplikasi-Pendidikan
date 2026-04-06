
 <style>
 /* custom radio */
.radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
/* hide the browser's default radio button */
.radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
 
/* create custom radio */
.radio .check {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 50%;
}
 
/* on mouse-over, add border color */
.radio:hover input ~ .check {
    border: 2px solid #2489C5;
}
 
/* add background color when the radio is checked */
.radio input:checked ~ .check {
    background-color: #2489C5;
    border:none;
}
 
/* create the radio and hide when not checked */
.radio .check:after {
    content: "";
    position: absolute;
    display: none;
}
 
/* show the radio when checked */
.radio input:checked ~ .check:after {
    display: block;
}
 
/* radio style */
.radio .check:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
/* custom checkbox */
.checkbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
/* hide the browser's default checkbox */
.checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
 
/* create custom checkbox */
.check {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border: 1px solid #ccc;
}
 
/* on mouse-over, add border color */
.checkbox:hover input ~ .check {
    border: 2px solid #2489C5;
}
 
/* add background color when the checkbox is checked */
.checkbox input:checked ~ .check {
    background-color: #2489C5;
    border:none;
}
 
/* create the checkmark and hide when not checked */
.check:after {
    content: "";
    position: absolute;
    display: none;
}
 
/* show the checkmark when checked */
.checkbox input:checked ~ .check:after {
    display: block;
}
 
/* checkmark style */
.checkbox .check:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

</style>
 
 <?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");

$soalx = $_POST['soal'];
$soalx = dekripsi($soalx);
$decoded = json_decode($soalx, true);
$pengacak = $_POST['pengacak'];
$pengacak = explode(',', $pengacak);
$pengacakpil = $_POST['pengacakpil'];
$pengacakpil = explode(',', $pengacakpil);
$id_siswa = (isset($_SESSION['id_siswa'])) ? $_SESSION['id_siswa'] : 0;
$ujiannya = dekripsi($_POST['ujian']);
$mapel = json_decode($ujiannya, true);
$pg = @$_POST['pg'];
$ac = $mapel[0]['id_ujian'];
$id = @$_POST['id'];
$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
?>

<?php if ($pg == 'soal') { ?>




    <?php
    $no_soal = $_POST['no_soal'];
    $no_prev = $no_soal - 1;
    $no_next = $no_soal + 1;
    $id_bank = $_POST['id_bank'];
    $id_siswa = $_POST['id_siswa'];
    $where2 = array(
        'id_siswa' => $id_siswa,
        'id_bank' => $id_bank,
        'id_ujian' => $ac
    );
   
    update($koneksi, 'nilai', array('ujian_berlangsung' => $waktumu), $where2);
    $nilai = fetch($koneksi, 'nilai', $where2);
	 $habis = strtotime($nilai['ujian_berlangsung']) - strtotime($nilai['ujian_mulai']);
    $lamaujian = $mapel[0]['lama_ujian'] * 60;
	 $bolehselesai = $mapel[0]['btnselesai'] * 60;
    if ($nilai['ujian_selesai'] <> null) {
        jump("$baseurl");
    }
	
    $nomor = $_POST['no_soal'];
    $nosoal = $nomor;
    foreach ($decoded as $soal) {
		

        if ($soal['id_soal'] == $pengacak[$nosoal]) {
            $jawab = fetch($koneksi, 'jawaban', array('id_siswa' => $id_siswa, 'id_bank' => $id_bank, 'id_soal' => $soal['id_soal'],'jenis'=>$soal['jenis'], 'id_ujian' => $ac));
			
 ?>
            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='callout soal'>						 
                            <div class='soaltanya animated fadeIn' style="text-align:justify"><?= $soal['soal'] ?> </div>
                        </div>
					
                        <div class='col-md-12'> 
                            <?php
                            if ($soal['file'] <> '') {
                                $ext = explode(".", $soal['file']);
                                $ext = end($ext);
                                if (in_array($ext, $image)) {
                                    echo "<span  id='zoom' style='display:inline-block'> <img  src='$baseurl/files/$soal[file]' class='img-responsive'/></span>";
                                } elseif (in_array($ext, $audio)) {
                                    echo "<audio controls='controls' ><source src='$baseurl/files/$soal[file]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                } else {
                                    echo "File tidak didukung!";
                                }
                            }
                            if ($soal['file1'] <> '') {
                                $ext = explode(".", $soal['file1']);
                                $ext = end($ext);
                                if (in_array($ext, $image)) {
                                    echo "<span  id='zoom1' style='display:inline-block'> <img  src='$baseurl/files/$soal[file1]' class='img-responsive'/></span>";
                                } elseif (in_array($ext, $audio)) {
                                    echo "<audio controls='controls' ><source src='$baseurl/files/$soal[file1]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                } else {
                                    echo "File tidak didukung!";
                                }
                            }
                            ?>
                        </div>
                    </div>
					
                    <?php if ($soal['jenis'] == 1) { ?>
                        <div class='col-md-12'>
                            <?php if ($mapel[0]['ulang'] == '1') : ?>
                                <?php
                                if ($mapel[0]['opsi'] == 3) {
                                    $kali = 3;
                                } elseif ($mapel[0]['opsi'] == 4) {
                                    $kali = 4;
                                    $nop4 = $no_soal * $kali + 3;
                                    $pil4 = $pengacakpil[$nop4];
                                    $pilDD = "pil" . $pil4;
                                    $fileDD = "file" . $pil4;
                                } elseif ($mapel[0]['opsi'] == 5) {
                                    $kali = 5;
                                    $nop4 = $no_soal * $kali + 3;
                                    $pil4 = $pengacakpil[$nop4];
                                    $pilDD = "pil" . $pil4;
                                    $fileDD = "file" . $pil4;
                                    $nop5 = $no_soal * $kali + 4;
                                    $pil5 = $pengacakpil[$nop5];
                                    $pilEE = "pil" . $pil5;
                                    $fileEE = "file" . $pil5;
                                }

                                $nop1 = $no_soal * $kali;
                                $nop2 = $no_soal * $kali + 1;
                                $nop3 = $no_soal * $kali + 2;
                                $pil1 = $pengacakpil[$nop1];
                                $pilAA = "pil" . $pil1;
                                $fileAA = "file" . $pil1;
                                $pil2 = $pengacakpil[$nop2];
                                $pilBB = "pil" . $pil2;
                                $fileBB = "file" . $pil2;
                                $pil3 = $pengacakpil[$nop3];
                                $pilCC = "pil" . $pil3;
                                $fileCC = "file" . $pil3;


                                $a = ($jawab['jawaban'] == 'A') ? 'checked' : '';
                                $b = ($jawab['jawaban'] == 'B') ? 'checked' : '';
                                $c = ($jawab['jawaban'] == 'C') ? 'checked' : '';

                                if ($mapel[0]['opsi'] == 4) :
                                    $d = ($jawab['jawaban'] == 'D') ? 'checked' : '';
                                elseif ($mapel[0]['opsi'] == 5) :
                                    $d = ($jawab['jawaban'] == 'D') ? 'checked' : '';
                                    $e = ($jawab['jawaban'] == 'E') ? 'checked' : '';
                                endif;


                                ?>
                                <?php if ($soal['pilA'] == '' and $soal['fileA'] == '' and $soal['pilB'] == '' and $soal['fileB'] == '' and $soal['pilC'] == '' and $soal['fileC'] == '' and $soal['pilD'] == '' and $soal['fileD'] == '') { ?>
                                    <?php
                                    $ax = ($jawab['jawaban'] == 'A') ? 'checked' : '';
                                    $bx = ($jawab['jawaban'] == 'B') ? 'checked' : '';
                                    $cx = ($jawab['jawaban'] == 'C') ? 'checked' : '';
                                    $dx = ($jawab['jawaban'] == 'D') ? 'checked' : '';
                                    if ($mapel[0]['opsi'] == 5) :
                                        $ex = ($jawab['jawaban'] == 'E') ? 'checked' : '';
                                    endif;
                                    ?>
                                    <table class='table'>
                                        <tr>
                                            <td>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='A' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'A','A',1,<?= $ac ?>)" <?= $ax ?> />
                                                <label class='button-label' for='A'>
                                                    <h1>A</h1>
                                                </label>
                                            </td>
                                            <?php if ($soal['pilC'] <>'') { ?>
                                            <td>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='C' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'C','C',1,<?= $ac ?>)" <?= $cx ?> />
                                                <label class='button-label' for='C'>
                                                    <h1>C</h1>
                                                </label>
                                            </td>
											 <?php } ?>
                                            <?php if ($soal['pilE'] <>'') { ?>
                                                <td>
                                                    <input class='hidden radio-label' type='radio' name='jawab' id='E' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'E','E',1,<?= $ac ?>)" <?= $ex ?> />
                                                    <label class='button-label' for='E'>
                                                        <h1>E</h1>
                                                    </label>

                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
										<?php if ($soal['pilB'] <>'') { ?>
                                            <td>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='B' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'B','B',1,<?= $ac ?>)" <?= $bx ?> />
                                                <label class='button-label' for='B'>
                                                    <h1>B</h1>
                                                </label>
                                            </td>
											 <?php } ?>
                                           <?php if ($soal['pilD'] <>'') { ?>
                                                <td>
                                                    <input class='hidden radio-label' type='radio' name='jawab' id='D' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'D','D',1,<?= $ac ?>)" <?= $dx ?> />
                                                    <label class='button-label' for='D'>
                                                        <h1>D</h1>
                                                    </label>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                <?php } else { ?>
                                    <table width='100%' class='table'>
                                        <tr>
                                          
                                            <td width='60'>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='A' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'<?= $pil1 ?>','A',1,<?= $ac ?>)" <?= $a ?> />
                                                <label class='button-label' for='A'>
                                                    <h1>A</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal[$pilAA] ?></span>
                                                <?php if ($soal[$fileAA] <> '') : ?>
                                                    <?php
                                                    $ext = explode(".", $soal[$fileAA]);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) :
                                                        echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[$fileAA]' class='img-responsive' style='width:250px;'/></span>";
                                                    elseif (in_array($ext, $audio)) :
                                                        echo "<audio controls='controls' ><source src='$baseurl/files/$soal[$fileAA]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    else :
                                                        echo "File tidak didukung!";
                                                    endif;
                                                    ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
										<?php if ($soal['pilB'] <>'') { ?>
                                        <tr>
                                          
                                            <td width='60'>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='B' onclick="jawabsoal(<?= $id_bank ?>, <?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'<?= $pil2 ?>','B',1, <?= $ac ?>)" <?= $b ?> />
                                                <label class='button-label' for='B'>
                                                    <h1>B</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal[$pilBB] ?></span>
                                                <?php
                                                if ($soal[$fileBB] <> '') {
                                                    $ext = explode(".", $soal[$fileBB]);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) :
                                                        echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[$fileBB]' class='img-responsive' style='width:250px;'/></span>";
                                                    elseif (in_array($ext, $audio)) :
                                                        echo "<audio controls='controls' ><source src='$baseurl/files/$soal[$fileBB]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    else :
                                                        echo "File tidak didukung!";
                                                    endif;
                                                }
                                                ?>
                                            </td>
                                        </tr>
										<?php } ?>
										<?php if ($soal['pilC'] <>'') { ?>
                                        <tr>
                                           
                                            <td>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='C' onclick="jawabsoal(<?= $id_bank ?>, <?= $id_siswa ?>, <?= $soal['id_soal'] ?>,'<?= $pil3 ?>','C',1,<?= $ac ?>)" <?= $c ?> />
                                                <label class='button-label' for='C'>
                                                    <h1>C</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal[$pilCC] ?></span>
                                                <?php
                                                if ($soal[$fileCC] <> '') {
                                                    $ext = explode(".", $soal[$fileCC]);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[$fileCC]' class='img-responsive' style='width:250px;'/></span>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$baseurl/files/$soal[$fileCC]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
										<?php } ?>
                                       <?php if ($soal['pilD'] <>'') { ?>
                                            <tr>
                                                <td>
                                                    <input class='hidden radio-label' type='radio' name='jawab' id='D' onclick="jawabsoal(<?= $id_bank ?>, <?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'<?= $pil4 ?>','D',1,<?= $ac ?>)" <?= $d ?> />
                                                    <label class='button-label' for='D'>
                                                        <h1>D</h1>
                                                    </label>
                                                </td>
                                                <td style='vertical-align:middle;'>
                                                    <span class='soal'><?= $soal[$pilDD] ?></span>
                                                    <?php
                                                    if ($soal[$fileDD] <> '') {
                                                        $ext = explode(".", $soal[$fileDD]);
                                                        $ext = end($ext);
                                                        if (in_array($ext, $image)) {
                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[$fileDD]' class='img-responsive' style='width:250px;'/></span>";
                                                        } elseif (in_array($ext, $audio)) {
                                                            echo "<audio controls='controls' ><source src='$baseurl/files/$soal[$fileDD]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                        } else {
                                                            echo "File tidak didukung!";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
									   <?php } ?>
                                     <?php if ($soal['pilE'] <>'') { ?>
                                            <tr>
                                                <td>
                                                    <input class='hidden radio-label' type='radio' name='jawab' id='E' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'<?= $pil5 ?>','E',1,<?= $ac ?>)" <?= $e ?> />
                                                    <label class='button-label' for='E'>
                                                        <h1>E</h1>
                                                    </label>
                                                </td>
                                                <td style='vertical-align:middle;'>
                                                    <span class='soal'><?= $soal[$pilEE] ?></span>
                                                    <?php
                                                    if ($soal[$fileEE] <> '') {
                                                        $ext = explode(".", $soal[$fileEE]);
                                                        $ext = end($ext);
                                                        if (in_array($ext, $image)) {
                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[$fileEE]' class='img-responsive' style='width:250px;'/></span>";
                                                        } elseif (in_array($ext, $audio)) {
                                                            echo "<audio controls='controls' ><source src='$baseurl/files/$soal[$fileEE]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                        } else {
                                                            echo "File tidak didukung!";
                                                        }
                                                    } ?>
                                                </td>
                                            </tr>
									 <?php } ?>
                                    </table>
                                <?php } ?>
                            <?php else : ?>
                                <?php

                                $a = ($jawab['jawaban'] == 'A') ? 'checked' : '';
                                $b = ($jawab['jawaban'] == 'B') ? 'checked' : '';
                                $c = ($jawab['jawaban'] == 'C') ? 'checked' : '';
                                if ($mapel[0]['opsi'] == 4) {
                                    $d = ($jawab['jawaban'] == 'D') ? 'checked' : '';
                                }
                                if ($mapel[0]['opsi'] == 5) {
                                    $d = ($jawab['jawaban'] == 'D') ? 'checked' : '';
                                    $e = ($jawab['jawaban'] == 'E') ? 'checked' : '';
                                }
                                ?>
                                <table width='100%' class='table'>
                                    <tr>
                                        <td width='60'>
                                            <input class='hidden radio-label' type='radio' name='jawab' id='A' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'A','A',1,<?= $ac ?>)" <?= $a ?> />
                                            <label class='button-label' for='A'>
                                                <h1>A</h1>
                                            </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilA'] ?></span>
                                            <?php
                                            if ($soal['fileA'] <> '') {
                                                $ext = explode(".", $soal['fileA']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$baseurl/files/$soal[fileA]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls'><source src='$baseurl/files/$soal[fileA]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
									 <?php if ($soal['pilB'] <>'') { ?>
                                    <tr>
                                        <td>
                                            <input class='hidden radio-label' type='radio' name='jawab' id='B' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'B','B',1,<?= $ac ?>)" <?= $b ?> />
                                            <label class='button-label' for='B'>
                                                <h1>B</h1>
                                            </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilB'] ?></span>
                                            <?php
                                            if ($soal['fileB'] <> '') {
                                                $ext = explode(".", $soal['fileB']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$baseurl/files/$soal[fileB]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$baseurl/files/$soal[fileB]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
									<?php } ?>
									 <?php if ($soal['pilC'] <>'') { ?>
                                    <tr>
                                        <td>
                                            <input class='hidden radio-label' type='radio' name='jawab' id='C' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'C','C',1,<?= $ac ?>)" <?= $c ?> />
                                            <label class='button-label' for='C'>
                                                <h1>C</h1>
                                            </label>

                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilC'] ?></span>
                                            <?php
                                            if ($soal['fileC'] <> '') {
                                                $ext = explode(".", $soal['fileC']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$baseurl/files/$soal[fileC]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$baseurl/files/$soal[fileC]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
									<?php } ?>
                                    <?php if ($soal['pilD'] <>'') { ?>
                                        <tr>
                                            <td>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='D' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'D','D',1,<?= $ac ?>)" <?= $d ?> />
                                                <label class='button-label' for='D'>
                                                    <h1>D</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilD'] ?></span>
                                                <?php
                                                if ($soal['fileD'] <> '') {
                                                    $ext = explode(".", $soal['fileD']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$baseurl/files/$soal[fileD]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$baseurl/files/$soal[fileD]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if  ($soal['pilE'] <>'') { ?>
                                        <tr>
                                            <td>
                                                <input class='hidden radio-label' type='radio' name='jawab' id='E' onclick="jawabsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'E','E',1,<?= $ac ?>)" <?= $e ?> />
                                                <label class='button-label' for='E'>
                                                    <h1>E</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilE'] ?></span>
                                                <?php
                                                if ($soal['fileE'] <> '') {

                                                    $ext = explode(".", $soal['fileE']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$baseurl/files/$soal[fileE]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$baseurl/files/$soal[fileE]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
					
                    <?php if ($soal['jenis'] == 2) { ?>
                        <div class='col-md-12'>
						<p> Isi Jawaban </p>
						<?php if($soal['jenisjawab']=='Teks'): ?>
                            <textarea id='jawabesai' name='textjawab' style='height:50px'  maxlength="<?= $soal['panjang'] ?>" class='form-control' onchange="jawabesai(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,2)"><?= $jawab['esai'] ?></textarea>
                          <?php else: ?>
                           <input type="text" maxlength="<?= $soal['panjang'] ?>" class="form-control"  id='jawabesai' name='textjawab'  onchange="jawabesai(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,2)" value="<?= $jawab['esai'] ?>">
                            <?php endif; ?>						  
						   <br><br>
							
                        </div>
                    <?php } ?>
               
				
			  <?php if ($soal['jenis'] == '3') { ?>
			  
			  <div class="col-md-12">
			   <form id='myForm'  method='POST' action='<?= $baseurl ?>/proses.php'>
                      <?php $checked = explode(', ',$jawab['jawabmulti']); ?>
                       <br></br>
                                <table width='100%' class='table'>
								 
                                    <tr>
                                        <td width='60'>
                                            <label style="margin-top:0px"  class="checkbox"><input type='checkbox' name='jawab[]' id='subA' value='A' <?php in_array ('A', $checked) ? print 'checked' : ''; ?> onclick="jawa(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'A','A',3,<?= $ac ?>)" <?= $a ?> />
                                             <span class="check"></span>
                                               </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                         <?php
                                                                    
                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileA]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
																
											<span class='soal'><?= $soal['pilA'] ?></span>
                                        </td>
                                    </tr>
									 <?php if ($soal['pilB'] <>'') { ?>
                                    <tr>
                                        <td>
                                           <label style="margin-top:0px" class="checkbox">  <input type='checkbox' name='jawab[]' id='subB' value='B' <?php in_array ('B', $checked) ? print 'checked' : ''; ?> onclick="jawa(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'B','B',3,<?= $ac ?>)" <?= $b ?> />
                                             <span class="check"></span>
                                               </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                     <?php
                                                                    
                                        if ($soal['fileB'] <> '') {
                                           $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                           $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                             $ext = explode(".", $soal['fileB']);
                                             $ext = end($ext);
                                             if (in_array($ext, $image)) {
                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileB]' style='max-width:100%;'/></span>";
                                            } elseif (in_array($ext, $audio)) {
                                           echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                            } else {
                                              echo "File tidak didukung!";
                                                  }
                                                 }
                                                 ?>
											 <span class='soal'><?= $soal['pilB'] ?></span>
                                        </td>
                                    </tr>
									 <?php } ?>
									 <?php if ($soal['pilC'] <>'') { ?>
                                    <tr>
                                        <td>
                                             <label style="margin-top:0px" class="checkbox"><input class='hidden radio-label' type='checkbox' name='jawab[]' id='subC' value='C' <?php in_array ('C', $checked) ? print 'checked' : ''; ?> onclick="jawa(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'C','C',3,<?= $ac ?>)" <?= $c ?> />
                                            <span class="check"></span>
                                               </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            
                                          <?php
                                                                    
                                                            if ($soal['fileC'] <> '') {
                                                             $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                             $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                             $ext = explode(".", $soal['fileC']);
                                                             $ext = end($ext);
                                                              if (in_array($ext, $image)) {
                                                              echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileC]' style='max-width:100%;'/></span>";
                                                               } elseif (in_array($ext, $audio)) {
                                                               echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                              } else {
                                                               echo "File tidak didukung!";
                                                                   }
                                                                }
                                                            ?>
															<span class='soal'><?= $soal['pilC'] ?></span>
                                        </td>
										
                                    </tr>
									 <?php } ?>
                                    <?php if ($soal['pilD'] <>'') { ?>
                                        <tr>
                                            <td>
                                               <label style="margin-top:0px" class="checkbox">  <input class='hidden radio-label' type='checkbox' name='jawab[]' id='subD' value='D' <?php in_array ('D', $checked) ? print 'checked' : ''; ?> onclick="jawa(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'D','D',3,<?= $ac ?>)" <?= $d ?> />
                                            <span class="check"></span>
                                               </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
															<?php
                                                                    
                                                                    if ($soal['fileD'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileD']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileD]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>                               
												 <span class='soal'><?= $soal['pilD'] ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                   <?php if ($soal['pilE'] <>'') { ?>
                                        <tr>
                                            <td>
                                              <label style="margin-top:0px" class="checkbox">  <input class='hidden radio-label' type='checkbox' name='jawab[]' id='subE' value='E' <?php in_array ('E', $checked) ? print 'checked' : ''; ?> onclick="jawa(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>,'E','E',3,<?= $ac ?>)" <?= $e ?> />
                                             <span class="check"></span>
                                               </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                               
                                                <?php
                                                if ($soal['fileE'] <> '') {

                                                    $ext = explode(".", $soal['fileE']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileE]' style='max-width:100%;'/></span>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$baseurl/files/$soal[fileE]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
												 <span class='soal'><?= $soal['pilE'] ?></span>
                                            </td>
											
                                        </tr>
                                    <?php } ?>
									  <tr>
                                            <td>
                                         
                                            </td>
                                            <td style='vertical-align:middle;'>
                                               
                                               
                                            </td>
											
                                        </tr>
                                </table>
								<input type='hidden' name='id_bank' value='<?= $id_bank ?>' >
								<input type='hidden' name='id_siswa' value='<?= $id_siswa ?>' >
								<input type='hidden' name='id_soal' value='<?= $soal['id_soal'] ?>' >
								<input type='hidden' name='id_ujian' value='<?= $ac ?>' >
							
											   </form>
											   <br></br>
                          
                       </div>
                         <?php } ?>
						 
				
						 
		                 <?php if ($soal['jenis'] == '4') { ?>
						 <?php $checked = explode(', ',$jawab['jawaban']); ?>
						  <div class='col-md-12'>
						   <form id='myForm3'  method='POST' action='<?= $baseurl ?>/proses3.php'>						                         
                          <table width='100%' class='table'>
													 <?php if ($soal['pilA']<>''){ ?>
													<tr style='vertical-align:middle;'>
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
													  <?php if ($soal['pilA'] <>'') : ?>
													 
															<tr style='vertical-align:middle;'>		
															<td style='vertical-align:middle;'>
															 <?php
                                                                    
                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                           echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileA]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
																
															 <span class='soal'><?= $soal['pilA'] ?></span>
															</td>
															<td class="text-center">						
															<label style="margin-top:0px" class="radio"><input type="radio" name="bs1" value="B"  id="bs1"  <?php if($checked[0]=='B'){echo "checked"; } ?>>
															<span class="check"></span></label>											
															</td>
															<td class="text-center">															
														   <label style="margin-top:0px" class="radio"><input type="radio" name="bs1" value="S" id="bs11"  <?php if($checked[0]=='S'){echo "checked"; } ?>>
															<span class="check"></span></label>											
															</td>															
															</tr>
															<?php endif; ?>
															
															  <?php if ($soal['pilB'] <>'') : ?>
															 
															<tr style='vertical-align:middle;'>										
																<td style='vertical-align:middle;'>
															<?php
                                                                    
                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileB]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
																
															<span class='soal'><?= $soal['pilB'] ?></span>
															</td>					
															<td class="text-center">
															<label style="margin-top:0px" class="radio"><input type="radio" name="bs2" value="B"  id="bs2"  <?php if($checked[1]=='B'){echo "checked"; } ?>>
											                <span class="check"></span></label>
															</td>
															<td class="text-center">
															 <label style="margin-top:0px" class="radio"><input type="radio" name="bs2" value="S" id="bs22"  <?php if($checked[1]=='S'){echo "checked"; } ?>>
											                <span class="check"></span></label>
															</td>															
															</tr>
															<?php endif; ?>
															
															  <?php if ($soal['pilC'] <>'') : ?>
															  
															<tr style='vertical-align:middle;'>
																<td style='vertical-align:middle;'>
															<?php
                                                                    
                                                            if ($soal['fileC'] <> '') {
                                                             $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                             $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                             $ext = explode(".", $soal['fileC']);
                                                             $ext = end($ext);
                                                              if (in_array($ext, $image)) {
                                                              echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileC]' style='max-width:100%;'/></span>";
                                                               } elseif (in_array($ext, $audio)) {
                                                               echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                              } else {
                                                               echo "File tidak didukung!";
                                                                   }
                                                                }
                                                            ?>
																	<span class='soal'><?= $soal['pilC'] ?></span>
															</td>
															<td class="text-center">
															<label style="margin-top:0px" class="radio"><input type="radio" name="bs3" value="B"  id="bs3" <?php if($checked[2]=='B'){echo "checked"; } ?>>
											               <span class="check"></span></label>
															</td>
															<td class="text-center">
															<label style="margin-top:0px" class="radio"><input type="radio" name="bs3" value="S" id="bs33"  <?php if($checked[2]=='S'){echo "checked"; } ?>>
															<span class="check"></span></label>
															</td>															
															</tr>
															<?php endif; ?>
															
															  <?php if ($soal['pilD'] <>'') : ?>
															  
															<tr style='vertical-align:middle;'>
																<td style='vertical-align:middle;'>
															<?php
                                                                    
                                                                    if ($soal['fileD'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileD']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileD]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
																<span class='soal'><?= $soal['pilD'] ?></span>
															
															</td>
															<td class="text-center">
															 <label style="margin-top:0px" class="radio"><input type="radio" name="bs4" value="B"  id="bs4"  <?php if($checked[3]=='B'){echo "checked"; } ?>>
															<span class="check"></span></label>
															</td>
															<td class="text-center">
															<label style="margin-top:0px" class="radio"><input type="radio" name="bs4" value="S" id="bs44"  <?php if($checked[3]=='S'){echo "checked"; } ?>>
															<span class="check"></span></label>
															</td>															
															</tr>
															<?php endif; ?>
															
															 <?php if ($soal['pilE'] <>'') : ?>
															 
															<tr style='vertical-align:middle;'>
																<td style='vertical-align:middle;'>
															<?php
                                                                    
                                                                    if ($soal['fileE'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileE']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                             echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileE]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
																	<span class='soal'><?= $soal['pilE'] ?></span>
															</td>
															<td class="text-center">
															<label style="margin-top:0px" class="radio"><input type="radio" name="bs5" value="B"  id="bs5" <?php if($checked[4]=='B'){echo "checked"; } ?>>
															<span class="check"></span></label>
															</td>
															<td class="text-center">
															<label  style="margin-top:0px" class="radio"><input type="radio" name="bs5" value="S" id="bs55"  <?php if($checked[4]=='S'){echo "checked"; } ?>>
															<span class="check"></span></label>
															</td>														
															</tr>
															<?php endif; ?>
															
															<tr>
                                            <td>
                                         
                                            </td>
                                            <td style='vertical-align:middle;'>
                                               
                                               
                                            </td>
											
                                        </tr>
									</table>
						   
						   
											 <br><br> <br><br>
								<input type='hidden' name='id_bank' value='<?= $id_bank ?>' >
								<input type='hidden' name='id_siswa' value='<?= $id_siswa ?>' >
								<input type='hidden' name='id_soal' value='<?= $soal['id_soal'] ?>' >
								<input type='hidden' name='id_ujian' value='<?= $ac ?>' >
								
								</form>
                           
                        </div>
                    <?php } ?>

					 
		        <?php if ($soal['jenis'] == '5') { ?>
						<?php 
						$checked = explode(', ',$jawab['jawaban']);
						$warna = explode(', ',$jawab['warna']); 
						$jmljdh = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jodoh WHERE id_siswa='$id_siswa' and id_bank='$id_bank' and jenis='5' and id_soal='$soal[id_soal]'"));

						?>				
					<div class='col-md-12'>							
									<table width="100%"  border="0">
									<tr>
										<td>
			                             <table width="49%" class='table'>
										<tr style='vertical-align:middle;'>
											<td colspan="3" class="soal">Pernyataan</td>	
										</tr>
                                        <?php if ($soal['perA'] <>'') : ?>
										<tr id="row1-5-1"  style='vertical-align:middle;' onClick="pilih1('5','1','#00BCD4','1')">
											<td  width="5%" class="soal"> 1). </td>
											<td class="soal"><?= $soal['perA'] ?></td>
											<td width="5%" >			
											<label style="margin-top:0px" class="checkbox"><input type="radio" name="rp1" id="P51<?= $soal['id_soal'] ?>" value="#00BCD4" onclick="PR51<?= $soal['id_soal'] ?>()" >
											<span class="check"></span></label>														
											</td>											
										</tr>
										<?php endif; ?>
										<?php if ($soal['perB'] <>'') : ?>
										<tr id="row1-5-2" class="tr-left-5" style='vertical-align:middle;' onClick="pilih1('5','2','#F44336','2')">
											<td width="5%" class="soal"> 2). </td>
											<td class="soal"><?= $soal['perB'] ?></td>
											<td width="5%">
											<label style="margin-top:0px" class="checkbox"><input type="radio" name="rp2" value="#F44336"  id="P52<?= $soal['id_soal'] ?>"  onclick="PR52<?= $soal['id_soal'] ?>()" >
											<span class="check"></span></label>															
											</td>											
										</tr>
										<?php endif; ?>
										<?php if ($soal['perC'] <>'') : ?>
										<tr id="row1-5-3" class="tr-left-5" style='vertical-align:middle;' onClick="pilih1('5','3','#4CAF50','3')">
											<td width="5%" class="soal"> 3).</td> 
											<td class="soal"><?= $soal['perC'] ?></td>
											<td width="5%">
											<label style="margin-top:0px" class="checkbox"><input type="radio" name="rp3" value="#4CAF50" id="P53<?= $soal['id_soal'] ?>"  onclick="PR53<?= $soal['id_soal'] ?>()">
											<span class="check"></span></label>															
											</td>															
										</tr>
										<?php endif; ?>
										<?php if ($soal['perD'] <>'') : ?>
										<tr id="row1-5-4" class="tr-left-5" style='vertical-align:middle;' onClick="pilih1('5','4','#FF9800','4')">
											<td width="5%" class="soal"> 4).</td> 
											<td class="soal"><?= $soal['perD'] ?></td>
											<td width="5%">
											<label style="margin-top:0px" class="checkbox"><input type="radio" name="rp4" value="#FF9800" id="P54<?= $soal['id_soal'] ?>"  onclick="PR54<?= $soal['id_soal'] ?>()" >
											<span class="check"></span></label>															
											</td>															
										</tr>
										<?php endif; ?>
										<?php if ($soal['perE'] <>'') : ?>
										<tr id="row1-5-5" class="tr-left-5" style='vertical-align:middle;' onClick="pilih1('5','5','#0277BD','5')">
											<td width="5%" class="soal"> 5).</td>
											<td class="soal"><?= $soal['perE'] ?></td>
											<td width="5px">
											<label style="margin-top:0px" class="checkbox"><input type="radio" name="rp5" value="#0277BD" id="P55<?= $soal['id_soal'] ?>"  onclick="PR55<?= $soal['id_soal'] ?>()" >
											<span class="check"></span></label>															
											</td>															
										</tr>
										<?php endif; ?>															
										</table>
									</td>
									<td width="2%"></td>
									<td>
										<table width="49%" class='table'>
											<tr style='vertical-align:middle;'>										
												<td colspan="3" class="soal">Jawaban</td>																														
													</tr>
										<?php if ($soal['pilA'] <>'') : ?>
										<tr id="row2-5-1" class="tr-right-5" style='vertical-align:middle;' onCLick="pilih2('5','1',2,'1','18','2')">
											<td width='5%'>							
											<label style="margin-top:0px" class="checkbox"> <input type="radio" name="urut1" value="A" id="J51<?= $soal['id_soal'] ?>" onclick="JW51<?= $soal['id_soal'] ?>()" <?php in_array ('A', $checked) ? print 'checked' : ''; ?>>
											<span class="check"></span></label>
											</td>															
											<td class="soal" width="5%">A).</td>
											<td class="soal">
																<?php
                                                                    
                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileA]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
																		echo"<br>";
                                                                    }
                                                                ?>
															<?= $soal['pilA'] ?>
											</td>															
										</tr>
										<?php endif; ?>
										<?php if ($soal['pilB'] <>'') : ?>
										<tr id="row2-5-2" class="tr-right-5" style='vertical-align:middle;'  onCLick="pilih2('5','2',2,'2','18','2')">
											<td width='5%'>							
												<label style="margin-top:0px" class="checkbox"> <input type="radio" name="urut2" value="B" id="J52<?= $soal['id_soal'] ?>" onclick="JW52<?= $soal['id_soal'] ?>()" <?php in_array ('B', $checked) ? print 'checked' : ''; ?>>
												<span class="check"></span></label>
												</td>															
												<td width="5%" class="soal"> B). </td>
												<td class="soal">
                                                           <?php
                                                                    
                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileB]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
																		echo"<br>";
                                                                    }
                                                                    ?>
            												<?= $soal['pilB'] ?>														
												</td>															
											</tr>
											<?php endif; ?>
											<?php if ($soal['pilC'] <>'') : ?>
											<tr id="row2-5-3" class="tr-right-5" style='vertical-align:middle;' onCLick="pilih2('5','3',2,'3','18','2')">
												<td width='5%'>							
												<label style="margin-top:0px" class="checkbox"> <input type="radio" name="urut3" value="C" id="J53<?= $soal['id_soal'] ?>" onclick="JW53<?= $soal['id_soal'] ?>()" <?php in_array ('C', $checked) ? print 'checked' : ''; ?>>
												<span class="check"></span></label>
												</td>	
												<td width="5%" class="soal"> C). </td>
												<td class="soal">
                                                           <?php
                                                                    
                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileC]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
																		echo "<br>";
                                                                    }
                                                                    ?>
            												<?= $soal['pilC'] ?>													
												</td>															
											</tr>
											<?php endif; ?>
											<?php if ($soal['pilD'] <>'') : ?>
											<tr id="row2-5-4" class="tr-right-5" style='vertical-align:middle;' onCLick="pilih2('5','4',2,'4','18','2')">
												<td width='5%'>							
												<label style="margin-top:0px" class="checkbox"> <input type="checkbox" name="urut4" value="D" id="J54<?= $soal['id_soal'] ?>" onclick="JW54<?= $soal['id_soal'] ?>()" <?php in_array ('D', $checked) ? print 'checked' : ''; ?>>
												<span class="check"></span></label>
												</td>
												<td class="soal" width="5%"> D).</td>
												<td class="soal">
                                                           <?php
                                                                    
                                                                    if ($soal['fileD'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileD']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileD]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
																		echo "<br>";
                                                                    }
                                                                    ?>
            												 <?= $soal['pilD'] ?>														
												</td>															
											</tr>
											<?php endif; ?>		
											<?php if ($soal['pilE'] <>'') : ?>
											<tr id="row2-5-5" class="tr-right-5" style='vertical-align:middle;' onCLick="pilih2('5','5',2,'4','18','2')">
												<td width='5%'>							
												<label style="margin-top:0px" class="checkbox"> <input type="checkbox" name="urut5" value="E" id="J55<?= $soal['id_soal'] ?>" onclick="JW55<?= $soal['id_soal'] ?>()" <?php in_array ('E', $checked) ? print 'checked' : ''; ?>>
												<span class="check"></span></label>
												</td>
												<td class="soal" width="5%"> E).</td>
												<td class="soal">
                                                           <?php
                                                                    
                                                                    if ($soal['fileE'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileE']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                             echo "<span  class='lup' style='display:inline-block'><img src='$baseurl/files/$soal[fileE]' style='max-width:100%;'/></span>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
																		echo "<br>";
                                                                    }
                                                                    ?>
            												<?= $soal['pilE'] ?>													
												</td>															
											</tr>
											<?php endif; ?>		
											</table>
									</td>
								</tr>
							</table>		
						
						<input type='hidden' id="idbank" value='<?= $id_bank ?>' >				
						<input type='hidden' id="idsiswa" value='<?= $id_siswa ?>' >
						<input type='hidden' id="idsoal" value='<?= $soal['id_soal'] ?>' >
						<input type='hidden' id="idujian" value='<?= $ac ?>' >
					<center>
					<button  onclick="haper()" type="button" class="btn btn-primary btn-sm"> Ganti Jawaban</button>
					</center>
					<br><br><br>					
				</div>
                 <script>
				function PR51<?= $soal['id_soal'] ?>() {
				var warna = $('#P51<?= $soal["id_soal"] ?>').val();
				var idsiswa = $('#idsiswa').val();
				var idsoal = $('#idsoal').val();
				var idbank = $('#idbank').val();
				var idujian = $('#idujian').val();
				var kode = "5.1.<?= $soal['id_soal'] ?>";
				$.ajax({
				type: 'POST',
				url: 'proses2.php?pg=JDH1',
				data: 'warna=' + warna + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
				success: function(response) {
								 
				}
				});
				}
			</script>
			  <script>
				function PR52<?= $soal['id_soal'] ?>() {
				var warna = $('#P52<?= $soal["id_soal"] ?>').val();
				var idsiswa = $('#idsiswa').val();
				var idsoal = $('#idsoal').val();
				var idbank = $('#idbank').val();
				var idujian = $('#idujian').val();
				var kode = "5.2.<?= $soal['id_soal'] ?>";
				$.ajax({
				type: 'POST',
				url: 'proses2.php?pg=JDH1',
				data: 'warna=' + warna + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
				success: function(response) {
								 
				}
				});
				}
			</script>
			<script>
				function PR53<?= $soal['id_soal'] ?>() {
				var warna = $('#P53<?= $soal["id_soal"] ?>').val();
				var idsiswa = $('#idsiswa').val();
				var idsoal = $('#idsoal').val();
				var idbank = $('#idbank').val();
				var idujian = $('#idujian').val();
				var kode = "5.3.<?= $soal['id_soal'] ?>";
				$.ajax({
				type: 'POST',
				url: 'proses2.php?pg=JDH1',
				data: 'warna=' + warna + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
				success: function(response) {
								 
				}
				});
				}
			</script>
			<script>
				function PR54<?= $soal['id_soal'] ?>() {
				var warna = $('#P54<?= $soal["id_soal"] ?>').val();
				var idsiswa = $('#idsiswa').val();
				var idsoal = $('#idsoal').val();
				var idbank = $('#idbank').val();
				var idujian = $('#idujian').val();
				var kode = "5.4.<?= $soal['id_soal'] ?>";
				$.ajax({
				type: 'POST',
				url: 'proses2.php?pg=JDH1',
				data: 'warna=' + warna + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
				success: function(response) {
								 
				}
				});
				}
			</script>
			<script>
				function PR55<?= $soal['id_soal'] ?>() {
				var warna = $('#P55<?= $soal["id_soal"] ?>').val();
				var idsiswa = $('#idsiswa').val();
				var idsoal = $('#idsoal').val();
				var idbank = $('#idbank').val();
				var idujian = $('#idujian').val();
				var kode = "5.5.<?= $soal['id_soal'] ?>";
				$.ajax({
				type: 'POST',
				url: 'proses2.php?pg=JDH1',
				data: 'warna=' + warna + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
				success: function(response) {
								 
				}
				});
				}
			</script>
			
	<script>
	function JW51<?= $soal['id_soal'] ?>() {
	var jawab = $('#J51<?= $soal["id_soal"] ?>').val();
	var idsiswa = $('#idsiswa').val();
	var idsoal = $('#idsoal').val();
	var idbank = $('#idbank').val();
	var idujian = $('#idujian').val();
	var kode = "5.1.<?= $soal['id_soal'] ?>";
	$.ajax({
	type: 'POST',
	url: 'proses2.php?pg=UPJDH',
	data: 'jawab=' + jawab + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
	success: function(response) {
					 
	}
	});
	}
</script>	
	<script>
	function JW52<?= $soal['id_soal'] ?>() {
	var jawab = $('#J52<?= $soal["id_soal"] ?>').val();
	var idsiswa = $('#idsiswa').val();
	var idsoal = $('#idsoal').val();
	var idbank = $('#idbank').val();
	var idujian = $('#idujian').val();
	var kode = "5.2.<?= $soal['id_soal'] ?>";
	$.ajax({
	type: 'POST',
	url: 'proses2.php?pg=UPJDH',
	data: 'jawab=' + jawab + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
	success: function(response) {
					 
	}
	});
	}
</script>
<script>
	function JW53<?= $soal['id_soal'] ?>() {
	var jawab = $('#J53<?= $soal["id_soal"] ?>').val();
	var idsiswa = $('#idsiswa').val();
	var idsoal = $('#idsoal').val();
	var idbank = $('#idbank').val();
	var idujian = $('#idujian').val();
	var kode = "5.3.<?= $soal['id_soal'] ?>";
	$.ajax({
	type: 'POST',
	url: 'proses2.php?pg=UPJDH',
	data: 'jawab=' + jawab + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
	success: function(response) {
					 
	}
	});
	}
</script>
<script>
	function JW54<?= $soal['id_soal'] ?>() {
	var jawab = $('#J54<?= $soal["id_soal"] ?>').val();
	var idsiswa = $('#idsiswa').val();
	var idsoal = $('#idsoal').val();
	var idbank = $('#idbank').val();
	var idujian = $('#idujian').val();
	var kode = "5.4.<?= $soal['id_soal'] ?>";
	$.ajax({
	type: 'POST',
	url: 'proses2.php?pg=UPJDH',
	data: 'jawab=' + jawab + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
	success: function(response) {
					 
	}
	});
	}
</script>
<script>
	function JW55<?= $soal['id_soal'] ?>() {
	var jawab = $('#J55<?= $soal["id_soal"] ?>').val();
	var idsiswa = $('#idsiswa').val();
	var idsoal = $('#idsoal').val();
	var idbank = $('#idbank').val();
	var idujian = $('#idujian').val();
	var kode = "5.5.<?= $soal['id_soal'] ?>";
	$.ajax({
	type: 'POST',
	url: 'proses2.php?pg=UPJDH',
	data: 'jawab=' + jawab + "&idsoal=" + idsoal + "&idsiswa=" + idsiswa + "&idbank=" + idbank + "&idujian=" + idujian + "&kode=" + kode,
	success: function(response) {
					 
	}
	});
	}
</script>							
<script>

function haper() {
<?php if ($soal['perA'] <>'') : ?>
document.getElementById("J51<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("P51<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("row1-5-1").style.backgroundColor = '#ffffff';
document.getElementById("row2-5-1").style.backgroundColor = '#ffffff';
 <?php endif; ?>
 <?php if ($soal['perB'] <>'') : ?>
document.getElementById("J52<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("P52<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("row1-5-2").style.backgroundColor = '#ffffff';
document.getElementById("row2-5-2").style.backgroundColor = '#ffffff';
<?php endif; ?>
 <?php if ($soal['perC'] <>'') : ?>
 document.getElementById("J53<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("P53<?= $soal['id_soal'] ?>").checked = false;
 document.getElementById("row1-5-3").style.backgroundColor = '#ffffff';
  document.getElementById("row2-5-3").style.backgroundColor = '#ffffff';
 <?php endif; ?>
  <?php if ($soal['perD'] <>'') : ?>
document.getElementById("J54<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("P54<?= $soal['id_soal'] ?>").checked = false;
   document.getElementById("row1-5-4").style.backgroundColor = '#ffffff';
  document.getElementById("row2-5-4").style.backgroundColor = '#ffffff';
 <?php endif; ?>
  <?php if ($soal['perE'] <>'') : ?>
document.getElementById("J55<?= $soal['id_soal'] ?>").checked = false;
document.getElementById("P55<?= $soal['id_soal'] ?>").checked = false;
  document.getElementById("row1-5-5").style.backgroundColor = '#ffffff';
  document.getElementById("row2-5-5").style.backgroundColor = '#ffffff';
 <?php endif; ?>  
  
var idso = $('#idsoal').val();
var idsis = $('#idsiswa').val();
$.ajax({
	type: 'POST',
	url: '<?= $baseurl ?>/proses20.php',
	data: 'idso=' + idso + "&idsis=" + idsis,
	
	});
}
</script>					  
    <script>
	<?php if($jmljdh<>0): ?>
	<?php if(in_array('#00BCD4', $warna)): ?>
	 document.getElementById("row1-5-1").style.backgroundColor = '#00BCD4';
	 document.getElementById("P51<?= $soal['id_soal'] ?>").checked = true;
	
	 <?php endif; ?>
	 <?php if(in_array('#F44336', $warna)): ?>
	 document.getElementById("row1-5-2").style.backgroundColor = '#F44336';
	 document.getElementById("P52<?= $soal['id_soal'] ?>").checked = true;
	 <?php endif; ?>
	 <?php if(in_array('#4CAF50', $warna)): ?>
	 document.getElementById("row1-5-3").style.backgroundColor = '#4CAF50';
	 document.getElementById("P53<?= $soal['id_soal'] ?>").checked = true;
	 <?php endif; ?>
	  <?php if(in_array('#FF9800', $warna)): ?>
	 document.getElementById("row1-5-4").style.backgroundColor = '#FF9800';
	 document.getElementById("P54<?= $soal['id_soal'] ?>").checked = true;
	 <?php endif; ?>
	  <?php if(in_array('#0277BD', $warna)): ?>
	 document.getElementById("row1-5-5").style.backgroundColor = '#0277BD';
	 document.getElementById("P55<?= $soal['id_soal'] ?>").checked = true;
	 <?php endif; ?>
	 <?php endif; ?>
	 
	 
	 
  <?php if(in_array('A', $checked)): ?>
 <?php if($checked[0]=='A'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='A'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='A'){$warnamu=$warna[2]; } ?>
 <?php if($checked[3]=='A'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='A'){$warnamu=$warna[4]; } ?>
 document.getElementById("row2-5-1").style.backgroundColor = '<?= $warnamu ?>';

 <?php endif; ?>

 <?php if(in_array('B', $checked)): ?>
 <?php if($checked[0]=='B'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='B'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='B'){$warnamu=$warna[2]; } ?>
 <?php if($checked[3]=='B'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='B'){$warnamu=$warna[4]; } ?>
 document.getElementById("row2-5-2").style.backgroundColor = '<?= $warnamu ?>';
 
  <?php endif; ?>

 <?php if(in_array('C', $checked)): ?>
 <?php if($checked[0]=='C'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='C'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='C'){$warnamu=$warna[2]; } ?>
 <?php if($checked[3]=='C'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='C'){$warnamu=$warna[4]; } ?>
 document.getElementById("row2-5-3").style.backgroundColor = '<?= $warnamu ?>';
 
 <?php endif; ?>
  <?php if(in_array('D', $checked)): ?>
 <?php if($checked[0]=='D'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='D'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='D'){$warnamu=$warna[2]; } ?>
 <?php if($checked[3]=='D'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='D'){$warnamu=$warna[4]; } ?>
 document.getElementById("row2-5-4").style.backgroundColor = '<?= $warnamu ?>';

 <?php endif; ?>
 <?php if(in_array('E', $checked)): ?>
 <?php if($checked[0]=='E'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='E'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='E'){$warnamu=$warna[2]; } ?>
 <?php if($checked[3]=='E'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='E'){$warnamu=$warna[4]; } ?>
 document.getElementById("row2-5-5").style.backgroundColor = '<?= $warnamu ?>';
 
 <?php endif; ?>
</script> 
	 <?php } ?>				
														
		
	</div>
</div>	
														
            <div class='box-footer navbar-fixed-bottom' style="background-color:#fff">
                <table width='100%'>
                    <tr>
                        <td style="text-align:center">
                            <button id='move-prev' class='btn  btn-primary' onclick="loadsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $no_prev ?>)"><i class='fas fa-chevron-circle-left'></i> <span>Prev</span></button>
                           
                        </td>
                       
                            <td style="text-align:center">
                                     
                                <div id='load-ragu'>
                                    <a href='#' class='btn btn-warning'><input type='checkbox' onclick="radaragu(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $soal['id_soal'] ?>, <?= $ac ?>)" <?= $ragu = ($jawab['ragu'] == 1) ? 'checked' : ''; ?> /> Ragu <span class='hidden-xs'>- Ragu</span></a>
                                </div>
                                   
                            </td>
                        
                        <td style="text-align:center">
                            <?php
                            $jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank' "));

                            $cekno_soal = $no_soal + 1;
                            ?>
                            <?php if (($no_soal >= 0) && ($cekno_soal < $jumsoal)) { ?>
                                
                                <button id='move-next' class='btn  btn-success' onclick="loadsoal(<?= $id_bank ?>,<?= $id_siswa ?>,<?= $no_next ?>)"><span>Next </span><i class='fas fa-chevron-circle-right'></i></button>

                             <?php } elseif (($no_soal >= 0) && ($cekno_soal = $jumsoal)) { ?>
                                <?php
                                if($habis >= $bolehselesai) { ?>
							   <input type='submit' name='done' id='selesai-submit' style='display:none;' />
                                <button class='done-btn btn btn-danger'><i class="fas fa-flag-checkered    "></i> <span class='hidden-xs'>TEST </span>SELESAI</button>
                               <?php } else { ?>
                                    <button class='btn btn-belum btn-warning'>Belum Saatnya</button>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
    <?php
        }
    }
    ?>
	
	
<script>
        function selesai() {
            var idmapel = '<?= $id_bank  ?>';
            var idsiswa = '<?= $id_siswa  ?>';
            $.ajax({
                type: 'POST',
                url: baseurl + '/selesai.php',
                data: {

                    id_bank: idmapel,
                    id_siswa: idsiswa,
                    id_ujian: <?= $ac ?>
                },
                beforeSend: function() {
                    $('.loader').css('display', 'block');
                },
                success: function(response) {

                    $('.loader').css('display', 'none');
                    location.href = baseurl;
                }
            });
        }
        var lamaujian = +'<?= $lamaujian ?>';
        var habis = +'<?= $habis ?>';

        console.log(habis)
        if (habis > lamaujian) {
            selesai();
        }
        $(document).ready(function() {
            $('#zoom').zoom();
            $('#zoom1').zoom();
            $('.lup').zoom();
            $('.soal img')
                .wrap('<span style="display:inline-block"></span>')
                .css('display', 'block')
                .parent()
                .zoom();
        });
    </script>
    <script>
        $(document).ready(function() {
            Mousetrap.bind('enter', function() {
                loadsoal(<?= $id_bank . "," . $id_siswa . "," . $no_next ?>);
            });

            Mousetrap.bind('right', function() {
                loadsoal(<?= $id_bank . "," . $id_siswa . "," . $no_next ?>);
            });

            Mousetrap.bind('left', function() {
                loadsoal(<?= $id_bank . "," . $id_siswa . "," . $no_prev  ?>);
            });

            Mousetrap.bind('a', function() {
                $('#A').click()
            });

            Mousetrap.bind('b', function() {
                $('#B').click()
            });

            Mousetrap.bind('c', function() {
                $('#C').click()
            });

            Mousetrap.bind('d', function() {
                $('#D').click()
            });

            Mousetrap.bind('e', function() {
                $('#E').click()
            });

            Mousetrap.bind('space', function() {
                $('input[type=checkbox]').click()
                radaragu(<?= $id_bank . "," . $id_siswa . "," . $soal['id_soal'] ?>, <?= $ac ?>)
            });

        });
    </script>
    <script>
        MathJax.Hub.Typeset()
    </script>
<?php } ?>
<?php
if ($pg == 'jawab') {
    $jenis = $_POST['jenis'];
	
    $dataesai = array(
        'id_ujian' => $_POST['idu'],
        'id_bank' => $_POST['id_bank'],
        'id_siswa' => $_POST['id_siswa'],
        'id_soal' => $_POST['id_soal'],
        'jenis' => $_POST['jenis'],
        'esai' => strtolower($_POST['jawaban']),
		 'jawaban' => strtolower($_POST['jawaban'])
    );
    $data = array(
        'id_ujian' => $_POST['idu'],
        'id_bank' => $_POST['id_bank'],
        'id_siswa' => $_POST['id_siswa'],
        'id_soal' => $_POST['id_soal'],
        'jenis' => $_POST['jenis'],
        'jawaban' => $_POST['jawaban']
       
    );
	 
    $where = array(
        'id_ujian' => $_POST['idu'],
        'id_bank' => $_POST['id_bank'],
        'id_siswa' => $_POST['id_siswa'],
        'id_soal' => $_POST['id_soal'],
        'jenis' => $jenis
    );
    $cekjawaban = rowcount($koneksi, 'jawaban', $where);

    if ($jenis == 1) {
        if ($cekjawaban == 0) {
            $exec = insert($koneksi, 'jawaban', $data);
        } else {
            $exec = update($koneksi, 'jawaban', $data, $where);
        }
    } else {
        if ($cekjawaban == 0) {
            $exec = insert($koneksi, 'jawaban', $dataesai);
        } else {
            $exec = update($koneksi, 'jawaban', $dataesai, $where);
        }
    }
    echo $exec;
	
	if($exec){
		$soale = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kunci_soal WHERE id_soal='$_POST[id_soal]'"));
		$jawabane = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$_POST[id_soal]' and id_siswa='$_POST[id_siswa]'"));
	
	if($soale['jawaban']==$jawabane['jawaban']){
		$skore = $soale['skor'];
	}else{
		$skore =0;
	}
	$simpan = mysqli_query($koneksi,"UPDATE jawaban SET skor='$skore' WHERE id_soal='$_POST[id_soal]' and id_siswa='$_POST[id_siswa]'");
	if($simpan){
		$wherez = array(
    'id_bank' => $_POST['id_bank'],
    'id_siswa' => $_POST['id_siswa']
    
    );
	$max = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(max_skor) AS skr,id_bank FROM soal WHERE id_bank='$_POST[id_bank]'"));
	$score_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skormu FROM jawaban WHERE id_bank='$_POST[id_bank]' AND id_siswa='$_POST[id_siswa]' "));
	$skor_pg = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$_POST[id_bank]' AND id_siswa='$_POST[id_siswa]' AND jenis='1'"));
	$skor_esai = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$_POST[id_bank]' AND id_siswa='$_POST[id_siswa]' AND jenis='2'"));
	$skor_multi = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$_POST[id_bank]' AND id_siswa='$_POST[id_siswa]' AND jenis='3'"));
	$skor_bs = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$_POST[id_bank]' AND id_siswa='$_POST[id_siswa]' AND jenis='4'"));
	$skor_urut = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$_POST[id_bank]' AND id_siswa='$_POST[id_siswa]' AND jenis='5'"));
	$spg = $skor_pg['skor'];
	$spe = $skor_esai['skor'];
	$spm = $skor_multi['skor'];
	$spb = $skor_bs['skor'];
	$spu = $skor_urut['skor'];
	$nilai = ($score_siswa['skormu']/$max['skr'])*100;
	$data = array(
	'skor' => $spg,
	 'skor_esai' => $spe,
	 'skor_multi' => $spm,
	 'skor_bs' => $spb,
	 'skor_urut' => $spu,
    'total' => $score_siswa['skormu'],
	'makskor'=> $max['skr'],
	'nilai'=>round($nilai)
	);

    update($koneksi, 'nilai', $data, $wherez);
	}
	}
}
 elseif ($pg == 'ragu') {
	$jenis = $_POST['jenis'];
    $where = array(
        'id_bank' => $_POST['id_bank'],
        'id_siswa' => $_POST['id_siswa'],
        'id_soal' => $_POST['id_soal']
        
        
    );
    $cekragu = fetch($koneksi, 'jawaban', $where);
    if ($cekragu['ragu'] == 0) {
        $exec = update($koneksi, 'jawaban', array('ragu' => 1), $where);
    } else {
        $exec = update($koneksi, 'jawaban', array('ragu' => 0), $where);
    }
    echo $exec;
}

?>
<script>
$("#subA").click(function() {
	$.post($("#myForm").attr("action"), $("#myForm :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm").submit(function(){
	return false;
});
$("#subB").click(function() {
	$.post($("#myForm").attr("action"), $("#myForm :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm").submit(function(){
	return false;
});
$("#subC").click(function() {
	$.post($("#myForm").attr("action"), $("#myForm :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm").submit(function(){
	return false;
});
$("#subD").click(function() {
	$.post($("#myForm").attr("action"), $("#myForm :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm").submit(function(){
	return false;
});

$("#subE").click(function() {
	$.post($("#myForm").attr("action"), $("#myForm :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm").submit(function(){
	return false;
});
 

</script>





<script>
$("#bs1").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});


$("#bs11").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});
$("#bs2").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});


$("#bs22").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});
$("#bs3").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});


$("#bs33").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});
$("#bs4").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});


$("#bs44").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});
$("#bs5").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});


$("#bs55").click(function() {
	$.post($("#myForm3").attr("action"), $("#myForm3 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm3").submit(function(){
	return false;
});


</script>

	<script>
$("#pgm11").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
 $("#pgm12").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
$("#pgm13").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 $("#pgm21").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
 $("#pgm22").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
$("#pgm23").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});

$("#pgm31").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
 $("#pgm32").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
$("#pgm33").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
$("#pgm41").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
 $("#pgm42").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
$("#pgm43").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
$("#pgm51").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
 $("#pgm52").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm8").submit(function(){
	return false;
});
$("#pgm53").click(function() {
	$.post($("#myForm8").attr("action"), $("#myForm8 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
$("#myForm8").submit(function(){
	return false;
});

</script>
	

	<script>
$("#urutkan1").change(function() {
	$.post($("#myForm5").attr("action"), $("#myForm5 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm5").submit(function(){
	return false;
});
 $("#urutkan2").change(function() {
	$.post($("#myForm5").attr("action"), $("#myForm5 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm5").submit(function(){
	return false;
});
$("#urutkan3").change(function() {
	$.post($("#myForm5").attr("action"), $("#myForm5 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm5").submit(function(){
	return false;
});
$("#urutkan4").change(function() {
	$.post($("#myForm5").attr("action"), $("#myForm5 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm5").submit(function(){
	return false;
});
$("#urutkan5").change(function() {
	$.post($("#myForm5").attr("action"), $("#myForm5 :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm5").submit(function(){
	return false;
});
</script>

<script>
	
	       
			var left = '';
			eval('var right_5' + '= "";');
			eval('var warna1_5' + '= "";');
			eval('var id1_5' + '= "";');
			eval('var pos1_5' + '= "";');
			eval('var pos11_5' + '= "";');
			eval('var dipilih1_5' + '= [];');
			eval('var dipilih2_5' + '= [];');
			eval('var order1_5' + '= "";');
			eval('var free1_5' + '= true;');
			eval('var free_5' + '= true;');
			
			
	function pilih1(no, id, warna, order) {
		
			if (window['free1_'+no]) {
				window['free1_'+no] = true;
				
				$('#row1-'+no+'-'+id).css('background',warna);
				window['pos1_'+no] = $('#r_left_'+no+'_'+id).offset();
				window['pos11_'+no] = $('#r_left_'+no+'_'+id).position();
				window['warna1_'+no] = warna;
				window['id1_'+no] = id;
				window['order1_'+no] = order;
				window['dipilih1_'+no].push(id);
				
				
			}
			
	}
	
	
	function pilih2(no, id,tipe,order,s, ps) {
			
				$('#row2-'+no+'-'+id).css('background',window['warna1_'+no]);
				$('#r_right_'+no+'_'+id).val(window['id1_'+no]+';'+id);
				
				
		
	}
	
			

	
	
	
</script>