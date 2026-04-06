<?php
ini_set('max_execution_time', 600); 
require "../../konek/koneksi.php";
require "../../konek/function.php";
require "../../konek/crud.php";
$waktusinkron = date('D, d-m-Y H:i:s');
if ($koneksi) {
    $token = $setting['token_api'];
	$npsn = $_POST['npsn'];
    $data[]='register';
	
    if ($token <> '' and $data <> '') {
        foreach ($data as $data) {
            $masuk = $masuk2 = 0;
            if ($data == 'register') {
                $datax = http_request($setting['server'] . "/sinkron/sinmaster.php?token=" . $token);
                $r = json_decode($datax, TRUE);
                if ($r <> null) {
                  $sql = mysqli_query($koneksi, "truncate table datareg");
				  
                    foreach ($r['register'] as $rg) {
                       $sqlreg = mysqli_query($koneksi, "insert into datareg
                                (id,nokartu,idsiswa,idpeg,level,nama) values 			
                                ('$rg[id]','$rg[nokartu]','$rg[idsiswa]','$rg[idpeg]','$rg[level]','" . addslashes($rg['nama']) . "')");

                            $masuk++;
                        
                    }
				$exec = mysqli_query($koneksi, "update sinkron set jumlah='$masuk',tanggal='$waktusinkron' where kode='REGISTER'");
              }
			
            }
			if ($data == 'absensi') {
                $syncdata = http_request($setting['server'] . "/sinkron/sinmaster.php?token=" . $token);

                $sync = json_decode($syncdata, TRUE);

                if ($sync <> null) {
                
                     $sql = mysqli_query($koneksi, "truncate table absensi");
                    foreach ($sync['absensi'] as $a) {
                      
                        $sqlpel = mysqli_query($koneksi, "insert into absensi
                                (nokartu,tanggal,idsiswa,kelas,idpeg,level,masuk,pulang,ket,bulan,tahun,keterangan,mesin) values 			
                                ('$a[nokartu]','$a[tanggal]','$a[idsiswa]','$a[kelas]','$a[idpeg]','$a[level]','$a[masuk]','$a[pulang]','$a[ket]','$a[bulan]','$a[tahun]','$a[keterangan]','$a[mesin]')");
                        
                            $masuk2++;
                        
					}
                 
                   $exec = mysqli_query($koneksi, "update sinkron set jumlah='$masuk2',tanggal='$waktusinkron' where kode='ABSENSI'");
              }
			}
			
			
		}
	}
}