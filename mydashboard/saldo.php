<div class="row">
<div class="col-md-12">
   <div class="card">
       <div class="card-header">
          <a href="." class="btn btn-secondary btn-sm"> <i class="material-icons">west</i><strong class="card-title"> Back</strong></a>       
		<div class="kanan">
		Saldo Rp <?= number_format($siswa['saldo']) ?>
		</div>
		</div>
         <div class="card-body">
		 <table id="tablesaldo" class="table table-bordered" style="width:100%">
		 <tr>
           
		     <td style="text-align:center; vertical-align:middle;width:15%">Tanggal</td>
			   <td style="text-align:center; vertical-align:middle;">Debet</td>
			     <td style="text-align:center; vertical-align:middle;">Kredit</td>
				  <td style="text-align:center; vertical-align:middle;">Ket</td>
			</tr>
		 <?php
			$no=0;
			$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE idsiswa='$id_siswa' ORDER BY id DESC LIMIT 10"); 
			while ($data = mysqli_fetch_array($query)) :
			
			$no++;
			?>
             <tr>
               
			    <td><?= date('d-m-Y',strtotime($data['tanggal'])) ?><br><?= $data['jam'] ?></td>
				 <td style="text-align:right;">Rp<?= number_format($data['debet']) ?></td>
				  <td style="text-align:right;">Rp<?= number_format($data['kredit']) ?></td>
				    <td><?= $data['ket'] ?></td>
			</tr>
			<?php endwhile; ?>
			</table>
			
		 </div>
             </div>
                 </div>
                   </div>
				  
				   