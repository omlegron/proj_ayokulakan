<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class ArahQiblatController extends Controller
{


    public function index()
    { 
        return $this->render('frontend.maps.arah-qiblat', [
            'mockup' => false,
        ]);
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
