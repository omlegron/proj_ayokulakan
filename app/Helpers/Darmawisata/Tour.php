<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Tour
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
        $this->userID = Config::$userID;
        $this->pass = Config::$pass;
        $this->apiEndPoint = Config::$apiEndPoint;
        // $this->userID = "T26SHRTMC5";
        // $this->pass = "KIF8A6YWJW";
        // $this->apiEndPoint = "https://www.darmawisataindonesiah2h.co.id";
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
            'token' => $this->apiToken
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
            'token' => $this->apiToken
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Session/Logout', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Tour Categories
     *
     * @return \GuzzleHttp\Client
     */
    public function getTourCategories()
    {   
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint.'/Tour/Categories', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Tour Type
     *
     * @return \GuzzleHttp\Client
     */
    public function getTourType()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/Type', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Tour Provinces
     *
     * @return \GuzzleHttp\Client
     */
    public function getTourProvince()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/Provinces', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Available Tour
     *
     * @return \GuzzleHttp\Client
     */
    public function getTourSearch($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'Keyword' => $request->Keyword,
            'TourType' => $request->TourType,
            'Category' => $request->Category,
            'MinPrice' => $request->MinPrice,
            'MaxPrice' => $request->MaxPrice,
            'Duration' => $request->Duration,
            'MinimumPax' => $request->MinimumPax,
            'Province' => $request->Province
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/Search', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Available Tour Detail
     *
     * @return \GuzzleHttp\Client
     */
    public function getTourDetail($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
            'id' => $request->id,
            'variant' => $request->variant
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/Detail', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Bus Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getTourImageList($request)
    {
        // Selain Pahala Kencana infant dan child harus 0
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
            'tourid' => $request->tourid,
            'tourvariant' => $request->tourvariant
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/Images', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Tour Booking
     *
     * @return \GuzzleHttp\Client
     */
    public function setTourBooking($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
            'TourID' => $request->TourID,
            'PackageID' => $request->PackageID,
            'TourVariant' => $request->TourVariant,
            'RabID' => $request->RabID,
            'DepartDate' => $request->DepartDate,
            'PaymentType' => $request->PaymentType,
            'Pax' => $request->Pax,
        ]);
        // return $data;
        $response = $this->client->post($this->apiEndPoint . '/Tour/Booking', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Issued Tour Booking
     *
     * @return \GuzzleHttp\Client
     */
    public function setIssuedTourBooking($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'BookingCode' => $request->BookingCode,
            'TourVariant' => $request->TourVariant
        ]);
        // return $data;
        $response = $this->client->post($this->apiEndPoint . '/Tour/Issued', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * get Tour Booking Detail
     *
     * @return \GuzzleHttp\Client
     */
    public function getBookingDetail($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'BookingCode' => $request->BookingCode,
            'TourVariant' => $request->TourVariant
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/TransactionDetail', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * get Tour Booking On Request
     *
     * @return \GuzzleHttp\Client
     */
    public function getGetTourOnRequest($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $request->accessToken,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Tour/GetBookingOnRequest', $this->options($data))->getBody();
        return json_decode($response);
    }

}
