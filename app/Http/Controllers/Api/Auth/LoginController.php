<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'role' => 'required|in:dosen,mahasiswa',
        ]);

        $role = $request->role;
        $password = $request->password;

        // Ambil user berdasarkan relasi dari dosens atau mahasiswas
        if ($role === 'dosen' && $request->filled('email')) {
            $user = User::whereHas('dosen', function ($q) use ($request) {
                $q->where('email', $request->email);
            })->with('dosen')->first();
        } elseif ($role === 'mahasiswa' && $request->filled('nim')) {
            $user = User::whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('nim', $request->nim);
            })->with(['mahasiswa.prodi'])->first();
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau NIM tidak valid',
            ], 422);
        }

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login gagal. Password salah atau akun tidak ditemukan.',
            ], 401);
        }

        // Cek verifikasi mahasiswa (jika diperlukan)
        if ($role === 'mahasiswa' && $user->mahasiswa->email_verified_at === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun anda belum aktif. Silahkan aktivasi terlebih dahulu.',
            ], 403);
        }

        $token = auth('api')->login($user);
        $originalTTL = auth('api')->factory()->getTTL();
        // Set TTL melalui factory
        auth('api')->factory()->setTTL(60 * 24 * 14);
        $refreshToken = JWTAuth::customClaims(['type' => 'refresh'])->fromUser($user);

        // Reset TTL ke original
        auth('api')->factory()->setTTL($originalTTL);

        // Ambil data profil berdasarkan role
        $data = ['user_id' => $user->id];

        if ($role === 'dosen') {
            $dosen = $user->dosen;
            $data += [
                'dosen_id' => $dosen->id ?? null,
                'nama' => $dosen->nama ?? null,
                'email' => $dosen->email ?? null,
                'nip' => $dosen->nip ?? null,
                'foto' => $dosen->foto ?? null,
            ];
        } else {
            $mahasiswa = $user->mahasiswa;
            $data += [
                'mahasiswa_id' => $mahasiswa->id ?? null,
                'nama' => $mahasiswa->nama ?? null,
                'nim' => $mahasiswa->nim ?? null,
                'email' => $mahasiswa->email ?? null,
                'semester' => $mahasiswa->semester ?? null,
                'prodi_id' => $mahasiswa->prodi_id ?? null,
                'nama_prodi' => $mahasiswa->prodi->nama_prodi ?? null,
                'foto' => $mahasiswa->foto ?? null,
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'data' => $data,
        ]);
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->bearerToken();

        try {
            $payload = JWTAuth::setToken($refreshToken)->getPayload();

            if ($payload->get('type') !== 'refresh') {
                return response()->json(['error' => 'Invalid token type'], 401);
            }

            $user = JWTAuth::setToken($refreshToken)->toUser();
            $newAccessToken = JWTAuth::fromUser($user);

            return response()->json([
                'token' => $newAccessToken,
                'token_type' => 'Bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Refresh token expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token error'], 401);
        }
    }
}
