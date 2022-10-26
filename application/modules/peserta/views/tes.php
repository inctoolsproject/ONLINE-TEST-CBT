<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/peserta/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>

<?php $one->get_css('toastr/toastr.min.css'); ?>
<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<style>
	table {
		border: none !important;
		border-spacing: 0;
		border-collapse: collapse;
	}

	p {
		margin: auto !important;
	}

	.dropdown-menu {
		max-height: 280px;
		overflow-y: auto;
	}
</style>

<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/peserta/views/inc_navigation.php'; ?>
<div class="content">
	<div class="row">
		<div class="col-sm-12 text-right">
			<div class="btn-group mb-3">
				<div class="dropdown">
					<button type="button" class="btn btn-secondary dropdown-toggle" id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Daftar Soal
					</button>
					<div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-align-primary" style="width: 370px;">
						<?php foreach ($allSoal as $hasil) : ?>
							<?php if ($hasil->ragu == 0) {
								$class_btn = 'btn-danger';
							} else if ($hasil->ragu == 1) {
								$class_btn = 'btn-success';
							} else if ($hasil->ragu == 2) {
								$class_btn = 'btn-warning';
							}

							?>
							<button type="button" class="btn <?= $class_btn; ?> mb-2 ml-1" style="width: 63px;" id="<?= 'btn_soal' . $hasil->urutan; ?>" onclick="window.location='<?= base_url('peserta/tes/') . enkrip($hasil->urutan); ?>'"><?= $hasil->urutan; ?></button>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="block block-rounded">
				<?php
				if ($urutan[0]->status == 0) {
					$block_header = 'bg-danger';
				} elseif ($urutan[0]->status == 1) {
					$block_header = 'bg-warning';
				} else {
					$block_header = 'bg-success';
				}
				?>
				<div class="block-header <?= $block_header; ?>">
					<h3 class="block-title">No. <?= $urutan[0]->urutan; ?></h3>
				</div>
				<div class="block-content">
					<?php foreach ($soal as $i => $sl) : ?>
						<div class="row mb-1">
							<div class="col-md-12">
								<p class="h4 text-justify">
									<?= $sl->soal; ?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table id="tabel_jawaban">
									<?php foreach ($jawaban[$i][$sl->id] as $hasil) : ?>
										<?php if ($hasil['jwb'] != null) : ?>
											<tr>
												<td width="40" height="50" class="text-center" valign="middle">
													<input type="radio" class="radio_jwb" name="jawaban" value="<?= enkrip($hasil['pil']); ?>" <?= enkrip($hasil['pil']) == enkrip($allUrutan[$i][$sl->id]->jawaban) ? 'checked' : ''; ?>>
												</td>
												<td valign="middle" height="50">
													<label class="label_jwb" data-jwb="<?= enkrip($hasil['pil']); ?>">
														<p><?= $hasil['jwb']; ?></p>
													</label>
												</td>
											</tr>
										<?php endif; ?>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					<?php endforeach; ?>

					<div class="row mt-5 mb-3">
						<div class="col-sm-12 text-right">
							<?php if ($urutan[0]->urutan != 1) : ?>
								<a href="<?= base_url('peserta/tes/') . enkrip($urutan[0]->urutan - 1); ?>" class="btn btn-danger prevEssay"><i class="fa fa-arrow-left"></i>&nbsp;Previous</a>
							<?php endif; ?>

							<a href="javascript:void(0)" id="ragu" data-id_jawaban="<?= enkrip($urutan[0]->id); ?>" data-urut="<?= $urutan[0]->urutan; ?>" class="btn btn-warning">&nbsp;Ragu-ragu</a>

							<?php if ($urutan[0]->urutan != count($allSoal)) : ?>
								<a href="<?= base_url('peserta/tes/') . enkrip($urutan[0]->urutan + 1); ?>" class="btn btn-primary nextEssay">Next&nbsp;<i class="fa fa-arrow-right"></i></a>
							<?php endif; ?>
							<?php if ($urutan[0]->urutan == count($allSoal)) : ?>
								<a href="#" class="btn btn-success" data-target="#modal-akhiri" data-toggle="modal">Akhiri</a>
							<?php endif; ?>
						</div>
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

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>