<?php

namespace App\Helper;
use GuzzleHttp\Client;

class Helper
{
    public function getprovince()
    {
        $client = new Client();

        try{
            $response = $client->get('https://api.rajaongkir.com/starter/province',
                array(
                    'headers' => array(
                        'key' => '91c8040385b06b96e8ae36c7f5584bbd',
                        
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
}