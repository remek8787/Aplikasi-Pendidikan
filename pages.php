  <?php if ($pg == '') : ?>
			<?php include 'home.php'; ?>
		<?php elseif ($pg == 'jadwal') : ?>
			<?php include 'jadwal.php'; ?>
		<?php elseif ($pg == 'testongoing') : ?>
			<?php include 'tes.php'; ?>
		<?php elseif ($pg == 'hasil') : ?>
			<?php include 'ujian/hasil.php'; ?>	
		<?php elseif ($pg == 'lihathasil') : ?>
			<?php include 'ujian/lihat.php'; ?>		
		<?php elseif ($pg == 'mintareset') : ?>
			<?php include 'ujian/mintareset.php'; ?>			
		<?php elseif ($pg == 'cekreset') : ?>
			<?php include 'ujian/cekreset.php'; ?>
		<?php elseif ($pg == 'profil') : ?>
			<?php include 'ujian/profil.php'; ?>
			
		<?php elseif ($pg == 'materi') : ?>
			<?php include 'silearn/materi.php'; ?>
		<?php elseif ($pg == 'bukamateri') : ?>
		  <?php include 'silearn/lihatmateri.php'; ?>
		<?php elseif ($pg == 'tugas') : ?>
			<?php include 'silearn/tugas.php'; ?>
		<?php elseif ($pg == 'bukatugas') : ?>
			<?php include 'silearn/lihattugas.php'; ?>
		
		<?php else : ?>
		<?php jump($homeurl); ?>
		<?php endif ?>