<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
cek_session_siswa();
$id_bank = $_POST['id_bank'];
$id_siswa = $_POST['id_siswa'];
$id_ujian = $_POST['id_ujian'];
$jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank'"));
                       
                 
$jumjawab = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND id_ujian='$id_ujian'"));
$cekragu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND id_ujian='$id_ujian' and ragu='1'"));
 
if ($jumsoal == $jumjawab) {
    if ($cekragu == 0) {
        echo "ok";
    } else {
        echo "ragu";
    }
} else {
    echo "belum";
}
