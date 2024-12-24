<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_masuk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tanggal_surat',
        'no_surat',
        'asal_surat',
        'tujuan_surat',
        'no_agenda',
        'perihal_surat',
        'sifat_surat',
        'jenis_surat',
        'kategori_surat',
        'posisi_surat',
        'file_surat'
    ];
}
