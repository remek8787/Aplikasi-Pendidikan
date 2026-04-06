<?php
  
    if ($_FILES['file']['name'] != '') {
        $file_name = $_FILES['file']['name'];
        $array = explode(".", $file_name);
        $name = $array[0];
        $ext = $array[1];
        if ($ext == 'zip') {
            $path = '../../images/fotosiswa/';
            $location = $path . $file_name;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $zip = new ZipArchive;
                if ($zip->open($location)) {
                    $zip->extractTo($path);
                    $zip->close();
                }
                unlink($location);
               
            }
        } else {
            
        }
    }

?>
