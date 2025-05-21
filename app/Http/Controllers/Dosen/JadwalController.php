<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $title = 'Jadwal Mengajar Dosen';
        return view('dosen.jadwal', compact('title'));
    }
}
