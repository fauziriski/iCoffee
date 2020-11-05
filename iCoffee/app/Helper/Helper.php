<?php

namespace App\Helper;
use GuzzleHttp\Client;
use App\Internationaldestination;
use App\Countrydialcode;
use App\Subdistrict;
use App\Zip_codes;
use App\Province;
use App\City;
use DB;

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
        //     $city = City::where('id', $array_result['rajaongkir']['results'][$i]['city_id'])->first();
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
        // dd($array_result);

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
            $response = $client->request('POST','https://pro.rajaongkir.com/api/cost',
                [
                    // 'body' => 'origin='.$data["origin"].'&destination='.$data["destination"].'&weight='.$data["weight"].'&courier='.$data["courier"],
                    'body' => 'origin='.$data["origin"].'&originType=subdistrict&destination='.$data["destination"].'&destinationType=subdistrict&weight='.$data["weight"].'&courier='.$data["courier"],
                    'headers' => [
                        'key' => $this->apiKey,
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
        
        $origin = $array_result['rajaongkir']['origin_details']['city'];
        
        $destination = $array_result['rajaongkir']['destination_details']['city'];

        return $array_result;

    }

    public function getwaybill($data)
    {
        $title = 'CEK SHIPPING RESULT';
        $client = new Client();

        try{
            $response = $client->request('POST','https://pro.rajaongkir.com/api/waybill',
                [
                    // 'body' => 'waybill='.$data["waybill"].'&courier='.$data["courier"],
                    'body' => 'waybill=JP7185093592&courier=jnt',
                    'headers' => [
                        'key' => $this->apiKey,
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

        return $array_result;

    }

    public function getPostalCode($data)
    {
        // $postal_code = DB::table('postal_code')->where('kecamatan', $data)->get();

        $postal_code = Zip_codes::where('kecamatan', $data)->get();

        $kode_pos = array();

        foreach ($postal_code as $key => $value) 
        {
            if(!(in_array($value->kode_pos, $kode_pos))) {
                $kode_pos[] = $value->kode_pos;
            }
        }

        return $kode_pos;
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
 
}