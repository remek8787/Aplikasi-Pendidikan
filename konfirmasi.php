<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
cek_session_siswa();
$ac = $_POST['idm'];
$id_siswa = $_POST['ids'];
$query = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_ujian='$ac'"));
$idbank = $query['id_bank'];
$namamapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_ujian='$ac'"));
$pesan = '';
$bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$idbank'"));
?>
<div class='row'>
    <div class='col-md-3'></div>
    <div class='col-md-6'>
        <div class='box box-solid'>
            <div class='box-header'>
                <h3 class='box-title'>Konfirmasi Tes</h3>
                <div class='box-title pull-right'>
                    <a href='<?= $homeurl ?>'><span class='btn btn-sm btn-default'>Kembali</span></a>
                </div>
            </div>
            <div class='box-body'>

                <div class='table-responsive'>
                    <form id="formmulaiujian" action='' method='post'>
                        <input type='hidden' value='<?= $id_siswa ?>' name='ids'>
                        <input type='hidden' value='<?= $ac ?>' name='idm'>
                        <table class='table no-margin edis '>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Nama Tes</b><br />
                                        <small class='label bg-red'><?= $namamapel['kode_ujian'] ?></small>
                                        <small class='label bg-purple'><?= $namamapel['nama'] ?></small>
                                        <small class='label bg-blue'><?= $namamapel['level'] ?></small>
										
                                    </td>
                                  
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Status Tes</b><br />
                                        <span>Tersedia</span>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
									<?php if($bank['model']==1){ ?>
                                        <b>Jumlah Soal AKM</b><br />
										
                                        <span style="color:blue"><b><?= $namamapel['tampil_pg'] . ' PG | ' . $namamapel['tampil_multi'] . ' Multi | ' . $namamapel['tampil_bs'] . ' BS | ' . $namamapel['tampil_urut'] . ' Jodoh | '.$namamapel['tampil_esai'] ?> Esai</b></span>
                                        <?php }else{ ?>
										<b>Jumlah Soal</b><br />
										<span style="color:blue"><b><?= $namamapel['tampil_pg'] . ' PG | ' .$namamapel['tampil_esai'] ?> Esai</b></span>
										<?php } ?>
									</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Tanggal Waktu Tes</b><br />
                                        <span> <?= buat_tanggal('D, d M Y') ?></span>
                                        <span class='label bg-red'><?= $namamapel['waktu_ujian'] ?></span>
                                    </td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <b>Alokasi Waktu Tes</b><br />
                                        <span><?= $namamapel['lama_ujian'] ?> menit</span>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <?php if ($namamapel['token'] == 1) : ?>
									 <?php $token=fetch($koneksi,'token',['id_token'=>1]); ?>
                                        <td>
                                            <input type='text' value="<?= $token['token'] ?>" class='form-control' name='token' placeholder='masukan token' autofocus readonly />
                                        </td>
                                    <?php endif ?>
                                    <td>
                                        <button type='submit' name='mulai' class='btn btn-primary btn-block right'>Mulai Test</button>
                                    </td>
                                </tr>
								
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#formmulaiujian').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'cekkonfirmasi.php',
            data: $(this).serialize(),
            success: function(data) {
                toastr.success(data);
				
            }
        });
        return false;
    });
</script>