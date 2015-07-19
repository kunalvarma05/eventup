<?php
namespace Eventup\Http\Controllers;

use \Input;
use \Curl\Curl;

class HomeController extends Controller{

    function index(){
        return "Ignorance is bliss.";
    }

    function api(){
        $apiKey = Input::get('apiKey');
        if(!$apiKey){
          \App::abort(500);
      }
      $sysKey = config('settings.apiKey');
      if($sysKey !== $apiKey){
        \App::abort(500);
    }
    $base = Input::get('image');
    $binary = base64_decode($base);
    $fname = rand(0,100) . ".jpg";
    header('Content-Type: bitmap; charset=utf-8');
    $file = fopen(base_path() . "/uploads/" . $fname, 'wb');
    fwrite($file, $binary);
    fclose($file);
    $furl =  asset('/uploads/' . $fname);

    $curl = new Curl();
    $key = config('settings.idol.key');
    $url = config('settings.idol.orc_url');
    $response = $curl->get($url, array(
        'apikey' => $key,
        'url' => $furl,
        ));

    if($response && isset($response->text_block)){
        return $response->text_block[0]->text;
    }else{
        return "error";
    }
}

}