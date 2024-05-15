<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Tour;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->tour = new Tour();
    }

    /**
     * Get Tour Route
     *
     * @return Illuminate\Http\Response
     */
    public function getTourCategories()
    {
        return response()->json(['data' => $this->tour->getTourCategories()]);
    }

    /**
     * Get Tour Type
     *
     * @return Illuminate\Http\Response
     */
    public function getTourType(Request $request)
    {
        return response()->json(['data' => $this->tour->getTourType()]);
    }

    /**
     * Get Tour Province
     *
     * @return Illuminate\Http\Response
     */
    public function getTourProvince(Request $request)
    {
        return response()->json(['data' => $this->tour->getTourProvince()]);
    }

    /**
     * Get Available Tour
     *
     * @return Illuminate\Http\Response
     */
    public function getTourSearch(Request $request)
    {
        return response()->json(['data' => $this->tour->getTourSearch($request)]);
    }

    /**
     * getTourDetail
     *
     * @return Illuminate\Http\Response
     */
    public function getTourDetail(Request $request)
    {
        return response()->json(['data' => $this->tour->getTourDetail($request)]);
    }

    /**
     * getTourImageList
     *
     * @return Illuminate\Http\Response
     */
    public function getTourImageList(Request $request)
    {
        return response()->json(['data' => $this->tour->getTourImageList($request)]);
    }

    /**
     * setTourBooking
     *
     * @return Illuminate\Http\Response
     */
    public function setTourBooking(Request $request)
    {
        return response()->json(['data' => $this->tour->setTourBooking($request)]);
    }

    /**
     * setIssuedTourBooking
     *
     * @return Illuminate\Http\Response
     */
    public function setIssuedTourBooking(Request $request)
    {
        return response()->json(['data' => $this->tour->setIssuedTourBooking($request)]);
    }

    /**
     * getBookingDetail
     *
     * @return Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->tour->getBookingDetail($request)]);
    }

    /**
     * getGetTourOnRequest
     *
     * @return Illuminate\Http\Response
     */
    public function getGetTourOnRequest(Request $request)
    {
        return response()->json(['data' => $this->tour->getGetTourOnRequest($request)]);
    }
}
