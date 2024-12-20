<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Karyawan;

class PengajuanController extends Controller
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
                'text' => 'Pengajuan Surat',
                'route' => route('admin.pengajuan.index')
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
        return Inertia::render('Admin/Pengajuan', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
