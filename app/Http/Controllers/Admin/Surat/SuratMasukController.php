<?php

namespace App\Http\Controllers\Admin\Surat;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Karyawan;

class SuratMasukController extends Controller
{
    /**
     *
     * Initiate controller instance
     *
     */    
    function __construct()
    {
        $this->breadcrumbs = [
            [
                'text' => 'Surat Masuk',
                'route' => route('admin.surat.surat_masuk.index')
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Surat/SuratMasuk/Index', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
