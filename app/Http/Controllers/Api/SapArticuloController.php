<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapArticuloController extends Controller
{
    public function SapGetValidarArticulo(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $json = [
                    'json' => [
                        "ItemCode"    => $request->cNumeroVin
                        ]
                ];

        $response = $client->request('POST', "/api/Articulo/SapGetValidarArticulo/", $json);
        return $response->getBody();
    }

    public function SapSetArticulo(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {

            $cItemCode = $value['cNumeroVin'].' '.$value['nAnioFabricacion'].' '.$value['nAnioVersion'];
            $ItemType = $value['cItemType'];
            $ItemType = ($ItemType == NULL) ? ($ItemType = 'itItems') : $ItemType;

            $json = [
                'json' => [
                    "ItemCode"    => $value['cNumeroVin'],
                    "ItemName"    => $cItemCode,
                    "ItemType"    => $ItemType,
                    "ItemsGroupCode" => "107"
                ]
            ];

            $response = $client->request('POST', "/api/Articulo/SapSetArticulo/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
