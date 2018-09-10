<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ParametroController as Parametro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class VendedorLineaController extends Controller
{
    public function GetLstVendedorLinea(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdProveedor = $request->nidproveedor;
        $nIdLinea = $request->nidlinea;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;
        $nIdJefeVentas = $request->nidjefeventas;
        $arrayVendedorLinea = DB::select('exec usp_AsigVendedorModelo_GetListVendedoresAsignados ?, ?, ?, ?, ?, ?, ?',
                                                            array($nIdEmpresa,
                                                                  $nIdSucursal,
                                                                  $nIdProveedor, 
                                                                  $nIdLinea,
                                                                  $nIdMarca,
                                                                  $nIdModelo,
                                                                  $nIdJefeVentas));

        $arrayVendedorLinea = ParametroController::arrayPaginator($arrayVendedorLinea, $request);
        return ['arrayVendedorLinea'=>$arrayVendedorLinea];
    }
    public function SetVendedorLineaAsignar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $vendedorlinea = DB::select('exec [usp_LineaVendedor_SetAsignar] ?, ?, ?, ?, ?, ?, ?, ?',
                                                            array($request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdProveedor,
                                                                    $request->nIdVendedor,
                                                                    $request->nIdLinea,
                                                                    $request->nIdMarca,
                                                                    $request->nIdModelo,
                                                                    Auth::user()->id
                                                                    ));
        return response()->json($vendedorlinea);
    }
    public function SetVendedorLineaDesignar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $vendedorlinea = DB::select('exec [usp_LineaVendedor_SetDesignar] ?',
                                                            array($request->nIdAsignacion));
        return response()->json($vendedorlinea);
    }
}