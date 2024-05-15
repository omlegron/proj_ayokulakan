<?php

namespace App\Http\Controllers\API\MobilPulsa;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiKurir;

class MobilPulsaController extends Controller
{
    public function callback(Request $request)
    {
        try{
          $notif = $request;
          	$file = fopen("testMobilPulsa.txt","w");
        	fwrite($file,json_encode($request->all()));
        	fclose($file);
        	if(isset($notif->data->tr_id)){
        		$recordTrans = TransaksiAmpase::where('order_id',$notif->data->tr_id)->first();
		          if($recordTrans){
		            $recordTrans->status = $notif->data->message;
		            $recordTrans->status_code = $notif->data->rc;
		            $recordTrans->ppob_sn = isset($notif->data->sn) ? $notif->data->sn : null;
		            $recordTrans->ppob_pin = isset($notif->data->pin) ? $notif->data->pin : null;
		          }
        	}
          // return;
        } catch (Exception $e) {
            $file = fopen("testErrorMobilPulsa.txt","w");
            fwrite($file,$e->getMessage());
            fclose($file);
        }
    }
}
