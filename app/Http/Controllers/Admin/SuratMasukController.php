<?php

namespace App\Http\Controllers\Admin;

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
                'route' => route('admin.surat_masuk.index')
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
        return Inertia::render('Admin/SuratMasuk', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
