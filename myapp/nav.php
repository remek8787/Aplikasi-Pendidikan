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
		   <?php if($user['level']=='admin'): ?>
		   <div id="waktu" style="color:red;font-size:24px;font-weight:bold;"></div>
		   <?php endif; ?> 
              <ul class="navbar-nav">
			   <?php if($pg== enkripsi('kantin')): ?>
			    <li class="nav-item">
			    <a class="nav-link" href="?pg=<?= enkripsi('kantin') ?>&ac=<?= enkripsi('mykeranjang') ?>" style="color:red"><i class="material-icons">shopping_cart</i> <?= $keranjang ?></a>  
				 </li>
				<?php endif; ?> 
                <li class="nav-item hidden-on-mobile">
                   <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"> <?= ucfirst($user['nama']) ?><i class="material-icons has-sub-menu">keyboard_arrow_down</i><?php if($user['foto']==''){ ?>
				    <img src="<?= $baseurl ?>/images/guru.png" alt="">
				     <?php }else{ ?>
				      <img src="<?= $baseurl ?>/images/fotoguru/<?= $user['foto'] ?>" alt=""><?php } ?> </a>
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
			