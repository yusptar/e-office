const Ziggy = {
    "url":"http:\/\/tailwind-admin.test",
    "port":null,"defaults":{},
    "routes":{
        "login":{"uri":"login","methods":["GET","HEAD"]},
        "logout":{"uri":"logout","methods":["GET","HEAD"]},
        "password.confirm":{"uri":"user\/confirm-password","methods":["GET","HEAD"]},
        "password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"]},
        "admin.profile.show":{"uri":"user\/profile","methods":["GET","HEAD"]},
        "other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"]},
        "current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"]},
        "password.request":{"uri":"lupa-password","methods":["GET","HEAD"]},
        "password.email":{"uri":"lupa-password","methods":["POST"]},
        "password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"]},
        "password.update":{"uri":"reset-password","methods":["POST"]},
        "admin.dashboard.index":{"uri":"\/","methods":["GET","HEAD"]},
        "admin.profile.update":{"uri":"user\/profile","methods":["PUT","PATCH"]},
        "admin.profile.password":{"uri":"user\/password","methods":["GET","HEAD"]},
        "admin.profile.password-update":{"uri":"user\/password","methods":["PUT","PATCH"]},
        "admin.data-master.jabatan.index":{"uri":"data-master\/jabatan","methods":["GET","HEAD"]},
        "admin.data-master.jabatan.create":{"uri":"data-master\/jabatan\/tambah","methods":["GET","HEAD"]},
        "admin.data-master.jabatan.store":{"uri":"data-master\/jabatan","methods":["POST"]},
        "admin.data-master.jabatan.edit":{"uri":"data-master\/jabatan\/{jabatan}\/ubah","methods":["GET","HEAD"],"bindings":{"jabatan":"slug"}},
        "admin.data-master.jabatan.update":{"uri":"data-master\/jabatan\/{jabatan}","methods":["PUT","PATCH"],"bindings":{"jabatan":"slug"}},
        "admin.data-master.jabatan.destroy":{"uri":"data-master\/jabatan\/{jabatan}","methods":["DELETE"],"bindings":{"jabatan":"slug"}},
        "admin.data-master.jabatan.table":{"uri":"data-master\/jabatan\/table","methods":["GET","HEAD"]},
        "admin.data-master.karyawan.index":{"uri":"data-master\/karyawan","methods":["GET","HEAD"]},
        "admin.data-master.karyawan.create":{"uri":"data-master\/karyawan\/tambah","methods":["GET","HEAD"]},
        "admin.data-master.karyawan.store":{"uri":"data-master\/karyawan","methods":["POST"]},
        "admin.data-master.karyawan.edit":{"uri":"data-master\/karyawan\/{karyawan}\/ubah","methods":["GET","HEAD"],"bindings":{"karyawan":"slug"}},
        "admin.data-master.karyawan.update":{"uri":"data-master\/karyawan\/{karyawan}","methods":["PUT","PATCH"],"bindings":{"karyawan":"slug"}},
        "admin.data-master.karyawan.destroy":{"uri":"data-master\/karyawan\/{karyawan}","methods":["DELETE"],"bindings":{"karyawan":"slug"}},
        "admin.data-master.karyawan.table":{"uri":"data-master\/karyawan\/table","methods":["GET","HEAD"]},
        }
    };

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
