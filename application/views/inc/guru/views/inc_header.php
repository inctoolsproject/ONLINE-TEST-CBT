<header id="page-header">
	<div class="content-header">
		<div class="d-flex align-items-center">
			<button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
				<i class="fa fa-fw fa-bars"></i>
			</button>
			<button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
				<i class="fa fa-fw fa-ellipsis-v"></i>
			</button>
		</div>

		<div class="d-flex align-items-center">
			<div class="dropdown d-inline-block ml-2">
				<button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="rounded-circle" src="<?= base_url('upload/guru/') . $this->user[0]->foto; ?>" alt="Header Avatar" style="width: 21px;">
					<span class="d-none d-sm-inline-block ml-2"><?= $this->user[0]->nama; ?></span>
					<i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
					<div class="p-3 text-center bg-primary-dark rounded-top">
						<img class="img-avatar img-avatar48" src="<?= base_url('upload/guru/') . $this->user[0]->foto; ?>" alt="Profile">
						<p class="mt-2 mb-0 text-white font-w500"><?= $this->user[0]->nama; ?></p>
						<p class="mb-0 text-white-50 font-size-sm"><?= $this->user[0]->nama_group; ?></p>
					</div>
					<div class="p-2">
						<a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url('guru/profile'); ?>">
							<span class="font-size-sm font-w500">Profil & Keamanan</span>
						</a>
						<a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= $this->logout; ?>">
							<span class="font-size-sm font-w500">Keluar</span>
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div id="page-header-loader" class="overlay-header bg-white">
		<div class="content-header">
			<div class="w-100 text-center">
				<i class="fa fa-fw fa-circle-notch fa-spin"></i>
			</div>
		</div>
	</div>
</header>