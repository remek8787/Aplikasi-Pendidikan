<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $data = [
	  
        'header' => $_POST['header'],
        'nosurat' => $_POST['nosurat'],
        'isi' => $_POST['isi'],
        'foter' => $_POST['foter']
    ];
    $where = [
        'id' => 1
    ];
    $exec = update($koneksi, 'skkb', $data, $where);
    
    
