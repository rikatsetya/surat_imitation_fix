<?php

namespace App\Http\Controllers;

use App\Models\InboxModel;
use App\Models\SuratModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SuratModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Memo',
            'list' => ['Memo', 'list']
        ];
        $page = (object) [
            'title' => 'Memo'
        ];
        $activeMenu = 'memo';
        $activeSubMenu = 'inbox';
        return view('memo.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu
        ]);
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $surat = SuratModel::select(
            'name',
            'surat_id',
            'user_id',
            'kepada',
            'pengirim',
            'perihal',
            'lampiran',
            'm_surat.created_at'
        )
            ->join('m_user', 'm_surat.kepada', '=', 'm_user.user_id')
            ->where('m_surat.pengirim', $user->user_id)
            ->get();

        return DataTables::of($surat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($surat) {
                $btn = '<a href="' . url('/memo/' . $surat->surat_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/memo/' . $surat->surat_id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = UserModel::select('user_id', 'name')->get();
        return view('memo.create')
            ->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi
            $rules = [
                'kepada' => 'required|integer',
                'tembusan' => 'nullable|integer',
                'pengirim' => 'required|integer',
                'pemeriksa' => 'nullable|integer',
                'perihal' => 'required|string',
                'isi_surat' => 'required|string',
                'lampiran' => 'nullable|mimes:pdf,xlsx,png,jpg,jpeg',
            ];

            // Menggunakan Validator untuk memvalidasi input
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal, kembalikan respon JSON dengan pesan error
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Error',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            if ($request->has('lampiran')) {
                $file = $request->file('lampiran');
                $extension = $file->getClientOriginalExtension();

                $filename = time() . '.' . $extension;

                $path = 'asset/lampiran/';
                $file->move($path, $filename);
                $pathname = $path . $filename;

                SuratModel::create([
                    'kepada' => $request->kepada,
                    'tembusan' => $request->tembusan,
                    'pengirim' => $request->pengirim,
                    'pemeriksa' => $request->pemeriksa,
                    'perihal' => $request->perihal,
                    'isi_surat' => $request->isi_surat,
                    'lampiran' => $pathname,
                ]);
            } else {
                SuratModel::create($request->all());
            }
            // Jika validasi berhasil, simpan data user


            // Kembalikan respon JSON berhasil
            return response()->json([
                'status' => true,
                'message' => 'Data surat berhasil disimpan',
            ]);
        }

        // Jika bukan request Ajax, redirect ke halaman utama
        return redirect('/memo');
    }

    public function send(String $id)
    {
        $surat = SuratModel::find($id);
        $kepada = $surat->kepada;
        $user = UserModel::all();

        $inbox = InboxModel::select('sender', 'surat_id', 'receiver')
            ->where('sender', $surat->pengirim)
            ->where('surat_id', $surat->surat_id)
            ->where('receiver', $surat->kepada)
            ->first();
        return view('memo.confirm_send', ['inbox' => $inbox, 'surat' => $surat, 'kepada' => $kepada, 'user' => $user]);
    }

    public function sent(String $id)
    {
        $surat = SuratModel::find($id);
        $kepada = $surat->kepada;
        $user = UserModel::all();

        InboxModel::create([
            'sender' => $surat->pengirim,
            'surat_id' => $surat->surat_id,
            'receiver' => $kepada,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Memo berhasil Dikirim',
        ]);

        return view('memo.detail', ['surat' => $surat, 'kepada' => $kepada, 'user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $userid = auth()->user()->id;
        $surat = SuratModel::find($id);
        $user = UserModel::all();
        $activeMenu = 'memo';
        $activeSubMenu = 'inbox';
        $breadcrumb = (object) [
            'title' => 'Email',
            'list' => ['Detail']
        ];
        $page = (object) [
            'title' => 'Email'
        ];
        return view('memo.detail', ['userid' => $userid, 'surat' => $surat, 'user' => $user, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'breadcrumb' => $breadcrumb, 'page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function forward(String $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratModel $suratModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirm(string $id)
    {
        $surat = SuratModel::find($id);
        $user = UserModel::all();
        return view('memo.confirm_delete', ['surat' => $surat, 'user' => $user]);
    }

    public function delete(Request $request, $id)
    {
        // Cek apakah request dari Ajax
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $surat = SuratModel::find($id);
                if ($surat) {
                    $surat->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus',
                        'redirect' => route('memo.index'),
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                // Menangkap error database (termasuk foreign key constraint error)
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak dapat dihapus karena masih digunakan di data lain.'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak dapat dihapus'
            ]);
        }
    }

    public function export_pdf(String $id)
    {
        $surat = SuratModel::select('surat_id', 'kepada', 'tembusan', 'pengirim', 'pemeriksa', 'perihal', 'isi_surat', 'created_at')
            ->where('surat_id', $id)
            ->first();
        $user = UserModel::all();
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('memo.export_pdf', ['surat' => $surat, 'user' => $user]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url $pdf->render();
        return $pdf->stream($surat->perihal . '.pdf');
    }
}
