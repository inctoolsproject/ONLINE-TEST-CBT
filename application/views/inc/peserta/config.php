<?php
$one->inc_header                 = APPPATH . 'views/inc/peserta/views/inc_header.php';
$one->inc_footer                 = APPPATH . 'views/inc/peserta/views/inc_footer.php';

$one->title                      = $title . ' | Peserta';
$one->l_header_dark              = true;
$one->l_header_fixed             = false;

$one->l_m_content                = 'boxed';

$one->main_nav                   = array(
    array(
        'name'  => 'Dashboard',
        'icon'  => 'si si-compass',
        'url'   => base_url('peserta')
    ),
    array(
        'name'  => 'Menu',
        'type'  => 'heading'
    ),
    array(
        'name'  => 'Ujian',
        'icon'  => 'si si-chart',
        'sub'   => array(
            array(
                'name'  => 'Ambil Ujian | Token',
                'icon' => 'far fa-file-alt',
                'url'   => base_url('peserta/ujian/token')
            ),
            array(
                'name'  => 'List Ujian',
                'icon' => 'far fa-file-alt',
                'url'   => base_url('peserta/ujian/list')
            )
        )
    )
);
