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
		<div class="col-md-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">List Ujian</h3>
				</div>
				<div class="block-content">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover table-vcenter start-at-25">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Nama Ujian</th>
									<th>Topik</th>
									<th>Jumlah Soal</th>
									<th>Estimasi jam</th>
									<th>Keterangan</th>
									<th>Tanggal Ujian</th>
									<th>Status Ujian</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php if (is_array($list_ujian) || is_object($list_ujian)) : ?>
									<?php foreach ($list_ujian as $hasil) : ?>
										<tr>
											<td class="text-center font-size-sm"><?= $i++; ?></td>
											<td class="font-size-sm"><?php echo $hasil->nama_ujian ?></td>
											<td class="font-size-sm"><?php echo $hasil->topik ?></td>
											<td class="font-size-sm"><?php echo $hasil->jumlah_soal ?></td>
											<td class="font-size-sm"><?php echo $hasil->waktu . ' Menit' ?></td>
											<td class="font-size-sm"><?php echo $hasil->keterangan ?></td>
											<td class="font-size-sm"><?php echo date('d M Y - H:i:s', strtotime($hasil->tanggal_ujian)) ?></td>
											<td class="font-size-sm">
												<?php if ($hasil->status == 0) : ?>
													<span class="badge badge-danger">Belum Ujian</span>
												<?php elseif ($hasil->status == 1) : ?>
													<span class="badge badge-info">Sedang Ujian</span>
												<?php elseif ($hasil->status == 2) : ?>
													<span class="badge badge-success">Sudah Ujian</span>
												<?php endif; ?>
											</td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail Ujian" onclick="window.location='<?= base_url('peserta/ujian/detail/' . enkrip($hasil->id)); ?>'">
														<i class="fa fa-fw fa-info"></i>
													</button>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
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