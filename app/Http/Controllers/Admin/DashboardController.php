<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\SuratMasuk;
use App\Models\Karyawan;

class DashboardController extends Controller
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
                'text' => 'Dashboard',
                'route' => route('admin.dashboard.index')
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
        $user = Auth()->user();
        $jabatan_id = $user->jabatan_id;

        if (in_array($jabatan_id, [3, 4, 16, 2])) {
            $query = SuratMasuk::query();
        } else {
            $query = SuratMasuk::where('user_id', $user->id);
        }

        $totalSurat = (clone $query)->count();
        $suratSelesai = (clone $query)->where('status', '2')->count();
        $suratDiproses = (clone $query)->whereIn('status', ['0', '1'])->count();

        return Inertia::render('Admin/Dashboard', [
            'breadcrumbs' => $this->breadcrumbs,
            'surat' => [
                'total' => $totalSurat,
                'selesai' => $suratSelesai,
                'proses' => $suratDiproses,
            ]
        ]);
    }
}
