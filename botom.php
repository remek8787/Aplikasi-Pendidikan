<script src='assets/zoom-master/jquery.zoom.js'></script>

<script src='vendor/js/bootstrap.min.js'></script>
<script src='vendor/iCheck/icheck.min.js'></script>
<script src='vendor/js/app.min.js'></script>	
<script src="assets/js/sweetalert2.min.js"></script>
<script src='assets/toastr/toastr.min.js'></script>	 
<script src='assets/mousetrap/mousetrap.min.js'></script>

<script src='assets/izitoast/js/iziToast.min.js'></script>
   <script>
        $('.loader').fadeOut('fast');
        var url = window.location;
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
      
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).closest('.treeview').addClass('active');
       
    </script>
   
        <script>
            var baseurl;
            baseurl = '.';
           $(window).keydown(function(event) 
            {
                if(event.keyCode == 91)
                    {
                  
                    console.log("Win Key was clicked");
                    }
            });
            jQuery('body').on('contextmenu', function(e){ 
                return false; 
            });
            jQuery(document).bind('selectstart dragstart', function(e) {
                e.preventDefault();
                return false;
            });
            $(document).keydown(function(e) {
                if (e.keyCode == 27) return false;
            });
                function selesai() {
                    var idmapel = '<?= $id_bank  ?>';
                    var idsiswa = '<?= $id_siswa  ?>';
                    $.ajax({
                        type: 'POST',
                       url: baseurl + '/selesai.php',
                        data: {
                            
                            id_bank: idmapel,
                            id_siswa: idsiswa,
                            id_ujian: <?= $ac ?>
                        },
                        beforeSend: function() {
                            $('.loader').css('display', 'block');
                        },
                        success: function(response) {
                           
                            $('.loader').css('display', 'none');
                            location.href=baseurl;
                           
                           
                        }
                    });
                }    
        var elem = document.documentElement;

        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {
               
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
              
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
            
                elem = window.top.document.body; 
                elem.msRequestFullscreen();
            }
        }
        swal({
            title: 'Info Ujian',
            html: 'Selamat Mengerjakan',
           
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                openFullscreen();
            }
        })
        
        if (document.addEventListener) {
            document.addEventListener('fullscreenchange', exitHandler, false);
            document.addEventListener('mozfullscreenchange', exitHandler, false);
            document.addEventListener('MSFullscreenChange', exitHandler, false);
            document.addEventListener('webkitfullscreenchange', exitHandler, false);
        }

        function exitHandler() {
            if (document.webkitIsFullScreen === false) {
                <?php if($mapel['pelanggaran']<>0){ ?>
                var
                    closeInSeconds = <?= $mapel['pelanggaran'] ?>,
                    displayText = "Ujian terpaksa selesai dalam #1 detik lagi",
                    timer;


                timer = setInterval(function() {
                    closeInSeconds--;
                    if (closeInSeconds < 0) {
                        clearInterval(timer);
                        selesai();
                    }
                    $('.swal2-content').text(displayText.replace(/#1/, closeInSeconds));
                }, 1000);
                swal({
                    title: "Pelanggaran!",
                    text: displayText.replace(/#1/, closeInSeconds),
                    timer: closeInSeconds * 1000,
                    confirmButtonText: 'Lanjut Ujian',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        clearInterval(timer);
                        openFullscreen();
                    }
                })
                <?php }else{?>
                    swal({
                        title: 'Ujian',
                        html: '',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iya',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            openFullscreen();
                        }
                    })
                <?php } ?>
            } else if (document.mozFullScreen === false) {
                console.log('bbbbbb')
            } else if (document.msFullscreenElement === false) {
                console.log('cccccc')
            }
        }
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };
            
            var baseurl;
            baseurl = '<?= $baseurl ?>';
            $(document).ready(function() {
                $("#modalnosoal").on('shown.bs.modal', function() {
                    var idmapel = '<?= $id_bank  ?>';
                    var idsiswa = '<?= $id_siswa  ?>';
                    var pengacak = JSON.parse(localStorage.getItem('pengacakpg'));
                    var pengacakpil = JSON.parse(localStorage.getItem('pengacakpil'));
                    $.ajax({
                        type: 'POST',
                        url: baseurl + '/nosoal.php',
                        data: {
                            id_bank: idmapel,
                            id_siswa: idsiswa,
                            pengacak: pengacak,
                            pengacakpil: pengacakpil,
                            idu: <?= $ac ?>
                        },
                        success: function(response) {
                            
                            $('#loadnosoal').html(response);

                        }
                    });
                });
            });


            function soalpertama() {
                var idmapel = '<?= $id_bank  ?>';
                var idsiswa = '<?= $id_siswa  ?>';
                var soalsoal = JSON.parse(localStorage.getItem('soallokal'));
                var ujianya = JSON.parse(localStorage.getItem('ujianya'));
                var pengacak = JSON.parse(localStorage.getItem('pengacakpg'));
                var pengacakpil = JSON.parse(localStorage.getItem('pengacakpil'));
                $.ajax({
                    type: 'POST',
                    url: baseurl + '/soal.php',
                    data: {
                        pg: 'soal',
                        id_bank: idmapel,
                        id_siswa: idsiswa,
                        no_soal: 0,
                        ujian: ujianya,
                        soal: soalsoal,
                        pengacak: pengacak,
                        pengacakpil: pengacakpil,
                        idu: <?= $ac ?>
                    },
                    beforeSend: function() {
						$('#loading-image').show();
					},
                    success: function(response) {
                        num = 1;
                        $('#loading-image').hide();
                        $('#displaynum').html(num);
                        $('#loadsoal').html(response);
                        $('.fa-spin').hide();
                        
                        soalFont(fontSize);
                        
                    }
                });
            }
            soalpertama();
            /* Font Adjusments */
            let defaultFontSize = 10;
            let fontSize = 0;
            fontSize = localStorage.getItem('fontSize');
            if (!fontSize) {
                fontSize = defaultFontSize;
                localStorage.setItem('fontSize', fontSize);
            }
            soalFont(fontSize);

            function soalFont(fontSize) {
                $('div.soal > p > span').css({
                    fontSize: fontSize + 'pt'
                });
                $('span.soal > p > span').css({
                    fontSize: fontSize + 'pt'
                });
                $('.soal').css({
                    fontSize: fontSize + 'pt'
                })
                $('.callout soal').css({
                    fontSize: fontSize + 'pt'
                })
            }

            $(document).ready(function() {
                $('#smaller_font').on('click', function() {
                    fontSize = localStorage.getItem('fontSize')
                    fontSize--;
                    localStorage.setItem('fontSize', fontSize)
                    soalFont(fontSize)
                });

                $('#bigger_font').on('click', function() {
                    fontSize = localStorage.getItem('fontSize')
                    fontSize++;
                    localStorage.setItem('fontSize', fontSize)
                    soalFont(fontSize)
                });

                $('#reset_font').on('click', function() {
                    fontSize = defaultFontSize
                    localStorage.setItem('fontSize', fontSize)
                    soalFont(fontSize)
                });
                function selesai() {
                    var idmapel = '<?= $id_bank  ?>';
                    var idsiswa = '<?= $id_siswa  ?>';
                    $.ajax({
                        type: 'POST',
                        url: baseurl + '/selesai.php',
                        data: {
                            
                            id_bank: idmapel,
                            id_siswa: idsiswa,
                            id_ujian: <?= $ac ?>
                        },
                        beforeSend: function() {
                            $('.loader').css('display', 'block');
                        },
                        success: function(response) {
                           
                            $('.loader').css('display', 'none');
                            location.href=baseurl;
                           
                           
                        }
                    });
                }
                $(document).on('click', '.done-btn', function() {
                    var idmapel = '<?= $id_bank  ?>';
                    var idsiswa = '<?= $id_siswa  ?>';
                    $.ajax({
                        type: 'POST',
                        url: baseurl + '/cekselesai.php',
                        data: {
                            id_bank: idmapel,
                            id_siswa: idsiswa,
                            id_ujian: <?= $ac ?>
                        },
                        success: function(response) {
                            if (response == 'ok') {
                                swal({
                                    title: 'Apa kamu yakin telah selesai?',
                                    html: 'Pastikan telah menyelesaikan semua dengan benar!',
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Iya'
                                }).then((result) => {
                                    if (result.value) {
                                        
                                       selesai();
                                    }
                                })
                            } else if (response == 'ragu') {
                                swal({
                                    type: 'warning',
                                    title: 'Peringatan',
                                    html: 'Masih ada soal yang masih ragu!!',
                                })
                            } else {
                                swal({
                                    type: 'warning',
                                    title: 'Peringatan',
                                    html: 'Masih ada soal yang belum dikerjakan!!',
                                })
                            }

                        }
                    });

                });
                
                var result = '';
                $('.jawabesai').change(function() {
                    result = $(this).val();
                    $('#result').html(result);
                });

                var jam = $('#htmljam').html();
                var menit = $('#htmlmnt').html();
                var detik = $('#htmldtk').html();

                function hitung() {
                    setTimeout(hitung, 1000);
                    $('#countdown').html(jam + ':' + menit + ':' + detik);
                    detik--;
                    if (detik < 0) {
                        detik = 59;
                        menit--;
                        if (menit < 0) {
                            menit = 59;
                            jam--;
                            if (jam < 0) {
                                jam = 0;
                                menit = 0;
                                detik = 0;
                                selesai();
                            }
                        }
                    }
                }
                hitung();

            });

            function waktuhabis() {
                swal({
                    title: 'Peringatan!',
                    text: 'Waktu Ujian Telah Habis',
                    timer: 1000,
                    onOpen: () => {
                        swal.showLoading()
                    }
                }).then((result) => {
                    selesai();
                });
            }

            function loadsoal(idmapel, idsiswa, nosoal) {

                if (nosoal >= 0 && nosoal<<?= $jumsoal ?>) {
                    curnum = $('#displaynum').html();
                    if (nosoal == curnum) {
                        $('#spin-next').show();
                    }
                    if (nosoal > curnum) {
                        $('#spin-next').show();
                    }
                    if (nosoal < curnum) {
                        $('#spin-prev').show();
                    }
                    var ujianya = JSON.parse(localStorage.getItem('ujianya'));
                    var soalsoal = JSON.parse(localStorage.getItem('soallokal'));
                    var pengacak = JSON.parse(localStorage.getItem('pengacakpg'));
                    var pengacakpil = JSON.parse(localStorage.getItem('pengacakpil'));
                    $.ajax({
                        type: 'POST',
                        url: baseurl + '/soal.php',
                        data: {
                            pg: 'soal',
                            id_bank: idmapel,
                            id_siswa: idsiswa,
                            no_soal: nosoal,
                            soal: soalsoal,
                            pengacak: pengacak,
                            pengacakpil: pengacakpil,
                            ujian: ujianya

                        },
                        success: function(response) {
                            num = nosoal + 1;
                            $('#displaynum').html(num);
                            $('#loadsoal').html(response);
                            $('.fa-spin').hide();
                            $("#modalnosoal").modal('hide');
                            soalFont(fontSize);
                            
                        }
                    });
                }
            }

            function jawabsoal(idmapel, idsiswa, idsoal, jawab, jawabQ, jenis, idu) {

                
                $.ajax({
                    type: 'POST',
                    url: baseurl + '/soal.php',
                    data: {
                        pg: 'jawab',
                        id_bank: idmapel,
                        id_siswa: idsiswa,
                        id_soal: idsoal,
                        jawaban: jawab,
                        jenis: jenis,
                        idu: idu,
                        jawabx: jawabQ
                    },
                    success: function(response) {
                      
                        if (response == 'OK') {
                            $('#nomorsoal #badge' + idsoal).removeClass('bg-gray');
                            $('#nomorsoal #badge' + idsoal).removeClass('bg-yellow');
                            $('#nomorsoal #badge' + idsoal).addClass('bg-green');
                            $('#nomorsoal #jawabtemp' + idsoal).html(jawabQ);
                            $('#ketjawab').load(window.location.href + ' #ketjawab');
                        }
                    }
                });
            }

			
			  function jawabbs(idmapel, idsiswa, idsoal, jawabbs, jawabbs2, jawabQ, jenis, idu) {

                
                $.ajax({
                    type: 'POST',
                    url: baseurl + '/soal.php',
                    data: {
                        pg: 'jawabbs',
                        id_bank: idmapel,
                        id_siswa: idsiswa,
                        id_soal: idsoal,
                        jawabbs: jawabbs,
						jawabbs2: jawabbs2,
                        jenis: jenis,
                        idu: idu,
                        jawabx: jawabQ
                    },
                    success: function(response) {
                        
                        if (response == 'OK') {
                            $('#nomorsoal #badge' + idsoal).removeClass('bg-gray');
                            $('#nomorsoal #badge' + idsoal).removeClass('bg-yellow');
                            $('#nomorsoal #badge' + idsoal).addClass('bg-green');
                            $('#nomorsoal #jawabtemp' + idsoal).html(jawabQ);
                            $('#ketjawab').load(window.location.href + ' #ketjawab');
                        }
                    }
                });
            }

			
            function jawabesai(idmapel, idsiswa, idsoal, jenis) {
                var jawab = $('#jawabesai').val();
                $.ajax({
                    type: 'POST',
                    url: baseurl + '/soal.php',
                    data: {
                        pg: 'jawab',
                        id_bank: idmapel,
                        id_siswa: idsiswa,
                        id_soal: idsoal,
                        jawaban: jawab,
                        jenis: jenis,
                        idu: <?= $ac ?>
                    },
                    success: function(response) {
                        if (response == 'OK') {
                            toastr.success("jawaban berhasil disimpan");
                            $('#badge' + idsoal).removeClass('bg-gray');
                            $('#badge' + idsoal).removeClass('bg-yellow');
                            $('#badge' + idsoal).addClass('bg-green');
                            $('#ketjawab').load(window.location.href + ' #ketjawab');
                        }

                    }
                });
            }

            function radaragu(idmapel, idsiswa, idsoal) {
                cekclass = $('#nomorsoal #badge' + idsoal).attr('class');
                if (cekclass != 'btn btn-app bg-gray') {
                    $.ajax({
                        type: 'POST',
                        url: baseurl + '/soal.php',
                        data: {
                            pg: 'ragu',
                            id_bank: idmapel,
                            id_siswa: idsiswa,
                            id_soal: idsoal
                           
							
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == 'OK') {
                                if (cekclass == 'btn btn-app bg-green') {
                                    $('#nomorsoal #badge' + idsoal).removeClass('bg-gray');
                                    $('#nomorsoal #badge' + idsoal).removeClass('bg-green');
                                    $('#nomorsoal #badge' + idsoal).addClass('bg-yellow');
                                    console.log('kuning');
                                }
                                if (cekclass == 'btn btn-app bg-yellow') {
                                    $('#nomorsoal #badge' + idsoal).removeClass('bg-gray');
                                    $('#nomorsoal #badge' + idsoal).removeClass('bg-yellow');
                                    $('#nomorsoal #badge' + idsoal).addClass('bg-green');
                                    console.log('hijau');
                                }
                            }
                        }
                    });
                } else {
                    $('#load-ragu input').removeAttr('checked');
                }
            }
        </script>
		
	<script>
	function kelapKelip() {
			$('.kedip').fadeOut(); 
			$('.kedip').fadeIn(); 
			}
			setInterval(kelapKelip, 500);
	</script>
	
   <script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$("#waktu").load('waktu.php');
							}, 1000);  
						});
					</script> 
	
</body>

</html>
 
