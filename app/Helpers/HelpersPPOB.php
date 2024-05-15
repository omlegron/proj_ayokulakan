<?php
namespace App\Helpers;

use Carbon\Carbon;

class HelpersPPOB
{
	public static function getAll(){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680";
		$signature  = md5($username.$apiKey.'pl');

		$json = '{
		          "commands" : "pricelist",
		          "username" : "082119328343",
		          "sign"     : "16bdad92c280b7ee9b0febabb630523b"
		        }';

		$url = "https://api.mobilepulsa.net/v1/legacy/index";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	public static function checkBalance(){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680"; // prod
		// $apiKey   = "4065db121b02cc0a"; // dev
		$signature  = md5($username.$apiKey.'bl');

		$json = '{
		          "commands" : "balance",
		          "username" : "082119328343",
		          "sign"     : "'.$signature.'"
		        }';

		$url = "https://api.mobilepulsa.net/v1/legacy/index"; // prod
		// $url = "https://testprepaid.mobilepulsa.net/v1/legacy/index"; // dev

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	public static function checkType($type){
		$return = '-';
	    switch ($type)
	    {
	        case 'list_ppob': $return = 'topup';
	        break;
	        case 'pln': $return = 'inquiry_pln';
	        break;
	        case 'PLNPOSTPAID': $return = 'inq-pasca';
	        break;
	    }

	    return $return;
	}

	public static function checkError($data){
		$return = '-';
		$type = isset(json_decode($data)->data) ? json_decode($data)->data : [];
		$array = ['2','05','06','07','09','13','14','16','17','20','10','34','37','43','50','52','53','54','55','56','57','58','60','61','62','102','103','105','106','107','201','202','203','204','205','206','207','false'];
		if(isset($type->status) && $type->status != 0){
			if(in_array($type->status,$array)){
				header('HTTP/1.1 500 Internal Server Booboo');
		        header('Content-Type: application/json; charset=UTF-8');
		        die($data);
			}else{
				return $data;
			}
		}else if(isset($type->status) && $type->status == 0){
			return $data;
		}elseif(isset($type->response_code)){
			if(in_array($type->response_code,$array)){
				header('HTTP/1.1 500 Internal Server Booboo');
		        header('Content-Type: application/json; charset=UTF-8');
		        die($data);
			}else{				
				return $data;
			}
		}else{
			if(count($type) > 0){
				return $data;
			}else{
				header('HTTP/1.1 500 Internal Server Booboo');
			    header('Content-Type: application/json; charset=UTF-8');
			    die(json_encode(array('dataPpob' => array('message' => 'Status Sedang Pending, Mohon Di Tunggu'))));
			}
			
		}
	}
	public static function checkErrorInternet($data){
		$return = '-';
		$type = isset(json_decode($data)->data) ? json_decode($data)->data : [];
		$array = ['01','2','05','06','07','09','13','14','16','17','20','10','34','37','39','43','50','52','53','54','55','56','57','58','60','61','62','102','103','105','106','107','201','202','203','204','205','206','207','false'];
		// dd($type);
		if(isset($type->status)){
			if(in_array($type->status,$array)){
				header('HTTP/1.1 500 Internal Server Booboo');
		        header('Content-Type: application/json; charset=UTF-8');
		        die($data);
			}else{
				return $data;
			}
		}elseif(isset($type->response_code)){
			if(in_array($type->response_code,$array)){
				header('HTTP/1.1 500 Internal Server Booboo');
		        header('Content-Type: application/json; charset=UTF-8');
		        die($data);
			}else{				
				return $data;
			}
		}else{
			if(count($type) > 0){
				return $data;
			}else{
				header('HTTP/1.1 500 Internal Server Booboo');
			    header('Content-Type: application/json; charset=UTF-8');
			    die(json_encode(array('dataPpob' => array('message' => 'Status Sedang Pending, Mohon Di Tunggu'))));
			}
			
		}
	}

	
	public static function checkGame($record){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680"; // prod
		// $apiKey   = "4065db121b02cc0a";
		$signature  = md5($username.$apiKey.$record['game_code']);
		
			$jsons = '{
	            "commands" : "check-game-id",
		        "username" : "'.$username.'",
		        "game_code"   : "'.$record['game_code'].'",
		        "hp"   : "'.$record['ppob_pelanggan'].'|'.$record['ppob_pelanggan_next'].'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://api.mobilepulsa.net/v1/legacy/index"; // prod
		// $url = "https://testprepaid.mobilepulsa.net/v1/legacy/index"; // dev
			// dd(json_decode($jsons));
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		// dd($data);
		return HelpersPPOB::checkError($data);
	}
	public static function checkGameFF($record){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680";
		// $apiKey   = "4065db121b02cc0a";
		$signature  = md5($username.$apiKey.$record['game_code']);
		
			$jsons = '{
	            "commands" : "check-game-id",
		        "username" : "'.$username.'",
		        "game_code"   : "'.$record['game_code'].'",
		        "hp"   : "'.$record['ppob_pelanggan'].'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://api.mobilepulsa.net/v1/player-detail ";
		// $url = "https://testprepaid.mobilepulsa.net/v1/player-detail";
			// dd(json_decode($jsons));
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		// dd($data);
		return HelpersPPOB::checkError($data);
	}

