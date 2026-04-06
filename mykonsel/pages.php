<?php if ($pg == '') : ?>
     <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('kategori')): ?>
    <?php include 'kategori.php'; ?>
<?php elseif ($pg == enkripsi('subkategori')): ?>
    <?php include 'subkategori.php'; ?>
<?php elseif ($pg == enkripsi('pelanggaran')): ?>
    <?php include 'pelanggaran.php'; ?>
<?php elseif ($pg == enkripsi('tindakan')): ?>
    <?php include 'tindakan.php'; ?>
<?php elseif ($pg == enkripsi('inputbk')): ?>
    <?php include 'inputpelanggaran.php'; ?>
<?php elseif ($pg == enkripsi('surat')): ?>
    <?php include 'surat.php'; ?>
<!-- TARIK -->
<?php elseif ($pg == enkripsi('setsinkron')) : ?>
    <?php include 'tarik/setting.php'; ?>
<?php elseif ($pg == enkripsi('sinmas')) : ?>
    <?php include 'tarik/sinmas.php'; ?>

<?php elseif ($pg == enkripsi('pesan')) : ?>
    <?php include 'pesan.php'; ?>

	
<?php else : ?>
    <div class='error-page'>
        <h2 class='headline text-yellow'> 404</h2>
        <div class='error-content'>
            <br />
            <h3><i class='fa fa-warning text-yellow'></i> Upss! Halaman tidak ditemukan.</h3>
            <p>
                Halaman yang anda inginkan saat ini tidak tersedia.<br />
                Silahkan kembali ke <a href='?'><strong>dashboard</strong></a> dan coba lagi.<br />
                Hubungi petugas <strong><i>Developer</i></strong> jika ini adalah sebuah masalah.
            </p>
        </div>
    </div>
<?php endif ?>
 <?php
 $sp1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_tindakan WHERE tindakan='SP1'"));
 $sp2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_tindakan WHERE tindakan='SP2'"));
 $sp3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_tindakan WHERE tindakan='SP3'"));
 
 $query = mysqli_query($koneksi, "select * from bk_siswa");
 while ($siswa = mysqli_fetch_array($query)):
 $poin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nis,SUM(poin) AS total FROM bk_siswa WHERE nis='$siswa[nis]' "));
 $kt1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE ket='SP1' AND nis='$poin[nis]'"));
 $kt2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE ket='SP2' AND nis='$poin[nis]'"));
 $kt3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE ket='SP3' AND nis='$poin[nis]'"));
 
 if($kt1==0):
if($poin['total'] >=$sp1['minpoin'] and $poin['total'] <= $sp1['maxpoin']){
$exec = mysqli_query($koneksi, "INSERT INTO bk_sp(nis,ket,poin,tapel) VALUES('$poin[nis]','SP1','$poin[total]','$setting[tp]')");
}
endif;
if($kt2==0):
 if($poin['total'] >=$sp2['minpoin'] and $poin['total'] <= $sp2['maxpoin']){
$exec = mysqli_query($koneksi, "INSERT INTO bk_sp(nis,ket,poin,tapel) VALUES('$poin[nis]','SP2','$poin[total]','$setting[tp]')");
}
endif;
if($kt3==0):
if($poin['total'] >=$sp3['minpoin'] and $poin['total'] <= $sp3['maxpoin']){
$exec = mysqli_query($koneksi, "INSERT INTO bk_sp(nis,ket,poin,tapel) VALUES('$poin[nis]','SP3','$poin[total]','$setting[tp]')");
}
endif;
 endwhile;
 

?>