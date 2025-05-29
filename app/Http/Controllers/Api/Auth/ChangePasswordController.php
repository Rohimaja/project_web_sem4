<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'nim' => 'nullable|string',
            'nip' => 'nullable|string',
            'new_password' => 'required|min:8'
        ]);

        $newPassword = Hash::make($request->new_password);
        $email = $request->email;
        $nim = $request->nim;
        $nip = $request->nip;

        DB::beginTransaction();
        try {
            // Cek mahasiswa berdasarkan email/nim
            $mahasiswa = DB::table('users')
                ->join('mahasiswas', 'mahasiswas.user_id', '=', 'users.id')
                ->where(function ($q) use ($email, $nim) {
                    if ($email)
                        $q->orWhere('mahasiswas.email', $email);
                    if ($nim)
                        $q->orWhere('users.nim', $nim);
                })
                ->select('users.id')
                ->first();

            if ($mahasiswa) {
                DB::table('users')->where('id', $mahasiswa->id)->update([
                    'password' => $newPassword
                ]);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password berhasil diperbarui untuk mahasiswa.'
                ]);
            }

            // Cek dosen berdasarkan email/nip
            $dosen = DB::table('users')
                ->join('dosens', 'dosens.user_id', '=', 'users.id')
                ->where(function ($q) use ($email, $nip) {
                    if ($email)
                        $q->orWhere('users.email', $email);
                    if ($nip)
                        $q->orWhere('dosens.nip', $nip);
                })
                ->select('users.id')
                ->first();

            if ($dosen) {
                DB::table('users')->where('id', $dosen->id)->update([
                    'password' => $newPassword
                ]);
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password berhasil diperbarui untuk dosen.'
                ]);
            }

            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui password. Pastikan email/NIM/NIP benar.'
            ], 404);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
