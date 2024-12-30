<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class SuratMasukFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    /**
     *
     * Any methods defined in the blackist array will not be called by the filter.
     * Those methods are normally used for internal filter logic.
     *
     * @var array
     */    
    protected $blacklist = [
        'nomerSurat',
        'asalSurat',
        'kategoriSurat',
    ];

    public function setup()
    {
        // 
    }

    public function search($value)
    {
        $this->nomerSurat($value)
            ->asalSurat($value, true)
            ->kategoriSurat($value, true);
    }

    public function nomerSurat($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('no_surat', 'LIKE', '%'.$value.'%');
        }
        return $this->where('no_surat', 'LIKE', '%'.$value.'%');
    }

    public function asalSurat($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('asal_surat', 'LIKE', '%'.$value.'%');
        }
        return $this->where('asal_surat', 'LIKE', '%'.$value.'%');
    }

    public function kategoriSurat($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('kategori_surat', 'LIKE', '%'.$value.'%');
        }
        return $this->where('kategori_surat', 'LIKE', '%'.$value.'%');
    }

    public function sortOrder($sortOrder)
    {
        foreach ($sortOrder as $value) {
            $this->orderBy($value['column'], $value['order']);
        }
    }
}
