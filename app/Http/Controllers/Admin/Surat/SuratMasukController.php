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

class SuratMasukController extends Controller
{
    private $breadcrumbs;
    /**
     *
     * Initiate controller instance
     *
     */    
    function __construct()
    {
        $this->breadcrumbs = [
            [
                // 'text' => 'Surat Masuk',
                'text' => 'Disposisi',
                'route' => route('admin.surat.masuk.index')
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
        $pengajuan = SuratMasuk::all();  
        return Inertia::render('Admin/Surat/SuratMasuk/Index', [
            'breadcrumbs' => $this->breadcrumbs,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function sertifikasi(SuratMasuk $pengajuan)
    {
        $this->breadcrumbs[] = [
            'text' => 'Sertifikat TTD Surat',
            'route' => route('sertifikasi', [$pengajuan->slug])
        ];

        return Inertia::render('Admin/Surat/SuratMasuk/Sertifikat', [
            'breadcrumbs' => $this->breadcrumbs,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function create()
    {
        $this->breadcrumbs[] = [
            'text' => 'Buat Pengajuan Surat',
            'route' => route('admin.surat.masuk.create')
        ];

        return Inertia::render('Admin/Surat/SuratMasuk/Create', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $validated['user_id'] = Auth::user()->id;
        $validated['tanggal_surat'] = Carbon::now()->format('Y-m-d');
        $validated['roles'] = Auth::user()->jabatan_id;

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filePath = $file->store('pengajuan_surat', 'public');
            $validated['file_surat'] = $filePath;
        }
        
        DB::beginTransaction();
        try {
            SuratMasuk::create($validated);
            DB::commit();
            return redirect()->route('admin.surat.masuk.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan surat berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function edit(SuratMasuk $pengajuan)
    {
        $this->breadcrumbs[] = [
            'text' => 'Edit Surat Masuk',
            'route' => route('admin.surat.masuk.edit', [$pengajuan->slug])
        ];

        return Inertia::render('Admin/Surat/SuratMasuk/Edit', [
            'breadcrumbs' => $this->breadcrumbs,
            'pengajuan' => $pengajuan,
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
            return redirect()->route('admin.surat.masuk.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan surat berhasil diperbarui.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function tanggapi(Request $request, SuratMasuk $pengajuan)
    {
        DB::beginTransaction();
        try {
            $pengajuan->update([
                'status' => '1',
                'posisi_surat' => $request->posisi_surat,
                'catatan_kasi_tuud' => $request->catatan_kasi_tuud
            ]);

            DB::commit();
            return redirect()->route('admin.surat.masuk.index')->with('alertState', 'success')->with('alertMessage', 'Status surat berhasil diajukan.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }

    public function persetujuan(Request $request, SuratMasuk $pengajuan)
    {
        DB::beginTransaction();
        try {
            $pengajuan->update([
                'status' => '2',
                'catatan_ka' => $request->catatan_ka,
                'asal_surat' => $request->asal_surat,
                'rencana_aksi' => $request->aksi
            ]);

            DB::commit();
            return redirect()->route('admin.surat.masuk.index')->with('alertState', 'success')->with('alertMessage', 'Surat berhasil diterima.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', 'Terjadi Kesalahan: ' . $e->getMessage());
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
            return redirect()->route('admin.surat.masuk.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan Surat berhasil dihapus.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function table(Request $request)
    {
        $query = SuratMasuk::where('kategori_surat', 'Masuk')
            ->orderBy('created_at', 'DESC')
            ->filter($request->all());
    
            if (auth()->user()->jabatan_id == 3) {
                $query->where('status', '1')->where('posisi_surat', 'Kepala');
            } elseif (auth()->user()->jabatan_id == 4) {
                $query->where('status', '1')->where('posisi_surat', 'Waka');
            } elseif (auth()->user()->jabatan_id == 16) {
                $query->whereIn('status', ['0']);
            } elseif (auth()->user()->jabatan_id == 2) {
                $query->whereIn('status', ['0', '1']);
            } else {
                $query->where('status', '0');
            }
            
        return response()->json($query->paginateFilter());
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
