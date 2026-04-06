<script src="<?= $baseurl ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?= $baseurl ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $baseurl ?>/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="<?= $baseurl ?>/assets/plugins/pace/pace.min.js"></script>
<script src="<?= $baseurl ?>/assets/plugins/highlight/highlight.pack.js"></script>	
<script src="<?= $baseurl ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= $baseurl ?>/assets/plugins/datatables/datatables.js"></script>
<script src="<?= $baseurl ?>/assets/js/main.min.js"></script>
<script src="<?= $baseurl ?>/assets/js/custom.js"></script>
<script src='<?= $baseurl ?>/assets/izitoast/js/iziToast.min.js'></script>
<script src="<?= $baseurl ?>/assets/js/sweetalert2.min.js"></script>
<script src='<?= $baseurl ?>/assets/datetimepicker/build/jquery.datetimepicker.full.min.js'></script>
<script>
var autoRefresh = setInterval(
function() {
$('#waktu').load('waktu.php?pg=waktu');
	}, 1000
);
</script>
	  
<script>
$('#datatable1').DataTable({
pageLength: 10
	});
$('.select2').select2();
	
$('.datepicker').datetimepicker({
	timepicker: false,
	format: 'Y-m-d'
	});
$('.tgl').datetimepicker();
$('.timer').datetimepicker({
	datepicker: false,
	format: 'H:i'
	});	
$('.jam1').datetimepicker({
	datepicker: false,
	format: 'H:i'
	});	
$('.jam').datetimepicker({
	datepicker: false,
	format: 'H:i:s'
	});		
$(function() {
	$('#textarea').wysihtml5()
	});
</script>
</body>
</html>