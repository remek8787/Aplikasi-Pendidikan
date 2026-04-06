<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>

 <!-- PENGATURAN -->
<?php elseif ($pg == enkripsi('waktu')) : ?>
    <?php include 'pengaturan/waktu.php'; ?>
<?php elseif ($pg == enkripsi('mesin')) : ?>
    <?php include 'pengaturan/mesin.php'; ?>
<?php elseif ($pg == enkripsi('psis')) : ?>
    <?php include 'pesan/pesansis.php'; ?>	
<?php elseif ($pg == enkripsi('ppeg')) : ?>
    <?php include 'pesan/pesanpeg.php'; ?>	
<?php elseif ($pg == enkripsi('esis')) : ?>
    <?php include 'pesan/esis.php'; ?>	
<?php elseif ($pg == enkripsi('epeg')) : ?>
    <?php include 'pesan/epeg.php'; ?>	
 <!-- REGISTER -->
<?php elseif ($pg == enkripsi('rfid')) : ?>
    <?php include 'rfid/rfid.php'; ?>
<?php elseif ($pg == enkripsi('barkode')) : ?>
    <?php include 'barkode/barkode.php'; ?>
<?php elseif ($pg == enkripsi('finger')) : ?>
    <?php include 'finger/finger.php'; ?>
<?php elseif ($pg == enkripsi('face')) : ?>
    <?php include 'face/face.php'; ?>
	<?php elseif ($pg == enkripsi('faces')) : ?>
    <?php include 'face/faces.php'; ?>
<!-- ABSENSI -->
<?php elseif ($pg == enkripsi('presis')) : ?>
    <?php include 'absen/presis.php'; ?>
<?php elseif ($pg == enkripsi('prespeg')) : ?>
    <?php include 'absen/prespeg.php'; ?>
<?php elseif ($pg == enkripsi('absis')) : ?>
    <?php include 'cetak/absis.php'; ?>	
<?php elseif ($pg == enkripsi('abpeg')) : ?>
    <?php include 'cetak/abpeg.php'; ?>
<?php elseif ($pg == enkripsi('absis2')) : ?>
    <?php include 'cetak/absis2.php'; ?>	
<?php elseif ($pg == enkripsi('abpeg2')) : ?>
    <?php include 'cetak/abpeg2.php'; ?>		
<?php elseif ($pg == enkripsi('detail')) : ?>
    <?php include 'cetak/detail.php'; ?>	
<!-- TIDAK HADIR -->
<?php elseif ($pg == enkripsi('insis')) : ?>
    <?php include 'absen/absiswa.php'; ?>		
<?php elseif ($pg == enkripsi('inpeg')) : ?>
    <?php include 'absen/abpeg.php'; ?>	
<!-- HAPUS DATA -->
<?php elseif ($pg == enkripsi('hapres')) : ?>
    <?php include 'hapus/hapres.php'; ?>
<?php elseif ($pg == enkripsi('haples')) : ?>
    <?php include 'hapus/haples.php'; ?>	
	
<!-- HOME -->
<?php elseif ($pg == enkripsi('surat')) : ?>
    <?php include 'surat/surat.php'; ?>
<?php elseif ($pg == enkripsi('blokir')) : ?>
    <?php include 'surat/blokir.php'; ?>	
<!-- DATABASE -->

<?php elseif ($pg == enkripsi('resetpres')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>	
<?php elseif ($pg == enkripsi('suara')) : ?>
    <?php include 'suara.php'; ?>	
	
<?php elseif ($pg == enkripsi('cetak')) : ?>
    <?php include 'kartu/cetak.php'; ?>
<!-- TARIK -->
<?php elseif ($pg == enkripsi('setsinkron')) : ?>
    <?php include 'tarik/setting.php'; ?>
<?php elseif ($pg == enkripsi('sinmas')) : ?>
    <?php include 'tarik/sinmas.php'; ?>
	
<!-- GPS -->
<?php elseif ($pg == enkripsi('luar')) : ?>
    <?php include 'gps/dinlu.php'; ?>
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'face/resetdata.php'; ?>
<?php else : ?>
 <div class="app app-error align-content-stretch d-flex flex-wrap">
        <div class="app-error-info">
            <h5>Oops!</h5>
            <span>It seems that the page you are looking for no longer exists.<br>
                We will try our best to fix this soon.</span>
            <a href="." class="btn btn-dark">Go to dashboard</a>
        </div>
        <div class="app-error-background"></div>
    </div>

<?php endif ?>
