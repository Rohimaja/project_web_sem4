<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {

        $title = 'Jadwal Mengajar Dosen';
        $dosen = Auth::user()->dosen;
        $jadwal = Jadwal::with('prodi','dosen','ruangan','tahunAjaran','matkul')->where('dosen_id', $dosen->id)->get();
        return view('dosen.jadwal', compact('title','jadwal'));
    }
}
