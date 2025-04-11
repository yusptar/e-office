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

class DisposisiController extends Controller
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
                // 'text' => 'Disposisi',
                'text' => 'Manajemen Surat',
                'route' => route('admin.surat.disposisi.index')
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
        return Inertia::render('Admin/Surat/Disposisi/Index', [
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function sertifikasi(SuratMasuk $pengajuan)
    {
        $this->breadcrumbs[] = [
            'text' => 'Sertifikat TTD Surat',
            'route' => route('sertifikasi', [$pengajuan->slug])
        ];

        return Inertia::render('Admin/Surat/Disposisi/Sertifikat', [
            'breadcrumbs' => $this->breadcrumbs,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function create()
    {
        $this->breadcrumbs[] = [
            'text' => 'Buat Pengajuan Surat',
            'route' => route('admin.surat.disposisi.create')
        ];

        return Inertia::render('Admin/Surat/Disposisi/Create', [
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
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension(); 
            $timestamp = Carbon::now()->format('Ymd_His'); 
            $newFileName = "{$originalName}_{$timestamp}.{$extension}"; 
            $filePath = $file->storeAs('pengajuan_surat', $newFileName, 'public'); 
    
            $validated['file_surat'] = $filePath;
        }
        
        DB::beginTransaction();
        try {
            SuratMasuk::create($validated);
            DB::commit();
            return redirect()->route('admin.surat.disposisi.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan surat berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function edit(SuratMasuk $pengajuan)
    {
        $this->breadcrumbs[] = [
            'text' => 'Tanda Tangan Elektronik',
            'route' => route('admin.surat.disposisi.edit', [$pengajuan->slug])
        ];

        return Inertia::render('Admin/Surat/Disposisi/Edit', [
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
            return redirect()->route('admin.surat.disposisi.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan surat berhasil diperbarui.');
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
            return redirect()->route('admin.surat.disposisi.index')->with('alertState', 'success')->with('alertMessage', 'Pengajuan Surat berhasil dihapus.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    public function table(Request $request)
    {
        // return response()->json(SuratMasuk::where('kategori_surat', 'Masuk')->where('status', '2')->orderBy('created_at', 'DESC')->filter($request->all())->paginateFilter());
        $query = SuratMasuk::where('kategori_surat', 'Masuk')
            ->orderBy('created_at', 'DESC')
            ->filter($request->all());
    
            if (auth()->user()->jabatan_id == 3) {
                $query->where('status', '2')->where('posisi_surat', 'Kepala');
            } elseif (auth()->user()->jabatan_id == 4) {
                $query->where('status', '2')->where('posisi_surat', 'Waka');
                // KASI TUUD
            } elseif (auth()->user()->jabatan_id == 16) {
                $query->whereIn('status', ['0', '1', '2', '3', '99']);
                // IT
            } elseif (auth()->user()->jabatan_id == 2) {
                $query->whereIn('status', ['0', '1', '2', '3', '99']);
            } else {
                $query->whereIn('status',  ['0', '1', '2', '99'])->where('user_id', Auth::user()->id);
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
