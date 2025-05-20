<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{

    public function changePassword(){
        $title = "Ganti Password";
        return view('changePassword', compact('title'));
    }
    /**
     * Update the user's password.
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        // $validated = $request->validateWithBag('updatePassword', [
        //     'current_password' => ['required', 'current_password'],
        //     'password' => ['required', Password::defaults(), 'confirmed'],
        // ]);

        try {
            $request->user()->update([
                'password' => Hash::make($request->validated()['password']),
            ]);

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Password berhasil diperbarui',
            ]);

        } catch (\Exception $e) {

            Log::error('Gagal perbarui password', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);


            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }



        // return back()->with('status', 'password-updated');
    }
}
