<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ParametroController as Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GestionContactoController extends Controller
{
    public function SetContactoPerNatural(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetPerNaturalContacto] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdTipoDocumento,
                                                                $request->cNumeroDocumento,
                                                                $request->cNombre,
                                                                $request->cApellidoPaterno,
                                                                $request->cApellidoMaterno,
                                                                $request->cUbigeo,
                                                                $request->cDireccion,
                                                                $request->cEmail,
                                                                $request->cEmailAlternativo,
                                                                $request->dFechaNacimiento,
                                                                $request->nIdEstadoCivil,
                                                                $request->cTelefonoFijo,
                                                                $request->nTelefonoMovil,
                                                                $request->nTelefonoMovilAlternativo,
                                                                $request->cCentroLaboral,
                                                                $request->nIdProfesion,
                                                                Auth::user()->id
                                                            ]);

        return response()->json($arrayContacto);
    }

    public function SetContactoPerJuridica(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetPerJuridicaContacto] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                                [   $request->cRuc,
                                                                    $request->cRazonSocial,
                                                                    $request->cUbigeo,
                                                                    $request->cDireccion,
                                                                    $request->cEmail,
                                                                    $request->cEmailAlternativo,
                                                                    $request->cTelefonoFijo,
                                                                    $request->nTelefonoMovil,
                                                                    $request->nTelefonoMovilAlternativo,
                                                                    //Datos Contacto
                                                                    $request->nIdTipoDocumentoContacto,
                                                                    $request->cNumeroDocumentoContacto,
                                                                    $request->cNombreContacto,
                                                                    $request->cApellidoPaternoContacto,
                                                                    $request->cApellidoMaternoContacto,
                                                                    $request->cEmailPrincipalContacto,
                                                                    $request->cTelefonoMovilContacto,
                                                                    Auth::user()->id
                                                                ]);

        return response()->json($arrayContacto);
    }

    public function SetContactoRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec [usp_Contacto_SetReferenciaVehiculo] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [   $request->nIdEmpresa,
                                                                $request->nIdSucursal,
                                                                $request->nIdCronograma,
                                                                $request->nIdContacto,
                                                                $det['nIdProveedor'],
                                                                $det['nIdLinea'],
                                                                $det['nIdMarca'],
                                                                $det['nIdModelo'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioModelo'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function SetContactoSegRefVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec [usp_Contacto_SetReferenciaVehiculo] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                        [   $request->nIdEmpresa,
                                                            $request->nIdSucursal,
                                                            $request->nIdCronograma,
                                                            $request->nIdContacto,
                                                            $request->nIdProveedor,
                                                            $request->nIdLinea,
                                                            $request->nIdMarca,
                                                            $request->nIdModelo,
                                                            $request->nAnioFabricacion,
                                                            $request->nAnioModelo,
                                                            Auth::user()->id
                                                        ]);
        return response()->json($arrayContacto);
    }

    public function GetListContactoBySinCarteraMes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContacto = DB::select('exec [usp_Contacto_GetListContactoBySinCarteraMes] ?, ?, ?, ?, ?, ?, ?',
                                                                                [   $nIdEmpresa,
                                                                                    $nIdSucursal,
                                                                                    $nIdCronograma,
                                                                                    $nTipoPersona,
                                                                                    $cNroDocumento,
                                                                                    $cFiltroDescripcion,
                                                                                    Auth::user()->id
                                                                                ]);

        $arrayContacto = ParametroController::arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function SetContactoCarteraMes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayContacto = DB::select('exec usp_Contacto_SetContactoCarteraMes ?, ?, ?',
                                                            array(  $request->nIdCronograma,
                                                                    $request->nIdContacto,
                                                                    Auth::user()->id
                                                                    ));

        return response()->json($arrayContacto);
    }

    public function GetCarteraMesByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContactoCarteraMes = DB::select('exec usp_Contacto_GetContactoCarteraMes ?, ?, ?, ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdCronograma,
                                                                                $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                Auth::user()->id
                                                                                ));

        $arrayContactoCarteraMes = ParametroController::arrayPaginator($arrayContactoCarteraMes, $request);
        return ['arrayContactoCarteraMes'=>$arrayContactoCarteraMes];
    }

    public function GetContactoNaturalById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto = $request->nidcontacto;
        $nIdPersonaNatural = $request->nidpersonanatural;

        $contacto = DB::select('exec usp_Contacto_GetContactoNaturalById ?, ?',
                                                                        array(  $nIdContacto,
                                                                                $nIdPersonaNatural
                                                                                ));

        return response()->json($contacto);
    }

    public function GetContactoJuridicoById(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto = $request->nidcontacto;
        $nIdPersonaJuridico = $request->nidpersonajuridico;

        $contacto = DB::select('exec usp_Contacto_GetContactoJuridicoById ?, ?',
                                                                        array(  $nIdContacto,
                                                                                $nIdPersonaJuridico
                                                                                ));

        return response()->json($contacto);
    }

    public function GetRefVehiculoByContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec usp_Contacto_GetRefVehiculoByContacto ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                Auth::user()->id
                                                                                ));

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    public function SetSeguimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arraySeguimiento = DB::select('exec [usp_Contacto_SetSeguimiento] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            array(  $request->cFlagOrigenSeguimiento,
                                                                    $request->nIdAsignacionContactoVendedor,
                                                                    $request->nIdZona,
                                                                    $request->nIdTipoSeguimiento,
                                                                    $request->nIdFormaPago,
                                                                    $request->nIdEstadoSeguimiento,
                                                                    $request->dFechaSeguimientoVendedor,
                                                                    $request->cHoraSeguimiento,
                                                                    $request->cAsunto,
                                                                    $request->cRendirSeguimiento,
                                                                    Auth::user()->id
                                                                ));

        return response()->json($arraySeguimiento);
    }

    public function GetListSeguimientoByIdAsignacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdAsignacionContactoVendedor = $request->nidasignacioncontactovendedor;

        $arraySeguimiento = DB::select('exec [usp_Contacto_GetListSeguimientoByIdAsignacion] ?',
                                                            [  $nIdAsignacionContactoVendedor
                                                            ]);

        $arraySeguimiento = ParametroController::arrayPaginator($arraySeguimiento, $request);
        return ['arraySeguimiento'=>$arraySeguimiento];
    }

    public function GetListContactosLibres(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;
        $nTipoContacto = $request->ntipocontacto;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContactoLibre = DB::select('exec usp_Contacto_GetListContactosLibres ?, ?, ?, ?',
                                                                        array(  $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                $nTipoContacto
                                                                                ));

        $arrayContactoLibre = ParametroController::arrayPaginator($arrayContactoLibre, $request);
        return ['arrayContactoLibre'=>$arrayContactoLibre];
    }

    public function GetListReferenciaVehiculoLibre(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdContacto = $request->nidcontacto;

        $arrayReferenciaLibre = DB::select('exec usp_Contacto_GetListReferenciaVehiculoLibre ?',
                                                                        array(  $nIdContacto
                                                                                ));

        $arrayReferenciaLibre = ParametroController::arrayPaginator($arrayReferenciaLibre, $request);
        return ['arrayReferenciaLibre'=>$arrayReferenciaLibre];
    }

    public function SetAsignaReferenciaLibre(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayRefLibre = DB::select('exec usp_Contacto_SetAsignaReferenciaLibre ?, ?, ?, ?, ?, ?',
                                                            array(  $request->nIdReferenciaVehiculoContacto,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdCronograma,
                                                                    $request->nIdVendedor,
                                                                    Auth::user()->id
                                                                    ));

        return response()->json($arrayRefLibre);
    }

    public function GetRefVehiculoByContactoPorReasignar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;
        $nIdVendedor = $request->nidvendedor;

        $arrayReasignarReferencia = DB::select('exec usp_Contacto_GetRefVehiculoByContacto ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto,
                                                                                $nIdVendedor
                                                                                ));

        $arrayReasignarReferencia = ParametroController::arrayPaginator($arrayReasignarReferencia, $request);
        return ['arrayReasignarReferencia'=>$arrayReasignarReferencia];
    }

    public function UpdReasignarReferenciaVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $arrayReasignarRef = DB::select('exec usp_Contacto_UpdReasignarReferenciaVehiculo ?, ?, ?, ?, ?, ?',
                                                            array(  $request->nIdReferenciaVehiculoContacto,
                                                                    $request->nIdEmpresa,
                                                                    $request->nIdSucursal,
                                                                    $request->nIdCronograma,
                                                                    $request->nIdVendedor,
                                                                    Auth::user()->id
                                                                    ));

        return response()->json($arrayReasignarRef);
    }

    //Acciones Mis Contactos
    public function GetListContactoByJFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;

        $arrayContacto = DB::select('exec usp_Contacto_GetListContactoByJFV ?, ?, ?, ?, ?, ?, ?',
                                                                    array(  $nIdEmpresa,
                                                                            $nIdSucursal,
                                                                            $nIdCronograma,
                                                                            $nTipoPersona,
                                                                            $cNroDocumento,
                                                                            $cFiltroDescripcion,
                                                                            Auth::user()->id
                                                                    ));

        $arrayContacto = ParametroController::arrayPaginator($arrayContacto, $request);
        return ['arrayContacto'=>$arrayContacto];
    }

    public function GetListContactoByVendedor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdCronograma = $request->nidcronograma;
        $nTipoPersona = $request->ntipopersona;
        $cNroDocumento = $request->cnrodocumento;
        $cFiltroDescripcion = $request->cfiltrodescripcion;
        $nIdVendedor = $request->nidvendedor;

        $cNroDocumento = ($cNroDocumento == NULL) ? ($cNroDocumento = ' ') : $cNroDocumento;
        $cFiltroDescripcion = ($cFiltroDescripcion == NULL) ? ($cFiltroDescripcion = ' ') : $cFiltroDescripcion;
        $nIdVendedor = ($nIdVendedor == NULL) ? ($nIdVendedor = Auth::user()->id) : $nIdVendedor;

        $arrayContactosPorVendedor = DB::select('exec usp_Contacto_GetListContactoByVendedor ?, ?, ?, ?, ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdCronograma,
                                                                                $nTipoPersona,
                                                                                $cNroDocumento,
                                                                                $cFiltroDescripcion,
                                                                                $nIdVendedor
                                                                                ));

        $arrayContactosPorVendedor = ParametroController::arrayPaginator($arrayContactosPorVendedor, $request);
        return ['arrayContactosPorVendedor'=>$arrayContactosPorVendedor];
    }

    public function GetListVendedoresByJFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cNombreVendedor = $request->cnombrevendedor;

        $cNombreVendedor = ($cNombreVendedor == NULL) ? ($cNombreVendedor = ' ') : $cNombreVendedor;

        $arrayVendedor = DB::select('exec usp_Contacto_GetListVendedoresByJFV ?, ?',
                                                                        array(  $cNombreVendedor,
                                                                                Auth::user()->id
                                                                                ));

        $arrayVendedor = ParametroController::arrayPaginator($arrayVendedor, $request);
        return ['arrayVendedor'=>$arrayVendedor];
    }

    public function UpdReasignarContacto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $idasignacion   =   $request->asigcontactvendedor;
        $idvendedor     =   $request->vendedor;
        $idusuario      =   Auth::user()->id;

        $data = DB::select('exec usp_Contacto_UpdReasignarContacto ?, ?, ?',
                                                            array(  $idasignacion,
                                                                    $idvendedor,
                                                                    $idusuario
                                                                ));

        return ['data' => $data];
    }

    public function GetRefVehiculoByContacto_JFV(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdContacto = $request->nidcontacto;

        $arraySegReferenciavehiculo = DB::select('exec usp_Contacto_GetRefVehiculoByContacto_JFV ?, ?, ?',
                                                                        array(  $nIdEmpresa,
                                                                                $nIdSucursal,
                                                                                $nIdContacto
                                                                                ));

        $arraySegReferenciavehiculo = ParametroController::arrayPaginator($arraySegReferenciavehiculo, $request);
        return ['arraySegReferenciavehiculo'=>$arraySegReferenciavehiculo];
    }

    public function SetLeads(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                DB::select('exec usp_Contacto_SetLeads ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',
                                                            [
                                                                $det['cTipoDocumento'],
                                                                $det['cNumeroDocumento'],
                                                                $det['cNombre'],
                                                                $det['cApellidoPaterno'],
                                                                $det['cApellidoMaterno'],
                                                                $det['cTelefonoFijo'],
                                                                $det['nTelefonoMovil'],
                                                                $det['cEmail'],
                                                                $det['cDepartamentoNombre'],
                                                                $det['cProvinciaNombre'],
                                                                $det['cDistritoNombre'],
                                                                $det['cDireccion'],
                                                                $det['cLineaNombre'],
                                                                $det['cMarcaNombre'],
                                                                $det['cModeloNombre'],
                                                                $det['nAnioFabricacion'],
                                                                $det['nAnioModelo'],
                                                                $det['cGlosa'],
                                                                Auth::user()->id
                                                            ]);
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function GetEstadoAsignacionSeguimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdEmpresa = $request->nidempresa;
        $nIdSucursal = $request->nidsucursal;
        $nIdAsignacionContactoVendedor = $request->nidasignacioncontactovendedor;

        $arrayEstadoSeguimiento = DB::select('exec [usp_Contacto_GetEstadoAsignacionSeguimiento] ?, ?, ?',
                                                                [   $nIdEmpresa,
                                                                    $nIdSucursal,
                                                                    $nIdAsignacionContactoVendedor
                                                                ]);
        return ['arrayEstadoSeguimiento'=>$arrayEstadoSeguimiento];
    }

    public function desactivarSeguimiento(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $objSeguimiento = DB::select('exec [usp_Contacto_DesactivaSeguimientoById] ?, ?',
                                                    [   $request->nIdSeguimientoContacto,
                                                        Auth::user()->id
                                                    ]);
        return response()->json($objSeguimiento);
    }
}
