<?php
require "../../../config/koneksi.php";

require "../../../config/function.php";
$idb = $_POST['id'];
$mapel = mysqli_query($koneksi, "SELECT file, file1, fileA, fileB, fileC, fileD, fileE FROM soal WHERE id_bank='$idb'");
while ($mapelb = mysqli_fetch_array($mapel)) :
    if ($mapelb['file'] <> "") {
        $file = $mapelb['file'];
        $path = '../../../files/' . $mapelb['file'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['file1'] <> "") {
        $file = $mapelb['file1'];
        $path = '../../../files/' . $mapelb['file1'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileA'] <> "") {
        $file = $mapelb['fileA'];
        $path = '../../../files/' . $mapelb['fileA'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileB'] <> "") {
        $file = $mapelb['fileB'];
        $path = '../../../files/' . $mapelb['fileB'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileC'] <> "") {
        $file = $mapelb['fileC'];
        $path = '../../../files/' . $mapelb['fileC'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileD'] <> "") {
        $file = $mapelb['fileD'];
        $path = '../../../files/' . $mapelb['fileD'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileE'] <> "") {
        $file = $mapelb['fileE'];
        $path = '../../../files/' . $mapelb['fileE'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
endwhile;

if (isset($array)) :
    $backup_file = '../../../' . $idb .'.zip';
    if (file_exists($backup_file)) {
        unlink($backup_file);
    }
    $jumlah_array = count($array);
    $zip = new ZipArchive;
    if ($zip->open($backup_file, ZipArchive::CREATE) === TRUE) {
        for ($i = 0; $i < $jumlah_array; $i++) :
            $zip->addFile($array[$i]);
        endfor;
        $zip->close();
    }
    for ($i = 0; $i < $jumlah_array; $i++) :
        unlink($array[$i]);
    endfor;
endif;

?>
