<aside class='main-sidebar'>
            <section class='sidebar'>
                <hr style="margin:0px">
                <div class='user-panel'>
                    <div class='pull-left image'>
                        <?php
                        if ($siswa['foto'] <> '') :
                            if (!file_exists("images/fotosiswa/$siswa[foto]")) :
                                echo "<img src='images/siswa.png' class='img'  style='max-width:60px' alt='+'>";
                            else :
                                echo "<img src='images/fotosiswa/$siswa[foto]' class='img'  style='max-width:60px' alt='+'>";
                            endif;
                        else :
                            echo "<img src='images/siswa.png' class='img'  style='max-width:60px' alt='+'>";
                        endif;
                        ?>
                    </div>
                    <div class='pull-left info' style='left:65px'>
                        <?php
                        if (strlen($siswa['nama']) > 15) {
                            $nama = substr($siswa['nama'], 0, 15) . "...";
                        } else {
                            $nama = $siswa['nama'];
                        }
                        ?>
                        <p title="<?= $siswa['nama'] ?>"><?= $nama ?></p>
						
                        <p><a href='#'><i class='fa fa-circle text-green'></i> online</a>
                        <p><span class="badge bg-blue"><?=strtoupper($siswa['jurusan']); ?></span> <span class="badge bg-green"><?=$siswa['kelas']?></span></p>
                   </div>
                </div><br>
				<ul class='sidebar-menu tree' data-widget='tree' style="font-size:13px;vertical-align:middle;">
				<br>
                    <li>&nbsp;&nbsp;<b>Menu Utama</b></li>
					<br>   
				<li><a href='mydashboard/'><i class="material-icons" style="vertical-align:middle;">menu</i><span>Dashboard Utama</span></a></li>		
				 <li><a href='.'><i class="material-icons" style="vertical-align:middle;">home</i> Dashboard Ujian</a></li>
				
				<li><a href='logout.php'><i class="material-icons" style="vertical-align:middle;">logout</i><span> Log Out</span></a></li>
                </ul>
            </section>
        </aside>