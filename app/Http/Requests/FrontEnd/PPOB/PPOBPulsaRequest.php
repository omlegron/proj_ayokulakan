<?php

namespace App\Http\Requests\FrontEnd\PPOB;

use App\Http\Requests\Request;

class PPOBPulsaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      if($this->get('tpe')){
        return [
          'type' => 'required',
          'ppob_pelanggan' => 'required',

        ];
      }elseif(!is_null($this->get('type'))){

        if($this->get('type') == 'pulsa'){
          return [
            'ppob_pelanggan' => 'required|min:10|max:13',
            'id_barang' => 'required',
          ];
        }else if($this->get('type') == 'data'){
          return [
            'ppob_pelanggan' => 'required|min:10|max:13',
            'id_barang' => 'required',
          ];
        }else if($this->get('types') == 'PDAM'){
          return [
            'ppob_pelanggan' => 'required',
            'type' => 'required',
            'types' => 'required',
          ];
        }else if($this->get('types') == 'telepon'){
          return [
            'ppob_pelanggan' => 'required',
            'type' => 'required',
            'types' => 'required',
          ];
        }else if($this->get('types') == 'internet'){
          return [
            'ppob_pelanggan' => 'required',
            
            'types' => 'required',
          ];
        }else if($this->get('types') == 'TV'){
          return [
            'ppob_pelanggan' => 'required',
            
            'types' => 'required',
          ];
        }else if($this->get('type') == 'game'){
          return [
            // 'ppob_pelanggan' => 'required|min:12|max:13',
            'id_barang' => 'required',
          ];
          if(!is_null($this->get('ppob_pelanggan'))){
            return [
              'ppob_pelanggan' => 'required',
              'id_barang' => 'required',
            ];
          }
        }else if($this->get('type') == 'BPJS'){
          return [
              'ppob_pelanggan' => 'required',
              'month' => 'required',
            ];
          if(!is_null($this->get('nominal'))){
            return [
              'nominal' => 'required'
            ];
          }
        }else if($this->get('type') == 'pln'){
            return [
              'hp' => 'required'
            ];
            if(!is_null($this->get('ppob_pelanggan'))){
              return [
                'ppob_pelanggan' => 'required',
              ];
            }

            if(!is_null($this->get('id_barang'))){
              return [
                'id_barang' => 'required',
              ];
            }
        }else if($this->get('type') == 'PLNPOSTPAID'){
            return [
              'ppob_pelanggan' => 'required'
            ];
        }else if(explode('.',$this->get('type'))[0] == 'ESAMSAT'){
            return [
              'ppob_pelanggan' => 'required',
              'type' => 'required',
            ];
        }
      }else{
        return [
          'type' => 'required',
          'ppob_pelanggan' => 'required',

        ];
      }
    }
   
    public function messages()
    {
      return [
        'required' => 'Kolom tidak boleh kosong',
        'min' => 'Isian kolom min :min angka',
        'max' => 'Isian kolom max :max angka',
      ];
    }
}