	public static function checkStatusPrepaid($ref_id=''){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680";
		$signature  = md5($username.$apiKey.$ref_id);
			$jsons = '{
	            "commands" : "inquiry",
		        "username" : "'.$username.'",
		        "ref_id"   : "'.$ref_id.'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://api.mobilepulsa.net/v1/legacy/index";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}

	public static function checkStatusPostpaid($ref_id=''){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680";
		$signature  = md5($username.$apiKey.'cs');
			$jsons = '{
	            "commands" : "checkstatus",
		        "username" : "'.$username.'",
		        "ref_id"   : "'.$ref_id.'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://mobilepulsa.net/api/v1/bill/check";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}

	public static function post($order_id, $type, $jsons){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680"; // prod
		// $apiKey   = "4065db121b02cc0a"; // dev
		$signature  = md5($username.$apiKey.$order_id);
		$pulsa_code = isset($jsons['pulsa_code']) ? $jsons['pulsa_code'] : null;
		$hp = isset($jsons['hp']) ? $jsons['hp'] : $username;
				$jsons = '{
		          "commands"    : "'.HelpersPPOB::checkType($type).'",
		          "username"    : "'.$username.'",
		          "ref_id"      : "'.$order_id.'",
		          "hp"          : "'.$hp.'",
		          "pulsa_code"  : "'.$pulsa_code.'",
		          "sign"        : "'.$signature.'"
		        }';
		        
		$url = "https://api.mobilepulsa.net/v1/legacy/index"; // prod
		// $url = "https://testprepaid.mobilepulsa.net/v1/legacy/index"; // dev

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		return HelpersPPOB::checkError($data);
	}


	// CEK DATA PULSA, PAKET DATA, VOUCHER
	public static function cekData($data, $type){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680";
		$signature  = md5($username.$apiKey.'pl');
			
		$jsons = '{
			"commands" : "pricelist",
			"username" : "082119328343",
			"sign"     : "'.$signature.'",
			"status"   : "all"
		}';
		$url = "https://api.mobilepulsa.net/v1/legacy/index/".$data."/".$type."";
		// dd($jsons);
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		// dd($data);
		return HelpersPPOB::checkError($data);
	}

// CEK DATA INQUERY PASCA PDAM dan Internet
public static function cekInqueryPascaPdamInternet($req){
	$username   = "082119328343";
	$apiKey   = "6805f8b48ea6ce94680"; // prod
	// $apiKey   = "4065db121b02cc0a"; // dev
	
	$ref_id  = uniqid('');
	$signature  = md5($username.$apiKey.$ref_id);
	$json = '{
			  "commands" : "inq-pasca",
			  "username" : "'.$username.'",
			  "code"     : "'.$req['type'].'",
			  "hp"       : "'.$req['ppob_pelanggan'].'",
			  "ref_id"   : "'.$ref_id.'",
			  "sign"     : "'.md5($username.$apiKey.$ref_id).'"
		  }';
	$url = "https://mobilepulsa.net/api/v1/bill/check"; // prod
	// $url = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check"; // dev
	// dd($json);

	$ch  = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);
	// dd($data);
	return HelpersPPOB::checkErrorInternet($data);
}

// CEK DATA INQUERY PASCA TV
public static function cekInqueryPascaTv($req){
	$username   = "082119328343";
	$apiKey   = "6805f8b48ea6ce94680";
	// $apiKey   = "4065db121b02cc0a";
	// $apiKeyProd = "6805f8b48ea6ce94680";
	$ref_id  = uniqid('');
	$signature  = md5($username.$apiKey.$ref_id);
	$json = '{
			  "commands" : "inq-pasca",
			  "username" : "'.$username.'",
			  "code"     : "'.$req['type'].'",
			  "hp"       : "'.$req['ppob_pelanggan'].'",
			  "ref_id"   : "'.$ref_id.'",
			  "sign"     : "'.md5($username.$apiKey.$ref_id).'"
		  }';
	$url = "https://mobilepulsa.net/api/v1/bill/check";
	// $url = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check";
	// dd($json);

	$ch  = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);
	// dd($data);
	return HelpersPPOB::checkErrorInternet($data);
}

