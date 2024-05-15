<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Master\PPOBPulsa;
use App\Models\Master\PPOBPdam;
use App\Models\Master\TicketingAirport;
use App\Models\Master\TicketingStatsiunKereta;
use App\Helpers\HelpersTiketPesawat;
use App\Helpers\HelpersTiketKapal;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Master\TicketingPelni;

class getPriceListPPOB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ppob:pricelist {--queue=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Synchronize mulai');

        $username   = "0895422649167";
        $apiKey   = "8585cfe52cfc0dff";
        $signature  = md5($username.$apiKey.'pl');

        $json = '{
                  "commands" : "pricelist",
                  "username" : "0895422649167",
                  "sign"     : "16bdad92c280b7ee9b0febabb630523b",
                  "status"   : "active"
                }';

        $url = "https://testprepaid.mobilepulsa.net/v1/legacy/index";

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
        $ampas = json_decode($data);
        $record = [];
        if(isset($ampas->data)){
            foreach ($ampas->data as $value) {
                $record['pulsa_code'] = $value->pulsa_code;
                $record['pulsa_op'] = $value->pulsa_op;
                $record['pulsa_nominal'] = $value->pulsa_nominal;
                $record['pulsa_price'] = $value->pulsa_price;
                $record['pulsa_type'] = $value->pulsa_type;
                $record['status'] = $value->status;
                $record['masaaktif'] = $value->masaaktif;
                $save = PPOBPulsa::where('pulsa_code',$value->pulsa_code)->first();
                if($save){
                  $save->fill($record);
                  $save->save();
                }else{
                  $save = new PPOBPulsa;
                  $save->fill($record);
                  $save->save();
                }
            }
        }

        // PPOB PDAM
        $jsonPD ='{
            "commands" : "pricelist-pasca",
            "username" : "0895422649167",
            "sign"     : "16bdad92c280b7ee9b0febabb630523b",
            "status"   : "all"
        }';
        $urlPD = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check/pdam";
        
        $chPD  = curl_init();
        curl_setopt($chPD, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chPD, CURLOPT_URL, $urlPD);
        curl_setopt($chPD, CURLOPT_POSTFIELDS, $jsonPD);
        curl_setopt($chPD, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chPD, CURLOPT_RETURNTRANSFER, true);

        $dataPD = curl_exec($chPD);
        curl_close($chPD);
        $ampasPD = json_decode($dataPD);
        $recordPD = [];
        if(isset($ampasPD->data)){
            foreach ($ampasPD->data->pasca as $value) {
                $recordPD['code'] = $value->code;
                $recordPD['name'] = $value->name;
                $recordPD['fee'] = $value->fee;
                $recordPD['komisi'] = $value->komisi;
                $recordPD['type'] = $value->type;
                $recordPD['status'] = $value->status;
                $recordPD['province'] = $value->province;
                $savePD = PPOBPdam::where('code',$value->code)->first();
                if($savePD){
                  $savePD->fill($recordPD);
                  $savePD->save();
                }else{
                  $savePD = new PPOBPdam;
                  $savePD->fill($recordPD);
                  $savePD->save();
                }
            }
        }

        // PPOB DESTINATION KRETA
        $jsonDK ='{
            "commands" : "station-list",
            "sign"     : "e84b6ec531ad186194446d4f818667c4"
        }';
        $urlDK = "https://testpostpaid.mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        $ampasDK = json_decode($dataDK);
        $recordDK = [];
        if($ampasDK->data){
            foreach ($ampasDK->data->station as $value) {
              if(isset($value->group)){
                foreach ($value->group as $k => $v) {
                  $recordDK['group_code'] = isset($value->groupCode) ? $value->groupCode : '';
                  $recordDK['code'] = $v->code;
                  $recordDK['name'] = $v->name;
                  $saveDK = TicketingStatsiunKereta::where('code',$recordDK['code'])->first();
                  if($saveDK){
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }else{
                    $saveDK = new TicketingStatsiunKereta;
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }
                }
              }else{
                  $recordDK['group_code'] = isset($value->groupCode) ? $value->groupCode : '';
                  $recordDK['code'] = $value->code;
                  $recordDK['name'] = $value->name;
                  $saveDK = TicketingStatsiunKereta::where('code',$recordDK['code'])->first();
                  if($saveDK){
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }else{
                    $saveDK = new TicketingStatsiunKereta;
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }
              }
                
            }
        } 

      $this->info('Synchronize selesai');
    }
}
