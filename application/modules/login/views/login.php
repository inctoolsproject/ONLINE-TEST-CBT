<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title ?></title>
	<meta name="description" content="Online Test">
	<meta name="author" content="ot">
	<meta name="robots" content="index, follow">
	<meta property="og:title" content="Login | Online Test">
	<meta property="og:site_name" content="OnlineTest">
	<meta property="og:description" content="Online Test">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= base_url(); ?>">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/fontawesome-all.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/style.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/theme.css') ?>">

</head>

<body>
	<div class="form-body" class="container-fluid">
		<div class="row">
			<div class="img-holder">
				<div class="bg"></div>
				<div class="info-holder">
					<img src="<?= base_url('assets/frontend/images/graphic1.svg') ?>" alt="Online Test">
				</div>
			</div>
			<div class="form-holder">
				<div class="form-content">
					<div class="form-items">
						<h3>Online Test</h3>
						<p>Akses Aplikasi Online Test Dimanapun & Kapanpun</p>
						<form autocomplete="off" method="POST" action="<?= base_url('login/proses') ?>">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
							<?php
							if (!empty($this->session->flashdata('error'))) { ?>
								<div class="alert alert-danger" id="error">
									<?= $this->session->flashdata('error') ?>
								</div>
							<?php } ?>
							<input class="form-control" type="text" name="username" autocomplete="off" autocomplete="off" placeholder="Username" required>
							<input class="form-control" type="password" min="5" max="10" name="password" autocomplete="off" id="password" autocomplete="off" placeholder="Password" required>
							<input type="checkbox" class="form-check-input" id="showpw">
							<label class="form-check-label font-weight-light" for="showpw">Show Password</label>
							<div class="form-button">
								<button id="submit" type="submit" class="ibtn">Login</button>
							</div>
						</form>
						<div class="other-links">
							<span>Belum punya akun? <a href="<?php echo base_url('register') ?>">Klik disini</a></span><br>
							<a href="<?= base_url(); ?>">Copyright © <?= date('Y') ?> | Online Test</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?= base_url('assets/frontend/js/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/frontend/js/popper.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/frontend/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/frontend/js/main.js') ?>"></script>
</body>

</html>