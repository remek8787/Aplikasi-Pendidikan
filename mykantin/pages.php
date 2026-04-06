<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('kategori')) : ?>
    <?php include 'produk/kategori.php'; ?>
<?php elseif ($pg == enkripsi('produk')) : ?>
    <?php include 'produk/produk.php'; ?>
	
<?php elseif ($pg == enkripsi('produktoko')) : ?>
    <?php include 'toko/produk.php'; ?>
<?php elseif ($pg == enkripsi('ctrx')) : ?>
    <?php include 'toko/ctrx.php'; ?>	
<?php elseif ($pg == enkripsi('cstk')) : ?>
    <?php include 'toko/cstk.php'; ?>	
<?php elseif ($pg == enkripsi('trxtoko')) : ?>
    <?php include 'toko/trxtoko.php'; ?>	
<?php elseif ($pg == enkripsi('transaksi')) : ?>
    <?php include 'transaksi.php'; ?>	

<?php elseif ($pg == enkripsi('register')) : ?>
    <?php include 'rfid/rfid.php'; ?>
<?php elseif ($pg == enkripsi('regpegawai')) : ?>
    <?php include 'rfid/rfidpeg.php'; ?>
<?php elseif ($pg == enkripsi('pelanggan')) : ?>
    <?php include 'siswa/siswa.php'; ?>
<?php elseif ($pg == enkripsi('pegawai')) : ?>
    <?php include 'siswa/pegawai.php'; ?>	
	
<?php elseif ($pg == enkripsi('topup')) : ?>
    <?php include 'siswa/topup.php'; ?>
<?php elseif ($pg == enkripsi('toppegawai')) : ?>
    <?php include 'siswa/toppegawai.php'; ?>
<?php elseif ($pg == enkripsi('toko')) : ?>
    <?php include 'toko/toko.php'; ?>
<!-- DATABASE -->
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>

<?php elseif ($pg == enkripsi('tran')) : ?>
    <?php include 'manual/tran.php'; ?>
<?php elseif ($pg == enkripsi('struk')) : ?>
    <?php include 'manual/struk.php'; ?>
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
