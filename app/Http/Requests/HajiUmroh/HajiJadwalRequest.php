<?php

namespace App\Http\Requests\HajiUmroh;

use App\Http\Requests\Request;

class HajiJadwalRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'type_paket' => 'required|max:200',
          'judul' => 'required|max:200',
          'tgl_berangkat' => 'required',
          'tgl_pulang' => 'required',
          'total_hari' => 'required',
          'keterangan' => 'required|max:5000',
          'harga' => 'required',
        ];
    }
}
