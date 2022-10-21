<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/guru/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<div class="bg-black-75">
    <div class="content content-full text-center">
        <div class="my-3">
            <img class="img-avatar img-avatar128" src="<?= base_url('upload/guru/') . $this->user[0]->foto; ?>" alt="Profile">
        </div>
        <h1 class="h2 text-white mb-5"><?= $this->user[0]->nama; ?></h1>
        <a class="btn btn-light" href="<?= base_url('guru'); ?>">
            <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Dashboard
        </a>
    </div>
</div>

<!-- Page Content -->
<div class="content content-boxed">
    <!-- User Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">User Account</h3>
        </div>
        <div class="block-content">
            <form action="<?= base_url('guru/profile/updateFoto'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Your account’s vital info. Your username will be publicly visible.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-ediusername">Username</label>
                            <input type="text" class="form-control" readonly name="username" required autocomplete="off" value="<?= $this->user[0]->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" required autocomplete="off" value="<?= $this->user[0]->email; ?>">
                        </div>
                        <div class="form-group">
                            <label>Your Avatar</label>
                            <div class="push">
                                <img class="img-avatar img-avatar64" id="gambar_nodin" src="<?= base_url('upload/guru/') . $this->user[0]->foto; ?>" alt="Profile">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" accept="image/jpg,image/jpeg,image/png" data-toggle="custom-file-input" name="foto">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new
                                    avatar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END User Profile -->

    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">User Biodata</h3>
        </div>
        <div class="block-content">
            <form action="<?= base_url('guru/profile/updateBio'); ?>" method="POST">
                <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Your account’s vital info. Your username will be publicly visible.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $this->user[0]->nama; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" class="form-control">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" <?= ($this->user[0]->jk == 'Laki-laki') ? 'selected' : ''; ?>>Laki - laki</option>
                                <option value="Laki-laki" <?= ($this->user[0]->jk == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="number" class="form-control" name="no_hp" required autocomplete="off" value="<?= $this->user[0]->no_hp; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah" required autocomplete="off" value="<?= $this->user[0]->nama_sekolah; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" cols="30" rows="5" class="form-control"><?= $this->user[0]->alamat; ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Change Password</h3>
        </div>
        <div class="block-content">
            <form action="<?= base_url('guru/profile/updatePass'); ?>" method="POST">
                <input type="hidden" class="csrf_tokem" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Changing your sign in password is an easy way to keep your account secure.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="oldPass">Current Password</label>
                            <input type="password" class="form-control" required autocomplete="off" name="oldPass">
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="newPass">New Password</label>
                                <input type="password" class="form-control" required autocomplete="off" name="newPass">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="confirPass">Confirm New Password</label>
                                <input type="password" class="form-control" required autocomplete="off" name="confirPass">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Change Password -->

</div>
<!-- END Page Content -->

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('toastr/script.js'); ?>

<script>
    $("#image").change(function() {
        bacaGambar(this);
    });

    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar_nodin').attr('src', e.target.result);
            }, reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>