<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/peserta/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>

<?php $one->get_css('toastr/toastr.min.css'); ?>
<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/peserta/views/inc_navigation.php'; ?>
<div class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Detail Ujian</h3>
				</div>
				<div class="block-content">
					<h4 class="mb-1"><?= $list_ujian->nama_ujian; ?></h4>
					<p class="font-size-sm">
						<span class="text-primary"><?= $list_ujian->topik; ?></span> | <span><?= $list_ujian->jumlah_soal . ' soal'; ?></span> - <em class="text-muted"><?= $list_ujian->waktu . ' menit'; ?></em>
					</p>
					<p class="font-size-sm"><?= $list_ujian->keterangan; ?></p>

					<div class="row mt-5 mb-2">
						<div class="col-lg-12">
							<label>Ujian akan dimulai pada :</label>
							<span class="text-danger h6" id="jam">0</span>
							<span class="text-danger h6 pemisah">:</span>
							<span class="text-danger h6" id="menit">0</span>
							<span class="text-danger h6 pemisah">:</span>
							<span class="text-danger h6" id="detik">0</span>
						</div>
					</div>

					<div class="form-group d-none" id="div-ujian">
						<button type="button" class="btn btn-primary" onclick="window.location='<?= base_url('peserta/tes'); ?>'">Mulai Ujian</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>

<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/dataTables.bootstrap4.min.js'); ?>

<?php $one->get_js('js/pages/be_tables_datatables.min.js'); ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<script>
	var x = null;

	clearInterval(x);
	var countDownDate_x = new Date(<?= strtotime($list_ujian->tanggal_ujian) * 1000; ?>).getTime();

	x = setInterval(function() {
		var now = new Date().getTime();

		var distance = countDownDate_x - now;

		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		$('#jam').text(hours);
		$('#menit').text(minutes);
		$('#detik').text(seconds);

		if (distance < 0) {
			clearInterval(x);
			$('#jam').text('ujian sudah dimulai !');
			$('#menit').text('');
			$('#detik').text('');
			$('.pemisah').text('');

			$('#div-ujian').removeClass('d-none');

		} else {
			$('#div-ujian').addClass('d-none');
		}
	}, 1000);

	$('li.nav-main-item').find('a[href*="<?= base_url('peserta/ujian/list') ?>"]').addClass('active');
	$('li.nav-main-item').find('a[href*="<?= base_url('peserta/ujian/list') ?>"]').parent().parent().parent().children('a').addClass('active');
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>