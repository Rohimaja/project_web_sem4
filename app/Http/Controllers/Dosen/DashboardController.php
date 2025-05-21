<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Prodi;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('dosen.dashboard',compact('title'));

    }
}
