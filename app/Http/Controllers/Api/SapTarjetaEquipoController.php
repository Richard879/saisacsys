<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapTarjetaEquipoController extends Controller
{
    public function SapSetTarjetaEquipo(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "CustomerCode"          => $value['cCustomerCode'],
                    "InternalSerialNum"     => $value['cInternalSerialNum'],
                    "ItemCode"              => $value['cItemCode']
                ]
            ];

            $response = $client->request('POST', "/api/TarjetaEquipo/SapSetTarjetaEquipo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapUpdSocioNegocio(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $json = [
                'json' => [
                    "EquipmentCardNum"  => $value['nEquipmentCardNum'],
                    "CustomerCode"      => $value['cCardCode']
                ]
            ];

            $response = $client->request('POST', "/api/TarjetaEquipo/SapPatchTarjetaEquipo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }

    public function SapUpdTarjetaPlaca(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $json = [
            'json' => [
                "EquipmentCardNum"      => $request->EquipmentCardNum,
                "ManufacturerSerialNum" => (string)$request->ManufacturerSerialNum
            ]
        ];

        $response   =   $client->request('POST', "/api/TarjetaEquipo/SapPatchTarjetaEquipo/", $json);
        $rptaSap    =   json_decode($response->getBody());
        return $rptaSap;
    }
}
