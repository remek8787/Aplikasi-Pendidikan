<?php
$id = $_GET['id'];
$materi = mysqli_fetch_array(mysqli_query($koneksi, "select * from materi where idm='$id'"));
$pel = mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id='$materi[mapel]'"));
function youtube($url)
{
    $link = str_replace('http://www.youtube.com/watch?v=', '', $url);
    $link = str_replace('https://www.youtube.com/watch?v=', '', $link);
    $data = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $link . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    return $data;
}
 $where = array(
     'idsiswa' => $_SESSION['id_siswa'],
     'mapel' => $materi['mapel']
      );
$datax = array(
	'mapel'=> $materi['mapel'],
    'idsiswa' => $_SESSION['id_siswa'],
	'kelas' => $siswa['kelas'],
    'tanggal' => date('Y-m-d'),
	'jam' => date('H:i:s'),
	'bulan'=> date('m'),
	'ket' => 'H',
    'guru'=> $materi['guru'],
	'tahun'=> date('Y')
    );			
$cek = rowcount($koneksi, 'absen_mapel', $where);
if ($cek == 0) {
  insert($koneksi, 'absen_mapel', $datax);
	}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-header">
                <h5 class='card-title'>Detail materi Siswa</h5>
            </div>
            <div class='card-body'>			
                <table class='table table-bordered table-striped'>
                    <tr>
                        <th width='150'>Mata Pelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $pel['nama_mapel'] ?></td>

                    </tr>
                    <tr>
                        <th>Tgl Pembelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $materi['dari'] ?> - <?= $materi['sampai'] ?></td>
                    </tr>
                    <?php if($materi['quiz']=='Ya' AND $nilai==0){ ?>
					
					<?php } ?>
					<?php if($materi['file']<>''){ ?>
					 <tr>
                        <th>Download</th>
                        <td width='10'>:</td>
                        <td> <a href="<?= $baseurl . '/materi/' . $materi['file'] ?>" target="_blank" class="btn btn-sm btn-success"><i class="material-icons">download</i> Materi</a></td>
                    </tr>
					<?php } ?>
					<?php if($materi['link']<>''){ ?>
					 <tr>
                        <th>Download</th>
                        <td width='10'>:</td>
                        <td> <a href="<?= $materi['link'] ?>" target="_blank" class="btn btn-sm btn-primary"><i class="material-icons">download</i> Materi</a></td>
                    </tr>
					<?php } ?>
                </table>
				
					<?php 
                    if(!empty($materi['file'])){
						$pecah=explode('.',$materi['file']);
						$ekstensi=$pecah[1];
					?>
					<?php if($ekstensi=='mp4'){ ?>
					<video src="<?= $baseurl ?>/materi/<?= $materi['file'] ?>" controls autoplay width="100%" height="315"></video>
					 <?php } ?>
					 <?php if($ekstensi=='jpg' OR $ekstensi=='png'){ ?>
					<img src="<?= $baseurl ?>/materi/<?= $materi['file'] ?>" controls autoplay width="100%" height="315">
					 <?php } ?>
					 <?php if($ekstensi=='pdf'){ ?>
					<iframe  src="<?= $baseurl ?>/materi/<?= $materi['file'] ?>" controls autoplay width="100%" height="315"></iframe>
					<?php } ?>
					 <?php if($ekstensi=='docx'){ ?>
					<iframe src="http://docs.google.com/viewer?url=berkas/<?= $materi['file'] ?> 
					&embedded=true"  width="100%" height="315" controls autoplay style="border: none;"></iframe>

					<?php } ?>
					  <?php } ?>
                       
                        <div class="col-md-12">
						<br>
						 <h5 class='card-title'><?= $materi['judul'] ?></h5>
                       </div>                                                          
                    <?php if ($materi['youtube'] <> null) {  ?>
                       
                        <div class="col-md-12">
                            <?= youtube($materi['youtube']) ?>
                        </div>
                        <div class="col-md-3"></div>
                    <?php } ?>
                    <div class="col-md-12">
					<br>
                       <p> <?= $materi['isimateri'] ?></p>
                    </div>
            </div>
       </div>
  </div>
</div>
