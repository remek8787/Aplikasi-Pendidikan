<?php
require("../../konek/koneksi.php");
$tables = array();
$result = mysqli_query($koneksi, "SHOW TABLES");

while ($row = mysqli_fetch_row($result)) {
	$tables[] = $row[0];
}



$sqlScript = "";
foreach ($tables as $table) {    
	$result = mysqli_query($koneksi, "SHOW CREATE TABLE $table");
	$row = mysqli_fetch_row($result);
	$sqlScript .= "\n\n" . $row[1] . ";\n\n";
	
	$result = mysqli_query($koneksi, "SELECT * FROM $table");
	$columnCount = mysqli_num_fields($result);

	for ($i = 0; $i < $columnCount; $i ++) {
		while ($row = mysqli_fetch_row($result)) {
			$sqlScript .= "INSERT INTO $table VALUES(";
				for ($j = 0; $j < $columnCount; $j ++) {
					$row[$j] = $row[$j];

					if (isset($row[$j])) {
						$sqlScript .= '"' . $row[$j] . '"';
					} else {
						$sqlScript .= '""';
					}
					if ($j < ($columnCount - 1)) {
						$sqlScript .= ',';
					}
				}
				$sqlScript .= ");\n";
			}
		}

		$sqlScript .= "\n"; 
	}



	if(!empty($sqlScript))
	{    
		$backup_file_name ='backup/newsandik'. time() . '.sql';
		
		$handle = fopen($backup_file_name, 'w+');
		
		fwrite($handle, $sqlScript);
        fclose($handle);

	}

?>
<div class="alert alert-custom" role="alert">
	
	Database <?= $backup_file_name; ?> telah di Backup<br />
	silahkan untuk mendownload database klik
	<a href="pengaturan/download.php?filename=<?= $backup_file_name ?>" ><button class="btn btn-outline-primary"> Download</button></a>

	</div>