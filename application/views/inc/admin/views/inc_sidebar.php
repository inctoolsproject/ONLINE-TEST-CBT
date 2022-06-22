<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header bg-white-5">
        <a class="font-w600 text-dual" href="<?= base_url('admin') ?>">
            <span class="smini-visible">
                <i class="fa fa-book-reader text-primary"></i>
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
                ONLINE<span class="font-w400">TEST</span>
            </span>
        </a>
        <div>

            <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>

        </div>

    </div>

    <div class="js-sidebar-scroll">
        <div class="content-side">
            <ul class="nav-main">
                <?php $one->build_nav(); ?>
            </ul>
        </div>
    </div>
</nav>