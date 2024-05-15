<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
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
            'id_trans_lapak' => 'required',
            'id_kategori' => 'required',
            'nama_barang' => 'required|unique:trans_lapak_barang,nama_barang,'.$this->get('id'),
            'disc_barang' => 'nullable|integer',
            'harga_normal' => 'required',
            'deskripsi_barang' => 'required',
            'satuan_barang' => 'required',
            'berat_barang' => 'required|min:0.1',
            'stock_barang' => 'required|min:1',
            'kondisi_barang' => 'required',
            'harga_barang' => 'required|min:1',
        ];
    }
}
