<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/peserta/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php $one->get_css('js/plugins/slick-carousel/slick.css'); ?>
<?php $one->get_css('js/plugins/slick-carousel/slick-theme.css'); ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/peserta/views/inc_navigation.php'; ?>


<div class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <a class="block block-rounded block-link-pop js-appear-enabled animated fadeIn" href="<?php echo base_url('peserta/profile') ?>" data-toggle="appear" data-offset="200">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Informasi Peserta</h3>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-sm-3 text-center">
                                        <div class="mb-3 py-1">
                                            <img class="img-thumbnail" style="width: 120px;" src="
                                            <?= ($this->user->foto == 'default.jpg' || $this->user->foto == '') ? base64img(base_url('upload/default.jpg')) :
                                                base64img(base_url('upload/peserta/' . $this->user->foto))
                                            ?>
                                            " alt="<?= $this->user->nama; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 py-2">
                                        <div class="font-size-h3 font-w600"><?= $this->user->nama; ?> <sup><span class="badge badge-success"><?= $this->user->nama_group ?></span></sup></div>
                                        <address class="font-size-sm">
                                            <p class="font-size-h6">
                                                <b>Email : </b> <?= $this->user->email; ?>
                                                <br>
                                                <b><?= ' ' . $this->user->nama_sekolah ?></b>
                                                <br>
                                                <b><?= ' ' . $this->user->alamat ?></b>
                                            </p>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/slick-carousel/slick.min.js'); ?>

<!-- Page JS Helpers (Slick Slider Plugin) -->
<script>
    jQuery(function() {
        One.helpers('slick');
    });
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>