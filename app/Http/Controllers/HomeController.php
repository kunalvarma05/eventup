<?php
namespace Eventup\Http\Controllers;

use \Input;
use \Curl\Curl;

class HomeController extends Controller{

    function index(){
        return \App::abort(500);
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
        $file = fopen(base_path() . "/resources/assets/images/" . $fname, 'wb');
        fwrite($file, $binary);
        fclose($file);
        return asset('images/' . $fname);

        $curl = new Curl();
        $key = config('settings.idol.key');
        $url = config('settings.idol.orc_url');
        $curl->setHeader("Content-type", "application/x-www-form-urlencoded");
        $response = $curl->get($url, array(
            'apikey' => $key,
            //'url' => "http://hanzratech.in/figures/tesseract-test.jpg",
            'file' => asset('images/' . $fname)
            ));

        return $response->text_block[0]->text;
    }

}