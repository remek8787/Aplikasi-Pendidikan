<style type="text/css">
    .ttd {
        position: absolute;
        z-index: -1;
    }
</style>
<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
include "../../vendor/phpqrcode/qrlib.php";

$kelas = @$_GET['kelas'];

if (date('m') >= 7 and date('m') <= 12) {
    $ajaran = date('Y') . "/" . (date('Y') + 1);
} elseif (date('m') >= 1 and date('m') <= 6) {
    $ajaran = (date('Y') - 1) . "/" . date('Y');
}
$kelasX = mysqli_fetch_array(mysqli_query($koneksi, "SELECT kelas FROM siswa WHERE kelas='$kelas'"));

$absQ = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas'");		
while ($sis = mysqli_fetch_array($absQ)) : 		  
$tempdir = "../../temp/"; 
if (!file_exists($tempdir)) 
    mkdir($tempdir);
$codeContents = $sis['nis'] . '-' . $sis['nama'];
QRcode::png($codeContents, $tempdir . $sis['nis'] . '.png', QR_ECLEVEL_M, 4);
endwhile;
?>
<style>
    * {
        font-size: x-small;
    }

    .box {
        border: 1px solid #000;
        width: 100%;
        height: 150px;
    }

    .ukuran {
        font-size: 15px;
    }

    .ukuran2 {
        font-size: 12px;
    }

    .user {
        font-size: 15px;
    }
</style>

<table width='100%' align='center' cellpadding='10'>
    <tr>
        <?php $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas' ORDER BY nama ASC"); ?>
        <?php while ($siswa = mysqli_fetch_array($siswaQ)) : ?>
            <?php
            $nopeserta = $siswa['nopes'];
            $no++;
            ?>
			
            <td width='50%'>
                <div style='width:10.5cm;border:1px solid #666;'>
                    <table style="text-align:center; width:100%">
                        <tr>
                            <td style="text-align:left; vertical-align:top">

                                <img src="<?= $baseurl; ?>/images/<?= $setting['logo'] ?>" height='60px'>
                            </td>
                            <td style="text-align:center">
                                
                                <b class="ukuran">
                                    <?= strtoupper($setting['header_kartu']) ?><br>
                                    <?= strtoupper($setting['sekolah']) ?><br>
                                    TAHUN PELAJARAN <?= $ajaran ?>
                                </b>
                            </td>
                            <td style="text-align:right; vertical-align:top">
							<?php if($setting['jenis']=='1'): ?>
                                <img src="<?= $baseurl; ?>/images/logo.png" height='60px' />
							<?php else : ?>
							<img src="<?= $baseurl; ?>/images/depag.png" height='60px' />
							<?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <table style="text-align:left; width:100%">
                        <tr>
                            <td style="text-align:center; vertical-align:top; width:100px" rowspan="8">
                                <?php
                                 if ($siswa['foto'] <> '') {
                                    if (!file_exists("$baseurl/images/fotosiswa/$siswa[foto]")) {
                                        echo "<img src='$baseurl/images/fotosiswa/$siswa[foto]' class='img'  style='max-width:60px' alt='+'>";
                                    } else {
                                        echo "<img src='$baseurl/images/user.png' class='img'  style='max-width:60px' >";
                                    }
                                } else {
                                    echo "<img src='$baseurl/images/user.png' class='img'  style='max-width:60px' alt='+'>";
                                }


                                ?>
								<br>
								<img src="<?= $baseurl ?>/temp/<?= $siswa['nis'] ?>.png" width="90px">
                            </td>
                        </tr>
                         <tr>
                            <td class="ukuran" valign='top' width="30%">No Peserta</td>
                            <td class="ukuran" valign='top'>: <?= $siswa['nopes'] ?></td>
                        </tr>
                        <tr>
                            <td class="ukuran" valign='top'>Nama</td>
                            <td class="ukuran2" valign='top'>: <?= substr($siswa['nama'],0,21) ?></td>
                        </tr>
                        <tr>
                            <td class="ukuran" valign='top'>Kelas / Sesi Ujian</td>
                            <td class="ukuran" valign='top'>: <?= $kelasX['kelas'] ?> / Sesi <?= $siswa['sesi'] ?></td>
                        </tr>
                        <tr>
                            <td class="ukuran" valign='top'>Username</td>
                            <td class="ukuran" valign='top'>:<b class="user"> <?= $siswa['username'] ?></b></td>
                        </tr>
                        <tr>

                            <td class="ukuran" valign='top'>Password</td>
                            <td class="ukuran" valign='top'>: <b class="user"><?= $siswa['password'] ?></b></td>

                        </tr>
                        
                        <tr>
                            <td valign='top'></td>
                            <td class="ukuran2" valign='top' align='center'>
							
                                Kepala Sekolah<br><br>
								
                                <br>
                                <b><?= $setting['kepsek'] ?></b><br>
                                <b>NIP. <?= $setting['nip'] ?></b>
							
                            </td>
							<?php if($setting['pk_stempel']=='1'): ?>
							<img style="z-index: 800;position:absolute;margin-top:90px;margin-left:250px"  src="<?= $baseurl ?>/images/<?= $setting['stempel'] ?>" width="90px">
							<?php endif; ?>
							<?php if($setting['pk_ttd']=='1'): ?>
							<img style="z-index: 800;position:absolute;margin-top:125px;margin-left:280px"  src="<?= $baseurl ?>/images/<?= $setting['ttd'] ?>" width="90px">
                            <?php endif; ?>
						</tr>
                    </table>
                </div>
               
            </td>
            <?php if (($no % 2) == 0) : ?>
    </tr>
    <tr>
    <?php endif; ?>
<?php endwhile; ?>
    </tr>
</table>