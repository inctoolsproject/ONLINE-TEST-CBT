<header id="page-header">
	<div class="content-header">
		<div class="d-flex align-items-center">
			<a class="font-w600 font-size-h5 tracking-wider text-dual mr-3" href="<?php echo base_url() ?>">
				ONLINE<span class="font-w400">TEST</span>
			</a>
		</div>
		<div class="d-flex align-items-center">
			<div class="dropdown d-inline-block ml-2">
				<button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="rounded-circle" src="
                    <?=
					($this->user->foto == 'default.jpg' || $this->user->foto == '') ?
						base64img(base_url('upload/default.jpg')) : base64img(base_url('upload/peserta/' . $this->user->foto))
					?>
                    " alt="<?= $this->user->nama; ?>" style="width: 21px;">
					<span class="d-none d-sm-inline-block ml-1"><?= $this->user->nama; ?></span>
					<i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
					<div class="p-3 text-center bg-primary-dark rounded-top">
						<img class="img-avatar img-avatar48 img-avatar-thumb" src="
                        <?=
						($this->user->foto == 'default.jpg' || $this->user->foto == '') ?
							base64img(base_url('upload/default.jpg')) : base64img(base_url('upload/peserta/' . $this->user->foto))
						?>
                        " alt="<?= $this->user->nama; ?>" style="width: 48px;">
						<p class="mt-2 mb-0 text-white font-w500"><?= $this->user->nama; ?></p>
					</div>
					<div class="p-2">
						<a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url('peserta/profile') ?>">
							<span class="font-size-sm font-w500">Profile & Keamanan</span>
						</a>
						<div role="separator" class="dropdown-divider"></div>
						<?php if (!empty($this->session->userdata('log_admin')) || !empty($this->session->userdata('log_baa')) || !empty($this->session->userdata('log_guru'))) { ?>
							<a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url('login') ?>">
								<span class="font-size-sm font-w500">Beralih ke Admin</span>
							</a>
						<?php } ?>
						<a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= $this->logout ?>">
							<span class="font-size-sm font-w500">Keluar</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="page-header-loader" class="overlay-header bg-primary-lighter">
		<div class="content-header">
			<div class="w-100 text-center">
				<i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
			</div>
		</div>
	</div>
</header>