<?php

use Illuminate\Database\Seeder;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Master\WilayahKelurahan;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahNegara;
use GuzzleHttp\Client;
class wilayahIndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function options($data=[]){
        $apiKey = Config('services.rajaongkir.key');
        if(count($data) > 0){
            return [
                'data' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'key' => $apiKey,
                ],
                'verify' => false
            ];
        }else{
            return [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'key' => $apiKey,
                ],
                'verify' => false
            ];
        }
    }

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ref_wilayah_kelurahan')->truncate();
        DB::table('ref_wilayah_kecamatan')->truncate();
        DB::table('ref_wilayah_kota')->truncate();
        DB::table('ref_wilayah_provinsi')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $negara = WilayahNegara::where('negara','Indonesia')->first();
        $client = new Client();
        $apiUrl = Config('services.rajaongkir.url');
        $prov = $client->get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->getBody();
        $prov = json_decode($prov);
        foreach ($prov->provinsi as $value) {
            $dataProv = WilayahProvinsi::create([
                'id_negara' => $negara->id,
                'provinsi' => $value->nama
            ]);
            $kota = $client->get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='.$value->id,$this->options())->getBody();
            $kota = \json_decode($kota);
            foreach ($kota->kota_kabupaten as $kab) {
                $dataKota = WilayahKota::create([
                    'id_negara' => $negara->id,
                    'id_provinsi' => $dataProv->id,
                    'kota' => $kab->nama
                ]);
                $kec = $client->get('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='.$kab->id,$this->options())->getBody();
                $kec = json_decode($kec);
                foreach ($kec->kecamatan as $kecamatan) {
                    $dataKec = WilayahKecamatan::create([
                        'id_negara' => $negara->id,
                        'id_provinsi' => $dataProv->id,
                        'id_kota'   => $dataKota->id,
                        'kecamatan' => $kecamatan->nama
                    ]);
                    $kel = $client->get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan='.$kecamatan->id,$this->options())->getBody();
                    $kel = json_decode($kel);
                    foreach ($kel->kelurahan as $kelurahan) {
                        $datakel = WilayahKelurahan::create([
                            'id_negara' => $negara->id,
                            'id_provinsi' => $kab->id_provinsi,
                            'id_kota'   =>  $dataKota->id,
                            'id_kecamatan' => $dataKec->id,
                            'kelurahan' => $kelurahan->nama
                        ]);
                    }
                }

            }
        }
    }
}