// CEK DATA INQUERY PASCA Esamsat
public static function cekInqueryPascaEsamsat($req){
	$username   = "082119328343";
	$apiKey   = "6805f8b48ea6ce94680"; // prod
	// $apiKey   = "4065db121b02cc0a"; // dev
	// $apiKeyProd = "6805f8b48ea6ce94680";
	$ref_id  = uniqid('');
	$signature  = md5($username.$apiKey.$ref_id);
	$nomor_identitas = $req['nomor_identitas'];
	$json = '{
			  "commands" : "inq-pasca",
			  "username" : "'.$username.'",
			  "code"     : "'.$req['type'].'",
			  "hp"       : "'.$req['ppob_pelanggan'].'",
			  "ref_id"   : "'.$ref_id.'",
			  "sign"     : "'.md5($username.$apiKey.$ref_id).'",
			  "nomor_identitas" : "'.$nomor_identitas.'"
		  }';
	$url = "https://mobilepulsa.net/api/v1/bill/check"; // prod
	// $url = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check"; // dev
	$ch  = curl_init();
	// dd($json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);
	// dd($data);
	return HelpersPPOB::checkError($data);
}

	// CEK DATA INQUERY PASCA BPJS
	public static function cekInqueryPasca($req){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680"; // prod
		// $apiKey   = "4065db121b02cc0a"; // dev
		
		$ref_id  = uniqid('');
		$signature  = md5($username.$apiKey.$ref_id);
		$month = isset($req['month']) ? formatNumMonth($req['month']) : '';
		$nomor_identitas = isset($req['nomor_identitas']) ? formatNumMonth($req['nomor_identitas']) : '';
		$json = '{
		          "commands" : "inq-pasca",
		          "username" : "'.$username.'",
		          "code"     : "'.$req['type'].'",
		          "hp"       : "'.$req['ppob_pelanggan'].'",
		          "ref_id"   : "'.$ref_id.'",
		          "sign"     : "'.md5($username.$apiKey.$ref_id).'",
		          "month"    : "'.$month.'"
		      }';
		$url = "https://mobilepulsa.net/api/v1/bill/check"; // prod
		// $url = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check"; // dev
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		// dd($data);
		return HelpersPPOB::checkErrorInternet($data);
	}
	
	public static function postPayPasca($tr_id){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680"; // prod
		// $apiKey   = "4065db121b02cc0a"; // dev
		
		$signature  = md5($username.$apiKey.$tr_id);

		$json = '{
		          "commands" : "pay-pasca",
		          "username" : "'.$username.'",
		          "tr_id"    : "'.$tr_id.'",
		          "sign"     : "'.$signature.'"
		        }';

		$url = "https://mobilepulsa.net/api/v1/bill/check"; // PROD
		// $url = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check"; // DEV

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return HelpersPPOB::checkError($data);
	}

	// STATSIUN KRETA
	public static function checkClass($class){
		$return = $class;
	    switch ($class)
	    {
	        case 'EKSEKUTIF': $return = 'EKS';
	        break;
	        case 'EKONOMI': $return = 'PREMIUM_SS';
	        break;
	    }

	    return $return;
	}

	public static function arrayToComa($req){
		$show = '';
        foreach ($req as $i => $data) {
            $show .= $data;
            if($i < count($req) - 1){
                $show .= ', ';
            }
        }
        return $show;
	}

	public static function arrayToGetLastChar($req){
		$show = '';
        foreach ($req as $i => $data) {
            if($i == 0){
            	$show = substr($data, -1);
            }
        }
        return $show;
	}

	public static function arrayToSliceLastChar($req){
		$show = '';
        foreach ($req as $i => $data) {
        	if($i == 0){
            	$show = substr($data, 0, -1);
        	}
        }
        return $show;
	}
	
	public static function getListKereta(){
		$username   = "082119328343";
		$apiKey   = "6805f8b48ea6ce94680";
		$signature  = md5($username.$apiKey.'pl');

		$json = '{
		          "commands" : "pricelist",
		          "username" : "082119328343",
		          "sign"     : "16bdad92c280b7ee9b0febabb630523b"
		        }';

		$url = "https://mobilepulsa.net/api/v1/tiketv2";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	public static function findKereta($req){
		// API PRODUCTION
		
		// $apiKey   = "4065db121b02cc0a"; // dev
		$apiKey   = "6805f8b48ea6ce94680"; // production
		$username   = "082119328343";
		$signature  = md5($username.$apiKey."st");
		 $jsonDK ='{
            "commands" : "search-train",
		    "username" : "'.$username.'",
		    "org" : "'.$req['rute_asal'].'",
		    "dest" : "'.$req['rute_tujuan'].'",
		    "date" : "'.$req['tanggal_berangkat'].'",
		    "sign" : "'.$signature.'"
        }';
        // dump(json_decode($jsonDK));
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2"; // production
        // $urlDK = "https://testpostpaid.mobilepulsa.net/api/v1/tiketv2"; // dev
        // dd($jsonDK);
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
		curl_close($chDK);
		// dd($dataDK);
		
		return $dataDK;
		
        
        
	}

	public static function seatMapSubClass($req){
		// API PRODUCTION
		// $apiKey   = "4065db121b02cc0a"; // dev
		$apiKey   = "6805f8b48ea6ce94680"; // production
		$username   = "082119328343";
		$ref_id  = uniqid('');
		$signature  = md5($username.$apiKey.$ref_id);
		$hp = $req['desc']['hp'];
		unset($req['desc']['hp']);
		$desc = $req['desc'];
		$jsonDK ='{
            "commands" : "inq-pasca",
		    "username" : "'.$username.'",
		    "code" : "KAI",
		    "ref_id" : "'.$ref_id.'",
		    "hp" : "'.$hp.'",
		    "desc" : {
		    	"contactName" : "'.$req['desc']['contactName'].'",
		        "contactEmail" : "'.$req['desc']['contactEmail'].'",
		        "fareId" : "'.$req['desc']['fareId'].'",
		        "adult" : "'.$req['desc']['adult'].'",
		        "passenger" : '.json_encode($req['desc']['passenger']).'
		    },
		    "sign" : "'.$signature.'"
        }';
        $jsonDK = preg_replace("!\r?\n?\t?\ ?!", "", $jsonDK);

        $urlDK = "https://mobilepulsa.net/api/v1/bill/check"; // prod
        // $urlDK = "https://testpostpaid.mobilepulsa.net/api/v1/tiketv2"; // dev
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
		curl_close($chDK);
		// dd(json_decode($dataDK));
        return $dataDK;
        
	}

	// SEAT MAP KERETA
	public static function seatMap($req){
		// API PRODUCTION
		// 6805f8b48ea6ce94680 
		// https://mobilepulsa.net/api/v1/tiket
		// $apiKey   = "4065db121b02cc0a"; // dev
		$apiKey   = "6805f8b48ea6ce94680"; // production
		$username   = "082119328343";
		$signature  = md5($username.$apiKey.$req['tr_id']);
		// dd($req['tanggal_berangkat']);
		// dd($req['tanggal_berangkat']);
		 $jsonDK ='{
            "commands" : "seat-map",
		    "username" : "'.$username.'",
		    "tr_id" : "'.$req['tr_id'].'",
		    "ticketNumber" : "'.$req['ticketNumber'].'",
		    "sign" : "'.$signature.'"
        }';
        // dd($jsonDK);
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2"; // prod
        // $urlDK = "https://testpostpaid.mobilepulsa.net/api/v1/tiketv2"; // dev
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        // dd(json_decode($dataDK));
        return HelpersPPOB::checkError($dataDK);
        
	}


	public static function bookingAccept($id){
		// API PRODUCTION
		// 6805f8b48ea6ce94680 
		// https://mobilepulsa.net/api/v1/tiketv2
		// $apiKey   = "4065db121b02cc0a"; // dev
		$apiKey   = "6805f8b48ea6ce94680"; // production
		// $apiKey   = "4065db121b02cc0a";
		$username   = "082119328343";
		$signature  = md5($username.$apiKey.$id);
		// dd($req['tanggal_berangkat']);
		// dd($id);
		 $jsonDK ='{
            "commands" : "pay-pasca",
		    "username" : "082119328343",
		    "tr_id" : '.$id.',
		    "sign" : "'.$signature.'"
        }';
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        // $urlDK = "https://testpostpaid.mobilepulsa.net/api/v1/tiketv2";
        // dd(json_decode($jsonDK));
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
		curl_close($chDK);
		// dd($dataDK);
        return $dataDK;
        
	}

	public static function checkBooking($id){
		// API PRODUCTION
		// 6805f8b48ea6ce94680 
		// https://mobilepulsa.net/api/v1/tiketv2
		$apiKey   = "6805f8b48ea6ce94680";
		$username   = "082119328343";
		$signature  = md5($username.$apiKey.$id);
		// dd($req['tanggal_berangkat']);
		// dd($req['tanggal_berangkat']);
		 $jsonDK ='{
            "commands" : "check-book",
		    "username" : "082119328343",
		    "trId" : "'.$id.'",
		    "sign" : "'.$signature.'"
        }';
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return $dataDK;
        
	}
	
}
