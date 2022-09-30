<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Siamarcade.backoffice-hotel',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SIAMARCADE</b>',
    // 'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    // 'logo_img' => '',
    // 'logo_img_class' => 'brand-image img-circle elevation-3',
    // 'logo_img_xl' => null,
    // 'logo_img_xl_class' => 'brand-image-xs',
    // 'logo_img_xl_class' => '',
    // 'logo_img_alt' => 'siamarcade.com',

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'รอสักครู่',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline',
    'classes_auth_header' => 'bg-primary',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => NULL,
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    // provider
    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        [
            'text' => 'หน้าหลัก',
            'url'  => 'dashboardprovider',
            'icon' => 'fas fa-fw fa-home',
            'can'  => 'menu_provider',
            'active' => ['dashboardprovider'],
        ],
        [
            'text' => 'ข้อมูลผู้ประกอบการ',
            'url'  => 'detailprovider',
            'icon' => 'fas fa-fw fa-file',
            'can'  => 'menu_provider',
            'active' => ['detailprovider'],
        ],
        [
            'text' => 'รายชื่อบัญชีที่ถูกแบน',
            'url'  => 'listban',
            'icon' => 'fas fa-fw fa-ban',
            'can'  => 'menu_provider',
            'active' => ['listban'],
        ],
        [
            'text' => 'ช่องทางชำระเงิน ',
            'url'  => 'paymentprovider',
            'icon' => 'fas fa-fw fa-credit-card',
            'can'  => 'menu_provider',
            'active' => ['paymentprovider'],
        ],
        [
            'header' => 'รายงาน',
            'can'  => 'menu_provider',
        ],
        [
            'text'       => 'รายงานผู้ใช้งาน',
            'icon' => 'fas fa-fw fa-bar-chart',
            'can'  => 'menu_provider',
            'submenu' => [
                [
                    'text' => 'รายวัน,รายเดือน',
                    'url'  => 'reportnewproviderD&M',
                    'can'  => 'menu_provider',
                    'active' => ['reportnewproviderD&M', 'reportrenewproviderD&M/*'],
                ],
                [
                    'text' => 'รายปี',
                    'url'  => 'reportnewproviderYear',
                    'can'  => 'menu_provider',
                    'active' => ['reportnewproviderYear'],
                ],
            ]

        ],
        [
            'text'       => 'รายงานต่ออายุ',
            'icon' => 'fas fa-fw fa-bar-chart',
            'can'  => 'menu_provider',
            'submenu' => [
                [
                    'text' => 'รายเดือน',
                    'url'  => 'reportrenewproviderMonth',
                    'can'  => 'menu_provider',
                    'active' => ['reportrenewproviderMonth', 'reportrenewproviderMonth/*'],
                ],
                [
                    'text' => 'รายปี',
                    'url'  => 'reportrenewproviderYear',
                    'can'  => 'menu_provider',
                    'active' => ['reportrenewproviderYear'],
                ],
            ]
        ],
        [
            'text' => 'หน้าหลัก',
            'url'  => 'dashboardcompany',
            'icon' => 'fas fa-fw fa-home',
            'can' => 'menu_company',
            'active' => ['dashboardcompany'],
        ],
        [
            'text' => 'รายชื่อพนักงาน',
            'url'  => 'detailemployee',
            'icon' => 'fas fa-fw fa-file-text',
            'can' => 'menu_company',
            'active' => ['detailemployee'],
        ],
        [
            'text' => 'การจัดการข้อมูล',
            'icon' => 'fas fa-fw fa-pencil-square-o',
            'can' => 'menu_company',
            'submenu' => [
                [
                    'text' => 'ข้อมูลผู้ใช้งาน',
                    'url'  => 'detailcompany',
                    'icon' => 'fas fa-fw fa-file',
                    'can' => 'manager_company',
                    'active' => ['detailcompany', 'manageusercheckin', 'manageusercheckout'],
                ],
                [
                    'text' => 'ข้อมูลลูกค้า',
                    'url'  => 'manageuser',
                    'icon' => 'fas fa-fw fa-users',
                    'can' => 'menu_company',
                    'active' => ['manageuser'],
                ],
            ]
        ],
        [
            'text' => 'การจัดการห้องพัก',
            'icon' => 'fas fa-fw fa-pencil-square-o',
            'can' => 'menu_company',
            'submenu' => [
                [
                    'text' => 'ประเภทห้องพัก',
                    'url'  => 'manage_typeroom',
                    'icon' => 'fas fa-fw fa-file-text',
                    'can' => 'menu_company',
                    'active' => ['manage_typeroom'],
                ],
                [
                    'text' => 'ข้อมูลห้องพัก',
                    'url'  => 'manageroom',
                    'icon' => 'fas fa-fw fa-bed',
                    'can' => 'menu_company',
                    'active' => ['manageroom', 'addroom', 'editroom/*'],
                ],
            ]
        ],
        [
            'text' => 'การจองห้องพัก',
            'icon' => 'fas fa-fw fa-bookmark',
            'can' => 'menu_company',
            'submenu' => [
                [
                    'text' => 'รายละเอียดการจอง',
                    'url'  => 'detailbooking',
                    'icon' => 'fas fa-fw fa-tasks',
                    'can' => 'menu_company',
                    'active' => ['detailbooking'],
                ],
                [
                    'text' => 'ข้อมูลการจอง',
                    'url'  => 'detailreserve',
                    'icon' => 'fas fa-fw fa-tags',
                    'can' => 'menu_company',
                    'active' => ['detailreserve'],
                ],
                [
                    'text' => 'ปฏิทินการจอง',
                    'url'  => 'reportreserves',
                    'icon' => 'fas fa-fw fa-calendar',
                    'can' => 'menu_company',
                    'active' => ['reportreserves'],
                ],
            ]
        ],
        [
            'text' => 'รายงานลูกค้า',
            'icon' => 'fas fa-fw fa-file-text',
            'can' => 'menu_company',
            'submenu' => [
                [
                    'text'       => 'รายวัน',
                    'url'        => 'company_reportcustomer_day',
                    'icon' => 'fas fa-fw fa-bar-chart',
                    'can' => 'menu_company',
                    'active' => ['reportcustomer_day'],
                ],
                [
                    'text'       => 'รายเดือน, รายปี',
                    'url'        => 'company_reportcustomer_M&Y',
                    'icon' => 'fas fa-fw fa-bar-chart',
                    'can' => 'menu_company',
                    'active' => ['reportrecustomer_M&Y'],
                ],
            ]
        ],
        [
            'header' => 'การชำระเงิน',
            'can' => 'menu_company',
        ],
        [
            'text' => 'ข้อมูลการชำระเงิน',
            'url'  => 'paymentcompany',
            'icon' => 'fas fa-fw fa-credit-card',
            'can' => 'menu_company',
            'active' => ['paymentcompany'],
        ],

        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'cyan',
        //     'url'        => '#',
        // ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'BsCustomFileInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bs-custom-file-input/bs-custom-file-input.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
