<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>

<?php if ($ac == ''): ?>
<div class='row'>
        <div class='col-md-12'>
            <div class="card">
             <div class="card-header">
			  <h5 class='card-title'>DATA SURAT PERINGATAN 1</h5>
				  </div>   
			 
				<div class="card-body">
                   <div class='table-responsive'>
                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                             
                             <th>NO</th>								                                 
                              <th>NIS</th>	
                              <th>KELAS</th>	
                               <th>NAMA SISWA</th>
                               <th width='10%'>POIN</th>								   
						       <th width='12%'></th>
                            </tr>							
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_sp WHERE tapel='$setting[tp]' AND ket='SP1'");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
                            $siswa=fetch($koneksi,'siswa',['nis'=>$bk['nis']]);		
                            $srt=fetch($koneksi,'bk_surat',['nis'=>$bk['nis']]);
                            $bs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_siswa WHERE nis='$bk[nis]' AND sts='SP1'"));							
                                $no++;                             
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
									 <td style="color:blue"><b><?= $siswa['nis'] ?></b></td>
                                    <td><?= $siswa['kelas'] ?></td>	
									<td><?= $siswa['nama'] ?></td>
									<td><b><?= $bk['poin'] ?></b></td>
								   <td>	
                                    <?php if($bk['sts']=='SP1' AND $bs<>0): ?>
                                      <a href="cetaksurat.php?id=<?= $bk['id'] ?>" target="_blank" class="btn btn-sm btn-success" data-bs-placement="top" data-bs-toggle="tooltip" title="Cetak Surat"><i class="material-icons">print</i></a>
                                     <?php elseif($bk['sts']=='0' ): ?>									
								    <a href="?pg=<?= enkripsi('surat') ?>&ac=<?= enkripsi('buatsurat') ?>&id=<?= enkripsi($bk['id']) ?>" class="btn btn-sm btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Buat Surat"><i class="material-icons">mail</i></a>
				                     
									<?php endif; ?>
									</td>
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
				
            </div>
        </div>
    </div>
</div>

<?php elseif($ac == 'reset'): ?>	
<?php
$exec = mysqli_query($koneksi, "truncate bk_siswa");
$exec = mysqli_query($koneksi, "truncate bk_sp");
$exec = mysqli_query($koneksi, "truncate bk_surat");
$exec = mysqli_query($koneksi, "truncate bk_pesan");
$exec = mysqli_query($koneksi, "update sinkron set jumlah=NULL,tanggal=NULL where id='7'");
$exec = mysqli_query($koneksi, "update sinkron set jumlah=NULL,tanggal=NULL where id='8'");
?>
<?php elseif($ac == 'sp2'): ?>	
<div class='row'>
        <div class='col-md-12'>
             <div class="card">
             <div class="card-header">
			 <h5 class='card-title'>DATA SURAT PERINGATAN 2</h5>
			  </div>    
			
						<div class="card-body">
                   <div class='table-responsive'>
                       <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                             
                              <th>NO</th>								                                 
                              <th>NIS</th>	
                              <th>KELAS</th>	
                               <th>NAMA SISWA</th>
                               <th width='10%'>POIN</th>								   
						       <th width='12%'></th>
                            </tr>							
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_sp WHERE tapel='$setting[tp]' AND ket='SP2'");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
                            $siswa=fetch($koneksi,'siswa',['nis'=>$bk['nis']]);		
                            $srt=fetch($koneksi,'bk_surat',['nis'=>$bk['nis']]);
                            $bs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_siswa WHERE nis='$bk[nis]' AND sts='SP2'"));							
                                $no++;                             
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
									 <td style="color:blue"><b><?= $siswa['nis'] ?></b></td>
                                    <td><?= $siswa['kelas'] ?></td>	
									<td><?= $siswa['nama'] ?></td>
									<td><b><?= $bk['poin'] ?></b></td>
								   <td>	
                                    <?php if($bk['sts']=='SP2'): ?>
                                      <a href="cetaksurat2.php?id=<?= $bk['id'] ?>" target="_blank" class="btn btn-sm btn-success" data-bs-placement="top" data-bs-toggle="tooltip" title="Cetak Surat"><i class="material-icons">print</i></a>
                                     <?php elseif($bk['sts']=='0' ): ?>									
								    <a href="?pg=<?= enkripsi('surat') ?>&ac=<?= enkripsi('buatsurat2') ?>&id=<?= enkripsi($bk['id']) ?>" class="btn btn-sm btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Buat Suratt"><i class="material-icons">mail</i></a>
				                    
									<?php endif; ?>
									</td>
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
				
            </div>
        </div>
    </div>
