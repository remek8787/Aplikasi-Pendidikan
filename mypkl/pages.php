<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('dudi')) : ?>
    <?php include 'dudi/dudi.php'; ?>
<?php elseif ($pg == enkripsi('siswa')) : ?>
    <?php include 'siswa/siswa.php'; ?>
<?php elseif ($pg == enkripsi('prakerin')) : ?>
    <?php include 'siswa/dtprk.php'; ?>
<?php elseif ($pg == enkripsi('guru')) : ?>
    <?php include 'guru/guru.php'; ?>
<?php elseif ($pg == enkripsi('panitia')) : ?>
    <?php include 'panitia/guru.php'; ?>
<?php elseif ($pg == enkripsi('kompetensi')) : ?>
    <?php include 'kompetensi/kompeten.php'; ?>
<?php elseif ($pg == enkripsi('sikap')) : ?>
    <?php include 'siswa/nilai.php'; ?>
<?php elseif ($pg == enkripsi('status')) : ?>
    <?php include 'siswa/status.php'; ?>
<?php elseif ($pg == enkripsi('statusjurnal')) : ?>
    <?php include 'siswa/statusjurnal.php'; ?>
<?php elseif ($pg == enkripsi('inputnilai')) : ?>
    <?php include 'siswa/nilaipkl.php'; ?>
<?php elseif ($pg == enkripsi('presensi')) : ?>
    <?php include 'siswa/absensi.php'; ?>	
<?php elseif ($pg == enkripsi('jurnal')) : ?>
    <?php include 'siswa/jurnal.php'; ?>	
<?php elseif ($pg == enkripsi('inputlaporan')) : ?>
    <?php include 'siswa/nilailaporan.php'; ?>	
<?php elseif ($pg == enkripsi('lokasi')) : ?>
    <?php include 'lokasi.php'; ?>	
<?php elseif ($pg == enkripsi('cetakhasil')) : ?>
    <?php include 'siswa/hasil.php'; ?>	
<?php elseif ($pg == enkripsi('cetakjurnal')) : ?>
    <?php include 'cetak/jurnal.php'; ?>	
<?php elseif ($pg == enkripsi('cetakpresensi')) : ?>
    <?php include 'cetak/absensi.php'; ?>	
<?php elseif ($pg == enkripsi('monitor')) : ?>
    <?php include 'guru/monitor.php'; ?>	
<?php elseif ($pg == enkripsi('cetakmonitor')) : ?>
    <?php include 'cetak/cetakmonitor.php'; ?>	
<?php elseif ($pg == enkripsi('jurnalharian')) : ?>
    <?php include 'cetak/jurnalharian.php'; ?>	
<?php elseif ($pg == enkripsi('resetpres')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>
<?php elseif ($pg == enkripsi('sertifikat')) : ?>
    <?php include 'siswa/sertifikat.php'; ?>	
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
