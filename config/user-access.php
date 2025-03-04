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
        // [
        //   'module' => 'Surat Masuk',
        //   'activities' => [
        //     [
        //       'label' => 'Menu Surat Masuk',
        //       'value' => 'module.surat.masuk.index',
        //     ],
        //     [
        //       'label' => 'Create Pengajuan',
        //       'value' => 'module.surat.masuk.create',
        //     ],
        //     [
        //       'label' => 'Edit Pengajuan',
        //       'value' => 'module.surat.masuk.edit',
        //     ],
        //     [
        //       'label' => 'Delete Pengajuan',
        //       'value' => 'module.surat.masuk.delete',
        //     ],
        //     [
        //       'label' => 'Sertifikasi',
        //       'value' => 'module.surat.masuk.sertifikasi',
        //     ]
        //   ]
        // ],
        [
          'module' => 'Disposisi',
          'activities' => [
            [
              'label' => 'Menu Disposisi',
              'value' => 'module.surat.masuk.index',
            ],
            [
              'label' => 'Create Surat Disposisi',
              'value' => 'module.surat.masuk.create',
            ],
            [
              'label' => 'Edit Surat Disposisi',
              'value' => 'module.surat.masuk.edit',
            ],
            [
              'label' => 'Delete Surat Disposisi',
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
        [
          'module' => 'Pengajuan Surat',
          'activities' => [
            [
              'label' => 'Menu Pengajuan',
              'value' => 'module.surat.pengajuan.index',
            ],
            [
              'label' => 'Create Pengajuan',
              'value' => 'module.surat.pengajuan.create',
            ],
            [
              'label' => 'Edit Pengajuan',
              'value' => 'module.surat.pengajuan.edit',
            ],
            [
              'label' => 'Delete Pengajuan',
              'value' => 'module.surat.pengajuan.delete',
            ],
            [
              'label' => 'Sertifikasi',
              'value' => 'module.surat.pengajuan.sertifikasi',
            ]
          ]
        ],
        [
          'module' => 'Manajemen Surat',
          'activities' => [
            [
              'label' => 'Menu Manajemen Surat',
              'value' => 'module.surat.disposisi.index',
            ],
            [
              'label' => 'Create Manajemen Surat',
              'value' => 'module.surat.disposisi.create',
            ],
            [
              'label' => 'Edit Manajemen Surat',
              'value' => 'module.surat.disposisi.edit',
            ],
            [
              'label' => 'Delete Manajemen Surat',
              'value' => 'module.surat.disposisi.delete',
            ],
            [
              'label' => 'Sertifikasi',
              'value' => 'module.surat.disposisi.sertifikasi',
            ]
          ]
        ]
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