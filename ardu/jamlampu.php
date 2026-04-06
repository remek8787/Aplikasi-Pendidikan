<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

$sql = "SELECT status FROM lampu ORDER BY id ASC";
$result = $koneksi->query($sql);

$statusList = [];

while ($row = $result->fetch_assoc()) {
    $statusList[] = $row['status'];
}

echo implode(',', $statusList);

$koneksi->close();
 
?>