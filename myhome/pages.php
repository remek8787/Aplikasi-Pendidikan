<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == 'info') : ?>
    <?php include 'info.php'; ?>
 <!-- PENGATURAN -->
<?php elseif ($pg == enkripsi('pengaturan')) : ?>
    <?php include 'asesmen/pengaturan.php'; ?>

<!-- MASTER -->
<?php elseif ($pg == enkripsi('mapel')) : ?>
    <?php include 'mapel/mapel.php'; ?>
<?php elseif ($pg == enkripsi('jenis')) : ?>
    <?php include 'master/jenis.php'; ?>
<?php elseif ($pg == enkripsi('imporsis')) : ?>
    <?php include 'siswa/imporsis.php'; ?>
<?php elseif ($pg == enkripsi('siswa')) : ?>
    <?php include 'siswa/siswa.php'; ?>	
<?php elseif ($pg == enkripsi('update')) : ?>
    <?php include 'update/update.php'; ?>		
	
<!-- USERS -->
<?php elseif ($pg == enkripsi('pengawas')) : ?>
    <?php include 'pengawas/pengawas.php'; ?>
<?php elseif ($pg == enkripsi('guru')) : ?>
    <?php include 'user/guru.php'; ?>
<!-- BANKSOAL -->
<?php elseif ($pg == enkripsi('banksoal')) : ?>
    <?php include 'bank/banksoal.php'; ?>
<?php elseif ($pg == 'banksoal') : ?>
    <?php include 'bank/banksoal.php'; ?>
<!-- EDIT SOAL -->
<?php elseif ($pg == enkripsi('editsoal1')): ?>
    <?php include 'bank/editsoal1.php'; ?>		
<?php elseif ($pg == enkripsi('editsoal2')): ?>
    <?php include 'bank/editsoal2.php'; ?>	
<?php elseif ($pg == enkripsi('editsoal3')): ?>
    <?php include 'bank/editsoal3.php'; ?>	
<?php elseif ($pg == enkripsi('editsoal4')): ?>
    <?php include 'bank/editsoal4.php'; ?>	
<?php elseif ($pg == enkripsi('editsoal5')): ?>
    <?php include 'bank/editsoal5.php'; ?>		

 <!-- FILE SOAL -->
<?php elseif ($pg == enkripsi('file')) : ?>
    <?php include 'asesmen/sandik_file/filesoal.php'; ?>	
<!-- BACKUP SOAL -->
<?php elseif ($pg == 'backupexcel'): ?>
    <?php include 'asesmen/backupexcel.php'; ?>	
<!-- JADWAL -->
<?php elseif ($pg == enkripsi('jadwal')) : ?>
    <?php include 'asesmen/jadwal.php'; ?>		
<!-- NILAI -->
<?php elseif ($pg == enkripsi('nilai')) : ?>
    <?php include 'siswa/nilai.php'; ?>			
<!-- PESERTA -->
<?php elseif ($pg == enkripsi('status')) : ?>
    <?php include 'siswa/status.php'; ?>
<?php elseif ($pg == enkripsi('status_ujian')) : ?>
    <?php include 'siswa/status_ujian.php'; ?>
<?php elseif ($pg == 'jawaban') : ?>
    <?php include 'siswa/jawaban.php'; ?>
<?php elseif ($pg == 'jawab') : ?>
    <?php include 'siswa/jawab.php'; ?>
	<!-- CETAK -->
<?php elseif ($pg == enkripsi('karpes')) : ?>
    <?php include 'cetak/kartu.php'; ?>
<?php elseif ($pg == enkripsi('absen')) : ?>
    <?php include 'cetak/absen.php'; ?>	
<?php elseif ($pg == enkripsi('berita')) : ?>
    <?php include 'cetak/berita.php'; ?>	
<?php elseif ($pg == 'buatberita') : ?>
    <?php include 'cetak/buatberita.php'; ?>	
<!-- DATABASE -->
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>
<?php elseif ($pg == enkripsi('backup')) : ?>
    <?php include 'pengaturan/backupdata.php'; ?>
<?php elseif ($pg == enkripsi('restore')) : ?>
    <?php include 'pengaturan/restoredata.php'; ?>
<?php elseif ($pg == enkripsi('optimal')) : ?>
    <?php include 'pengaturan/optimal.php'; ?>		

<?php elseif ($pg == enkripsi('bacsoal')) : ?>
    <?php include 'asesmen/sandik_file/excel.php'; ?>		
	
<?php elseif ($pg == enkripsi('analisis')) : ?>
    <?php include 'analisis/nilaianalisis2.php'; ?>		
<?php elseif ($pg == enkripsi('katrol')) : ?>
    <?php include 'katrol/katrol.php'; ?>
<?php elseif ($pg == enkripsi('ckatrol')) : ?>
    <?php include 'katrol/ckatrol.php'; ?>	
	
<!-- PENGAWAS -->
<?php elseif ($pg == enkripsi('stawas')) : ?>
    <?php include 'pengawas/status.php'; ?>	
<?php elseif ($pg == enkripsi('stawas_ujian')) : ?>
    <?php include 'pengawas/status_ujian.php'; ?>	
<?php elseif ($pg == enkripsi('siswas')) : ?>
    <?php include 'pengawas/siswa.php'; ?>		
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