</div>
<?php elseif($ac == 'sp3'): ?>	
<div class='row'>
        <div class='col-md-12'>
            <div class="card">
             <div class="card-header">
			  <h5 class='card-title'>DATA SURAT PERINGATAN 3</h5>
			  </div>    
			 
						<div class="card-body">
                   <div class='table-responsive'>
                       <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                             
                              <th>NO</th>								                                 
                              <th>NIS</th>	
                              <th>KELAS</th>	
                               <th>NAMA SISWA</th>
                               <th width='10%'>POIN</th>								   
						       <th width='12%'></th>
                            </tr>							
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_sp WHERE tapel='$setting[tp]' AND ket='SP3'");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
                            $siswa=fetch($koneksi,'siswa',['nis'=>$bk['nis']]);		
                            $srt=fetch($koneksi,'bk_surat',['nis'=>$bk['nis']]);
                            $bs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_siswa WHERE nis='$bk[nis]' AND sts='SP3'"));							
                                $no++;                             
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
									 <td style="color:blue"><b><?= $siswa['nis'] ?></b></td>
                                    <td><?= $siswa['kelas'] ?></td>	
									<td><?= $siswa['nama'] ?></td>
									<td><b><?= $bk['poin'] ?></b></td>
								   <td>	
                                    <?php if($bk['sts']=='SP3'): ?>
                                      <a href="cetaksurat3.php?id=<?= $bk['id'] ?>" target="_blank" class="btn btn-sm btn-success" data-bs-placement="top" data-bs-toggle="tooltip" title="Cetak Surat"><i class="material-icons">print</i></a>
                                     <?php elseif($bk['sts']=='0' ): ?>									
								    <a href="?pg=<?= enkripsi('surat') ?>&ac=<?= enkripsi('buatsurat3') ?>&id=<?= enkripsi($bk['id']) ?>" class="btn btn-sm btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Buat Surat"><i class="material-icons">mail</i></a>
				                    
									<?php endif; ?>
									</td>
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
				
            </div>
        </div>
    </div>
</div>
<?php elseif($ac == enkripsi('buatsurat')): ?>	
<?php
$id = dekripsi($_GET['id']);
$sp = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE id='$id'"));
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$sp[nis]'"));
?>
<?php
function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = $romawi." / ".$tahun;
$blnQ=date('m');
$query = "SELECT max(id) as maxKode FROM bk_surat";
$hasil = mysqli_query($koneksi,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;

$kode =  sprintf("%03s", $noUrut);
$nomorbaru = $kode." / ".$setting['kode_sekolah']." / ".$nomor;
$bulane=fetch($koneksi,'bulan',['bln'=>$blnQ]);
?>

<div class='row'>
        <div class='col-md-12'>
             <div class="card">
             <div class="card-header">
			  <h5 class='card-title'>INPUT SURAT PERINGATAN 1</h5>
			  </div>    
			 
				<div class="card-body">
				  <form  id="formsurat" class="form-horizontal" enctype='multipart/form-data'>
				  <input type="hidden" name="sts" value="<?= $sp['ket'] ?>">
				    <input type="hidden" name="idsp" value="<?= $id ?>">
                  <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Tahun Pelajaran</label>
							<div class="col-sm-5">
							<select  class='form-control' name="tapel" required >
							 <option value="<?= $setting['tp'] ?>"><?= $setting['tp'] ?></option>
							  
                                                    </select>   
                                            </div>
						            </div>
							 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">N I S</label>
							<div class="col-sm-5">
							<input type="text" name="nis" value="<?= $siswa['nis'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Nama Siswa</label>
							<div class="col-sm-5">
							<input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Kelas</label>
							<div class="col-sm-5">
							<input type="text" name="nama" value="<?= $siswa['kelas'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Nomor Surat</label>
							<div class="col-sm-9">
							    <input type='text' name='nosurat' value="<?= $nomorbaru ?>" class='form-control' readonly>
                                            </div>
						            </div>
							 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Tanggal Surat</label>
							<div class="col-sm-9">
							    <input type='text' name='tanggal' class='datepicker form-control' autocomplete='off' required='true' />
                                            </div>
						            </div>
									<div class="row mb-2">
					     <label  class="col-md-3 col-form-label bold">Sanksi</label>
							<div class="col-sm-9">
							    <textarea name='sanksi' class='form-control' rows="2" autocomplete='off' required='true' /></textarea>
                                            </div>
						            </div>
							<div class='kanan'>
									  <button type='submit'  class='btn btn-primary'>Simpan</button>
										 
								</div>
									
							</form>
							 </div>
						</div>
					</div>
				</div>
			</div>
			<script>
		$('#formsurat').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_surat.php?pg=surat1", 
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
             $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(surat) ?>');
                }, 2000);

            }
        });
        return false;
    });
</script>
			
