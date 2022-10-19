<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/guru/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php $one->get_css('toastr/toastr.min.css'); ?>
<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<div class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Add Soal - <?= $jenis_ujian->nama_ujian; ?></h3>
				</div>
				<div class="block-content block-content-full">
					<form action="<?= base_url('guru/jenis_ujian/add'); ?>" method="post">
						<div class="block-content font-size-sm">
							<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
							<div class="form-group">
								<label for="soal">Soal</label>
								<textarea name="soal" cols="30" rows="3" class="form-control editor" required></textarea>
							</div>
						</div>
						<div class="block-content block-content-full text-right border-top">
							<button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- END Page Content -->
<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/dataTables.bootstrap4.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/dataTables.buttons.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.print.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.html5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.flash.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.colVis.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_tables_datatables.min.js'); ?>

<script src="<?= base_url(); ?>assets/backend/tinymce/tinymce.min.js"></script>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>
<script>
	let tombol_edit = $('.edit_btn');
	$(tombol_edit).each(function(i) {
		$(tombol_edit[i]).click(function() {
			let id = $(this).data('id');
			$.ajax({
				url: '<?php echo base_url('guru/jenis_ujian/getOne/') ?>' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(respon) {
					$('#id').val(id);
					$('#nama_ujian').val(respon.nama_ujian);
					$('#topik').val(respon.topik);
					$('#jumlah_soal').val(respon.jumlah_soal);
					$('#waktu').val(respon.waktu);
					$('#kkm').val(respon.kkm);
					$('#keterangan').text(respon.keterangan);
				}
			});
		});
	});

	tinymce.init({
		selector: '.editor',
		plugins: 'preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking toc insertdatetime advlist lists imagetools textpattern noneditable help quickbars emoticons code',
		toolbar: 'undo redo | bold italic underline strikethrough superscript subscript | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview | image media link codesample | ltr rtl | code',
		toolbar_mode: 'sliding',
	});

	$('li.nav-main-item').find('a[href*="<?= base_url('guru/bank_soal/') . enkrip($jenis_ujian->id) ?>"]').addClass('active');
	$('li.nav-main-item').find('a[href*="<?= base_url('guru/bank_soal/') . enkrip($jenis_ujian->id) ?>"]').parent().parent().parent().addClass('open');
	$('li.nav-main-item').find('a[href*="<?= base_url('guru/bank_soal/') . enkrip($jenis_ujian->id) ?>"]').parent().parent().parent().parent().parent().addClass('open');
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>