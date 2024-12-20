<?php

return [
  'menu' => [
    [
      'uniqid' => 'menuDashboard', // unique identifier, use route name without function name like index, create, etc
      'type' => 'menu', // menu type "menu" or "divider"
      'text' => 'Dashboard', // menu label
      'route' => 'admin.dashboard.index', // menu url use route() helper
      'access' => true, // user access name, bypass it with true
      'active' => false, // required for helper change if menu active or not
      'open' => false, // required for helper change if submenu must be shown or not
      'children' => null // all sub menu, accept array of object like menu
    ],
    [
      'type' => 'divider',
    ],
    [
      'uniqid' => 'menuPengajuan', 
      'type' => 'menu',
      'text' => 'Pengajuan Surat', 
      'route' => 'admin.pengajuan.index', 
      'access' => 'module.pengajuan.index', 
      'active' => false, 
      'open' => false, 
      'children' => null
    ],
    [
      'type' => 'divider',
    ],
    // [
    //   'uniqid' => 'menuMasterData',
    //   'type' => 'menu',
    //   'text' => 'Kelola Surat',
    //   'route' => '#',
    //   'access' => [
    //     'module.data-master.jabatan.index',
    //     'module.data-master.karyawan.index',
    //     'module.data-master.banner.index',
    //   ],
    //   'active' => false,
    //   'open' => false,
    //   'children' => [
    //     [
    //       'uniqid' => 'masterBanner',
    //       'type' => 'menu',
    //       'text' => 'Surat Keluar',
    //       'route' => 'admin.data-master.banner.index',
    //       'access' => 'module.data-master.banner.index',
    //       'active' => false,
    //       'open' => false,
    //       'children' => null
    //     ],
    //     [
    //       'uniqid' => 'suratMasuk',
    //       'type' => 'menu',
    //       'text' => 'Surat Masuk',
    //       'route' => 'admin.surat_masuk.index',
    //       'access' => true,
    //       'active' => false,
    //       'open' => false,
    //       'children' => null
    //     ]
    //   ]
    // ],
    [
      'uniqid' => 'menuKelolaSurat',
      'type' => 'menu',
      'text' => 'Kelola Surat',
      'route' => '#',
      'access' => [
        'module.surat.surat_masuk.index',
        'module.surat.surat_keluar.index',
      ],
      'active' => false,
      'open' => false,
      'children' => [
        [
          'uniqid' => 'suratMasuk',
          'type' => 'menu',
          'text' => 'Surat Masuk',
          'route' => 'admin.surat.surat_masuk.index',
          'access' => 'module.surat.surat_masuk.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
        [
          'uniqid' => 'suratKeluar',
          'type' => 'menu',
          'text' => 'Surat Keluar',
          'route' => 'admin.surat.surat_keluar.index',
          'access' => 'module.surat.surat_keluar.index',
          'active' => false,
          'open' => false,
          'children' => null
        ]
      ]
    ],
    [
      'type' => 'divider',
    ],
   
    // [
    //   'uniqid' => 'menuLaporan',
    //   'type' => 'menu',
    //   'text' => 'Laporan',
    //   'route' => '#',
    //   'access' => [
    //     'module.laporan.pengaduan.index',
    //     'module.laporan.spi.index',
    //   ],
    //   'active' => false,
    //   'open' => false,
    //   'children' => [
    //     [
    //       'uniqid' => 'masterPengaduan',
    //       'type' => 'menu',
    //       'text' => 'Pengaduan',
    //       'route' => 'admin.laporan.pengaduan.index',
    //       'access' => 'module.laporan.pengaduan.index',
    //       'active' => false,
    //       'open' => false,
    //       'children' => null
    //     ],
    //     [
    //       'uniqid' => 'masterSPI',
    //       'type' => 'menu',
    //       'text' => 'SPI',
    //       'route' => 'admin.laporan.spi.index',
    //       'access' => 'module.laporan.spi.index',
    //       'active' => false,
    //       'open' => false,
    //       'children' => null
    //     ],
    //   ]
    // ],
    [
      'uniqid' => 'menuLainnya',
      'type' => 'menu',
      'text' => 'Lainnya',
      'route' => '#',
      'access' => [
        'module.data-master.karyawan.index',
        'module.data-master.jabatan.index',
        'module.log-activity.index',
      ],
      'active' => false,
      'open' => false,
      'children' => [
        [
          'uniqid' => 'masterUser',
          'type' => 'menu',
          'text' => 'List Users',
          'route' => 'admin.data-master.karyawan.index',
          'access' => 'module.data-master.karyawan.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
        [
          'uniqid' => 'masterGroupUser',
          'type' => 'menu',
          'text' => 'List Roles',
          'route' => 'admin.data-master.jabatan.index',
          'access' => 'module.data-master.jabatan.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
        [
          'uniqid' => 'menuLogActivity',
          'type' => 'menu',
          'text' => 'Log Activity',
          'route' => 'admin.log-activity.index',
          'access' => 'module.log-activity.index',
          'active' => false,
          'open' => false,
          'children' => null
        ],
      ]
    ],
  ]
];