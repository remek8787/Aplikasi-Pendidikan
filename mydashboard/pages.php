<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == 'materi') : ?>
    <?php include 'materi.php'; ?>
<?php elseif ($pg == 'bukamateri') : ?>
    <?php include 'lihatmateri.php'; ?>
<?php elseif ($pg == 'tugas') : ?>
    <?php include 'tugas.php'; ?>
<?php elseif ($pg == 'bukatugas') : ?>
    <?php include 'lihattugas.php'; ?>
<?php elseif ($pg == 'profile') : ?>
    <?php include 'siswa/profile.php'; ?>	
<?php elseif ($pg == 'nilai') : ?>
    <?php include 'nilai/nilai.php'; ?>
<?php elseif ($pg == 'absensi') : ?>
    <?php include 'nilai/absen.php'; ?>
<?php elseif ($pg == 'konsel') : ?>
    <?php include 'nilai/konsel.php'; ?>
<?php elseif ($pg == 'nilaiujian') : ?>
    <?php include 'nilai/ujian.php'; ?>	
<?php elseif ($pg == 'refleksi') : ?>
    <?php include 'refleksi.php'; ?>
<?php elseif ($pg == 'bukarefleksi') : ?>
    <?php include 'bukarefleksi.php'; ?>		
<?php elseif ($pg == 'skl') : ?>
    <?php include 'skl.php'; ?>
<?php elseif ($pg == 'surat') : ?>
    <?php include 'surat.php'; ?>
<?php elseif ($pg == 'kantin') : ?>
    <?php include 'kantin.php'; ?>	
<?php elseif ($pg == 'mykeranjang') : ?>
    <?php include 'keranjang.php'; ?>
<?php elseif ($pg == 'history') : ?>
    <?php include 'history.php'; ?>
<?php elseif ($pg == 'saldo') : ?>
    <?php include 'saldo.php'; ?>
<?php elseif ($pg == 'pkl') : ?>
    <?php include 'pkl.php'; ?>
<?php elseif ($pg == enkripsi('register')) : ?>
    <?php include 'siswa/inreg.php'; ?>
<?php elseif ($pg == enkripsi('absen')) : ?>
    <?php include 'absen.php'; ?>
<?php elseif ($pg == enkripsi('kegiatan')) : ?>
    <?php include 'siswa/kegiatan.php'; ?>
<?php elseif ($pg == enkripsi('jurnal')) : ?>
    <?php include 'siswa/jurnal.php'; ?>
<?php elseif ($pg == enkripsi('tandatangan')) : ?>
    <?php include 'siswa/ttd.php'; ?>		
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