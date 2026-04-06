
<header class='main-header'>
		
            <nav class='navbar navbar-static-top' style='background-color:#fff;box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.1)' role='navigation'>
              
			   <a href='#' class='sidebar-baru' data-toggle='<?= $disa ?>' role='button'>
                    <i class="fa fa-bars fa-lg fa-fw" style="color:black"></i>
					 
                </a>

                <div class='navbar-custom-menu'>
				
                    <ul class='nav navbar-nav'>
                        <li class="visible-xs"><a><?= $siswa['nama'] ?></a></li>
                        <li class='dropdown user user-menu'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                                <?php
                                if ($siswa['foto'] <> '') :
                                    if (!file_exists("images/fotosiswa/$siswa[foto]")) :
                                        echo "<img src='images/siswa.png' class='user-image'   alt='+'>";
                                    else :
                                        echo "<img src='images/fotosiswa/$siswa[foto]' class='user-image'   alt='+'>";
                                    endif;
                                else :
                                    echo "<img src='images/siswa.png' class='user-image'   alt='+'>";
                                endif;
                                ?>
                                <span class='hidden-xs'><?= $siswa['nama'] ?> &nbsp; <i class='fa fa-caret-down'></i></span>
                            </a>
                            <ul class='dropdown-menu'>
                                <li class='user-header'>
                                    <?php
                                    if ($siswa['foto'] <> '') :
                                        if (!file_exists("images/fotosiswa/$siswa[foto]")) :
                                            echo "<img src='images/siswa.png' class='img-circle' alt='User Image'>";
                                        else :
                                            echo "<img src='images/fotosiswa/$siswa[foto]' class='img-circle' alt='User Image'>";
                                        endif;
                                    else :
                                        echo "<img src='images/siswa.png' class='img-circle' alt='User Image'>";
                                    endif;
                                    ?>
                                    <p style="color:blue">
                                        <?= $siswa['nama'] ?>
                                    </p>
                                </li>
                                <li class='user-footer'>
                                    
									<?php if($pg !='testongoing'): ?>
									<div class='pull-left'>
									
									   </div>
									   <div class='pull-right'>
									   <a href='logout.php' class='btn btn-sm btn-danger'><i class='fa fa-sign-out'></i> Keluar</a>
										</div>
                                   <?php endif; ?>
								   
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>