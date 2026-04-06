<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('profil')) : ?>
    <?php include 'pengaturan/profil.php'; ?>
<?php elseif ($pg == enkripsi('pegawai')) : ?>
    <?php include 'pegawai/guru.php'; ?>
<?php elseif ($pg == enkripsi('produksi')) : ?>
    <?php include 'profil/produksi.php'; ?>
<?php elseif ($pg == enkripsi('bursa')) : ?>
    <?php include 'profil/bursa.php'; ?>
<?php elseif ($pg == enkripsi('ujikom')) : ?>
    <?php include 'profil/ujikom.php'; ?>
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