<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'toko', ['idt' => $id]);
	if($exec){
		$query = "SELECT * FROM toko ORDER BY idt";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['idt'];
	 $query2 = "UPDATE toko SET idt = $no WHERE idt = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE toko  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
     $data = [
	   
        'nama_toko'     => $_POST['nama'],
        'deskrip'   => $_POST['deskrip']
		
			];
			$exec = insert($koneksi, 'toko', $data);
			echo "OK";                   		
}
        
	
if ($pg == 'edit') {
	$idt = $_POST['idt'];
    
        $data = [
      
        'nama_toko'     => $_POST['nama'],
        'deskrip'   => $_POST['deskrip']
      
        ];
   
    $exec = update($koneksi, 'toko', $data, ['idt' => $idt]);
    echo $exec;
}

?>