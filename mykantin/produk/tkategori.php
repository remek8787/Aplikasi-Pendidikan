<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
	$produk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT produk_kategori FROM produk  WHERE produk_kategori='$id'"));
   $busek = delete($koneksi, 'transaksi', ['idproduk' => $produk['produk_kategori']]);
   $buseq = delete($koneksi, 'keranjang', ['idproduk' => $produk['produk_kategori']]);
   $exec = delete($koneksi, 'kategori', ['kategori_id' => $id]);
   $hapus = delete($koneksi, 'produk', ['produk_kategori' => $id]);
	
	if($exec){
		$query = "SELECT * FROM kategori ORDER BY kategori_id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['kategori_id'];
	 $query2 = "UPDATE kategori SET kategori_id = $no WHERE kategori_id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE kategori  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $cek = rowcount($koneksi, 'kategori', ['kategori_nama' => $_POST['kategori']]);
    if ($cek > 0) {
        echo "gagal";
    } else {
     $data = [
	    'kategori_nama' => $_POST['kategori']
			];
			$exec = insert($koneksi, 'kategori', $data);
			echo "OK";                   		
	  }
        
}
 
if ($pg == 'edit') {
	$idk = $_POST['idk'];
    
        $data = [
       'kategori_nama' => $_POST['kategori']
        ];
   
    $exec = update($koneksi, 'kategori', $data, ['kategori_id' => $idk]);
    echo $exec;
	
}
if ($pg == 'profil') {
	$kategori_id = $_POST['iduser'];
    if ($_POST['password'] <> "") {
        $data = [
       'nip'     => $_POST['nip'],
        'nama'   => $_POST['nama'],
		'jenis'   => $_POST['jenis'],
		 'nowa'   => $_POST['nowa'],
		'walas'   => $_POST['walas'],
        'password'  => $_POST['password']
        ];
    } else {
        $data = [
       'nip'     => $_POST['nip'],
        'nama'   => $_POST['nama'],
		 'nowa'   => $_POST['nowa'],
		'walas'   => $_POST['walas']
        
      
        ];
    }
   
    $exec = update($koneksi, 'kategori', $data, ['kategori_id' => $kategori_id]);
    echo $exec;
	 $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
       $dest = '../../images/fotoguru/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
		'foto' => $file
		];
		 $exec = update($koneksi, 'kategori', $datax, ['kategori_id' => $kategori_id]);
	}
   }
   }
    if ($_FILES['ttd']['name'] <> '') {
            $logo = $_FILES['ttd']['name'];
            $temp = $_FILES['ttd']['tmp_name'];
            $ext = explode('.', $logo);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
               $dest = 'ttd' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
								  if ($upload) {
                    $exec = update($koneksi, 'kategori', ['ttd' => $dest], ['kategori_id' => $kategori_id]);
                }
            }
        }
}
?>