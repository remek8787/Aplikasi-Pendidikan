<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
	$fs = fetch($koneksi,'siswa',['kelas'=>$_POST['kelas']]);
			$data = [
	            'ke'=>$_POST['ke'],
				'fase' => $fs['fase'],
				'tingkat' => $_POST['level'],
				'kelas'=>$_POST['kelas'],
				 'judul'=>$_POST['judul'],
				 'deskripsi'=>$_POST['deskripsi'],
				 'semester'=>$setting['semester']
				];
	 $where = [
		'kelas'=>$_POST['kelas'],
		'ke'=>$_POST['ke']			
    ];
	 $cek = rowcount($koneksi, 'm_proyek', $where);
            if ($cek == 0) {
            $exec = insert($koneksi, 'm_proyek', $data);
            echo "OK";
        }
}

if ($pg == 'hapus') {
    $id = $_POST['id'];
	$pr=fetch($koneksi,'m_proyek',['id'=>$id]);
    delete($koneksi, 'm_proyek', ['id' => $id]);
	 delete($koneksi, 'proyek', ['p_proyek' => $id]);
	 delete($koneksi, 'nilai_proyek', ['proyek' => $id]);
	 delete($koneksi, 'nilai_proses', ['proyek_ke' => $pr['ke']]);
}
if ($pg == 'tambah_proyek') {
	
    $data = [
	'p_proyek' => $_POST['proyek'],
	'kelas' => $_POST['kelas'],
	'p_dimensi'=>$_POST['dimensi'],
	'p_elemen'=>$_POST['elemen'],
	'p_sub'=>$_POST['sub_elemen'],
	'semester'=>$setting['semester']
    ];
	
	 $cek = rowcount($koneksi, 'proyek', $data);
            if ($cek == 0) {
            $exec = insert($koneksi, 'proyek', $data);
            echo "OK";
        }
}
if ($pg == 'hapus_proyek') {
    $id = $_POST['id'];
    delete($koneksi, 'proyek', ['idp' => $id]);
}
if ($pg == 'reset') {
    $id = $_POST['id'];
    delete($koneksi, 'nilai_proyek', ['idproyek' => $id]);
}
if ($pg == 'edit_nilai') {
    $id = $_POST['id'];
	$data=[
	'nilai'=>$_POST['nilai']
	];
    $exec = update($koneksi, 'nilai_proyek',$data, ['idn' => $id]);
	echo $exec;
}
if ($pg == 'tambah_catatan') {
	
  
    $data = [
				'proyek_ke' => $_POST['proyek'],
				'kelas' => $_POST['kelas'],
				'idsiswa'=>$_POST['ids'],
				 'catatan'=>$_POST['catatan'],
				 'semester'=>$setting['semester']
    ];
	$where = [
				'proyek_ke' => $_POST['proyek'],
				'kelas' => $_POST['kelas'],
				'idsiswa'=>$_POST['ids'],
			    'semester'=>$setting['semester']
				 
    ];
	 $cek = rowcount($koneksi, 'nilai_proses', $where);
            if ($cek == 0) {
            $exec = insert($koneksi, 'nilai_proses', $data);
            echo $exec;
        }
}
if ($pg == 'edit') {
	$id = $_POST['id'];
    $data = [
	
	'judul'=>$_POST['judul'],
	'deskripsi'=>$_POST['deskripsi']				
    ];
	 $exec = update($koneksi, 'm_proyek', $data,['id'=>$id]);
            echo $exec;
}
if ($pg == 'ambil_elemen') {
    $id_dimensi = $_POST['dimensi'];
    $sql = mysqli_query($koneksi, "SELECT * FROM m_elemen WHERE iddimensi='" . $id_dimensi . "' ");
    echo "<option value=''>--Pilih Elemen--</option>";
   while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[id_elemen]'>$data[elemen]</option>";
    }
}
if ($pg == 'ambil_sub_elemen') {
    $id_elemen = $_POST['elemen'];
    $sql = mysqli_query($koneksi, "SELECT * FROM m_sub_elemen WHERE idelemen='" . $id_elemen . "' ");
    echo "<option value=''>--Pilih Sub Elemen--</option>";
   while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[id_sub]'>$data[sub_elemen]</option>";
    }
}
if ($pg == 'ambil_kelas') {
    $fase = $_POST['fase'];
    $sql = mysqli_query($koneksi, "SELECT * FROM siswa JOIN kelas ON kelas.id_kelas=siswa.id_kelas WHERE siswa.fase='" . $fase . "' AND kelas.kurikulum='Merdeka' GROUP BY siswa.id_kelas");
    echo "<option value=''>--Pilih Kelas--</option>";
   while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[id_kelas]'>$data[id_kelas]</option>";
    }
}