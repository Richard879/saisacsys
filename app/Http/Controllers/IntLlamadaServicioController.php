<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IntLlamadaServicioController extends Controller
{
    public function SetIntegraLlamadaServicio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            // ======================================================================
            // GUARDAR LLAMADA DE SERVICIOS DE LA O.V DEL VEHICULO EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcVehiculoLength = sizeof($request->arraySapUpdSgcVehiculo);
            if($arraySapUpdSgcVehiculoLength > 0) {
                $arraySapUpdSgcVehiculo = $request->arraySapUpdSgcVehiculo;
                foreach($arraySapUpdSgcVehiculo as $ep=>$det)
                {
                    $objProyecto = DB::select('exec [usp_Integra_SetIntegraLlamadaServicio] ?, ?, ?, ?, ?, ?',
                                                                [   $det['nServiceCallID'],
                                                                    $det['nActivityCode'],
                                                                    $det['cItemCode'],
                                                                    $det['cInternalSerialNum'],
                                                                    $det['cLogRespuesta'],
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            // ======================================================================
            // GUARDAR LLAMADA DE SERVICIOS DE LA O.V DEL E.V EN SQL SERVER
            // ======================================================================
            $arraySapUpdSgcEVLength = sizeof($request->arraySapUpdSgcEV);
            if($arraySapUpdSgcEVLength > 0) {
                $arraySapUpdSgcEV = $request->arraySapUpdSgcEV;
                foreach($arraySapUpdSgcEV as $ep=>$det)
                {
                    $objProyecto = DB::select('exec [usp_Integra_SetIntegraLlamadaServicio] ?, ?, ?, ?, ?, ?',
                                                                [   $det['nServiceCallID'],
                                                                    $det['nActivityCode'],
                                                                    $det['cItemCode'],
                                                                    $det['cInternalSerialNum'],
                                                                    $det['cLogRespuesta'],
                                                                    Auth::user()->id
                                                                ]);
                }
            }

            DB::commit();
            return response()->json($objProyecto);
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
