<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/konek/koneksi.php';
header('Content-Type: text/plain; charset=utf-8');

if (!$koneksi) {
    echo "DB connect failed: " . mysqli_connect_error() . "\n";
    exit;
}

mysqli_set_charset($koneksi, 'utf8mb4');
mysqli_query($koneksi, "SET SESSION sql_mode='' ");

$source = __DIR__ . '/myapp/pengaturan/backup/newsandik1749048925.sql';
if (!file_exists($source)) {
    echo "SQL source not found: $source\n";
    exit;
}

$sql = file_get_contents($source);
if ($sql === false) {
    echo "Failed to read SQL source\n";
    exit;
}

// Repair malformed dump fragments found in m_sub_elemen rows.
$sql = preg_replace('/"\R\s*",""\s*\R\s*/u', '","', $sql);
$sql = preg_replace('/"\R\s*","/u', '","', $sql);
$sql = preg_replace('/",""\s*\R\s*/u', '","', $sql);

// Remove incompatible DB-select statements if present.
$sql = preg_replace('/^\s*CREATE DATABASE.*?;\s*$/mi', '', $sql);
$sql = preg_replace('/^\s*USE\s+`?.*?`?;\s*$/mi', '', $sql);

$parts = preg_split('/;\s*\n/', $sql);
$done = 0;
$failed = 0;
$firstError = null;

mysqli_query($koneksi, 'SET FOREIGN_KEY_CHECKS=0');

// Clean existing partially imported tables first.
$tables = [];
$res = mysqli_query($koneksi, 'SHOW TABLES');
if ($res) {
    while ($row = mysqli_fetch_row($res)) {
        if (!empty($row[0])) $tables[] = '`' . str_replace('`', '``', $row[0]) . '`';
    }
}
if ($tables) {
    mysqli_query($koneksi, 'DROP TABLE IF EXISTS ' . implode(',', $tables));
}

foreach ($parts as $part) {
    $stmt = trim($part);
    if ($stmt === '') continue;
    if (!mysqli_query($koneksi, $stmt)) {
        $failed++;
        if ($firstError === null) {
            $firstError = [
                'error' => mysqli_error($koneksi),
                'snippet' => substr($stmt, 0, 700),
            ];
            break;
        }
    } else {
        $done++;
    }
}

mysqli_query($koneksi, 'SET FOREIGN_KEY_CHECKS=1');

echo "executed_ok={$done}\n";
echo "failed={$failed}\n";
if ($firstError) {
    echo "error=" . $firstError['error'] . "\n";
    echo "snippet=\n" . $firstError['snippet'] . "\n";
    exit;
}

$q = mysqli_query($koneksi, "SHOW TABLES LIKE 'pengaturan'");
echo 'pengaturan_table=' . (($q && mysqli_num_rows($q) > 0) ? 'yes' : 'no') . "\n";
if ($q && mysqli_num_rows($q) > 0) {
    $s = mysqli_query($koneksi, "SELECT sekolah, aplikasi, waktu FROM pengaturan WHERE id_aplikasi='1' LIMIT 1");
    if ($s) {
        $row = mysqli_fetch_assoc($s) ?: [];
        echo 'sekolah=' . ($row['sekolah'] ?? '') . "\n";
        echo 'aplikasi=' . ($row['aplikasi'] ?? '') . "\n";
        echo 'waktu=' . ($row['waktu'] ?? '') . "\n";
    }
}

echo "IMPORT_DONE\n";
