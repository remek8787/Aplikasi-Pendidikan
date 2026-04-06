<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>ID PEMBAYARAN</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>
<link rel='stylesheet' href='../../vendor/css/bootstrap.min.css' />
</head>
<style>
@page { margin: 80px; }
body { margin: 20px; }
</style>
<body style="font-size: 12px;">	


<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            
   <br>
		
		<center><h4>ID PEMBAYARAN</h4></center>
		<br>
 
    
		 <table class='it-grid it-cetak' width='100%'>       
              <tr>
                <th width="5%" height="40px" class="text-center">ID</th>
                <th width="15%" class="text-center">KODE</th>
                <th  class="text-center">NAMA</th>
				 <th width="15%" class="text-center">MODE</th>
                <th width="15%" class="text-center">TOTAL RP</th>
               
            </tr>
                  <?php
				  $no = 0;
			$query = mysqli_query($koneksi,"select * from m_bayar");
              while ($data = mysqli_fetch_array($query)) {
		    if($data['model']==1){
				$model = 'Sekali Bayar';
			}else{
				$model = 'Bulanan';
			}
			  $no++;
			?>
			
							<tr>
                                    <td class="text-center"><?= $data['id'] ?></td>
                                    <td><?= $data['kode'] ?></td>
									<td><?= $data['nama'] ?></td>
									<td><?= $model ?></td>
				                    
									<td class="text-right"><?= number_format($data['total']) ?></td>
			                        
									 </tr>   
			  <?php } ?>
                    
								
            </table>
			<br>
			
	
</div>
</body>

</html>
<?php

$html = ob_get_clean();
require_once '../../pdf/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'Potrait');
$dompdf->render();
$dompdf->stream("Kode Pembayaran.pdf", array("Attachment" => false));
exit(0);
?>