<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'edit') {
	$ids = $_POST['ids'];

        $data = [
        'kegiatan'     => $_POST['kegiatan'],
		'status'     => 0
        ];
		
		$where=[
		'idsiswa' =>$ids,
		'tanggal'=> $tanggal
		];
    $exec = update($koneksi, 'pkl_kegiatan', $data,$where);
	

function compressImage($source, $destination, $quality) { 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime'];  
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
      
    imagejpeg($image, $destination, $quality); 
    
    return $destination; 
} 
  
$uploadPath = "../../images/fotopkl/"; 

    if(!empty($_FILES["file"]["name"])) { 
       
        $fileName = basename($_FILES["file"]["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
           
            $imageTemp = $_FILES["file"]["tmp_name"]; 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 50); 
              
            if($compressedImage){ 
			$datax = [
			'foto' =>  $fileName
			];
              $exec = update($koneksi, 'pkl_kegiatan', $datax, ['idsiswa' => $ids]);
            }else{ 
             
            } 
        }else{ 
           
        } 
    }else{ 
      
    } 

}

	
	
	