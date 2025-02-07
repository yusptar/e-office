<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use EloquentFilter\Filterable;

class SuratMasuk extends Model
{
    use HasFactory, SoftDeletes, Sluggable, Filterable;
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
        'slug',
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
        'file_surat',
        'status'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['no_surat', 'tujuan_surat']
            ]
        ];
    }

}
