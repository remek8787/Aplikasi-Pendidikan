<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>

<?php elseif ($pg == enkripsi('materi')) : ?>
    <?php include 'materi/materi.php'; ?>
<?php elseif ($pg == enkripsi('inputmateri')) : ?>
    <?php include 'materi/inputmateri.php'; ?>
<?php elseif ($pg == enkripsi('tugas')) : ?>
    <?php include 'tugas/tugas.php'; ?>
<?php elseif ($pg == enkripsi('inputtugas')) : ?>
    <?php include 'tugas/inputtugas.php'; ?>
<?php elseif ($pg == enkripsi('absensi')) : ?>
    <?php include 'cetak/abdaring.php'; ?>	
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'cetak/resetdata.php'; ?>		
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
