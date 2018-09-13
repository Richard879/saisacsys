<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ParametroController as Parametro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ObjComercialController extends Controller
{
    public function getCompraActiva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_Cronog_GetCompraActivo');

        return response()->json($data);
    }

    public function getVentaActiva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $data = DB::select('exec usp_Cronog_GetVentaActivo');

        return response()->json($data);
    }

    public function GetLstTipoBeneficio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdGrupoPar = $request->nidgrupopar;
        $ctipobeneficionombre = $request->ctipobeneficionombre;
        $variable   = $request->opcion;

        $ctipobeneficionombre = ($ctipobeneficionombre == NULL) ? ($ctipobeneficionombre = ' ') : $ctipobeneficionombre;

        $parametro = DB::select('exec usp_TipoBeneficio_GetLstTipoBeneficio ?, ?, ?',
                                                            array($nIdEmpresa, $nIdGrupoPar, $ctipobeneficionombre));

        $parametro = ParametroController::arrayPaginator($parametro, $request);
        return ['arrayTipoIncentivo'=>$parametro];
    }

    public function GetDetalleVehiculoCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nIdProveedor = $request->nidproveedor;
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;

        $data = DB::select('exec usp_ObjComercial_GetDetalleVehiculoCompra ?, ?, ?, ?, ?, ?, ?',
                                                             [  $nIdEmpresa,
                                                                $nIdSucursal,
                                                                $nIdCronograma,
                                                                $nIdProveedor,
                                                                $nIdLinea,
                                                                $nIdMarca,
                                                                $nIdModelo
                                                             ]);
        return response()->json($data);
    }

    public function SetRegistrarObjComercialCompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa             = $request->nIdEmpresa;
        $nIdSucursal            = $request->nIdSucursal;
        $nIdProveedor           = $request->nIdProveedor;
        $nIdCronograma          = $request->nIdCronograma;
        $cFlagTipoOperacion     = $request->cFlagTipoOperacion;
        $cFlagTipoBeneficio     = $request->cFlagTipoBeneficio;
        $cFlagTipoValor         = $request->cFlagTipoValor;
        $fValorPorcentual       = $request->fValorPorcentual;
        $fValorMoneda           = $request->fValorMoneda;
        $data                   = $request->arrayData;

        $cFlagTipoValor         = ($cFlagTipoValor) == null ? " " : $cFlagTipoValor;

        try{
            DB::beginTransaction();
            $arrayDetalleVehiculoLength = sizeof($data);
            if($arrayDetalleVehiculoLength > 0){
                foreach ($data as $key => $value) {
                    if($value['cantidad'] > 0){
                        DB::select('exec usp_ObjComercial_SetRegistrarCompra ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                [
                                    $nIdEmpresa,
                                    $nIdSucursal,
                                    $nIdProveedor,
                                    $nIdCronograma,
                                    $value['nIdVersionVeh'],
                                    $cFlagTipoOperacion,
                                    $value['cantidad'],
                                    $cFlagTipoBeneficio,
                                    $cFlagTipoValor,
                                    $fValorPorcentual,
                                    $fValorMoneda,
                                    Auth::user()->id
                                ]);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
