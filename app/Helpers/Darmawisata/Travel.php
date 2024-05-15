<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Travel
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
        // $this->userID = Config::$userID;
        // $this->pass = Config::$pass;
        // $this->apiEndPoint = Config::$apiEndPoint;
        $this->userID = "T26SHRTMC5";
        $this->pass = "KIF8A6YWJW";
        $this->apiEndPoint = "https://www.darmawisataindonesiah2h.co.id";
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
     * Show All Shuttle
     *
     * @return \GuzzleHttp\Client
     */
    public function getTravelList()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Shuttle/List', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Shuttle Nationality
     *
     * @return \GuzzleHttp\Client
     */
    public function getTravelRoute($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'shuttleID' => $request->shuttleID
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Shuttle/Route', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Shuttle Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getShuttleSchedule($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'shuttleID' => $request->shuttleID,
            'totalTicket' => $request->totalTicket,
            'departDate' => $request->departDate,
            'directionID' => $request->directionID,
        ]);
        // dump($data);
        $response = $this->client->post($this->apiEndPoint . '/Shuttle/Schedule', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Shuttle Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getShuttleSeatMap($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
            'shuttleID' => $request->shuttleID,
            'departDate' => $request->departDate,
            'seatLayoutID' => $request->seatLayoutID,
            'scheduleCode' => $request->scheduleCode,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Shuttle/SeatMap', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Shuttle Schedules
     *
     * @return \GuzzleHttp\Client
     */
    public function setShuttleBooking($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "shuttleID" => $request->shuttleID,
            "departDate" => $request->departDate,
            "directionID" => $request->directionID,
            "scheduleCode" => $request->scheduleCode,
            "seats" => $request->seats,
            "totalTicket" => $request->totalTicket,
            "contactName" => $request->contactName,
            "contactPhone" => $request->contactPhone,
            "contactAddress" => $request->contactAddress,
            "contactEmail" => $request->contactEmail,
            "paxNames" => $request->paxNames,
            "specialLayoutID" => $request->specialLayoutID,
            
        ];
        // dump($data);
        $response = $this->client->post($this->apiEndPoint . '/Shuttle/Booking', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Shuttle Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function setShuttleIssued($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "bookingCode" => $request->bookingCode,
            "bookingDate" => $request->bookingDate,
        ];
        // dump($data);
        $response = $this->client->post($this->apiEndPoint . '/Shuttle/Issued', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);
        // dump($obj);
        return $obj;
    }

    /**
     * Show All Shuttle Prices
     *
     * @return \GuzzleHttp\Client
     */
    public function getShuttleBookingDetail($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "bookingCode" => $request->bookingCode,
            "bookingDate" => $request->bookingDate,
        ];
        // return $data;
        $response = $this->client->post($this->apiEndPoint . '/Shuttle/BookingDetail', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }


    
}
