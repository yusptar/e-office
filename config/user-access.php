<?php

return [
  'access' => [
    [
      'module' => 'Master Data',
      'sub_module' => [
        // [
        //   'module' => 'Banner',
        //   'activities' => [
        //     [
        //       'label' => 'Menu Banner',
        //       'value' => 'module.data-master.banner.index',
        //     ],
        //     [
        //       'label' => 'Edit Banner',
        //       'value' => 'module.data-master.banner.edit',
        //     ],
        //     [
        //       'label' => 'Delete Banner',
        //       'value' => 'module.data-master.banner.delete',
        //     ]
        //   ]
        // ],
        [
          'module' => 'Group User',
          'activities' => [
            [
              'label' => 'Menu Group User',
              'value' => 'module.data-master.jabatan.index',
            ],
            [
              'label' => 'Create Group User',
              'value' => 'module.data-master.jabatan.create',
            ],
            [
              'label' => 'Edit Group User',
              'value' => 'module.data-master.jabatan.edit',
            ],
            [
              'label' => 'Delete Group User',
              'value' => 'module.data-master.jabatan.delete',
            ]
          ]
        ],
        [
          'module' => 'User',
          'activities' => [
            [
              'label' => 'Menu User',
              'value' => 'module.data-master.karyawan.index',
            ],
            [
              'label' => 'Create User',
              'value' => 'module.data-master.karyawan.create',
            ],
            [
              'label' => 'Edit User',
              'value' => 'module.data-master.karyawan.edit',
            ],
            [
              'label' => 'Delete User',
              'value' => 'module.data-master.karyawan.delete',
            ]
          ]
        ],
        [
          'module' => 'Surat Masuk',
          'activities' => [
            [
              'label' => 'Menu Surat Masuk',
              'value' => 'module.surat.masuk.index',
            ],
            [
              'label' => 'Create Pengajuan',
              'value' => 'module.surat.masuk.create',
            ],
            [
              'label' => 'Edit Pengajuan',
              'value' => 'module.surat.masuk.edit',
            ],
            [
              'label' => 'Delete Pengajuan',
              'value' => 'module.surat.masuk.delete',
            ],
            [
              'label' => 'Sertifikasi',
              'value' => 'module.surat.masuk.sertifikasi',
            ]
          ]
        ],
        [
          'module' => 'Surat Keluar',
          'activities' => [
            [
              'label' => 'Menu Surat Keluar',
              'value' => 'module.surat.keluar.index',
            ],
            [
              'label' => 'Create Pengajuan',
              'value' => 'module.surat.keluar.create',
            ],
            [
              'label' => 'Edit Pengajuan',
              'value' => 'module.surat.keluar.edit',
            ],
            [
              'label' => 'Delete Pengajuan',
              'value' => 'module.surat.keluar.delete',
            ],
            [
              'label' => 'Sertifikasi',
              'value' => 'module.surat.keluar.sertifikasi',
            ]
          ]
        ],
        // [
        //   'module' => 'Pengajuan',
        //   'activities' => [
        //     [
        //       'label' => 'Menu Pengajuan Surat',
        //       'value' => 'module.pengajuan.index',
        //     ],
        //     [
        //       'label' => 'Create Pengajuan',
        //       'value' => 'module.pengajuan.create',
        //     ],
        //   ]
        // ],
      ]
    ],
    [
      'module' => 'Log',
      'sub_module' => [
        [
          'module' => 'Log Activity',
          'activities' => [
            [
              'label' => 'Menu Log Activity',
              'value' => 'module.log-activity.index',
            ],
            [
              'label' => 'Detail Log Activity',
              'value' => 'module.log-activity.detail',
            ]
          ]
        ]
      ]
    ],
  ]
];