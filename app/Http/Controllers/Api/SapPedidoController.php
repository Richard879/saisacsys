<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapPedidoController extends Controller
{
    public function SapSetPedido(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $array_rpta = [];
        $rptaSap   = [];

        $data = $request->data;
        foreach ($data as $key => $value) {
            $json = [
                'json' => [
                    "CardCode"      => $value['cCardCode'],
                    "DocDate"       => (string)$request->fDocDate,
                    "DocDueDate"    => (string)$request->fDocDueDate,
                    "DocumentLines" => [
                            [
                                "ItemCode"    => $value['cNumeroVin'],
                                "Quantity"    => "1",
                                "TaxCode"     => "IGV",
                                "UnitPrice"   => (string)$value['fTotalPedidoSoles']
                            ]
                        ]
                    ]
                ];

            $response = $client->request('POST', "/api/Pedido/SapSetPedido/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($array_rpta, $rptaSap);
        }
        return $array_rpta;
    }
}
