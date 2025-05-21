<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapDosenController extends Controller
{
    public function index(){
        $title = 'Rekap Absensi Dosen';
        return view('dosen.rekap_presensi.rekap_dosen', compact('title'));
    }
}
