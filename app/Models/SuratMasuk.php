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

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = \Auth::user()->nama_lengkap ?? 'System';
            $model->updated_by = \Auth::user()->nama_lengkap ?? 'System';
        });
        static::updating(function ($model) {
            $model->updated_by = \Auth::user()->nama_lengkap ?? 'System';
        });
        static::deleted(function ($model) {
            $model->deleted_by = \Auth::user()->nama_lengkap ?? 'System';
            $model->save();
        });
    }
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['no_surat', 'tujuan_surat']
            ]
        ];
    }

}
