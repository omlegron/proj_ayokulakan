<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Airline
{
    /**
     * User ID yang di gunakan untuk koneksi server darmawisata
     *
     * @var String
     */
    private $userID;

    /**
     * Password yang di gunakan untuk koneksi server darmawisata
     *
     * @var String
     */
    private $pass;

    /**
     * URL darmawisata
     *
     * @var String
     */
    private $apiEndPoint;

    /**
     * new Client()
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * Default token
     *
     * @var Date
     */
    private $apiToken;

    /**
     * Method Constructor
     */
    public function __construct()
    {
        $this->client   = new Client();
        $this->apiToken = date('Y-m-d\TH:i:s');
        $this->headers  = Config::$header;
        $this->userID = "T26SHRTMC5";
        $this->pass = "KIF8A6YWJW";
        $this->apiEndPoint = "https://www.darmawisataindonesiah2h.co.id";
        // $this->userID = Config::$userID;
        // $this->pass = Config::$pass;
        // $this->apiEndPoint = Config::$apiEndPoint;
    }

    /**
     * Option API
     *
     * @param array $data
     * @return array
     */
    private function options($data)
    {
        return [
            'body' => $data,
            'headers' => $this->headers,
            'verify' => false
        ];
    }

    /**
     * Parsing data Token
     *
     * @return session
     */
    private function getAccessToken()
    {
        // if (session()->has('accessToken')) {
        //     $token = session('accessToken');
        // } else {
        //     $token = $this->sessionLogin()->accessToken;
        //     session(['accessToken' => $token]);
        // }
        $token = $this->sessionLogin()->accessToken;

        return $token;
    }

    /**
     * Session Login
     *
     * @return \GuzzleHttp\Client
     */
    private function sessionLogin()
    {
        $securityCode = md5($this->apiToken . md5($this->pass));

        $data = json_encode([
            'userID' => $this->userID,
            'securityCode' => $securityCode,
            'token' => $this->apiToken,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Session/Login', $this->options($data))->getBody();
        return json_decode($response);
    }

    public function sessionLoginDua()
    {
        $securityCode = md5($this->apiToken . md5($this->pass));

        $data = json_encode([
            'userID' => $this->userID,
            'securityCode' => $securityCode,
            'token' => $this->apiToken,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Session/Login', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Session Login
     *
     * @return \GuzzleHttp\Client
     */
    public function sessionLogout()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'token' => $this->apiToken,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Session/Logout', $this->options($data))->getBody();
        session()->forget('accessToken');
        return json_decode($response);
    }

    /**
     * Show All Airline
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirLine()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/List', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Airline Nationality
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineNationality()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/Nationality', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Airline Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineRoute($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'airlineID' => $request->airlineID,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/Route', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Airline Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineLowFareRoute()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/LowFareRoute', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Airline Schedules
     *
     * @return \GuzzleHttp\Client
     */
    public function getScheduleAllAirline($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => ($request['accessToken']) ? $request['accessToken'] : $this->getAccessToken(),
            "tripType" => $request['tripType'],
            "origin" => $request['origin'],
            "destination" => $request['destination'],
            "departDate" => $request['departDate'],
            "returnDate" => $request['returnDate'],
            "paxAdult" => $request['paxAdult'],
            "paxChild" => $request['paxChild'],
            "paxInfant" => $request['paxInfant'],
            "promoCode" => ($request['promoCode']) ? $request['promoCode'] : null,
            "airlineAccessCode" => ($request['airlineAccessCode']) ? (int)$request['airlineAccessCode'] : "",
            "cacheType" => "FullLive",
            "isShowEachAirline" => false
        ];
        // return $data;
        $response = $this->client->post($this->apiEndPoint . '/Airline/ScheduleAllAirline', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineSchedule($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "promoCode" => $request->promoCode,
            "airlineAccessCode" => $request->airlineAccessCode
        ];
        // dump($data);
        $response = $this->client->post($this->apiEndPoint . '/Airline/Schedule', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);
        // dump($obj);
        return $obj;
    }

    /**
     * Show All Airline Prices
     *
     * @return \GuzzleHttp\Client
     */
    public function getPriceAllAirline($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => ($request->tripType) ? $request->tripType : "",
            "departDate" => $request->departDate,
            "returnDate" => ($request->returnDate) ? $request->returnDate : "",
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "airlineAccessCode" => $request->airlineAccessCode,
            "journeyDepartReference" => $request->journeyDepartReference,
            "journeyReturnReference" => $request->journeyReturnReference
        ];
        // return $data;
        $response = $this->client->post($this->apiEndPoint . '/Airline/PriceAllAirline', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }


    /**
     * Get Baggage And Meal Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getBaggageAndMeal($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "tripType" => $request->tripType,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "schDepart" => $request->schDepart,
            "schReturn" => $request->schReturn,
            "contactTitle" => $request->contactTitle,
            "contactFirstName" => $request->contactFirstName,
            "contactLastName" => $request->contactLastName,
            "contactCountryCodePhone" => $request->contactCountryCodePhone,
            "contactAreaCodePhone" => $request->contactAreaCodePhone,
            "contactRemainingPhoneNo" => $request->contactRemainingPhoneNo,
            "insurance" => ($request->insurance) ? $request->insurance : "",
            "paxDetails" => ($request->paxDetails) ? $request->paxDetails : []
        ];
        $response = $this->client->post($this->apiEndPoint . '/Airline/BaggageAndMeal', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);
        // dump($data);
        // dump($obj);
        return $obj;
    }

    /**
     * Get Baggage And Meal Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getSeat($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "tripType" => $request->tripType,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "schDepart" => $request->schDepart,
            "schReturn" => $request->schReturn,
            "contactTitle" => $request->contactTitle,
            "contactFirstName" => $request->contactFirstName,
            "contactLastName" => $request->contactLastName,
            "contactCountryCodePhone" => $request->contactCountryCodePhone,
            "contactAreaCodePhone" => $request->contactAreaCodePhone,
            "contactRemainingPhoneNo" => $request->contactRemainingPhoneNo,
            "insurance" => ($request->insurance) ? $request->insurance : "",
            "paxDetails" => $request->paxDetails
        ];
        // dump($data);
        $response = $this->client->post($this->apiEndPoint . '/Airline/seat', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);
        // dump($obj);
        return $obj;
    }

    /**
     * Get Price Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getPriceAirline($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken, // accessToken dari hasil schedule
            "airlineID" => $request->airlineID,
            "tripType" => $request->tripType,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "promoCode" => $request->promoCode,
            "schDeparts" => $request->schDeparts,
            "schReturns" => []
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/Price', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Mengambil data List Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function getBookingList($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "filterByStatus" => $request->status,       // “Booking”,”Processed” or “Issued”
            "startDate" => $request->start,             // Filter date from       Format yyyy-MM-dd
            "endDate" => $request->end                  // Filter date end to     Format yyyy-MM-dd
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/BookingList', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Mengambil data List Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function getBookingDetail($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "bookingCode" => $request->bookingCode,
            "bookingDate" => $request->bookingDate,
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/BookingDetail', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Membuat data booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setBooking($request)
    {
        if(array_key_exists('adult', $request->paxDetails)){
            $adult = data_get($request->paxDetails, 'adult');
            $paxDetails = collect($adult);

            if (array_key_exists('child', $request->paxDetails)) {
                $child = data_get($request->paxDetails, 'child');
                $paxDetails = $paxDetails->concat($child);
            }

            if (array_key_exists('infant', $request->paxDetails)) {
                $infant = data_get($request->paxDetails, 'infant');
                $paxDetails = $paxDetails->concat($infant);
            }
        }else{
            $paxDetails = $request->paxDetails;
        }
        // dd($paxDetails);
        // dd($request->all());
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken, // accessToken dari hasil schedule
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => ($request->returnDate) ? $request->returnDate : "",
            "contactTitle" => $request->contactTitle,
            "contactFirstName" => $request->contactFirstName,
            "contactLastName" => $request->contactLastName,
            "contactCountryCodePhone" => $this->splitPhone($request->contactRemainingPhoneNo, 1),
            "contactAreaCodePhone" => $this->splitPhone($request->contactRemainingPhoneNo, 2),
            "contactRemainingPhoneNo" => $this->splitPhone($request->contactRemainingPhoneNo, 3),
            "paxAdult" => (int)$request->paxAdult,
            "paxChild" => (int)$request->paxChild,
            "paxInfant" => (int)$request->paxInfant,
            "searchKey" => $request->searchKey, // Optional
            "insurance" => $request->insurance, // Optional
            "schDeparts" => $request->schDeparts,
            "schReturns" => "",  // Optional
            "paxDetails" => $paxDetails
        ];
        // dd($data);
        $response = $this->client->post($this->apiEndPoint . '/Airline/Booking', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);
        // dump('asdasdas',$data);
        // dump($obj);
        return $obj;
    }

    /**
     * Membuat data isssue
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setIssued($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "bookingCode" => $request->bookingCode,
            "bookingDate" => $request->bookingDate,
            "airlineAccessCode" => $request->airlineAccessCode
        ];
        $response = $this->client->post($this->apiEndPoint . '/Airline/Issued', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Mendapatkan data Nomor Telepon
     *
     * @param String $nohp
     * @param integer $type
     * @return String
     */
    public function splitPhone($nohp, $type = 1)
    {
        $nohp = str_replace(" ", "", $nohp);
        $nohp = str_replace("(", "", $nohp);
        $nohp = str_replace(")", "", $nohp);
        $nohp = str_replace(".", "", $nohp);
        $nohp = str_replace("+", "", $nohp);

        $hp = '';
        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp), 0, 1) == '0') {
                if ($type == 1) {
                    $hp = '62';
                } elseif ($type == 2) {
                    $hp = substr(trim($nohp), 1, 3);
                } else {
                    $hp = substr(trim($nohp), 4);
                }
            } elseif (substr(trim($nohp), 0, 2) == '62') {
                if ($type == 1) {
                    $hp = '62';
                } elseif ($type == 2) {
                    $hp = substr(trim($nohp), 2, 3);
                } else {
                    $hp = substr(trim($nohp), 5);
                }
            }
        }

        return $hp;
    }
}
