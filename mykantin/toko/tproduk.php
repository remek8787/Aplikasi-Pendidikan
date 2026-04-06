<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
	
   $busek = delete($koneksi, 'transaksi', ['idproduk' => $id]);
   $buseq = delete($koneksi, 'keranjang', ['idproduk' => $id]);
   $hapus = delete($koneksi, 'produk', ['produk_id' => $id]);
	
	if($exec){
		$query = "SELECT * FROM produk ORDER BY produk_id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['produk_id'];
	 $query2 = "UPDATE produk SET produk_id = $no WHERE produk_id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE produk AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $cek = rowcount($koneksi, 'produk', ['produk_nama' => $_POST['nama']]);
    if ($cek > 0) {
        echo "gagal";
    } else {
		 $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../gambar/produk/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
     $data = [
	    'produk_nama' => $_POST['nama'],
		 'produk_toko' => $_POST['idtoko'],
		'produk_kategori' => $_POST['kategori'],
		'produk_harga' => $_POST['harga'],
		'produk_jumlah' => $_POST['jumlah'],
		'produk_foto1' => $file
			];
		$exec = insert($koneksi,'produk', $data);
			echo "OK"; 	
	  }	
	}
}else{
		  $datax = [
	    'produk_nama' => $_POST['nama'],
		 'produk_toko' => $_POST['idtoko'],
		'produk_kategori' => $_POST['kategori'],
		'produk_harga' => $_POST['harga'],
		'produk_jumlah' => $_POST['jumlah']
		
			];
		$exec = insert($koneksi,'produk', $datax);
			echo "OK"; 	
			
	  }     
 }
}
if ($pg == 'edit') {
	$idp = $_POST['idp'];
    
      $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../gambar/produk/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
     $data = [
	    'produk_nama' => $_POST['nama'],
		 'produk_toko' => $_POST['idtoko'],
		'produk_kategori' => $_POST['kategori'],
		'produk_harga' => $_POST['harga'],
		'produk_jumlah' => $_POST['jumlah'],
		'produk_foto1' => $file
			];
		$exec = update($koneksi,'produk', $data,['produk_id'=>$idp]);
			echo "OK"; 	
	  }	
	}
}else{
		  $datax = [
	    'produk_nama' => $_POST['nama'],
		 'produk_toko' => $_POST['idtoko'],
		'produk_kategori' => $_POST['kategori'],
		'produk_harga' => $_POST['harga'],
		'produk_jumlah' => $_POST['jumlah']
		
			];
		$exec = update($koneksi,'produk', $datax,['produk_id'=>$idp]);
			echo "OK"; 	
			
	  }     
 
	
}
if ($pg == 'stok') {
	$idp = $_POST['idp'];
	$jumlah = $_POST['jumlah'];
	$tambah = $_POST['tambah'];
	
	$stock = $jumlah + $tambah;
	$exec = mysqli_query($koneksi,"UPDATE produk SET produk_jumlah='$stock' WHERE produk_id='$idp'");
			echo "OK"; 	
}
?>