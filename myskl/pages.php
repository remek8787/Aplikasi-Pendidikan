<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('skl')) : ?>
    <?php include 'skl/skl.php'; ?>
<?php elseif ($pg == enkripsi('skb')) : ?>
    <?php include 'skl/skb.php'; ?>
<?php elseif ($pg == enkripsi('nilai')) : ?>
    <?php include 'nilai/nilai.php'; ?>	
<?php elseif ($pg == enkripsi('ujian')) : ?>
    <?php include 'nilai/ujian.php'; ?>	
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>	
<?php elseif ($pg == enkripsi('cskl')) : ?>
    <?php include 'cetak/cetak.php'; ?>	
<?php elseif ($pg == enkripsi('cskb')) : ?>
    <?php include 'cetak/cskb.php'; ?>	
<?php elseif ($pg == enkripsi('ctrp')) : ?>
    <?php include 'cetak/ctrp.php'; ?>	
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