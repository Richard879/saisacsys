<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapPedidoController extends Controller
{
    public function SapSetPedido(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        // ======================================================================
        // GENERAR ORDEN VENTA PARA VEHÍCULO
        // ======================================================================
        //Setear arreglos para Pedido (Vehiculo)
        $arrayVehiculo  = [];
        $rptaSap        = [];
        $ReceptionDate  = date('Y-m-d');

        $arraySapPedido = $request->arraySapPedido;
        foreach ($arraySapPedido as $key => $value) {
            $json = [
                'json' => [
                    "nIdEmpresa"        => (string)$request->nIdEmpresa,
                    "CardCode"          =>  (string)$value['cCardCode'],
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "SalesPersonCode"   =>  (string)$value['nSalesEmployeeCode'],
                    "U_SYP_MDMT"        =>  "01",
                    "DocumentLines" => [
                        [
                            "ItemCode"      =>  (string)$value['cNumeroVin'],
                            "Quantity"      =>  "1",
                            "TaxCode"       =>  "IGV",
                            "PriceAfterVAT" => (string)$value['fSubTotalDolares'],
                            "Currency"      =>  "US$",
                            "WarehouseCode" =>  (string)$request->WarehouseCode,
                            "ProjectCode"   =>  (string)$value['cNumeroVin'],
                            "CostingCode2"  =>  "01", //UnidadDeNegocio
                            "CostingCode3"  =>  (string)$request->nIdSapSucursal,
                            "U_SYP_TPOIMP"  =>   "01",
                            'SerialNumbers' =>  array()
                        ]
                    ]
                ]
            ];

            //Verificar la Entrada De Mercancia
            if($value['nDocEntryMercancia']) {
                //Agrgar informacion en el Array correspondiente
                $json['json']['DocumentLines'][0]['SerialNumbers'] = [
                    "ManufacturerSerialNumber"  =>  (string)$value['cNumeroVin'],
                    "InternalSerialNumber"      =>  (string)$value['cNumeroVin'],
                    "ExpiryDate"                =>  null,
                    "ManufactureDate"           =>  null,
                    "ReceptionDate"             =>  $ReceptionDate,
                    "WarrantyStart"             =>  null,
                    "WarrantyEnd"               =>  null,
                    "Location"                  =>  null,
                    "Notes"                     =>  null,
                    "BatchID"                   =>  null,
                    "SystemSerialNumber"        =>  1,
                    "BaseLineNumber"            =>  0,
                    "Quantity"                  =>  1,
                    "TrackingNote"              =>  null,
                    "TrackingNoteLine"          =>  null
                ];
            } else {
                $json['json']['DocumentLines'][0]['SerialNumbers'] = [];
            }

            $response = $client->request('POST', config('integracion.ruta') . "Pedido/SapSetPedido/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($arrayVehiculo, $rptaSap);
        }

        // ======================================================================
        // GENERAR ORDEN VENTA PARA LOS ELEMENTOS DE VENTA
        // ======================================================================
        //Setear arreglos para Pedido (Elemento Venta)
        $arrayEV  = [];
        $rptaSap  = [];

        //Obtener el numero de Elemento Venta encontrados
        $arraySAPEVPedidoLength = sizeof($request->arraySapEVPedido);
        //Verifica si existen Elemento Venta
        if($arraySAPEVPedidoLength > 0) {
            //Guardar Arreglo de Ele. Venta
            $arraySapEVPedido = $request->arraySapEVPedido;

            $json = [
                'json' => [
                    "nIdEmpresa"        =>  (string)$request->nIdEmpresa,
                    "CardCode"          =>  '',
                    "DocDate"           =>  (string)$request->fDocDate,
                    "DocDueDate"        =>  (string)$request->fDocDueDate,
                    "DocCurrency"       =>  "US$",
                    "SalesPersonCode"   =>  (string)$nSalesEmployeeCode,
                    "U_SYP_MDMT"        =>  "01",
                    "DocumentLines"     =>  array()
                ]
            ];

            //Recorrer todos los Elementos de Venta
            foreach ($arraySapEVPedido as $key => $value) {
                // Setear CardCode
                $json['json']['CardCode'] = $value['cCardCode'];

                // Setear DocumentLines
                $json['json']['DocumentLines'][] = [
                    "ItemCode"          =>  $value['cCodigoERP'],
                    "Quantity"          =>  $value['nCantidad'],
                    "TaxCode"           =>  "IGV",
                    "PriceAfterVAT"     =>  (string)$value['fSubTotalDolares'],
                    "Currency"          =>  "US$",
                    "WarehouseCode"     =>  (string)$value['cWhsCode'],
                    "CostingCode2"      =>  "01", //UnidadDeNegocio
                    "CostingCode3"      =>  (string)$request->nIdSapSucursal
                ];
            }

            $response = $client->request('POST', config('integracion.ruta') . "Pedido/SapSetPedido/", $json);
            $rptaSap = json_decode($response->getBody());
            array_push($arrayEV, $rptaSap);
        }

        return [
            'arrayVehiculo' =>  $arrayVehiculo,
            'arrayEV'       =>  $arrayEV
        ];
    }

    public function SapSetPedidoDscto(Request $request)
    {
        $client = new Client([
            'verify'    => false,
            'base_uri'  => config('integracion.webservice')
        ]);

        $nIdCabeceraPedido  =   $request->nIdCabeceraPedido;
        $data = DB::select('exec [usp_Pedido_GetNumDsctosPedidoHistorial] ?',
                                                            [
                                                                $nIdCabeceraPedido,
                                                            ]);

        $nDocEntryPedido    =   $request->nDocEntryPedido;
        $cCardCode          =   $request->cCardCode;
        $cItemCode          =   $request->cItemCode;
        //Calcular nuevo dscto
        $dMontoNuevoDolares =   $request->dMontoNuevoDolares;
        $dMontoNuevoDolares =   round($dMontoNuevoDolares, 2);
        $dMontoDescontar    =   $request->dMontoDescontar;
        $dFechaModificacion =   $request->dFechaModificacion;


        // Obtener el Total Porcentaje Historico
        $nPorcentajeHistorial   =   $data[0]->nCantPorcentaje;
        // Sumar el Porcentaje Historico + el Porcentaje Enviado
        $nPorcentajeTotal       =   $nPorcentajeHistorial + $dMontoDescontar;

        $json = [
            'json' => [
                "nIdEmpresa"        => (string)$request->nIdEmpresa,
                "DocEntryPedido"    => (string)$nDocEntryPedido,
                "CardCode"          => (string)$cCardCode,
                "DocTotal"          => (string)$dMontoNuevoDolares,
                "Comments"          => (string)$dFechaModificacion,
                "DocumentLines" => [
                    [
                        "DiscountPercent"   => (string)$nPorcentajeTotal
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', config('integracion.ruta') . "Pedido/SapSetPedidoDscto/", $json);
        return $response->getBody();
    }
}
