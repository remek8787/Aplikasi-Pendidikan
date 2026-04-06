<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('atur')) : ?>
    <?php include 'pengaturan/pengaturan.php'; ?>
<?php elseif ($pg == enkripsi('mapel')) : ?>
    <?php include 'mapel/mapel.php'; ?>
<?php elseif ($pg == enkripsi('ph')) : ?>
    <?php include 'nilai/ph.php'; ?>	
<?php elseif ($pg == enkripsi('pts')) : ?>
    <?php include 'nilai/pts.php'; ?>
<?php elseif ($pg == enkripsi('pas')) : ?>
    <?php include 'nilai/pas.php'; ?>	
<?php elseif ($pg == enkripsi('pat')) : ?>
    <?php include 'nilai/pat.php'; ?>		
<?php elseif ($pg == enkripsi('desrapor')) : ?>
    <?php include 'deskrip/deskrip.php'; ?>	
<?php elseif ($pg == enkripsi('desmer')) : ?>
    <?php include 'deskrip/desmer.php'; ?>		
<?php elseif ($pg == enkripsi('kkm')) : ?>
    <?php include 'kkm/kkm.php'; ?>	
<?php elseif ($pg == enkripsi('sikap')) : ?>
    <?php include 'kkm/sikap.php'; ?>	
<?php elseif ($pg == enkripsi('deskrip3')) : ?>
    <?php include 'nilai/deskrip3.php'; ?>	
<?php elseif ($pg == enkripsi('nsikap')) : ?>
    <?php include 'nilai/nsikap.php'; ?>	
<?php elseif ($pg == enkripsi('rappts')) : ?>
    <?php include 'cetak/pts.php'; ?>	
<?php elseif ($pg == enkripsi('rapor')) : ?>
    <?php include 'cetak/rapor.php'; ?>	
<?php elseif ($pg == enkripsi('menu13')) : ?>
    <?php include 'nilai/menu13.php'; ?>
<?php elseif ($pg == enkripsi('menu23')) : ?>
    <?php include 'nilai/menu23.php'; ?>	
<?php elseif ($pg == enkripsi('pts2')) : ?>
    <?php include 'nilai/pts2.php'; ?>
<?php elseif ($pg == enkripsi('sumatif')) : ?>
    <?php include 'nilai/sumatif.php'; ?>	
<?php elseif ($pg == enkripsi('sumatifpas')) : ?>
    <?php include 'nilai/sumatifpas.php'; ?>		
<?php elseif ($pg == enkripsi('sumatifpat')) : ?>
    <?php include 'nilai/sumatifpat.php'; ?>	
<?php elseif ($pg == enkripsi('formatif')) : ?>
    <?php include 'nilai/formatif.php'; ?>	
<?php elseif ($pg == enkripsi('peskul')) : ?>
    <?php include 'eskul/peskul.php'; ?>	
<?php elseif ($pg == enkripsi('nileskul')) : ?>
    <?php include 'eskul/nileskul.php'; ?>	
<?php elseif ($pg == enkripsi('absensi')) : ?>
    <?php include 'walas/absen.php'; ?>	
<?php elseif ($pg == enkripsi('prestasi')) : ?>
    <?php include 'walas/prestasi.php'; ?>	
<?php elseif ($pg == enkripsi('catatan')) : ?>
    <?php include 'walas/catat.php'; ?>	
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>	
<?php elseif ($pg == enkripsi('leger')) : ?>
    <?php include 'walas/leger.php'; ?>	
<?php elseif ($pg == enkripsi('kelompok')) : ?>
    <?php include 'mapel/kelompok.php'; ?>		
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
<?php mysqli_query($koneksi,"DELETE FROM absensi_mapel WHERE tanggal<>'$tanggal'"); ?>