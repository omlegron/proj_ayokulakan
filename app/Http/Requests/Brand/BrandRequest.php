<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_lapak' => 'required:unique:trans_lapak_lapak,nama_lapak,'.$this->get('id'),
            'deskripsi_lapak' => 'required',
            'id_negara' => 'required',
            'id_provinsi' => 'required',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'phone' => 'required',
            'kode_pos' => 'required',
            'alamat_lapak' => 'required',
          ];
    }
    public function messages()
    {
      return [
        'nama_lapak.required' => 'Isian Nama Brand Wajib Disi',
        'deskripsi_lapak.required' => 'Isian Deskripsi Brand Wajib Disi',
        'alamat_lapak.required' => 'Isian Alamat Brand Wajib Disi',
      ];
    }
}
