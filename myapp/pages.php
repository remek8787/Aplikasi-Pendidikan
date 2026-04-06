<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('bell')) : ?>
    <?php include 'bell/bell.php'; ?>
 <!-- PENGATURAN -->
<?php elseif ($pg == enkripsi('sekolah')) : ?>
    <?php include 'pengaturan/sekolah.php'; ?>
<!-- MASTER -->
<?php elseif ($pg == enkripsi('mapel')) : ?>
    <?php include 'mapel/mapel.php'; ?>
<?php elseif ($pg == enkripsi('walas')) : ?>
    <?php include 'walas/walas.php'; ?>
<?php elseif ($pg == enkripsi('imporsis')) : ?>
    <?php include 'siswa/imporsis.php'; ?>
<?php elseif ($pg == enkripsi('siswa')) : ?>
    <?php include 'siswa/siswa.php'; ?>	
<?php elseif ($pg == enkripsi('eskul')) : ?>
    <?php include 'eskul/eskul.php'; ?>		
<!-- MUTASI -->
<?php elseif ($pg == enkripsi('tamat')) : ?>
    <?php include 'mutasi/tamat.php'; ?>
<?php elseif ($pg == enkripsi('naik')) : ?>
    <?php include 'mutasi/naik.php'; ?>
<?php elseif ($pg == enkripsi('pdb')) : ?>
    <?php include 'mutasi/pdb.php'; ?>
<!-- KURIKULUM -->
<?php elseif ($pg == enkripsi('kuri')) : ?>
    <?php include 'kurikulum/kurikulum.php'; ?>
<?php elseif ($pg == enkripsi('pk')) : ?>
    <?php include 'kurikulum/pk.php'; ?>
	
<!-- USERS -->
<?php elseif ($pg == enkripsi('guru')) : ?>
    <?php include 'user/guru.php'; ?>
<?php elseif ($pg == enkripsi('admin')) : ?>
    <?php include 'user/admin.php'; ?>
<?php elseif ($pg == enkripsi('staff')) : ?>
    <?php include 'user/staff.php'; ?>


<!-- DATABASE -->
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>
<?php elseif ($pg == enkripsi('backup')) : ?>
    <?php include 'pengaturan/backupdata.php'; ?>
<?php elseif ($pg == enkripsi('restore')) : ?>
    <?php include 'pengaturan/restoredata.php'; ?>
<?php elseif ($pg == enkripsi('optimal')) : ?>
    <?php include 'pengaturan/optimal.php'; ?>		

<?php elseif ($pg == enkripsi('kantin')) : ?>
    <?php include 'kantin.php'; ?>
<?php elseif ($pg == enkripsi('history')) : ?>
    <?php include 'history.php'; ?>	
<?php elseif ($pg == enkripsi('saldoku')) : ?>
    <?php include 'saldo.php'; ?>	
<?php elseif ($pg == enkripsi('lampu')) : ?>
    <?php include 'lampu.php'; ?>		
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
