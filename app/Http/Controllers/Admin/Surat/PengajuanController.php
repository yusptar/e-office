<?php

namespace App\Http\Controllers\Admin\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use App\Models\SuratMasuk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Exception;

class PengajuanController extends Controller
{
    private $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = [
            [
                'text' => 'Pengajuan Surat',
                'route' => route('admin.surat.pengajuan.index')
            ]
        ];
    }

    public function index()
    {
        return Inertia::render('Admin/Surat/Pengajuan/Index', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function create()
    {
        $this->breadcrumbs[] = [
            'text' => 'Buat Pengajuan Surat',
            'route' => route('admin.surat.pengajuan.create')
        ];

        return Inertia::render('Admin/Surat/Pengajuan/Create', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $validated['user_id'] = Auth::user()->id;
        $validated['tanggal_surat'] = Carbon::now()->format('Y-m-d');
        $validated['roles'] = Auth::user()->jabatan_id;
        $validated['posisi_surat'] = 'Kasi TUUD';

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filePath = $file->store('pengajuan_surat', 'public');
            $validated['file_surat'] = $filePath;
        }
        
        DB::beginTransaction();
        try {
            SuratMasuk::create($validated);
            DB::commit();
            return redirect()->route('admin.surat.pengajuan.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan surat berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function edit(SuratMasuk $pengajuan)
    {
        $this->breadcrumbs[] = [
            'text' => 'Edit Pengajuan Surat',
            'route' => route('admin.surat.pengajuan.edit', [$pengajuan->slug])
        ];

        return Inertia::render('Admin/Surat/Pengajuan/Edit', [
            'breadcrumbs' => $this->breadcrumbs,
            'pengajuan' => $pengajuan
            
        ]);
    }

    public function update(Request $request, SuratMasuk $pengajuan)
    {
        $request->validate($this->validationRules($pengajuan));

        DB::beginTransaction();
        try {
            $pengajuan->fill($request->except(['file_surat']));
            if ($request->hasFile('file_surat')) {
                if ($pengajuan->file_surat) {
                    Storage::disk('public')->delete($pengajuan->file_surat);
                }
                $file = $request->file('file_surat');
                $filePath = $file->store('pengajuan_surat', 'public');
                $pengajuan->file_surat = $filePath; 
            }

            $pengajuan->save();
            DB::commit();
            return redirect()->route('admin.surat.pengajuan.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan surat berhasil diperbarui.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function destroy(SuratMasuk $pengajuan)
    {
        DB::beginTransaction();
        try {
            if ($pengajuan->file_surat) {
                Storage::disk('public')->delete($pengajuan->file_surat);
            }

            $pengajuan->delete();

            DB::commit();
            return redirect()->route('admin.surat.pengajuan.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan Surat berhasil dihapus.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function table(Request $request)
    {
        return response()->json(SuratMasuk::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->filter($request->all())->paginateFilter());
    }

    private function validationRules($pengajuan = null)
    {
        return [
            'no_surat' => 'required|string|max:255',
            'asal_surat' => 'required|string|max:255',
            'tujuan_surat' => 'required|string|max:255',
            'no_agenda' => 'required|string|max:255',
            'perihal_surat' => 'required|string|max:255',
            'sifat_surat' => 'required|string|max:50',
            'jenis_surat' => 'required|string|max:50',
            'kategori_surat' => 'required|string|max:50',
            'posisi_surat' => 'nullable|string|max:255',
            'file_surat' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
