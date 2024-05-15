<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Ship
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
     * Session Logout
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
        return json_decode($response);
    }

    /**
     * Get Ship Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getShipRoutes()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Ship/Route', $this->options($data))->getBody();
        return json_decode($response);
    }


    /**
     * Get Ship Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getShipSchedule($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'originPort' => $request->originPort,
            'destinationPort' => $request->destinationPort,
            'departStartDate' => $request->departStartDate,
            'departEndDate' => $request->departEndDate,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Ship/Schedule', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Ship Availability
     *
     * @return \GuzzleHttp\Client
     */
    public function getShipAvalibility($request)
    {
        $data = json_encode([
            'originPort' => $request->originPort,
            'originCall' => (int)$request->originCall,
            'destinationPort' => $request->destinationPort,
            'destinationCall' => (int)$request->destinationCall,
            'shipNumber' => $request->shipNumber,
            'departDate' => $request->departDate,
            'subClass' => $request->subClass,
            'pax' => $request->pax,
            'userID' => $this->userID,
            'accessToken' => $request->accessToken
        ]);
        // return json_decode($data);
        $response = $this->client->post($this->apiEndPoint . '/Ship/Availability', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Ship Rooms
     *
     * @return \GuzzleHttp\Client
     */
    public function getShipRooms($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
            'originPort' => $request->originPort,
            'originCall' => $request->originCall,
            'destinationPort' => $request->destinationPort,
            'destinationCall' => $request->destinationCall,
            'shipNumber' => $request->shipNumber,
            'departDate' => $request->departDate,
            'subClass' => $request->subClass,
            'pax' => $request->pax,
            'ticketBuyerName' => $request->ticketBuyerName,
            'ticketBuyerEmail' => $request->ticketBuyerEmail,
            'ticketBuyerAddress' => $request->ticketBuyerAddress,
            'ticketBuyerPhone' => $request->ticketBuyerPhone,
            'family' => $request->family,

        ]);
        // return json_decode($data);
        
        $response = $this->client->post($this->apiEndPoint . '/Ship/GetRoom', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Ship Booking
     *
     * @return \GuzzleHttp\Client
     */
    public function setShipBooking($request)
    {
        $data = json_encode([
            'numCode' => $request->numCode,
            'originPort' => $request->originPort,
            'originCall' => $request->originCall,
            'destinationPort' => $request->destinationPort,
            'destinationCall' => $request->destinationCall,
            'shipNumber' => $request->shipNumber,
            'departDate' => $request->departDate,
            'paxDetails' => $request->paxDetails,
            'userID' => $this->userID,
            'accessToken' => $request->accessToken
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Ship/Booking', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Ship Issued
     *
     * @return \GuzzleHttp\Client
     */
    public function setShipIssued($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'numCode' => $request->numCode,
            'bookingDate' => $request->bookingDate
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Ship/Issued', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * get Ship Booking List
     *
     * @return \GuzzleHttp\Client
     */
    public function getShipBookingList($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
            'filterBy' => $request->filter,
            'startDate' => $request->start,
            'endDate' => $request->end
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Ship/BookingList', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * get Ship Booking Detail
     *
     * @return \GuzzleHttp\Client
     */
    public function getShipBookingDetail($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'numCode' => $request->numCode,
            'bookingDate' => $request->bookingDate
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Ship/BookingDetail', $this->options($data))->getBody();
        return json_decode($response);
    }
}
