<?php
$idu = dekripsi($ac);
$query = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_ujian='$idu'"));
$idbank = $query['id_bank'];

$where = array(
    'id_bank' => $idbank

);
$wherepg = array(
    'id_bank' => $idbank,
    'jenis' => '1'

);
$where2 = array(
    'id_bank' => $idbank,
    'jenis' => '2'
);
$where3 = array(
    'id_bank' => $idbank,
    'jenis' => '3'
);
$where4 = array(
    'id_bank' => $idbank,
    'jenis' => '4'
);
$where5 = array(
    'id_bank' => $idbank,
    'jenis' => '5'
);
$wherelanjut = array(
    'id_bank' => $idbank,
    'id_ujian' => $idu,
    'id_siswa' => $_SESSION['id_siswa']

);
$mapel = fetch($koneksi, 'ujian', array('id_bank' => $idbank, 'id_ujian' => $idu));

$id_acak = [];

$soalsoal = select($koneksi, 'soal', $where);
foreach ($soalsoal as $soalnya) :
    $id_acak[] = $soalnya;
endforeach;
$acak = json_encode($id_acak);
$acak = enkripsi($acak);

$ujian = select($koneksi, 'ujian', array('id_bank' => $idbank, 'id_ujian' => $idu));
$ujianarray = [];
foreach ($ujian as $ujianya) :
    $ujianarray[] = $ujianya;
endforeach;
$ujianarray = json_encode($ujianarray);
$ujianarray = enkripsi($ujianarray);
$nilai = fetch($koneksi, 'nilai', $wherelanjut);

?>
<script>
    var acak = '<?= $acak ?>';
    var acakpg = '<?= $nilai['id_soal'] ?>';
    var ujian = '<?= $ujianarray ?>';
    localStorage.clear();
    localStorage.setItem("ujianya", JSON.stringify(ujian));
    localStorage.setItem("soallokal", JSON.stringify(acak));
    localStorage.setItem("pengacakpg", JSON.stringify(acakpg));
</script>
<?php if ($mapel['ulang'] == 1) { ?>
    <script>
        var acakopsi = '<?= $nilai['id_opsi'] ?>';
        if (localStorage.getItem("pengacakpil") === null) {
            localStorage.setItem("pengacakpil", JSON.stringify(acakopsi));
        }
    </script>
<?php } ?>