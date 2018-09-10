<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ParametroController as Parametro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function GetLstCotizacionIngresadas(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $dFechaInicio = $request->dfechainicio;
        $dFechaFin = $request->dfechafin;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;

        $arrayPedido = DB::select('exec usp_Pedido_GetLstCotizacionIngresadas ?, ?, ?, ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $dFechaInicio,
                                                                    $dFechaFin,
                                                                    $nIdMarca,
                                                                    $nIdModelo,
                                                                    Auth::user()->id
                                                                    ));

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetLstCompraByIdModelo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCabeceraCotizacion = $request->nidcabeceracotizacion;
        $cNumeroVin = $request->cnumerovin;

        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = ' ') : $cNumeroVin;

        $arrayCompra = DB::select('exec usp_Pedido_GetLstCompraByIdModelo ?, ?, ?, ?',
                                                            array(  $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdCabeceraCotizacion,
                                                                    $cNumeroVin
                                                                    ));

        $arrayCompra = ParametroController::arrayPaginator($arrayCompra, $request);
        return ['arrayCompra'=>$arrayCompra];
    }

    public function GetListaPrecioDetalleByIdCotizacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCabeceraCotizacion = $request->nidcabeceracotizacion;

        $objListaDetalle = DB::select('exec usp_Pedido_GetListaPrecioDetalleByIdCotizacion ?, ?, ?',
                                                                            array(  $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCabeceraCotizacion
                                                                                    ));
        return response()->json($objListaDetalle);
    }

    public function GetLstPedidosPendienteAprobacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidempresa    =   $request->nidempresa;
        $nidsucursal   =   $request->nidsucursal;
        $nidmarca      =   $request->nidmarca;
        $nidmodelo     =   $request->nidmodelo;
        $dfechainicio  =   $request->dfechainicio;
        $dfechafin     =   $request->dfechafin;

        $dfechainicio = ($dfechainicio == NULL) ? ($dfechainicio = '') : $dfechainicio;
        $dfechafin = ($dfechafin == NULL) ? ($dfechafin = '') : $dfechafin;

        $arrayPedido = DB::select('exec usp_Pedido_GetLstPedidosPendienteAprobacion ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidempresa, $nidsucursal,
                                        $nidmarca, $nidmodelo,
                                        $dfechainicio, $dfechafin, Auth::user()->id
                                    ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function SetAprobarPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidpedido  =  $request->nidpedido;

        $arrayPedido = DB::select('exec usp_Pedido_SetAprobarPedido ?', [$nidpedido]);
        return response()->json($arrayPedido);
    }

    public function SetCabeceraPedido(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPedido = DB::select('exec usp_Pedido_SetGenerarPedidoByVendedor ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $request->nIdEmpresa,
                                        $request->nIdSucursal,
                                        $request->nIdCabeceraCotizacion,
                                        $request->nIdCompra,
                                        $request->cNumeroPedido,
                                        $request->dFechaPedido,
                                        $request->nIdFormaPago,
                                        $request->cGlosa,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPedido);
    }

    public function subirArchivo(Request $request)
    {
        try{
            DB::beginTransaction();

            $nameFile = $request->file;
            $data = $request->data;

            foreach($nameFile as $key=> $file){

                if($file){

                    $bandera = str_random(10);

                    $ruta = Storage::putFileAs('uploads/Pedido', $file, $bandera .'_'. $file->getClientOriginalName());

                    $arrayDocumento = DB::select('exec usp_Pedido_SetDocumentoAdjunto ?, ?, ?',
                                                                    [  asset($ruta),
                                                                        $file->getClientOriginalName(),
                                                                        Auth::user()->id
                                                                    ]);

                    $nIdDocumentoAdjunto =  $arrayDocumento[0]->nIdDocumentoAdjunto;

                    foreach($data as $datakey=> $valorparametro)
                    {
                        if($datakey == $key)
                        {
                            //print_r($datakey . ' = ' . $key);
                            $nIdTablaDocumento = $valorparametro['%22nIdPar%22'];
                            $nIdCabeceraPedido = $valorparametro['%22nIdCabeceraPedido%22'];
                        }

                    }

                    DB::select('exec usp_Pedido_SetDocumentoAdjuntoPedido ?, ?, ?, ?',
                                                                        [   $nIdCabeceraPedido,
                                                                            $nIdTablaDocumento,
                                                                            $nIdDocumentoAdjunto,
                                                                            Auth::user()->id
                                                                        ]);


                }



            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }

    }

    public function GetListPedidoByTipoEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $dFechaInicio   =   $request->dfechainicio;
        $dFechaFin      =   $request->dfechafin;
        $cNumeroPedido  =   $request->cnumeropedido;
        $cNumeroVin     =   $request->cnumerovin;
        $nIdMarca       =   $request->nidmarca;
        $nIdModelo      =   $request->nidmodelo;
        $nIdEstadoPedido  = $request->nidestadopedido;

        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayPedido = DB::select('exec usp_Pedido_GetListPedidoByTipoEstado ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa, $nIdSucursal, $dFechaInicio, $dFechaFin,
                                        $cNumeroPedido, $cNumeroVin,
                                        $nIdMarca, $nIdModelo,
                                        $nIdEstadoPedido, Auth::user()->id
                                    ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }

    public function GetListPedidoAprobados(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa     =   $request->nidempresa;
        $nIdSucursal    =   $request->nidsucursal;
        $dFechaInicio   =   $request->dfechainicio;
        $dFechaFin      =   $request->dfechafin;
        $cNumeroPedido  =   $request->cnumeropedido;
        $cNumeroVin     =   $request->cnumerovin;
        $nIdMarca       =   $request->nidmarca;
        $nIdModelo      =   $request->nidmodelo;
        $nIdEstadoPedido  = $request->nidestadopedido;

        $dFechaInicio = ($dFechaInicio == NULL) ? ($dFechaInicio = '') : $dFechaInicio;
        $dFechaFin = ($dFechaFin == NULL) ? ($dFechaFin = '') : $dFechaFin;
        $cNumeroPedido = ($cNumeroPedido == NULL) ? ($cNumeroPedido = '') : $cNumeroPedido;
        $cNumeroVin = ($cNumeroVin == NULL) ? ($cNumeroVin = '') : $cNumeroVin;

        $arrayPedido = DB::select('exec usp_Pedido_GetListPedidoAprobados ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nIdEmpresa, $nIdSucursal, $dFechaInicio, $dFechaFin,
                                        $cNumeroPedido, $cNumeroVin,
                                        $nIdMarca, $nIdModelo,
                                        $nIdEstadoPedido, Auth::user()->id
                                    ]);

        $arrayPedido = ParametroController::arrayPaginator($arrayPedido, $request);
        return ['arrayPedido'=>$arrayPedido];
    }
}
