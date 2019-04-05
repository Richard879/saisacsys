<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaestroVehiculoController extends Controller
{
    public function SetRegistrarVehiculoPlaca(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidvehiculo            =   $request->fillNuevoVehiculo['nidvehiculo'];
        $cnroplaca              =   $request->fillNuevoVehiculo['cnroplaca'];
        $cnrotarjetapropiedad   =   $request->fillNuevoVehiculo['cnrotarjetapropiedad'];
        $nidclase               =   $request->fillNuevoVehiculo['nidclase'];
        $nidmarca               =   $request->fillNuevoVehiculo['nidmarca'];
        $nidmodelo              =   $request->fillNuevoVehiculo['nidmodelo'];
        $nidcolor               =   $request->fillNuevoVehiculo['nidcolor'];
        $nidaniofabricacion     =   $request->fillNuevoVehiculo['nidaniofabricacion'];
        $nidcombustible         =   $request->fillNuevoVehiculo['nidcombustible'];
        $dfechaventa            =   $request->fillNuevoVehiculo['dfechaventa'];
        $cnromotor              =   $request->fillNuevoVehiculo['cnromotor'];
        $cnroserie              =   $request->fillNuevoVehiculo['cnroserie'];
        $cnrocilindros          =   $request->fillNuevoVehiculo['cnrocilindros'];
        $cnrorueda              =   $request->fillNuevoVehiculo['cnrorueda'];
        $cnropasajeros          =   $request->fillNuevoVehiculo['cnropasajeros'];
        $cnroasiento            =   $request->fillNuevoVehiculo['cnroasiento'];
        $cpesoseco              =   $request->fillNuevoVehiculo['fpesoseco'];
        $cpesobruto             =   $request->fillNuevoVehiculo['fpesobruto'];
        $clongitud              =   $request->fillNuevoVehiculo['flongitud'];
        $caltura                =   $request->fillNuevoVehiculo['faltura'];
        $cancho                 =   $request->fillNuevoVehiculo['fancho'];
        $ccargautil             =   $request->fillNuevoVehiculo['fcargautil'];

        $nidvehiculo            = ($nidvehiculo == NULL)   ? ($nidvehiculo = ' ') : $nidvehiculo;
        $cnroplaca              = ($cnroplaca == NULL)              ? ($cnroplaca = ' ') : $cnroplaca;
        $cnrotarjetapropiedad   = ($cnrotarjetapropiedad == NULL)   ? ($cnrotarjetapropiedad = ' ') : $cnrotarjetapropiedad;
        $nidclase               = ($nidclase == NULL)       ? ($nidclase = ' ')         : $nidclase;
        $nidmarca               = ($nidmarca == NULL)       ? ($nidmarca = ' ')         : $nidmarca;
        $nidmodelo              = ($nidmodelo == NULL)      ? ($nidmodelo = ' ')        : $nidmodelo;
        $nidcolor               = ($nidcolor == NULL)       ? ($nidcolor = ' ')         : $nidcolor;
        $nidcombustible         = ($nidcombustible == NULL) ? ($nidcombustible = ' ')   : $nidcombustible;
        $dfechaventa            = ($dfechaventa == NULL)    ? ($dfechaventa = ' ')      : $dfechaventa;
        $cnromotor              = ($cnromotor == NULL)      ? ($cnromotor = ' ')        : $cnromotor;
        $cnroserie              = ($cnroserie == NULL)      ? ($cnroserie = ' ')        : $cnroserie;
        $cnrocilindros          = ($cnrocilindros == NULL)  ? ($cnrocilindros = ' ')    : $cnrocilindros;
        $cnrorueda              = ($cnrorueda == NULL)      ? ($cnrorueda = ' ')        : $cnrorueda;
        $cnropasajeros          = ($cnropasajeros == NULL)  ? ($cnropasajeros = ' ')    : $cnropasajeros;
        $cnroasiento            = ($cnroasiento == NULL)    ? ($cnroasiento = ' ')      : $cnroasiento;
        $cpesoseco              = ($cpesoseco == NULL)      ? ($cpesoseco = ' ')        : $cpesoseco;
        $cpesobruto             = ($cpesobruto == NULL)     ? ($cpesobruto = ' ')       : $cpesobruto;
        $clongitud              = ($clongitud == NULL)      ? ($clongitud = ' ')        : $clongitud;
        $caltura                = ($caltura == NULL)        ? ($caltura = ' ')          : $caltura;
        $cancho                 = ($cancho == NULL)         ? ($cancho = ' ')           : $cancho;
        $ccargautil             = ($ccargautil == NULL)     ? ($ccargautil = ' ')       : $ccargautil;

        $nFlagEditar = $request->nFlagEditar;

        $arrayVehiculoPlaca = DB::select('exec [usp_MaestroVehiculo_SetVehiculoPlaca]
                                                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        NULL,
                                        NULL,
                                        $nidvehiculo,
                                        $cnroplaca,
                                        $cnrotarjetapropiedad,
                                        $nidclase,
                                        $nidmarca,
                                        $nidmodelo,
                                        $nidcolor,
                                        $nidaniofabricacion,
                                        $nidcombustible,
                                        $dfechaventa,
                                        $cnromotor,
                                        $cnroserie,
                                        $cnrocilindros,
                                        $cnrorueda,
                                        $cnropasajeros,
                                        $cnroasiento,
                                        $cpesoseco,
                                        $cpesobruto,
                                        $clongitud,
                                        $caltura,
                                        $cancho,
                                        $ccargautil,
                                        $nFlagEditar,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayVehiculoPlaca);
    }

    public function SetRegistrarPerNatural(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidpersona             =   $request->fillPropietario['nidpersona'];
        $ntpodocumento          =   $request->fillPropietario['ntpodocumento'];
        $cnrodocumento          =   $request->fillPropietario['cnrodocumento'];
        $cnombre                =   $request->fillPropietario['cnombre'];
        $capepaterno            =   $request->fillPropietario['capepaterno'];
        $capematerno            =   $request->fillPropietario['capematerno'];
        $ccode                  =   $request->fillPropietario['ccode'];
        $cdireccion             =   $request->fillPropietario['cdireccion'];
        $cmailprincipal         =   $request->fillPropietario['cmailprincipal'];
        $cmailalternativo       =   $request->fillPropietario['cmailalternativo'];
        $dfecnacimiento         =   $request->fillPropietario['dfecnacimiento'];
        $nestadocivil           =   $request->fillPropietario['nestadocivil'];
        $ctelefonofijo          =   $request->fillPropietario['ctelefonofijo'];
        $ncelular               =   $request->fillPropietario['ncelular'];
        $ncelularalternativo    =   $request->fillPropietario['ncelularalternativo'];
        $ccentrolaboral         =   $request->fillPropietario['ccentrolaboral'];
        $nprofesion             =   $request->fillPropietario['nprofesion'];
        $cnrolicencia           =   $request->fillPropietario['cnrolicencia'];

        $nidpersona             = ($nidpersona == NULL) ? ($nidpersona = ' ') : $nidpersona;
        $ntpodocumento          = ($ntpodocumento == NULL) ? ($ntpodocumento = ' ') : $ntpodocumento;
        $cnrodocumento          = ($cnrodocumento == NULL) ? ($cnrodocumento = ' ') : $cnrodocumento;
        $cnombre                = ($cnombre == NULL) ? ($cnombre = ' ') : $cnombre;
        $capepaterno            = ($capepaterno == NULL) ? ($capepaterno = ' ') : $capepaterno;
        $capematerno            = ($capematerno == NULL) ? ($capematerno = ' ') : $capematerno;
        $ccode                  = ($ccode == NULL) ? ($ccode = ' ') : $ccode;
        $cdireccion             = ($cdireccion == NULL) ? ($cdireccion = ' ') : $cdireccion;
        $cmailprincipal         = ($cmailprincipal == NULL) ? ($cmailprincipal = ' ') : $cmailprincipal;
        $cmailalternativo       = ($cmailalternativo == NULL) ? ($cmailalternativo = ' ') : $cmailalternativo;
        $dfecnacimiento         = ($dfecnacimiento == NULL) ? ($dfecnacimiento = ' ') : $dfecnacimiento;
        $nestadocivil           = ($nestadocivil == NULL) ? ($nestadocivil = ' ') : $nestadocivil;
        $ctelefonofijo          = ($ctelefonofijo == NULL) ? ($ctelefonofijo = ' ') : $ctelefonofijo;
        $ncelular               = ($ncelular == NULL) ? ($ncelular = ' ') : $ncelular;
        $ncelularalternativo    = ($ncelularalternativo == NULL) ? ($ncelularalternativo = ' ') : $ncelularalternativo;
        $ccentrolaboral         = ($ccentrolaboral == NULL) ? ($ccentrolaboral = ' ') : $ccentrolaboral;
        $nprofesion             = ($nprofesion == NULL) ? ($nprofesion = ' ') : $nprofesion;
        $cnrolicencia           = ($cnrolicencia == NULL) ? ($cnrolicencia = ' ') : $cnrolicencia;


        $nIdVehiculoPlaca   = $request->nIdVehiculoPlaca;
        $nFlagEditar        = $request->nFlagEditar;

        $arrayPropietario = DB::select('exec [usp_MaestroVehiculo_SetPersonaNatural]
                                                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                [
                                                    $nidpersona,
                                                    $ntpodocumento,
                                                    trim($cnrodocumento),
                                                    $cnombre,
                                                    $capepaterno,
                                                    $capematerno,
                                                    $ccode,
                                                    $cdireccion,
                                                    $cmailprincipal,
                                                    $cmailalternativo,
                                                    $dfecnacimiento,
                                                    $nestadocivil,
                                                    $ctelefonofijo,
                                                    $ncelular,
                                                    $ncelularalternativo,
                                                    $ccentrolaboral,
                                                    $nprofesion,
                                                    $cnrolicencia,
                                                    $nIdVehiculoPlaca,
                                                    $nFlagEditar,
                                                    Auth::user()->id
                                                ]);
        return response()->json($arrayPropietario);
    }

    public function SetRegistrarPerJuridica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nidpersona             =   $request->fillPropietario['nidpersona'];
        $cnrodocumento          =   $request->fillPropietario['cnrodocumento'];
        $cnombre                =   $request->fillPropietario['cnombre'];
        $ccode                  =   $request->fillPropietario['ccode'];
        $cdireccion             =   $request->fillPropietario['cdireccion'];
        $cmailprincipal         =   $request->fillPropietario['cmailprincipal'];
        $cmailalternativo       =   $request->fillPropietario['cmailalternativo'];
        $ctelefonofijo          =   $request->fillPropietario['ctelefonofijo'];
        $ncelular               =   $request->fillPropietario['ncelular'];
        $ncelularalternativo    =   $request->fillPropietario['ncelularalternativo'];

        $nidpersona             = ($nidpersona == NULL) ? ($nidpersona = ' ') : $nidpersona;
        $cnrodocumento          = ($cnrodocumento == NULL) ? ($cnrodocumento = ' ') : $cnrodocumento;
        $cnombre                = ($cnombre == NULL) ? ($cnombre = ' ') : $cnombre;
        $ccode                  = ($ccode == NULL) ? ($ccode = ' ') : $ccode;
        $cdireccion             = ($cdireccion == NULL) ? ($cdireccion = ' ') : $cdireccion;
        $cmailprincipal         = ($cmailprincipal == NULL) ? ($cmailprincipal = ' ') : $cmailprincipal;
        $cmailalternativo       = ($cmailalternativo == NULL) ? ($cmailalternativo = ' ') : $cmailalternativo;
        $ctelefonofijo          = ($ctelefonofijo == NULL) ? ($ctelefonofijo = ' ') : $ctelefonofijo;
        $ncelular               = ($ncelular == NULL) ? ($ncelular = ' ') : $ncelular;
        $ncelularalternativo    = ($ncelularalternativo == NULL) ? ($ncelularalternativo = ' ') : $ncelularalternativo;

        $nIdVehiculoPlaca   = $request->nIdVehiculoPlaca;
        $nFlagEditar        = $request->nFlagEditar;

        $arrayPropietario = DB::select('exec [usp_MaestroVehiculo_SetPerJuridica] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $nidpersona,
                                        trim($cnrodocumento),
                                        $cnombre,
                                        $ccode,
                                        $cdireccion,
                                        $cmailprincipal,
                                        $cmailalternativo,
                                        $ctelefonofijo,
                                        $ncelular,
                                        $ncelularalternativo,
                                        $nIdVehiculoPlaca,
                                        $nFlagEditar,
                                        Auth::user()->id
                                    ]);

        return response()->json($arrayPropietario);
    }

    public function SetRegistrarSoat(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arraySOAT          = $request->arraySOAT;
        $fillProveedor      = $request->fillProveedor;
        $nIdVehiculoPlaca   = $request->nIdVehiculoPlaca;
        $nFlagEditar        = $request->nFlagEditar;

        try{
            DB::beginTransaction();
            $arraySOATLength = sizeof($arraySOAT);
            if($arraySOATLength > 0){
                foreach ($arraySOAT as $key => $value) {
                    $arraySoat = DB::select('exec usp_MaestroVehiculo_SetSoat ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                    [
                                        $value['nidsoat'],
                                        $value['csoat'],
                                        $nIdVehiculoPlaca,
                                        $fillProveedor['nidproveedor'],
                                        $value['dfechainicio'],
                                        $value['dfechafin'],
                                        $value['nidestado'],
                                        $nFlagEditar,
                                        Auth::user()->id
                                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetDetalleMaestroVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;
        $nIdMarca = $request->nidmarca;
        $nIdModelo = $request->nidmodelo;
        $nIdAnioFabricacion = $request->nidaniofabricacion;
        $dFechaVenta = $request->dfechaventa;
        $nIdVendedor = Auth::user()->id;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;
        $nIdMarca = ($nIdMarca == NULL) ? ($nIdMarca = ' ') : $nIdMarca;
        $nIdModelo = ($nIdModelo == NULL) ? ($nIdModelo = ' ') : $nIdModelo;
        $nIdAnioFabricacion = ($nIdAnioFabricacion == NULL) ? ($nIdAnioFabricacion = ' ') : $nIdAnioFabricacion;
        $dFechaVenta = ($dFechaVenta == NULL) ? ($dFechaVenta = ' ') : $dFechaVenta;

        $arrayVehiculo = DB::select('exec usp_MaestroVehiculo_GetDetalleMaestroVehiculo ?, ?, ?, ?, ?, ?, ?, ?',
                                                                        [
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            $nIdMarca,
                                                                            $nIdModelo,
                                                                            $nIdAnioFabricacion,
                                                                            $dFechaVenta,
                                                                            $nIdVendedor
                                                                        ]);

        $arrayVehiculo = ParametroController::arrayPaginator($arrayVehiculo, $request);
        return ['arrayVehiculo'=>$arrayVehiculo];
    }

    public function SetRegistrarPropietario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayPropietario = DB::select('exec [usp_MaestroVehiculo_SetPropietarioVehiculo]  ?, ?, ?, ?, ?, ?',
                                                [   $request->cFlagTipoPersona,
                                                    $request->nIdPersonaNatural,
                                                    $request->nIdPersonaJuridica,
                                                    $request->nIdVehiculoPlaca,
                                                    $request->nFlagEditar,
                                                    Auth::user()->id
                                                ]);
        return response()->json($arrayPropietario);
    }
}
