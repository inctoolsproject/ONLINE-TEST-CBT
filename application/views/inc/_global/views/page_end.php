    <div class="modal fade" id="idle-modal" tabindex="-1" role="dialog" aria-labelledby="idle-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Sesi Anda Telah Berakhir</h3>
                    </div>
                    <div class="block-content font-size-sm">
                        <p>Sistem kami tidak mendeteksi adanya aktivitas dari Anda. Sehingga Anda akan dikeluarkan secara otomatis oleh sistem. Jika Anda tetap ingin menggunakan sistem, silakan klik "Tetap Masuk".</p>
                        <p>Anda akan keluar dalam <span class="bold" id="sessionSecondsRemaining">10</span> detik.</p>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <a href="<?= base_url('logout') ?>" id="logoutSession" type="button" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <a href="javascript:void(0);" id="extendSession" type="button" class="btn btn-success" data-dismiss="modal">Tetap Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    </main>
    <?php if(isset($one->inc_footer) && $one->inc_footer) { include($one->inc_footer); } ?>
</div>