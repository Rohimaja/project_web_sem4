<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreAdminRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nip' => 'required|max:20|unique:dosens,nip,',
            'nim' => 'required|max:10|unique:mahasiswas,nim',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required|max:100',
            'tgl_lahir' => 'required|before:today',
            'no_telp' => 'required|max:20|regex:/^[0-9]+$/',
            'email' => ['required','email','max:100',Rule::unique('admins', 'email'),Rule::unique('dosens', 'email'),Rule::unique('mahasiswas', 'email')],
            'alamat' => 'required|max:200',
            'prodi_id' => 'required',
            'tahun_masuk' => 'required|max:4|regex:/^[0-9]+$/',
            'semester' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // opsional: validasi foto
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',

            'nama_matkul' => 'required|max:100',
            'tahun_ajaran_id' => 'required',
            'durasi_matkul' => 'required|integer|min:1|max:10',

            'tahun_awal' => 'required|max:4|regex:/^[0-9]+$/',
            'tahun_akhir' => 'required|max:4|regex:/^[0-9]+$/',
            'keterangan' => 'required',

            'kode_prodi' => 'required|max:8|regex:/^[A-Z0-9]+$/|unique:prodis,kode_prodi',
            'jenjang' => 'required',
            'nama_prodi' => 'required|max:40|unique:prodis,nama_prodi',
        ];
    }

    public function messages(){
        return [
            'nip.required' => 'Nip tidak boleh kosong',
            'nip.max' => 'Nip Maksimal 18 Karakter',
            'nip.unique' => 'Nip sudah terdaftar',

            'nim.required' => 'Nim tidak boleh kosong',
            'nim.max' => 'Nim Maksimal 10 Karakter',
            'nim.unique' => 'Nim sudah terdaftar',

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


            'nama_matkul.required' => 'Mata Kuliah tidak boleh kosong.',
            'nama_matkul.max' => 'Nama Mata Kuliah maksimal 100 karakter.',

            'tahun_ajaran_id.required' => 'Tahun Ajaran harus dipilih.',

            'durasi_matkul.required' => 'Jumlah SKS tidak boleh kosong.',
            'durasi_matkul.integer' => 'Jumlah SKS harus berupa angka.',
            'durasi_matkul.min' => 'Minimal 1 SKS.',
            'durasi_matkul.max' => 'Maksimal 10 SKS.',


            'tahun_awal.required' => 'Tahun Awal tidak boleh kosong.',
            'tahun_awal.max' => 'Tahun Awal maksimal 4 angka.',
            'tahun_awal.regex' => 'Tahun Awal hanya boleh berupa angka.',

            'tahun_akhir.required' => 'Tahun Akhir tidak boleh kosong.',
            'tahun_akhir.max' => 'Tahun Akhir maksimal 4 angka.',
            'tahun_akhir.regex' => 'Tahun Akhir hanya boleh berupa angka.',

            'keterangan.required' => 'Pilih Keterangan terlebih dahulu',

            'kode_prodi.required' => 'Kode Prodi tidak boleh kosong',
            'kode_prodi.max' => 'Kode Prodi hanya maksimal 8 karakter',
            'kode_prodi.unique' => 'Kode Prodi sudah terdaftar',

            'jenjang.required' => 'Silahkan pilih jenjang pendidikan',

            'nama_prodi.required' => 'Nama Program Studi tidak boleh kosong.',
            'nama_prodi.max' => 'Nama Program Studi maksimal 40 karakter.',
            'nama_prodi.unique' => 'Nama Program Studi sudah terdaftar.',
        ];
    }
}
