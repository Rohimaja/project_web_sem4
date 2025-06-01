<?php

namespace App\Console\Commands;

use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\Presensi;
use App\Services\FcmV1Service;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyMahasiswaPresensi extends Command
{
    protected $signature = 'presensi:notify-mahasiswa';
    protected $description = 'Kirim notifikasi ke mahasiswa untuk presensi < 1 jam lagi';

    public function handle()
    {
        $now = Carbon::now('Asia/Jakarta');

        $presensis = Presensi::whereDate('tgl_presensi', $now->toDateString())
            ->whereTime('jam_awal', '>', $now->format('H:i:s'))
            ->whereTime('jam_awal', '<=', $now->copy()->addHour()->format('H:i:s'))
            ->with('detailPresensi.mahasiswa.user')
            ->get();

        $fcmService = new FcmV1Service();

        $waktu = Carbon::now()->locale('id')->timezone('Asia/Jakarta');
        $tanggal = $waktu->translatedFormat('d F Y');
        $jam = $waktu->format('H.i');

        foreach ($presensis as $presensi) {
            foreach ($presensi->detailPresensi as $detail) {
                $user = $detail->mahasiswa->user ?? null;
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Presensi akan dimulai',
                    'message' => 'Presensi Anda akan dimulai pukul ' . Carbon::parse($presensi->jam_awal)->format('H:i'),
                    'type' => 'pengumuman',
                    'nama_user' => $user->name,
                    'tanggal' => $tanggal,
                    'jam' => $jam,
                    'mata_kuliah' => $presensi->matkul->nama_matkul ?? '-',
                ]);

                if ($user) {
                    $tokens = FcmToken::where('user_id', $user->id)->pluck('token');
                    foreach ($tokens as $token) {
                        $fcmService->send(
                            $token,
                            'Presensi akan dimulai',
                            'Presensi Anda akan dimulai pukul ' . Carbon::parse($presensi->jam_awal)->format('H:i')
                        );
                    }
                }
            }
        }

        $this->info('Notifikasi berhasil dikirim.');
    }
}
