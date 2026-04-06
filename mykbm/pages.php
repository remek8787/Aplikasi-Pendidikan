<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('jjm')) : ?>
    <?php include 'jjm/jjm.php'; ?>
<?php elseif ($pg == enkripsi('mjadwal')) : ?>
    <?php include 'jadwal/jadwal.php'; ?>

<?php elseif ($pg == enkripsi('agenda')) : ?>
    <?php include 'agenda/agenda.php'; ?>	
<?php elseif ($pg == enkripsi('ctkagenda')) : ?>
    <?php include 'agenda/cetak.php'; ?>
<?php elseif ($pg == enkripsi('nilai')) : ?>
    <?php include 'nilai/nilph.php'; ?>
<?php elseif ($pg == enkripsi('cnil')) : ?>
    <?php include 'nilai/cnilai.php'; ?>
<?php elseif ($pg == enkripsi('kikd')) : ?>
    <?php include 'kurtilas/kikd.php'; ?>
<?php elseif ($pg == enkripsi('crpp1')) : ?>
    <?php include 'kurtilas/crpp.php'; ?>	
<?php elseif ($pg == enkripsi('cp')) : ?>
    <?php include 'adm/cp.php'; ?>
<?php elseif ($pg == enkripsi('cpel')) : ?>
    <?php include 'adm/cpel.php'; ?>
<?php elseif ($pg == enkripsi('intp')) : ?>
    <?php include 'adm/intp.php'; ?>
<?php elseif ($pg == enkripsi('atp')) : ?>
    <?php include 'adm/atp.php'; ?>	
<?php elseif ($pg == enkripsi('konten')) : ?>
    <?php include 'adm/konten.php'; ?>	
<?php elseif ($pg == enkripsi('cmodul1')) : ?>
    <?php include 'adm/modul1.php'; ?>		
<?php elseif ($pg == enkripsi('cmodul2')) : ?>
    <?php include 'adm/modul2.php'; ?>			
<?php elseif ($pg == enkripsi('cmodul3')) : ?>
    <?php include 'adm/modul3.php'; ?>	
<?php elseif ($pg == enkripsi('crpp')) : ?>
    <?php include 'adm/crpp.php'; ?>
<?php elseif ($pg == enkripsi('crpp2')) : ?>
    <?php include 'kurtilas/crpp2.php'; ?>
<?php elseif ($pg == enkripsi('crpp3')) : ?>
    <?php include 'kurtilas/crpp3.php'; ?>	
<?php elseif ($pg == enkripsi('cprota')) : ?>
    <?php include 'adm/cprota.php'; ?>	
<?php elseif ($pg == enkripsi('cpromes')) : ?>
    <?php include 'adm/cpromes.php'; ?>	
	
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>
<?php elseif ($pg == enkripsi('notif')) : ?>
    <?php include 'pengaturan/notif.php'; ?>
<?php elseif ($pg == enkripsi('inref')) : ?>
    <?php include 'refleksi/inref.php'; ?>
<?php elseif ($pg == enkripsi('jaref')) : ?>
    <?php include 'refleksi/jaref.php'; ?>	
<?php elseif ($pg == enkripsi('jadref')) : ?>
    <?php include 'refleksi/jadref.php'; ?>		
<?php elseif ($pg == enkripsi('hasil')) : ?>
    <?php include 'refleksi/hasil.php'; ?>	

<?php elseif ($pg == enkripsi('cprota13')) : ?>
    <?php include 'kurtilas/cprota.php'; ?>
<?php elseif ($pg == enkripsi('cpromes13')) : ?>
    <?php include 'kurtilas/cpromes.php'; ?>	
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