<?php
$one->inc_sidebar                = APPPATH . 'views/inc/admin/views/inc_sidebar.php';
$one->inc_header                 = APPPATH . 'views/inc/admin/views/inc_header.php';
$one->inc_footer                 = APPPATH . 'views/inc/admin/views/inc_footer.php';
$one->l_m_content                = '';
$one->main_nav                   = [
    [
        'name'  => 'Dashboard',
        'icon'  => 'si si-speedometer',
        'url'   => base_url('admin')
    ],
    [
        'name'  => 'User Management',
        'icon'  => 'si si-user',
        'sub'   => [
            [
                'name'  => 'Group User',
                'url'   => base_url('admin/group')
            ],
            [
                'name'  => 'User Admin Manager',
                'url'   => base_url('admin/user')
            ]
        ]
    ]
];
