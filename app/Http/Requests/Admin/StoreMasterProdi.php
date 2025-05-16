<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreMasterProdi extends FormRequest
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

        $id = $id ?? $this->route('master_prodi');

        return [
            // 'kode_prodi' => 'required|max:8|regex:/^[A-Z0-9]+$/|unique:prodis,kode_prodi',
            'kode_prodi' => ['required','max:8','regex:/^[A-Za-z0-9]+$/',Rule::unique('prodis', 'kode_prodi')->ignore($id)],
            'jenjang' => 'required',
            'nama_prodi' => ['required','max:40',Rule::unique('prodis', 'nama_prodi')->ignore($id),],
            // 'nama_prodi' => 'required|max:40|unique:prodis,nama_prodi',
        ];
    }

    public function messages(){
        return [
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
