<?php
require __DIR__ . '/konek/koneksi.php';
header('Content-Type: text/plain; charset=utf-8');
if (!$koneksi) {
    echo 'DB_FAIL: ' . mysqli_connect_error() . "\n";
    exit;
}
mysqli_set_charset($koneksi, 'utf8mb4');
mysqli_query($koneksi, "SET SESSION sql_mode='' ");

$createUsers = <<<'SQL'
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `nowa` varchar(50) DEFAULT NULL,
  `sts` int(11) NOT NULL DEFAULT 0,
  `idjari` varchar(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `walas` varchar(50) DEFAULT NULL,
  `tingkat` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `sesi` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `golongan` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `norek` varchar(50) DEFAULT NULL,
  `nokartu` varchar(50) DEFAULT NULL,
  `saldo` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
SQL;

if (!mysqli_query($koneksi, $createUsers)) {
    echo 'CREATE_USERS_FAIL: ' . mysqli_error($koneksi) . "\n";
    exit;
}

echo "users_table_ready=yes\n";

$adminHash = password_hash('admin123', PASSWORD_DEFAULT);
$admin2Hash = password_hash('admin123', PASSWORD_DEFAULT);

$rows = [
    [1,'','Admin','admin',$adminHash,'admin','','2','','','','','','','','','','','','','','','','0'],
    [2,'09383948894819384','Lionel Messi, S.Pd. Gr.','guru1','guru1','guru','0882021733186','1','1','','Guru','X-A','','','','','','','','','BRI','4749578285927852','','0'],
    [3,'00394749739738547','Christiano Ronald, S.Pd.','guru2','guru2','guru','08468278783','1','2','','Guru','X-B','','','','','','','','','BNI','48472824784728842','','0'],
    [4,'374819376481768793','Anaya Putri, S.Pd. M.Pd.','guru3','guru3','guru','0882739466718','0','','','Guru','XI-A','','','','','','','','','0','0','','0'],
    [5,'','Ananda, S.Pd., M.Pd.','admin123',$admin2Hash,'admin','','0','','','','','','','','','','','','','','','','0'],
    [6,'83947820248754902','Elianor Elisa, S.Pd.','staff','staff','staff','0','0','','','Staff','','','','','','','','','','0','0','','0'],
    [7,'','Amelia Olivia, S.Pd.','pengawas','pengawas','awas','0','0','','','','','10','X-A','R1','1','','','','','','','','0'],
];

$sql = "REPLACE INTO users (id_user,nip,nama,username,password,level,nowa,sts,idjari,foto,jabatan,walas,tingkat,kelas,ruang,sesi,status,pendidikan,jk,golongan,bank,norek,nokartu,saldo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = mysqli_prepare($koneksi, $sql);
if (!$stmt) {
    echo 'PREPARE_FAIL: ' . mysqli_error($koneksi) . "\n";
    exit;
}
foreach ($rows as $r) {
    mysqli_stmt_bind_param($stmt, 'issssssissssssssssssssss', ...$r);
    if (!mysqli_stmt_execute($stmt)) {
        echo 'UPSERT_FAIL: ' . mysqli_stmt_error($stmt) . "\n";
        exit;
    }
}
mysqli_stmt_close($stmt);

echo "seeded_users=7\n";
$q = mysqli_query($koneksi, "SELECT id_user, username, level FROM users ORDER BY id_user ASC");
while ($row = mysqli_fetch_assoc($q)) {
    echo json_encode($row, JSON_UNESCAPED_UNICODE) . "\n";
}

echo "DONE\n";
