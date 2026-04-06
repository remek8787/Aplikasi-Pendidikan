<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/apk.php");
require("../konek/crud.php");
(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
($id_siswa == 0) ?  header("Location:$baseurl/mulai.php") : null;
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';
$id = $_GET['id'];
$jam = date('H:i:s');
$buku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM digital WHERE id='$id'"));
$simpan = mysqli_query($koneksi,"INSERT INTO digital_baca(idsiswa,tanggal,jam,idbuku) VALUES('$id_siswa','$tanggal','$jam','$id')");
?>
<!DOCTYPE html>
<html>

  <head>
  <link rel="shortcut icon" href="<?= $baseurl ?>/images/<?= $setting['logo'] ?>">
  <title><?= $setting['sekolah'] ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- AJAX -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <!-- costume css -->
  <link rel="stylesheet" type="text/css" href="css/flipbook.style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  
  <script src="js/flipbook.min.js"></script>

  <script type="text/javascript">

      $(document).ready(function () {
          $("#read").flipBook({
            //Layout Setting
            pdfUrl:"pdf/<?= $buku['file'] ?>",
            lightBox:true,
            layout:3,
            currentPage:{vAlign:"bottom", hAlign:"left"},
            
            btnShare : {enabled:false},
            btnPrint : {enabled:false},
            btn : {enabled:false},
           

            
        });
      })
  </script>

  <style>
    body {
      background-color: #f6f6f6;
    }
    #author {
      font-size: 15px;
      font-weight: bold;
      color: #0186c9;
    }
    #date {
      margin-left: 10px;
      font-size: 15px;
      color: #819196;
    }
    #size {
      font-size: 15px;
      color: #819196;
    }
    #description {
      margin-top: 20px;
      font-weight: lighter;
    }
  </style>

  </head>

  <body>

   <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
      <a class="navbar-brand" href="#">
        <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" width="50px"> <?= $setting['sekolah'] ?>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <a href="." class="btn btn-outline-danger my-2 my-sm-0" > Home</a>
       
      </div>
    </nav>
 
  <br><br><br><br><br>

  <section class="info" id="info">
    <div class="container">
      <div class="card shadow">
	  <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <img src="images/<?= $buku['ikon'] ?>" class="w-100 book-1">
          </div>
          <div class="col-md-7 mt-3">
           
            <h5 id="title">UPLOADED PROFILE</h5>
            <p id="author" class="d-inline"><?= $buku['guru'] ?></p>
            <p id="date" class="d-inline"><?= date('d',strtotime($buku['tanggal'])) ?> <?= bulan_indo($buku['tanggal']) ?> <?= date('Y',strtotime($buku['tanggal'])) ?> <?= $buku['jam'] ?></p>
            <p id="size"><i class="fas fa-file "></i> <?= $buku['judul'] ?></p>
          
            <div class="button">
              <a id="read" class="btn btn-primary mt-2 text-white">Baca Buku <i class="fas fa-book-reader fa-lg"></i></a>
             
            </div>
           
            <p id="description"><?= $buku['deskripsi'] ?></p>
          </div>
        </div>
      </div>
    </div>
</div>
  </section>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  </body>

</html>
