<?php

$pathdir = "files/"; 
$zipcreated = "files.zip";
$zip = new ZipArchive;
if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
    $dir = opendir($pathdir);
    while($file = readdir($dir)) {
        if(is_file($pathdir.$file)) {
            $zip -> addFile($pathdir.$file, $file);
        }
    }
    $zip ->close();
}
  
?>