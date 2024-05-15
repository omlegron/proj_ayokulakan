<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Darmawisata\Hotel;
use App\Models\Master\DarmaHotelNegara;
use App\Models\Master\DarmaHotelKota;
use App\Models\Master\DarmaPelniOrigin;
use App\Models\Master\DarmaBusList;
use App\Models\Master\DarmaTourCategorie;
use App\Models\Master\DarmaTourType;
use App\Models\Master\DarmaTourProvince;
use App\Models\Master\DarmaTravelList;
use App\Models\Master\DarmaTravelRoute;
use GuzzleHttp\Client;
use App\Helpers\Darmawisata\Tour;
use App\Helpers\Darmawisata\Bus;
use App\Helpers\Darmawisata\Travel;
use App\Helpers\Darmawisata\Balance;

use App\Helpers\HelpersPPOB;
class darmaWilayahHotel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:darmaWilayahHotel  {--queue=}';

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
        $this->hotel = new Hotel();
        $this->tour = new Tour();
        $this->bus = new Bus();
        $this->travel = new Travel();
        $this->balance = new Balance();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $apiUrl = Config('app.url');
        
        dump('balanceMobilPulsa',HelpersPPOB::checkBalance());
        
        // dump('balanceDarma',$this->balance->getBalance());
        
        // $countries = $this->hotel->getAccessTokenTwo();
        // dd($countries);
        // $city = $this->hotel->getCity();
        // dump($city);
        $result = $this->hotel->getAllCountryAllCity();
        // dump($result);
        if($result){
            if(($result->countries) && (count($result->countries) > 0)){
                DarmaHotelNegara::truncate();
                DarmaHotelKota::truncate();
                foreach ($result->countries as $k => $value) {
                    $record = DarmaHotelNegara::create([
                        'code' => $value->ID,
                        'name' => $value->Name
                    ]);

                    if(($value->cities) && (count($value->cities) > 0)){
                        foreach ($value->cities as $k1 => $value1) {
                            DarmaHotelKota::create([
                                'id_negara' => $record->id,
                                'code' => $value1->ID,
                                'name' => $value1->Name
                            ]);
                        }
                    }
                }
            }
        }

        $resultPelni = guzzleGet(request(),'/api/darmawisata/ship/route')->data;
        dump('resultPelni',$resultPelni);
        if($resultPelni->status == 'SUCCESS'){
            DarmaPelniOrigin::truncate();
            foreach ($resultPelni->origins as $value) {
                DarmaPelniOrigin::create([
                    'originPort' => $value->originPort,
                    'originName' => $value->originName
                ]);
            }
        }

        // $resultBusList = guzzleGet(request(),'/api/darmawisata/bus')->data;
        $resultBusList = $this->bus->getBusList();
        if($resultBusList->status == 'SUCCESS'){
            DarmaBusList::truncate();
            foreach ($resultBusList->busses as $value) {
                DarmaBusList::create([
                    'name' => $value->name,
                ]);
            }
        }

        // dump($this->tour->getTourCategories());
        // dump($this->tour->getTourType());
        // dd($this->tour->getTourProvince());
        $resultCategorie = guzzleGet(request(),'/api/darmawisata/tour/categorie')->data;
        // dd($resultCategorie);
        if($resultCategorie->status == 'SUCCESS'){
            DarmaTourCategorie::truncate();
            foreach ($resultCategorie->Categories as $value) {
                DarmaTourCategorie::create([
                    'refID' => $value->ID,
                    'Category' => $value->Category
                ]);
            }
        }

        $resultType = guzzleGet(request(),'/api/darmawisata/tour/type')->data;
        // dump($resultType);
        if($resultType->status == 'SUCCESS'){
            DarmaTourType::truncate();
            foreach ($resultType->Types as $value) {
                DarmaTourType::create([
                    'refID' => $value->ID,
                    'Type' => $value->Type,
                ]);
            }
        }

        $resultProvince = guzzleGet(request(),'/api/darmawisata/tour/province')->data;
        // dump($resultProvince);
        if($resultProvince->status == 'SUCCESS'){
            DarmaTourProvince::truncate();
            foreach ($resultProvince->Provinces as $value) {
                DarmaTourProvince::create([
                    'refID' => $value->ID,
                    'Province' => $value->Province,
                ]);
            }
        }

        // TRAVEL LIST
        $travelList = $this->travel->getTravelList();
        if($travelList->status == 'SUCCESS'){
            if(($travelList->shuttles != null) && (count($travelList->shuttles) > 0)){
                DarmaTravelList::truncate();
                DarmaTravelRoute::truncate();
                foreach ($travelList->shuttles as $k => $value) {
                    $saveTList = DarmaTravelList::create([
                        'name' => $value->name,
                        'listID' => $value->id,
                    ]);

                    request()['shuttleID'] = $value->id;
                    $travelRoute = $this->travel->getTravelRoute(request());
                    if($travelRoute->status == 'SUCCESS'){
                        if(($travelRoute->routes != null) && (count($travelRoute->routes) > 0)){
                            foreach ($travelRoute->routes as $k1 => $value1) {
                                DarmaTravelRoute::create([
                                    'origin' => $value1->origin,
                                    'destination' => $value1->destination,
                                    'originCity' => $value1->originCity,
                                    'destinationCity' => $value1->destinationCity,
                                    'directionID' => $value1->directionID,
                                ]);
                            }
                        }
                    }
                }
            }
        }


    }
}
