<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapMahasiswaController extends Controller
{
    public function index(){
        $title = 'Rekap Absensi Mahasiswa';
        return view('dosen.rekap_presensi.rekap_dosen', compact('title'));
    }
}
