<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdiProcesoController extends Controller
{
    public function GetListSolicitudByEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdEstadoSolicitud = $request->nidestadosolicitud;
                
        $arraySolicitud = DB::select('exec [usp_Pdi_GetListSolicitudByEstado] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdSucursal,
                                                                        $nIdEstadoSolicitud
                                                                    ]);

        $arraySolicitud = ParametroController::arrayPaginator($arraySolicitud, $request);
        return ['arraySolicitud'=>$arraySolicitud];
    }

    public function GetListCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nOrdenCompra = $request->nordencompra;
        $cNumeroVin = $request->cnumerovin;
        $nIdMarca   = $request->nidmarca;
        $nIdModelo  = $request->nidmodelo;

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = 0) : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = 0) : $nIdModelo;

        $arrayCompra = DB::select('exec [usp_Pdi_GetListCompra] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nOrdenCompra,
                                                                $cNumeroVin,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                            ]);

        $arrayCompra = Parametro::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListSeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;

        $arraySeccion = DB::select('exec [usp_Pdi_GetListSeccion] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arraySeccion);
    }

    public function GetListItem(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
        $nIdFlag = $request->nidflag;
        $nIdFlag = ($nIdFlag == NULL) ? ($nIdFlag = 0) : $nIdFlag;

        $arrayItems = DB::select('exec [usp_Pdi_GetListItem] ?, ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion,
                                                                        $nIdFlag
                                                                    ]);
        return response()->json($arrayItems);
    }

    public function SetCabeceraInspeccion(Request $request)
    {
        
    }

    public function GetLstVehiculoPaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa  = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $cNumeroVehiculo  = $request->cnrovehiculo;
        $nCriterio  = $request->criterio;

        $cNumeroVehiculo  = ($cNumeroVehiculo == NULL) ? ($cNumeroVehiculo = ' ') : $cNumeroVehiculo;

        $arrayVehiculoPlaca = DB::select('exec [usp_Pdi_GetLstVehiculoPaca] ?, ?, ?, ?',
                                                            [
                                                                $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $cNumeroVehiculo,
                                                                $nCriterio
                                                            ]);

        $arrayVehiculoPlaca = Parametro::arrayPaginator($arrayVehiculoPlaca, $request);
        return ['arrayVehiculoPlaca'=>$arrayVehiculoPlaca];
    }

    public function GetListPdi(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nCriterio  = $request->ncriterio;
        $cDescripcionCiterio = $request->cdescripcioncriterio;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdEstadoPdi = $request->nidestadopdi;
        
        $nIdEstadoPdi = ($nIdEstadoPdi == NULL) ? ($nIdEstadoPdi = 0) : $nIdEstadoPdi;

        $arrayPdi = DB::select('exec [usp_Pdi_GetListPdi] ?, ?, ?, ?, ?, ?, ?',
                                                            [   $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nCriterio,
                                                                $cDescripcionCiterio,
                                                                $dFechaInicio,
                                                                $dFechaFin,
                                                                $nIdEstadoPdi
                                                            ]);

        $arrayPdi = Parametro::arrayPaginator($arrayPdi, $request);
        return ['arrayPdi'=>$arrayPdi];
    }

    public function GetDetalleTipoInspeccionById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $nIdEmpresa   = $request->nidempresa;
        $nIdTipoInspeccion = $request->nidtipoinspeccion;
                
        $arrayTipoInspeccion = DB::select('exec [usp_Pdi_GetDetalleTipoInspeccionById] ?, ?', 
                                                                    [   $nIdEmpresa, 
                                                                        $nIdTipoInspeccion
                                                                    ]);

        return response()->json($arrayTipoInspeccion);
    }
}
