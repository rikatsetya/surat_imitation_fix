<?php

namespace App\Http\Controllers;

use App\Models\InboxModel;
use App\Models\SuratModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InboxModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function outbox()
    {
        $breadcrumb = (object) [
            'title' => 'Mailbox',
            'list' => ['Home']
        ];
        $page = (object) [
            'title' => 'Homepage'
        ];
        $activeMenu = 'home';
        $activeSubMenu = 'outbox';
        return view('home.outbox', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu
        ]);
    }

    public function outboxlist(Request $request)
    {
        $user = Auth::user();
        $inbox = InboxModel::select(
            'name',
            'sender',
            'm_inbox.surat_id',
            'receiver',
            'kepada',
            'pengirim',
            'perihal',
            'lampiran',
            'm_inbox.created_at'
        )
            ->join('m_surat', 'm_inbox.surat_id', '=', 'm_surat.surat_id')
            ->join('m_user', 'receiver', '=', 'm_user.user_id')
            ->where('sender', $user->user_id)
            ->get();

        return DataTables::of($inbox)
            ->addIndexColumn()
            ->addColumn('aksi', function ($inbox) {
                $btn = '<a href="' . url('/memo/' . $inbox->surat_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $inbox = InboxModel::select(
            'inbox_id',
            'name',
            'sender',
            'm_inbox.surat_id',
            'receiver',
            'kepada',
            'pengirim',
            'perihal',
            'lampiran',
            'm_inbox.created_at'
        )
            ->join('m_surat', 'm_inbox.surat_id', '=', 'm_surat.surat_id')
            ->join('m_user', 'sender', '=', 'm_user.user_id')
            ->where('receiver', $user->user_id)
            ->get();

        return DataTables::of($inbox)
            ->addIndexColumn()
            ->addColumn('aksi', function ($inbox) {
                $btn = '<a href="' . url('/surat/' . $inbox->inbox_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/inbox/' . $inbox->inbox_id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function forward(String $id)
    {
        $user = UserModel::all();
        $surat = SuratModel::find($id);
        return view('mailing.forwarding', ['user' => $user, 'surat' => $surat]);
    }

    public function forwarding(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $userid = auth()->user()->user_id;
            InboxModel::create([
                'sender' => $userid,
                'surat_id' => $id,
                'receiver' => $request->user_id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Memo telah diteruskan'
            ]);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $userid = auth()->user()->id;
        $inbox = InboxModel::find($id);
        $surat = SuratModel::find($inbox->surat_id);
        $user = UserModel::all();
        $activeMenu = 'home';
        $activeSubMenu = 'inbox';
        $breadcrumb = (object) [
            'title' => 'Email',
            'list' => ['Detail']
        ];
        $page = (object) [
            'title' => 'Email'
        ];
        return view('home.inbox', ['userid' => $userid, 'surat' => $surat, 'user' => $user, 'activeMenu' => $activeMenu, 'activeSubMenu' => $activeSubMenu, 'breadcrumb' => $breadcrumb, 'page' => $page, 'inbox' => $inbox]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InboxModel $inboxModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InboxModel $inboxModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirm(string $id)
    {
        $inbox = InboxModel::find($id);
        $surat = SuratModel::find($inbox->surat_id);
        $user = UserModel::all();
        return view('home.confirm_delete', ['inbox' => $inbox, 'user' => $user, 'surat' => $surat]);
    }

    public function delete(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $inbox = InboxModel::find($id);
            if ($inbox) {
                $inbox->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                    'redirect' => url('/')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
