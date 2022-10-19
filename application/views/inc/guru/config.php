<?php
$one->inc_sidebar                = APPPATH . 'views/inc/guru/views/inc_sidebar.php';
$one->inc_header                 = APPPATH . 'views/inc/guru/views/inc_header.php';
$one->inc_footer                 = APPPATH . 'views/inc/guru/views/inc_footer.php';
$one->l_m_content                = '';
$one->main_nav                   = [
    [
        'name'  => 'Dashboard',
        'icon'  => 'si si-speedometer',
        'url'   => base_url('guru')
    ],
    [
        'name'  => 'Data Master',
        'icon'  => 'si si-layers',
        'sub'   => [
            [
                'name'  => 'Jenis Ujian',
                'url'   => base_url('guru/jenis_ujian')
            ],
            [
                'name'  => 'Bank Soal',
                'sub'   => jenisUjian_menu(base_url('guru/bank_soal/'))
            ]
        ]
    ]
];
