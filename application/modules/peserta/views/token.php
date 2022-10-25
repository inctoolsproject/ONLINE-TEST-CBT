<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/peserta/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
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
					<h3 class="block-title">Token</h3>
				</div>
				<div class="block-content">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" id="csrf_token">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="input-group" data-autoclose="true" data-today-highlight="true">
									<input type="text" class="form-control" id="token" name="token" placeholder="Ketik token disini...." data-autoclose="true" data-today-highlight="true" autocomplete="OFF" required>
									<div class="input-group-prepend input-group-append">
										<button type="button" class="input-group-text font-w600" id="search">
											<i class="fa fa-fw fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 d-none" id="detail-ujian">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Detail Ujian</h3>
				</div>
				<div class="block-content">
					<h4 class="mb-1" id="nama-ujian"></h4>
					<p class="font-size-sm">
						<span class="text-primary" id="topik-ujian"></span> | <span id="soal-ujian"></span> - <em class="text-muted" id="waktu-ujian"></em>
					</p>
					<p class="font-size-sm" id="ket-ujian"></p>

					<div class="row mt-3 mb-2">
						<div class="col-lg-12">
							<span class="text-danger h6" id="jam"></span>
							<span class="text-danger h6 pemisah">:</span>
							<span class="text-danger h6" id="menit"></span>
							<span class="text-danger h6 pemisah">:</span>
							<span class="text-danger h6" id="detik"></span>
						</div>
					</div>

					<div class="form-group d-none" id="div-ambil">
						<button type="button" class="btn btn-primary" id="ambil">Ambil Ujian</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<script>
	var x = null;

	$('#token').on('keypress', function(e) {
		if (e.which == 13) {
			cekToken();
		}
	});

	$('#search').click(function() {
		cekToken();
	});

	function cekToken() {
		let token = $('#token').val();

		if (token == '') {
			toastr.error('Token tidak boleh kosong');
		} else {
			let csrfName = $("#csrf_token").attr('name');
			let csrfHash = $("#csrf_token").val();

			var dataJson = {
				[csrfName]: csrfHash,
				token: token
			};

			$('#detail-ujian').addClass('d-none');
			$('#div-ambil').addClass('d-none');

			$('#jam').text('0');
			$('#menit').text('0');
			$('#detik').text('0');
			$('.pemisah').text(':');

			$.ajax({
				url: '<?php echo base_url('peserta/ujian/cekToken') ?>',
				type: 'POST',
				dataType: 'JSON',
				data: dataJson,
				success: function(respon) {
					if (respon.status == 0) {
						toastr.error('Token tidak ditemukan !');

						$('#detail-ujian').addClass('d-none');
					} else {
						$('#detail-ujian').removeClass('d-none');

						$('#nama-ujian').text(respon.data.nama_ujian);
						$('#topik-ujian').text(respon.data.topik);
						$('#soal-ujian').text(respon.data.jumlah_soal + ' Soal');
						$('#waktu-ujian').text(respon.data.waktu + ' Menit');
						$('#ket-ujian').text(respon.data.keterangan);

						clearInterval(x);
						var countDownDate_x = new Date(respon.token.token_selesai).getTime();

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

								$('#jam').text('Token sudah berakhir !');
								$('#menit').text('');
								$('#detik').text('');
								$('.pemisah').text('');

								$('#div-ambil').addClass('d-none');
							} else {
								$('#div-ambil').removeClass('d-none');
							}
						}, 1000);
					}

					$('#csrf_token').val(respon.csrf_token);
				}
			});
		}
	}

	$('#ambil').click(function() {
		let token = $('#token').val();
		let csrfName = $("#csrf_token").attr('name');
		let csrfHash = $("#csrf_token").val();

		var dataJson = {
			[csrfName]: csrfHash,
			token: token
		};

		$.ajax({
			url: '<?php echo base_url('peserta/ujian/ambilUjian') ?>',
			type: 'POST',
			dataType: 'JSON',
			data: dataJson,
			success: function(respon) {
				$('#csrf_token').val(respon.csrf_token);

				if (respon.status == 0) {
					toastr.warning(respon.error);
				} else {
					document.location.href = `<?= base_url('peserta/ujian/list'); ?>`;
				}
			}
		});
	});
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>