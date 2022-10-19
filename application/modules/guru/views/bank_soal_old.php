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
					<h3 class="block-title">Bank Soal - <?= $jenis_ujian->nama_ujian; ?></h3>
					<div class="block-options">
						<a href="<?= base_url('guru/bank_soal/add/') . enkrip($jenis_ujian->id); ?>" class="btn btn-sm btn-alt-primary">
							<i class="fa fa-plus"></i>
						</a>
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
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>