<?php elseif($ac == enkripsi('buatsurat2')): ?>	
<?php
$id = dekripsi($_GET['id']);
$sp = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE id='$id'"));
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$sp[nis]'"));
?>
<?php
function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = $romawi." / ".$tahun;
$blnQ=date('m');
$query = "SELECT max(id) as maxKode FROM bk_surat";
$hasil = mysqli_query($koneksi,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;

$kode =  sprintf("%03s", $noUrut);
$nomorbaru = $kode." / ".$setting['kode_sekolah']." / ".$nomor;
$bulane=fetch($koneksi,'bulan',['bln'=>$blnQ]);
?>

<div class='row'>
        <div class='col-md-12'>
           <div class="card">
             <div class="card-header">
			 <h5 class='card-title'>INPUT SURAT PERINGATAN 2</h5>
			  </div>    
			 
			 <div class="card-body">
				  <form  id="formsurat" class="form-horizontal" enctype='multipart/form-data'>
				  <input type="hidden" name="sts" value="<?= $sp['ket'] ?>">
				    <input type="hidden" name="idsp" value="<?= $id ?>">
                  <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Tahun Pelajaran</label>
							<div class="col-sm-5">
							<select  class='form-control' name="tapel" required >
							 <option value="<?= $setting['tp'] ?>"><?= $setting['tp'] ?></option>
							  
                                                    </select>   
                                            </div>
						            </div>
							 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">N I S</label>
							<div class="col-sm-5">
							<input type="text" name="nis" value="<?= $siswa['nis'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Nama Siswa</label>
							<div class="col-sm-5">
							<input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Kelas</label>
							<div class="col-sm-5">
							<input type="text" name="nama" value="<?= $siswa['kelas'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Nomor Surat</label>
							<div class="col-sm-9">
							    <input type='text' name='nosurat' value="<?= $nomorbaru ?>" class='form-control' readonly>
                                            </div>
						            </div>
							 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Tanggal Surat</label>
							<div class="col-sm-9">
							    <input type='text' name='tanggal' class='datepicker form-control' autocomplete='off' required='true' />
                                            </div>
						            </div>
									<div class="row mb-2">
					     <label  class="col-md-3 col-form-label bold">Sanksi</label>
							<div class="col-sm-9">
							    <textarea name='sanksi' class='form-control' rows="2" autocomplete='off' required='true' /></textarea>
                                            </div>
						            </div>
							<div class='kanan'>
									  <button type='submit'  class='btn btn-primary'>Simpan</button>
										 
											</div>
									
							</form>
							 </div>
						</div>
					</div>
				</div>
			</div>
			<script>
		$('#formsurat').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_surat.php?pg=surat1", 
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
            $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(surat) ?>&ac=sp2');
                }, 2000);

            }
        });
        return false;
    });
</script>
			<?php elseif($ac == enkripsi('buatsurat3')): ?>	
<?php
$id = dekripsi($_GET['id']);
$sp = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE id='$id'"));
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$sp[nis]'"));
?>
<?php
function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = $romawi." / ".$tahun;
$blnQ=date('m');
$query = "SELECT max(id) as maxKode FROM bk_surat";
$hasil = mysqli_query($koneksi,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;

$kode =  sprintf("%03s", $noUrut);
$nomorbaru = $kode." / ".$setting['kode_sekolah']." / ".$nomor;
$bulane=fetch($koneksi,'bulan',['bln'=>$blnQ]);
?>

<div class='col-md-12'>
           <div class="card">
             <div class="card-header">
			 <h5 class='card-title'>INPUT SURAT PERINGATAN 3</h5>
			  </div>    
			 
			 <div class="card-body">
				  <form  id="formsurat" class="form-horizontal" enctype='multipart/form-data'>
				  <input type="hidden" name="sts" value="<?= $sp['ket'] ?>">
				    <input type="hidden" name="idsp" value="<?= $id ?>">
                  <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Tahun Pelajaran</label>
							<div class="col-sm-5">
							<select  class='form-control' name="tapel" required >
							 <option value="<?= $setting['tp'] ?>"><?= $setting['tp'] ?></option>
							  
                                                    </select>   
                                            </div>
						            </div>
							 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">N I S</label>
							<div class="col-sm-5">
							<input type="text" name="nis" value="<?= $siswa['nis'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Nama Siswa</label>
							<div class="col-sm-5">
							<input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Kelas</label>
							<div class="col-sm-5">
							<input type="text" name="nama" value="<?= $siswa['kelas'] ?>" class="form-control" readonly> 
                                            </div>
						            </div>
									 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Nomor Surat</label>
							<div class="col-sm-9">
							    <input type='text' name='nosurat' value="<?= $nomorbaru ?>" class='form-control' readonly>
                                            </div>
						            </div>
							 <div class="row mb-2">
					<label  class="col-md-3 col-form-label bold">Tanggal Surat</label>
							<div class="col-sm-9">
							    <input type='text' name='tanggal' class='datepicker form-control' autocomplete='off' required='true' />
                                            </div>
						            </div>
									<div class="row mb-2">
					     <label  class="col-md-3 col-form-label bold">Sanksi</label>
							<div class="col-sm-9">
							    <textarea name='sanksi' class='form-control' rows="2" autocomplete='off' required='true' /></textarea>
                                            </div>
						            </div>
							<div class='kanan'>
									  <button type='submit'  class='btn btn-primary'>Simpan</button>
										 
											</div>
									
							</form>
							 </div>
						</div>
					</div>
				</div>
			</div>
			<script>
		$('#formsurat').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_surat.php?pg=surat1", 
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
            $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(surat) ?>&ac=sp3');
                }, 2000);

            }
        });
        return false;
    });
</script>
<?php endif; ?>