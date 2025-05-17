<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreMasterMahasiswa extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($id = null): array
    {

        $id = $id ?? $this->route('master_mahasiswa');

        return [
            'nim' => ['required', 'max:10', Rule::unique('mahasiswas', 'nim')->ignore($id),],
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required|max:100',
            'tgl_lahir' => 'required|before:today',
            'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
            'email' => ['required','email','max:100',Rule::unique('mahasiswas', 'email')->ignore($id),],
            'alamat' => 'required|max:200',
            'prodi_id' => 'required',
            'tahun_masuk' => 'required|max:4|regex:/^[0-9]+$/',
            'semester' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // opsional: validasi foto
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'nim.required' => 'Nip tidak boleh kosong',
            'nim.max' => 'Nip Maksimal 18 Karakter',
            'nim.unique' => 'Nip sudah terdaftar',

            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama maksimal 100 karakter',

            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih',
            'agama.required' => 'Agama harus dipilih',

            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tempat_lahir.max' => 'Tempat Lahir maksimal 100 karakter',

            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'tgl_lahir.before' => 'Tanggal Lahir harus sebelum hari ini',

            'no_telp.required' => 'Nomor Telepon wajib diisi',
            'no_telp.max' => 'Nomor Telepon maksimal 20 karakter',
            'no_telp.regex' => 'Nomor Telepon hanya boleh berisi angka',

            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah digunakan',

            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.max' => 'Alamat maksimal 200 karakter',

            'prodi_id.required' => 'Program Studi wajib dipilih',

            'semester.required' => 'Semester wajib dipilih',

            'tahun_masuk.required' => 'Tahun Akhir tidak boleh kosong.',
            'tahun_masuk.max' => 'Tahun Akhir maksimal 4 angka.',
            'tahun_masuk.regex' => 'Tahun Akhir hanya boleh berupa angka.',

            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB',

            'provinsi_id.required' => 'Provinsi wajib dipilih',
            'kota_id.required' => 'Kota wajib dipilih',
            'kecamatan_id.required' => 'Kecamatan wajib dipilih',
            'kelurahan_id.required' => 'Kelurahan wajib dipilih',
        ];
    }
}
