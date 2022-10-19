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
					<h3 class="block-title">Jenis Ujian</h3>
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
									<th>Nama Ujian</th>
									<th>Topik</th>
									<th>Jumlah Soal</th>
									<th>Bobot Soal</th>
									<th>KKM</th>
									<th>Estimasi Waktu</th>
									<th>Keterangan</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php if (is_array($jenis_ujian) || is_object($jenis_ujian)) : ?>
									<?php foreach ($jenis_ujian as $hasil) : ?>
										<tr>
											<td class="text-center font-size-sm"><?= $i++; ?></td>
											<td class="font-size-sm"><?php echo $hasil->nama_ujian ?></td>
											<td class="font-size-sm"><?php echo $hasil->topik ?></td>
											<td class="font-size-sm"><?php echo $hasil->jumlah_soal ?></td>
											<td class="font-size-sm"><?php echo $hasil->bobot ?></td>
											<td class="font-size-sm"><?php echo $hasil->kkm ?></td>
											<td class="font-size-sm"><?php echo $hasil->waktu . ' Menit' ?></td>
											<td class="font-size-sm"><?php echo $hasil->keterangan ?></td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-sm btn-primary edit_btn" data-toggle="modal" data-target="#modal-edit" data-id="<?php echo enkrip($hasil->id) ?>" title="Edit">
														<i class="fa fa-fw fa-pencil-alt"></i>
													</button>
													<button type="button" data-href="<?= base_url('guru/jenis_ujian/delete/') . enkrip($hasil->id); ?>" data-text="data akan dihapus" class="btn btn-sm btn-danger tombol-hapus" data-toggle="tooltip" title="Delete">
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
<div class="modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center">Add Jenis Ujian</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form action="<?= base_url('guru/jenis_ujian/add'); ?>" method="post">
							<div class="block-content font-size-sm">
								<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
								<div class="form-group">
									<label for="nama_ujian">Nama Ujian</label>
									<input type="text" name="nama_ujian" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="topik">Topik</label>
									<input type="text" name="topik" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="jumlah_soal">Jumlah Soal</label>
									<input type="number" name="jumlah_soal" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="bobot">Bobot Soal</label>
									<input type="number" name="bobot" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="kkm">KKM</label>
									<input type="number" name="kkm" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="waktu">Estimasi Waktu <sup class="text-danger">(menit)</sup></label>
									<input type="number" name="waktu" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="keterangan">Keterangan</label>
									<textarea name="keterangan" cols="30" rows="3" class="form-control" required></textarea>
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center">Edit Jenis Ujian</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form action="<?= base_url('guru/jenis_ujian/edit'); ?>" method="post">
							<div class="block-content font-size-sm">
								<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
								<input type="hidden" name="id" id="id">
								<div class="form-group">
									<label for="nama_ujian">Nama Ujian</label>
									<input type="text" name="nama_ujian" id="nama_ujian" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="topik">Topik</label>
									<input type="text" name="topik" id="topik" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="jumlah_soal">Jumlah Soal</label>
									<input type="number" name="jumlah_soal" id="jumlah_soal" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="bobot">Bobot Soal</label>
									<input type="number" name="bobot" id="bobot" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="kkm">KKM</label>
									<input type="number" name="kkm" id="kkm" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="waktu">Estimasi Waktu <sup class="text-danger">(menit)</sup></label>
									<input type="number" name="waktu" id="waktu" min="0" max="1000" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label for="keterangan">Keterangan</label>
									<textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" required></textarea>
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
					$('#bobot').val(respon.bobot);
					$('#waktu').val(respon.waktu);
					$('#kkm').val(respon.kkm);
					$('#keterangan').text(respon.keterangan);
				}
			});
		});
	});
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>