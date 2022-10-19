<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/guru/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<style>
	p {
		margin: auto !important;
	}
</style>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php $one->get_css('toastr/toastr.min.css'); ?>
<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<div class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Bank Soal - <?= $jenis_ujian->nama_ujian; ?></h3>
					<div class="block-options">
						<button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#modal-add">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="block-content block-content-full">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover table-vcenter start-at-40">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Soal</th>
									<th>A</th>
									<th>B</th>
									<th>C</th>
									<th>D</th>
									<th>E</th>
									<th>Kunci</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php if (is_array($bank_soal) || is_object($bank_soal)) : ?>
									<?php foreach ($bank_soal as $hasil) : ?>
										<tr>
											<td class="text-center font-size-sm"><?= $i++; ?></td>
											<td class="font-size-sm"><?php echo $hasil->soal ?></td>
											<td class="font-size-sm"><?php echo $hasil->a ?></td>
											<td class="font-size-sm"><?php echo $hasil->b ?></td>
											<td class="font-size-sm"><?php echo $hasil->c ?></td>
											<td class="font-size-sm"><?php echo $hasil->d ?></td>
											<td class="font-size-sm"><?php echo $hasil->e ?></td>
											<td class="font-size-sm"><?php echo $hasil->kunci ?></td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-sm btn-primary edit_btn" data-toggle="modal" data-target="#modal-edit" data-id="<?php echo enkrip($hasil->id) ?>" title="Edit">
														<i class="fa fa-fw fa-pencil-alt"></i>
													</button>
													<button type="button" data-href="<?= base_url('guru/bank_soal/delete/') . enkrip($hasil->id); ?>" data-text="data akan dihapus" class="btn btn-sm btn-danger tombol-hapus" data-toggle="tooltip" title="Delete">
														<i class="fa fa-fw fa-times"></i>
													</button>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add -->
<div class="modal" id="modal-add" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center">Add Soal</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form action="<?= base_url('guru/bank_soal/add'); ?>" method="post">
							<div class="block-content font-size-sm">
								<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
								<input type="hidden" name="id_jenis_ujian" value="<?= enkrip($jenis_ujian->id); ?>">
								<div class="form-group">
									<label for="soal">Soal</label>
									<textarea name="soal" cols="30" rows="5" class="form-control editor"></textarea>
								</div>
								<div class="form-group">
									<label for="a">Jawaban A</label>
									<textarea name="a" cols="30" rows="5" class="form-control editor"></textarea>
								</div>
								<div class="form-group">
									<label for="b">Jawaban B</label>
									<textarea name="b" cols="30" rows="5" class="form-control editor"></textarea>
								</div>
								<div class="form-group">
									<label for="c">Jawaban C</label>
									<textarea name="c" cols="30" rows="5" class="form-control editor"></textarea>
								</div>
								<div class="form-group">
									<label for="d">Jawaban D</label>
									<textarea name="d" cols="30" rows="5" class="form-control editor"></textarea>
								</div>
								<div class="form-group">
									<label for="e">Jawaban E</label>
									<textarea name="e" cols="30" rows="5" class="form-control editor"></textarea>
								</div>
								<div class="form-group">
									<label for="kunci">Kunci Jawaban</label>
									<select name="kunci" class="form-control" required>
										<option value="">-- Pilih Kunci Jawaban --</option>
										<option value="a">A</option>
										<option value="b">B</option>
										<option value="c">C</option>
										<option value="d">D</option>
										<option value="e">E</option>
									</select>
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
</div>

<!-- Modal Edit -->
<div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center">Edit Soal</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form action="<?= base_url('guru/bank_soal/edit'); ?>" method="post">
							<div class="block-content font-size-sm">
								<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

								<input type="hidden" name="id" id="id">
								<input type="hidden" name="id_jenis_ujian" value="<?= enkrip($jenis_ujian->id); ?>">
								<div class="form-group">
									<label for="soal">Soal</label>
									<textarea name="soal" cols="30" rows="5" class="form-control editor" id="soal"></textarea>
								</div>
								<div class="form-group">
									<label for="a">Jawaban A</label>
									<textarea name="a" cols="30" rows="5" class="form-control editor" id="a"></textarea>
								</div>
								<div class="form-group">
									<label for="b">Jawaban B</label>
									<textarea name="b" cols="30" rows="5" class="form-control editor" id="b"></textarea>
								</div>
								<div class="form-group">
									<label for="c">Jawaban C</label>
									<textarea name="c" cols="30" rows="5" class="form-control editor" id="c"></textarea>
								</div>
								<div class="form-group">
									<label for="d">Jawaban D</label>
									<textarea name="d" cols="30" rows="5" class="form-control editor" id="d"></textarea>
								</div>
								<div class="form-group">
									<label for="e">Jawaban E</label>
									<textarea name="e" cols="30" rows="5" class="form-control editor" id="e"></textarea>
								</div>
								<div class="form-group">
									<label for="kunci">Kunci Jawaban</label>
									<select name="kunci" class="form-control" required id="kunci">
										<option value="">-- Pilih Kunci Jawaban --</option>
										<option value="a">A</option>
										<option value="b">B</option>
										<option value="c">C</option>
										<option value="d">D</option>
										<option value="e">E</option>
									</select>
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
				url: '<?php echo base_url('guru/bank_soal/getOne/') ?>' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(respon) {
					$('#id').val(id);
					$('#kunci').val(respon.kunci);

					tinyMCE.get('soal').setContent(respon.soal);
					tinyMCE.get('a').setContent(respon.a);
					tinyMCE.get('b').setContent(respon.b);
					tinyMCE.get('c').setContent(respon.c);
					tinyMCE.get('d').setContent(respon.d);
					tinyMCE.get('e').setContent(respon.e);
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
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>