<?php

namespace App\Helper;
use GuzzleHttp\Client;
use App\Internationaldestination;
use App\Countrydialcode;
use App\Subdistrict;
use App\Province;
use App\City;

class Helper
{

    public $apiKey = '90c0eb2631ea1750e8e024d99d413f41';

    public function getprovince()
    {
        $client = new Client();

        try{
            $response = $client->get('https://pro.rajaongkir.com/api/province',
                array(
                    'headers' => array(
                        'key' => $this->apiKey,
                        
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
        dd($array_result);
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
            $response = $client->get('https://pro.rajaongkir.com/api/city',
                array(
                    'headers' => array(
                        'key' => $this->apiKey,
                        
                    )
                )
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();

        $array_result = json_decode($json, true);
        dd($array_result);

        // for ($i=0; $i < count($array_result['rajaongkir']['results']); $i++) { 
        //     $city = City::where('id', $array_result['rajaongkir']['results'][$i]['province_id'])->first();
        //     $city->update([
        //         'type' => $array_result['rajaongkir']['results'][$i]['type']
        //     ]);
        // }

        return $array_result;
    }

    public function getSubdistrict($city)
    {
        $client = new Client();

        try{
            $response = $client->get('https://pro.rajaongkir.com/api/subdistrict?city='. $city,
                array(
                    'headers' => array(
                        'key' => $this->apiKey,
                        
                    )
                )
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();

        $array_result = json_decode($json, true);
        dd($array_result);

        // for ($i=0; $i < count($array_result['rajaongkir']['results']); $i++) { 
        //     $subdistrict = Subdistrict::create([
        //         'province_id' => $array_result['rajaongkir']['results'][$i]['province_id'],
        //         'city_id' => $array_result['rajaongkir']['results'][$i]['city_id'],
        //         'name' => $array_result['rajaongkir']['results'][$i]['subdistrict_name']
        //     ]);
        // }

        return $array_result;
        
    }

    public function getInternationalDestination()
    {
        $client = new Client();

        try{
            $response = $client->get('https://pro.rajaongkir.com/api/v2/internationalDestination',
                array(
                    'headers' => array(
                        'key' => $this->apiKey,
                        
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
            $subdistrict = Internationaldestination::create([
                'country_name' => $array_result['rajaongkir']['results'][$i]['country_name'],
            ]);
        }

        return $array_result;
        

    }

    public function cekOngkir($data)
    {
        $title = 'CEK SHIPPING RESULT';
        $client = new Client();

        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin='.$data["origin"].'&destination='.$data["destination"].'&weight='.$data["weight"].'&courier='.$data["courier"],
                    'headers' => [
                        'key' => '91c8040385b06b96e8ae36c7f5584bbd',
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

        return $array_result;

    }

    public function removeDot($value)
    {
        $trueValue = str_replace('.', '', $value);
        if ($trueValue) {
            return $trueValue;
        }
        else {
            return $value;
        }
        
    }

    public function dialCode($data)
    {
        $count = count($data);
        for ($i=0; $i < $count ; $i++) { 
            $result = Countrydialcode::create([
                'name' => $data[$i]['name'],
                'code' => $data[$i]['code'], 
                'callingCode' => $data[$i]['callingCode']
            ]);

            $datas[] = $result;
        }


        return $datas;
    }

    public function doUpload($file,$detailBuktiId){
        $name = 'confirm_top_up' .$detailBuktiId .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads/'.$this->folderName, $name);        
        if($path){
            return $name;
        }
        else{
            return false;
        }
    }

    public static function instance()
    {
        return new Helper();
    }

    public function myDateFormat($value) {
        return \Carbon\Carbon::createFromFormat($value, 'd/m/Y')->toDateTimeString();
    }
 
}