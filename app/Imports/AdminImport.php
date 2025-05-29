<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;

class AdminImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Admin([
            'nama' => $row[1],
            'jenis_kelamin' => $row[2],
            'agama' => $row[3],
            'tempat_lahir' => $row[4],
            'tgl_lahir' => $row[5],
            'email' => [6],
            'no_telp' => [7],
            'alamat' => [8],
        ]);
    }
}
