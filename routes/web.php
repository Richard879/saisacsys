<?php

Route::get('/','Auth\LoginController@showLoginForm')->name('formlogin');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::middleware(['auth'])->group(function(){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/parametro/GetParametroByGrupo', 'ParametroController@GetParametroByGrupo');
    Route::get('/parametro/GetLstProveedor', 'ParametroController@GetLstProveedor');
    Route::get('/parametro/GetLineasByProveedor', 'ParametroController@GetLineasByProveedor');
    Route::get('/parametro/GetMarcasByProveedor', 'ParametroController@GetMarcasByProveedor');
    Route::get('/parametro/GetModelosByProveedor', 'ParametroController@GetModelosByProveedor');
    Route::get('/parametro/GetDocumentoNatural', 'ParametroController@GetDocumentoNatural');
    Route::get('/parametro/GetDocumentoJuridica', 'ParametroController@GetDocumentoJuridica');
    Route::get('/parametro/GetParametroById', 'ParametroController@GetParametroById');
    Route::get('/parametro/GetListParametroByGrupo', 'ParametroController@GetListParametroByGrupo');
    Route::get('/parparametro/GetBancosByEmpresa', 'ParParametroController@GetBancosByEmpresa');
    Route::get('/tipoparametro/GetTipoByIdParametro', 'ParametroController@GetTipoByIdParametro');
    Route::get('/grupopar/GetGrupoParametroEventoCampania', 'GrupoParametroController@GetGrupoParametroEventoCampania');
    Route::get('/elemento/GetElementoByTipo', 'ElementoController@GetElementoByTipo');
    Route::post('/elemento/SetElemento', 'ElementoController@store');
    Route::put('/elemento/desactivar','ElementoController@desactivar');
    Route::put('/elemento/activar','ElementoController@activar');
    Route::post('/elemento/UpdElementoById', 'ElementoController@UpdElementoById');
    Route::post('/versionvehiculo/SetVersion', 'VersionVehiculoController@store');
    Route::get('/versionvehiculo/GetVersionVehiculo', 'VersionVehiculoController@GetVersionVehiculo');
    Route::post('/versionvehiculo/UpdVersionVehiculoById', 'VersionVehiculoController@UpdVersionVehiculoById');
    Route::put('/versionvehiculo/desactivar','VersionVehiculoController@desactivar');
    Route::put('/versionvehiculo/activar','VersionVehiculoController@activar');
    Route::get('/versionvehiculo/GetLineasByProveedor', 'VersionVehiculoController@GetLineasByProveedor');
    Route::get('/versionvehiculo/GetMarcaByLinea', 'VersionVehiculoController@GetMarcaByLinea');
    Route::get('/versionvehiculo/GetModeloByMarca', 'VersionVehiculoController@GetModeloByMarca');
    Route::post('/compra/importFileCompra', 'ExcelController@importFileCompra');
    Route::post('/compra/readFileCompra', 'ExcelController@readFileCompra');
    Route::post('/compra/SetCompra', 'CompraController@store');
    Route::get('/compra/GetCompra', 'CompraController@GetCompra');
    Route::put('/compra/desactivar','CompraController@desactivar');
    Route::post('/compra/importFileForum', 'ExcelController@importFileForum');
    Route::post('/compra/readFileForum', 'ExcelController@readFileForum');
    Route::post('/compra/SetForum', 'CompraController@SetForum');
    Route::get('/compra/GetCompraSinWOperativo', 'CompraController@GetCompraSinWOperativo');
    Route::get('/compra/GetCompraSinWFinanciero', 'CompraController@GetCompraSinWFinanciero');
    Route::get('/listapreciovh/GetListaVh', 'ListaPrecioVersionVehController@GetListaVh');
    Route::post('/listapreciovh/SetListaVh', 'ListaPrecioVersionVehController@SetListaVh');
    Route::post('/listapreciovh/importFileListaPrecioVh', 'ExcelController@importFileListaPrecioVh');
    Route::post('/listapreciovh/readFileListaPrecioVh', 'ExcelController@readFileListaPrecioVh');
    Route::post('/listapreciovh/SetListaPrecioVhDetalle', 'ListaPrecioVersionVehController@store');
    Route::get('/listapreciovh/GetListaVhDetalle', 'ListaPrecioVersionVehController@GetListaVhDetalle');
    Route::put('/listapreciovh/activar','ListaPrecioVersionVehController@activar');
    Route::put('/listapreciovh/desactivar','ListaPrecioVersionVehController@desactivar');
    Route::get('/woperativo/GetWOperativo', 'WarrantOperativoController@GetWOperativo');
    Route::post('/woperativo/SetWOperativo', 'WarrantOperativoController@SetWOperativo');
    Route::post('/woperativo/SetWOperativoDetalle', 'WarrantOperativoController@SetWOperativoDetalle');
    Route::get('/woperativo/GetWOperativoDetalle', 'WarrantOperativoController@GetWOperativoDetalle');   
    Route::get('/wfinanciero/GetWFinanciero', 'WarrantFinancieroController@GetWFinanciero');
    Route::post('/wfinanciero/SetWFinanciero', 'WarrantFinancieroController@SetWFinanciero');
    Route::post('/wfinanciero/SetWFinancieroDetalle', 'WarrantFinancieroController@SetWFinancieroDetalle');
    Route::get('/wfinanciero/GetWFinancieroDetalle', 'WarrantFinancieroController@GetWFinancieroDetalle');
    Route::post('/ec/SetEventoCampania', 'EventoCampaniaController@store');
    Route::post('/ec/SetDetalleEventoCampania', 'EventoCampaniaController@SetDetalleEventoCampania');
    Route::post('/ec/SetEventoElementoVenta', 'EventoCampaniaController@SetEventoElementoVenta');
    Route::post('/ec/SetDistribucionEventoByEC', 'EventoCampaniaController@SetDistribucionEventoByEC');
    Route::post('/ec/SetDistribucionEventoByElemento', 'EventoCampaniaController@SetDistribucionEventoByElemento');
    Route::get('/ec/GetEventoCampania', 'EventoCampaniaController@GetEventoCampania');
    Route::get('/ec/GetDistribucionByElementoVenta', 'EventoCampaniaController@GetDistribucionByElementoVenta');
    Route::put('/ec/desactivar', 'EventoCampaniaController@desactivar');
    Route::put('/ec/activar', 'EventoCampaniaController@activar');
    Route::get('/ubigeo/GetDptos', 'UbigeoController@GetDptos');
    Route::get('/ubigeo/GetProvinciasByDpto', 'UbigeoController@GetProvinciasByDpto');
    Route::get('/ubigeo/GetDistritosByProv', 'UbigeoController@GetDistritosByProv');
    Route::post('/gescontacto/SetContactoPerNatural', 'GestionContactoController@SetContactoPerNatural');
    Route::post('/gescontacto/SetContactoPerJuridica', 'GestionContactoController@SetContactoPerJuridica');
    Route::post('/gescontacto/SetContactoRefVehiculo', 'GestionContactoController@SetContactoRefVehiculo');
    Route::post('/gescontacto/SetContactoSegRefVehiculo', 'GestionContactoController@SetContactoSegRefVehiculo');
    Route::get('/gescontacto/GetListContactoByVendedor', 'GestionContactoController@GetListContactoByVendedor');
    Route::post('/gescontacto/SetContactoCarteraMes', 'GestionContactoController@SetContactoCarteraMes');
    Route::get('/gescontacto/GetListContactoBySinCarteraMes', 'GestionContactoController@GetListContactoBySinCarteraMes');
    Route::get('/gescontacto/GetCarteraMesByVendedor', 'GestionContactoController@GetCarteraMesByVendedor');
    Route::get('/gescontacto/GetContactoNaturalById', 'GestionContactoController@GetContactoNaturalById');
    Route::get('/gescontacto/GetContactoJuridicoById', 'GestionContactoController@GetContactoJuridicoById');
    Route::get('/gescontacto/GetRefVehiculoByContacto', 'GestionContactoController@GetRefVehiculoByContacto');
    Route::post('/gescontacto/SetSeguimiento', 'GestionContactoController@SetSeguimiento');
    Route::get('/gescontacto/GetListSeguimientoByIdAsignacion', 'GestionContactoController@GetListSeguimientoByIdAsignacion');
    Route::get('/gescontacto/GetListVendedoresByJFV', 'GestionContactoController@GetListVendedoresByJFV');
    Route::get('/gescontacto/GetListContactoByJFV', 'GestionContactoController@GetListContactoByJFV');
    Route::get('/gescontacto/GetListContactosLibres', 'GestionContactoController@GetListContactosLibres');
    Route::get('/gescontacto/GetListReferenciaVehiculoLibre', 'GestionContactoController@GetListReferenciaVehiculoLibre');
    Route::post('/gescontacto/SetAsignaReferenciaLibre', 'GestionContactoController@SetAsignaReferenciaLibre');
    Route::get('/gescontacto/GetRefVehiculoByContactoPorReasignar', 'GestionContactoController@GetRefVehiculoByContactoPorReasignar');
    Route::post('/gescontacto/UpdReasignarReferenciaVehiculo', 'GestionContactoController@UpdReasignarReferenciaVehiculo');
    Route::get('/gescontacto/UpdReasignarContacto', 'GestionContactoController@UpdReasignarContacto');
    Route::get('/gescontacto/GetRefVehiculoByContacto_JFV', 'GestionContactoController@GetRefVehiculoByContacto_JFV');
    Route::post('/gescontacto/importFileLeads', 'ExcelController@importFileLeads');
    Route::post('/gescontacto/readFileLeads', 'ExcelController@readFileLeads');
    Route::post('/gescontacto/SetLeads', 'GestionContactoController@SetLeads');
    Route::get('/pedido/GetLstCotizacionIngresadas', 'PedidoController@GetLstCotizacionIngresadas');
    Route::get('/pedido/GetLstCompraByIdModelo', 'PedidoController@GetLstCompraByIdModelo');
    Route::get('/pedido/GetListaPrecioDetalleByIdCotizacion', 'PedidoController@GetListaPrecioDetalleByIdCotizacion');
    Route::post('/pedido/subirArchivo', 'PedidoController@subirArchivo');
    Route::post('/pedido/SetCabeceraPedido', 'PedidoController@SetCabeceraPedido');
    Route::get('/pedido/GetListPedidoByTipoEstado', 'PedidoController@GetListPedidoByTipoEstado');
    Route::get('/pedido/GetListPedidoAprobados', 'PedidoController@GetListPedidoAprobados');
    Route::get('/pedido/GetLstPedidosPendienteAprobacion', 'PedidoController@GetLstPedidosPendienteAprobacion');
    Route::put('/pedido/SetAprobarPedido', 'PedidoController@SetAprobarPedido');
    Route::get('/deposito/GetNumeroCuentaByBancoAndMoneda', 'DepositoPedidoController@GetNumeroCuentaByBancoAndMoneda');
    Route::post('/deposito/subirArchivo', 'DepositoPedidoController@subirArchivo');
    Route::post('/deposito/SetDepositoPedido', 'DepositoPedidoController@SetDepositoPedido');
    Route::get('/tipocambio/GetTipoCambioById', 'TipoCambioController@GetTipoCambioById');
    Route::post('/compra/UpdCompraById', 'CompraController@UpdCompraById');
    Route::get('/compra/GetLstCompraNoLineaCredito', 'CompraController@GetLstCompraNoLineaCredito');


    Route::get('/gescotizacion/GetListReferencias', 'CotizacionController@GetListReferencias');
    Route::get('/gescotizacion/GetTipoLista', 'CotizacionController@GetTipoLista');
    Route::get('/gescotizacion/GetListVehiculos', 'CotizacionController@GetListVehiculos');
    Route::get('/gescotizacion/GetTipoCambio', 'CotizacionController@GetTipoCambio');
    Route::get('/gescotizacion/GetListCampañasByVehiculo', 'CotizacionController@GetListCampañasByVehiculo');
    Route::get('/gescotizacion/GetListEventoElementoVenta', 'CotizacionController@GetListEventoElementoVenta');
    Route::post('/gescotizacion/SetCabeceraCotizacion', 'CotizacionController@SetCabeceraCotizacion');
    Route::post('/gescotizacion/SetDetalleCotizacion', 'CotizacionController@SetDetalleCotizacion');
    Route::get('/gescotizacion/GetListCotizacionesByIdVendedor', 'CotizacionController@GetListCotizacionesByIdVendedor');
    Route::get('/gescotizacion/GetRefVehiculoByContacto', 'CotizacionController@GetRefVehiculoByContacto');
    Route::get('/getComision/GetLineasByProveedor', 'ComisionController@GetLineasByProveedor');
    Route::get('/getComision/GetParametroByGrupo', 'ComisionController@GetParametroByGrupo');
    Route::post('/getComision/SetRegistrarComision', 'ComisionController@SetRegistrarComision');
    Route::get('/objComercial/getCompraActiva', 'ObjComercialController@getCompraActiva');
    Route::get('/objComercial/GetLstTipoBeneficio', 'ObjComercialController@GetLstTipoBeneficio');
    Route::get('/objComercial/getVentaActiva', 'ObjComercialController@getVentaActiva');
    Route::get('/objComercial/GetDetalleVehiculoCompra', 'ObjComercialController@GetDetalleVehiculoCompra');
    Route::post('/objComercial/SetRegistrarObjComercialCompra', 'ObjComercialController@SetRegistrarObjComercialCompra');
    Route::get('/asigVendedorTurno/GetParametroById', 'AsigVendedorTurnoController@GetParametroById');
    Route::get('/asigVendedorTurno/GetParametroByParParent', 'AsigVendedorTurnoController@GetParametroByParParent');
    Route::post('/asigVendedorTurno/SetRegistrarVendedorTurno', 'AsigVendedorTurnoController@SetRegistrarVendedorTurno');
    Route::get('/asigVendedorTurno/GeLstDetalleTurno', 'AsigVendedorTurnoController@GeLstDetalleTurno');
    Route::get('/solicitudCartaCaracteristica/GeLstCompras', 'SolicitudCartaCaracteristicaController@GeLstCompras');
    Route::get('/solicitudCartaCaracteristica/GetLstCotizacionAprobadas', 'SolicitudCartaCaracteristicaController@GetLstCotizacionAprobadas');
    Route::post('/solicitudCartaCaracteristica/SetRegistrarSCC', 'SolicitudCartaCaracteristicaController@SetRegistrarSCC');
    Route::get('/solicitudCartaCaracteristica/GetLstCartaCaracteristica', 'SolicitudCartaCaracteristicaController@GetLstCartaCaracteristica');
    Route::get('/solicitudCartaCaracteristica/GetDetalleSolicitud', 'SolicitudCartaCaracteristicaController@GetDetalleSolicitud');
    Route::put('/solicitudCartaCaracteristica/SetConformeNoConforme', 'SolicitudCartaCaracteristicaController@SetConformeNoConforme');
    Route::post('/solicitudCartaCaracteristica/SetAprobadoNoAprobado', 'SolicitudCartaCaracteristicaController@SetAprobadoNoAprobado');
    Route::put('/solicitudCartaCaracteristica/SetAnularSCC', 'SolicitudCartaCaracteristicaController@SetAnularSCC');

    Route::get('/turnoventa/GetLstTurnoVenta', 'TurnoVentaController@GetLstTurnoVenta');
    Route::post('/turnoventa/SetTurnoVenta', 'TurnoVentaController@store');
    Route::post('/turnoventa/UpdTurnoVentaById', 'TurnoVentaController@UpdTurnoVentaById');
    Route::put('/turnoventa/desactivar','TurnoVentaController@desactivar');
    Route::put('/turnoventa/activar','TurnoVentaController@activar');

    Route::get('/asignavendedormodelo/GetLstVendedorModelo','AsignaVendedorModeloController@GetLstVendedorModelo');
    Route::post('/asignavendedormodelo/SetAsignaModelo','AsignaVendedorModeloController@SetAsignaModelo');
    Route::post('/asignavendedormodelo/SetDesasignaModelo','AsignaVendedorModeloController@SetDesasignaModelo');
});
