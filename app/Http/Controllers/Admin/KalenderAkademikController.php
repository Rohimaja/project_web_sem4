<?php

namespace App\Http\Controllers\Admin;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        $title = 'Data Kalender Akademik';
        $kalenders = KalenderAkademik::latest()->get();

        return view('admin.master_data.kalender', compact('kalenders', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Kalender Akademik';
        return view('admin.master_data.form-kalender', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ]);

        try {
            KalenderAkademik::create($request->only(['judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai']));

            return redirect()->route('admin.kalender-akademik.index')->with([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan kalender akademik', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()
            ]);
        }
    }

    public function edit(KalenderAkademik $kalender_akademik)
    {
        $title = 'Edit Kalender Akademik';
        return view('admin.master_data.form-kalender', compact('kalender_akademik', 'title'));
    }

    public function update(Request $request, KalenderAkademik $kalender_akademik)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ]);

        try {
            $kalender_akademik->update($request->only(['judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai']));

            return redirect()->route('admin.kalender-akademik.index')->with([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui kalender akademik', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy(KalenderAkademik $kalender_akademik)
    {
        try {
            $kalender_akademik->delete();

            return redirect()->route('admin.kalender-akademik.index')->with([
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kalender akademik', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.kalender-akademik.index')->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ]);
        }
    }
    public function viewCalendar()
    {
        $title = 'Lihat Kalender Akademik';

        // Ambil data kalender akademik untuk ditampilkan di kalender (misal: id, judul, tanggal_mulai, tanggal_selesai)
        $kalenders = KalenderAkademik::all();

        return view('admin.view-kalender', compact('kalenders', 'title'));
    }

}
