<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Province;
use App\City;

class ApiController extends Controller
{
    public function getprovince()
    {
        $client = new Client();

        try{
            $response = $client->get('https://api.rajaongkir.com/starter/province',
                array(
                    'headers' => array(
                        'key' => '173f863cc1b39ff155f1d8058cebc703',
                        
                    )
                )
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();


        $array_result = json_decode($json, true);

        // print_r($array_result);
        
        for ($i=0; $i < count($array_result['rajaongkir']['results']); $i++) { 
            $province = Province::create([
                'id' => $array_result['rajaongkir']['results'][$i]['province_id'],
                'nama' => $array_result['rajaongkir']['results'][$i]['province']
            ]);
        }

        print_r($array_result);
    }

    public function getcity()
    {
        $client = new Client();

        try{
            $response = $client->get('https://api.rajaongkir.com/starter/city',
                array(
                    'headers' => array(
                        'key' => '173f863cc1b39ff155f1d8058cebc703',
                        
                    )
                )
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();


        $array_result = json_decode($json, true);

        for ($i=0; $i < count($array_result['rajaongkir']['results']); $i++) { 
            $province = City::create([
                'id' => $array_result['rajaongkir']['results'][$i]['city_id'],
                'id_provinsi' => $array_result['rajaongkir']['results'][$i]['province_id'],
                'nama' => $array_result['rajaongkir']['results'][$i]['city_name']
                
            ]);
        }

        print_r($array_result);
    }

    public function prosesshipping(Request $request)
    {
        $title = 'CEK SHIPPING RESULT';
        $client = new Client();

        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin='.$request->origin.'&destination='.$request->destination.'&weight='.$request->weight.'&courier=tiki',
                    'headers' => [
                        'key' => '173f863cc1b39ff155f1d8058cebc703',
                        'content-type' => 'application/x-www-form-urlencoded',
                        
                    ]
                ]
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();


        $array_result = json_decode($json, true);

        $origin = $array_result['rajaongkir']['origin_details']['city_name'];
        $destination = $array_result['rajaongkir']['destination_details']['city_name'];

        return view('jne.check-shipping-result', compact('title','origin','destination','array_result'));

    }

    public function cekshipping(Request $request)
    {
        $title = 'CEK SHIPPING RESULT';
        $client = new Client();

        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin=501&destination=114&weight=1&courier=tiki',
                    'headers' => [
                        'key' => '173f863cc1b39ff155f1d8058cebc703',
                        'content-type' => 'application/x-www-form-urlencoded',
                        
                    ]
                ]
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();


        $array_result = json_decode($json, true);

        $origin = $array_result['rajaongkir']['origin_details']['city_name'];
        $destination = $array_result['rajaongkir']['destination_details']['city_name'];

        print_r($array_result);
        

    }
    
}
