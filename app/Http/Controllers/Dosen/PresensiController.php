<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $title = 'Data Presensi Dosen';
        return view('dosen.presensi', compact('title'));
    }

    public function create()
    {

    }

    public function show()
    {

    }
}
