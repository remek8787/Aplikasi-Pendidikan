<div class="app-menu">
<ul class="accordion-menu">
<li><a href="."><i class="material-icons-two-tone">home</i>Beranda</a></li>
<li><a href="../myapp/"><i class="material-icons-two-tone">apps</i>Dashboard</a></li>

 <?php if($user['level']=='admin'): ?>   
<li>
<a href="#"><i class="material-icons-two-tone">menu</i>Master Pelanggaran<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
<ul class="sub-menu">
<li><a href="?pg=<?= enkripsi('kategori') ?>">Kategori Pelanggaran</a></li>
	<li><a href="?pg=<?= enkripsi('subkategori') ?>">Sub Pelanggaran</a></li>
	<li><a href="?pg=<?= enkripsi('pelanggaran') ?>">Point Pelanggaran</a></li>	
    </ul>
    </li>
	 				
<li><a href="?pg=<?= enkripsi('tindakan') ?>"><i class="material-icons-two-tone">settings</i>Setting Tindakan</a><li>
    <?php endif; ?>		        
<li>			
<a href="#"><i class="material-icons-two-tone">mail</i>Surat Peringatan <i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>                    
<ul class="sub-menu">
    <li><a href="?pg=<?= enkripsi('surat') ?>">Surat Peringatan 1</a></li>
	<li><a href="?pg=<?= enkripsi('surat') ?>&ac=sp2">Surat Peringatan 2</a></li>
	<li><a href="?pg=<?= enkripsi('surat') ?>&ac=sp3">Surat Peringatan 3</a></li>
	</ul>
	</li>	
			
<li><a href="?pg=<?= enkripsi('pesan') ?>"><i class="material-icons-two-tone">select_all</i>Pesan Terkirim</a></li>

<?php if($user['level']=='admin'): ?>   
<li class="sidebar-title">DATABASE</li>
<li><a href="#" id="btnxml"><i class="material-icons-two-tone">storage</i>Reset Pelanggaran</a></li>
<?php endif; ?>				 
					 
<li><a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a></li>
		
    </ul>
    </div>
      <script>
   $("#btnxml").click(function() {
        var id = $(this).data('id');
        swal({
            title: 'Konfirmasi ',
            text: 'Yakin akan mereset data ini??',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '?pg=<?= enkripsi(surat) ?>&ac=reset',
                    data: "id=" + id,
                    type: "POST",
                    success: function(respon) {
                    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
					$('.progress-bar').animate({
					width: "30%"
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