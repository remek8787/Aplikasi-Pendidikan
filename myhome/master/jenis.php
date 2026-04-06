<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>

<?php if ($ac == '') : ?>
	<div class='row'>
		<div class="col-xl-8" >
			<div class="card" >
				<div class="card card-header" >	
				<h5 class="card-title">JENIS ASESMEN</h5>
			</div>				
     <div class="card-body">                    
   <div class="table-responsive">
   <table id="datatable1" class="table  table-bordered table-hover edis2">
        <thead>
            <tr>
            <th>NO</th>
			<th>KODE</th>
			 <th>NAMA UJIAN</th>
			<th>STATUS</th>			
			<th>ACTION</th>
            </tr>
        </thead>
		<tbody>
		 <?php $Q = mysqli_query($koneksi, "SELECT * FROM jenis ORDER BY status");?>
           <?php while ($jenis = mysqli_fetch_array($Q)) : ?>
			<?php
                   $no++;
                       ?>
                        <tr>
                         <td><?= $no ?></td>
						 <td><?= $jenis['id_jenis'] ?></td>
						 <td><?= $jenis['nama'] ?></td>
                         <td><?= strtoupper($jenis['status']); ?></td>
						
                         <td>
						 <a href="?pg=<?= enkripsi('jenis') ?>&ac=edit&id=<?= $jenis['id_jenis'] ?>"> <button class='btn btn-sm btn-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class='material-icons'>edit</i></button></a>
						 <button data-id="<?= $jenis['id_jenis'] ?>" class="hapus btn-sm btn btn-danger"><i class="material-icons">delete</i></button>
						 </td>								
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
       </div>                     
			
        <div class='col-md-4'>
           <div class="card">
              <div class="card-header">
			
					</div>
			<div class="card-body">   
				<div class="d-flex align-items-center flex-column mb-4">
					<div class="d-flex align-items-center flex-column">
						<div class="sw-13 position-relative mb-3">
					<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
						</div>
						<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
					<div class="text-muted">HIGH SCHOOL</div>
						</div>
					</div>			
		          <form id='formjenis' class="row g2" enctype='multipart/form-data'>
					<div class="col-md-12 mb-2">
                      <label class="bold">Kode</label>
                        <input type='text' name='kode' class='form-control' required />
                      </div>
                   				   
					<div class="col-md-12 mb-2">
                      <label class="bold">Nama Ujian</label>
                        <input type='text' name='nama' class='form-control' required />
                      </div>
                       
						<div class="col-md-12 mb-2">
                      <label class="bold">Status</label>                    
                       <select name='status' class='form-select' required='true'>
					    <option value=''>Pilih Status</option>
                           <option value='aktif'>AKTIF</option>
						   <option value='tidak'>TIDAK</option>
						   </select>
                      </div>
					 
                    <div class="col-md-12 mb-2">
                     <button type='submit' name='submit' class='btn btn-primary kanan' id="blockui-3">Simpan</button>
                         </div>
                    </form> 
             					
				</div>
			</div>
		</div>
	</div>
	
<?php elseif ($ac == 'edit') : ?>
	<?php $id=$_GET['id']; ?>
<?php $jns=fetch($koneksi,'jenis',['id_jenis'=>$id]); ?>	
<div class='row'>

        <div class='col-md-8'  >
          <div class="card">
              <div class="card-header">
				 <h5 class="card-title">JENIS ASESMEN</h5>
										
		</div>
     <div class="card-body">                                    
         <div class="table-responsive">
   <table id="datatable1" class="table  table-bordered" style="width:100%;font-size:12px">
        <thead>
            <tr>
            <th>NO</th>
			<th>KODE</th>
			 <th>NAMA UJIAN</th>
			<th>STATUS</th>			
			
            </tr>
        </thead>
		<tbody>
		 <?php $Q = mysqli_query($koneksi, "SELECT * FROM jenis ORDER BY status");?>
           <?php while ($jenis = mysqli_fetch_array($Q)) : ?>
			<?php
                   $no++;
                       ?>
                        <tr>
                         <td><?= $no ?></td>
						 <td><?= $jenis['id_jenis'] ?></td>
						 <td><?= $jenis['nama'] ?></td>
                         <td><?= $jenis['status'] ?></td>
												
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
       </div>                     
			
        <div class='col-md-4'>
           <div class="card">
              <div class="card-header">
				 </div>
     <div class="card-body">  
			<div class="d-flex align-items-center flex-column mb-4">
					<div class="d-flex align-items-center flex-column">
						<div class="sw-13 position-relative mb-3">
					<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
						</div>
						<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
					<div class="text-muted">HIGH SCHOOL</div>
						</div>
					</div>			 
		       <form id='formedit' class="form-horizontal" enctype='multipart/form-data'>
					<input type="hidden" name="id" value="<?= $id ?>" >
						<div class="col-md-12 mb-2">
                      <label class="bold">Kode</label>
                        <input type='text' name='kode' class='form-control' value="<?= $jns['id_jenis'] ?>" required />
                      </div>
          	   
					<div class="col-md-12 mb-2">
                      <label class="bold">Nama Ujian</label>                     
                        <input type='text' name='nama' class='form-control' value="<?= $jns['nama'] ?>" required />
                      </div>
                    
						<div class="col-md-12 mb-2">
                      <label class="bold">Status</label>                   
                       <select name='status' class='form-select' required='true'>
                           <option value="<?= $jns['status'] ?>"><?= strtoupper($jns['status']) ?></option>
						    <option value='aktif'>AKTIF</option>
						   <option value='tidak'>TIDAK</option>
						   </select>
                      </div>
                    
                  <br>
                    <div class="col-md-12 mb-2">
                     <button type='submit' name='submit' class="btn btn-primary kanan">Simpan</button>
                         </div>
                    </form> 
              					
				</div>
			</div>
		</div>
	</div>
		
				
		<?php endif; ?>
		<script>
    $('#formjenis').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'master/tjenis.php?pg=tambah',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;margin-left:100px;"></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 500);
            },
            success: function(response) {

						setTimeout(function() {
                    window.location.reload();
                    }, 2000);
             
            }
        });
    });
</script>
		 <script>
    $('#formedit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'master/tjenis.php?pg=edit',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;margin-left:100px;"></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 500);
            },
            success: function(response) {

						setTimeout(function() {
                      window.location.replace('?pg=<?= enkripsi(jenis) ?>');
                    }, 1000);
             
            }
        });
    });
</script>
<script>
$('#datatable1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
			type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'master/tjenis.php?pg=hapus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;margin-left:100px;"></div>');
					$('.progress-bar').animate({
        
						}, 500);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
            return false;
        })

    });
	</script>