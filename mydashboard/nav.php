 
 <div class="app-header" >
    <nav class="navbar navbar-light navbar-expand-lg">
       <div class="container-fluid">
          <div class="navbar-nav" id="navbarNav">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a> 
			 
               </li>
			  
            
			 
             
				 </ul>
				
                     </div>
		
           <div class="d-flex" id='progressbox'>
		 
              <ul class="navbar-nav">
			  <?php if($pg=='kantin'): ?>
			    <li class="nav-item">
			    <a class="nav-link" href="?pg=kantin&ac=mykeranjang" style="color:red"><i class="material-icons">shopping_cart</i> <?= $keranjang ?></a>  
				 </li>
				<?php endif; ?> 
                <li class="nav-item hidden-on-mobile">
                   <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"> <?= ucfirst($siswa['nama']) ?><i class="material-icons has-sub-menu">keyboard_arrow_down</i><?php if($siswa['foto']==''){ ?>
				    <img src="<?= $baseurl ?>/images/siswa.png" alt="">
				     <?php }else{ ?>
				      <img src="<?= $baseurl ?>/images/fotosiswa/<?= $siswa['foto'] ?>" alt=""><?php } ?> </a>
                     <ul class="dropdown-menu dropdown-menu-end language-dropdown" aria-labelledby="languageDropDown">
                        <li><a class="dropdown-item" href="logout.php"><img src="<?= $baseurl ?>/images/logout.png" alt="">Log Out</a></li>
                           </ul>
                              </li>
                                </li>
                                 </ul>
                              </div>
                         </div>
                     </nav>
                 </div>
			