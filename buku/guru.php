<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/apk.php");
require("../konek/crud.php");
(isset($_SESSION['id_user'])) ? $id_user = $_SESSION['id_user'] : $id_user = 0;
($id_user == 0) ? header('location:../myapp/mulai.php') : null;
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$id_user'"));
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';

?>
<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<!-- Costume CSS -->
<link rel="stylesheet" type="text/css" href="css/flipbook.style.css">
<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<!-- Bootstrap Css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="js/flipbook.min.js"></script>


<style type="text/css">
    body {
      background-color: #f6f6f6;
    }
    .bookshelf .thumb{
        display: inline-block;
        cursor: pointer;
        margin: 0px 0.5%;
        width: 15% !important;
        box-shadow:0px 1px 3px rgba(0,0,0,.3);
        max-width:120px;
    }
    .bookshelf .thumb img{
        width:100%;
        display:block;
        vertical-align:top;
    }
    .bookshelf .shelf-img{
        z-index:0;
        height: auto;
        max-width: 100%;
        vertical-align: top;
        margin-top:-12px;
    }
    .bookshelf .covers{
        width:100%;
        height:auto;
        z-index: 99;
        position: relative;
        text-align:center;
    }
    .bookshelf{
        text-align: center;
        padding:0px;
    }
    /* Pagination */
    .pagination>li>a,
    .pagination>li>span {
      color: #c0392b;
    }
    .pagination>li>a:hover,
    .pagination>li>span:hover {
      color: #c0392b !important;
    }
    .pagination>li.active>a {
      background-color: #c0392b !important;
      border: 0;
      color: #fff;
    }
</style>
<link rel="shortcut icon" href="<?= $baseurl ?>/images/<?= $setting['logo'] ?>">
<title><?= $setting['sekolah'] ?></title>

</head>
	<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
      <a class="navbar-brand" href="#">
        <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" width="50px"> <?= $setting['sekolah'] ?>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <a href="../myapp/" class="btn btn-outline-danger my-2 my-sm-0" > Dashboard</a>
       
      </div>
    </nav>
   

    <br><br><br><br><br>

   
    <div class="bookshelf">
        <div class="covers">
		<?php
		$query = mysqli_query($koneksi, "SELECT * FROM digital where id between 1 and 5"); 
		while ($data = mysqli_fetch_array($query)) :
			?>
          <div class="thumb book-1">
		   <?= $data['judul'] ?>
             <a href="v-guru.php?id=<?= $data['id'] ?>">
              <img src="images/<?= $data['ikon'] ?>">
            </a>
			
          </div>
		  <?php endwhile; ?>    
        </div>
        <img class="shelf-img" src="images/shelf_wood.png">
    </div>
    <br>
    <div class="bookshelf">
        <div class="covers">
		<?php
		$query = mysqli_query($koneksi, "SELECT * FROM digital where id between 6 and 10"); 
		while ($data = mysqli_fetch_array($query)) :
			?>
          <div class="thumb book-1">
		   <?= $data['judul'] ?>
            <a href="v-pdf.php?id=<?= $data['id'] ?>">
              <img src="images/<?= $data['ikon'] ?>">
            </a>
			
          </div>
		  <?php endwhile; ?>    
        </div>
        
        <img class="shelf-img" src="images/shelf_glass.png">
    </div>
	<br>
    <div class="bookshelf">
        <div class="covers">
         <div class="bookshelf">
        <div class="covers">
		<?php
		$query = mysqli_query($koneksi, "SELECT * FROM digital where id between 11 and 15"); 
		while ($data = mysqli_fetch_array($query)) :
			?>
          <div class="thumb book-1">
		   <?= $data['judul'] ?>
            <a href="v-pdf.php">
              <img src="images/<?= $data['ikon'] ?>">
            </a>
			
          </div>
		  <?php endwhile; ?>    
        </div>
        <img class="shelf-img" src="images/shelf_metal.png">
    </div>
   <br>
    <div class="bookshelf">
        <div class="covers">
		<?php
		$query = mysqli_query($koneksi, "SELECT * FROM digital where id between 16 and 20"); 
		while ($data = mysqli_fetch_array($query)) :
			?>
          <div class="thumb book-1">
		   <?= $data['judul'] ?>
             <a href="v-pdf.php?id=<?= $data['id'] ?>">
              <img src="images/<?= $data['ikon'] ?>">
            </a>
			
          </div>
		  <?php endwhile; ?>    
        </div>
        <img class="shelf-img" src="images/shelf_wood.png">
    </div>
  
    
   
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</body>
</html>
