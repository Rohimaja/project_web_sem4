<?php

namespace App\Http\Controllers\Api\activity;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function index(Request $request)
    {
        $calendar = KalenderAkademik::select('id', 'judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'status')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => (int) $item->id,
                    'judul' => $item->judul,
                    'deskripsi' => $item->deskripsi,
                    'tanggal_mulai' => $item->tanggal_mulai,
                    'tanggal_selesai' => $item->tanggal_selesai,
                    'status' => (int) $item->status, // Paksa jadi integer
                ];
            });

        return response()->json([
            'status' => 'success',
            'message' => 'Data kalender akademik berhasil ditampilkan',
            'data' => $calendar
        ]);
    }
}
