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
    Route::get('/listapreciovh/GetListaVh', 'ListaPrecioVersionVehController@GetListaVh');
    Route::post('/listapreciovh/SetListaVh', 'ListaPrecioVersionVehController@SetListaVh');
    Route::post('/listapreciovh/importFileListaPrecioVh', 'ExcelController@importFileListaPrecioVh');
    Route::post('/listapreciovh/readFileListaPrecioVh', 'ExcelController@readFileListaPrecioVh');
    Route::post('/listapreciovh/SetListaPrecioVhDetalle', 'ListaPrecioVersionVehController@store');
    Route::get('/listapreciovh/GetListaVhDetalle', 'ListaPrecioVersionVehController@GetListaVhDetalle');
    Route::put('/listapreciovh/activar','ListaPrecioVersionVehController@activar');
    Route::put('/listapreciovh/desactivar','ListaPrecioVersionVehController@desactivar');
    Route::get('/compra/GetCompraSinWOperativo', 'CompraController@GetCompraSinWOperativo');
    Route::get('/woperativo/GetWOperativo', 'WarrantOperativoController@GetWOperativo');
    Route::post('/woperativo/SetWOperativo', 'WarrantOperativoController@SetWOperativo');
    Route::post('/woperativo/SetWOperativoDetalle', 'WarrantOperativoController@SetWOperativoDetalle');
    Route::get('/woperativo/GetWOperativoDetalle', 'WarrantOperativoController@GetWOperativoDetalle');
    Route::get('/compra/GetCompraSinWFinanciero', 'CompraController@GetCompraSinWFinanciero');
    Route::get('/wfinanciero/GetWFinanciero', 'WarrantFinancieroController@GetWFinanciero');
    Route::post('/wfinanciero/SetWFinanciero', 'WarrantFinancieroController@SetWFinanciero');
    Route::post('/wfinanciero/SetWFinancieroDetalle', 'WarrantFinancieroController@SetWFinancieroDetalle');
    Route::get('/wfinanciero/GetWFinancieroDetalle', 'WarrantFinancieroController@GetWFinancieroDetalle');
    Route::get('/grupopar/GetGrupoParametroEventoCampania', 'GrupoParametroController@GetGrupoParametroEventoCampania');
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
    Route::get('/pedido/GetLstCotizacionIngresadas', 'PedidoController@GetLstCotizacionIngresadas');
    Route::get('/pedido/GetLstCompraByIdModelo', 'PedidoController@GetLstCompraByIdModelo');
    Route::get('/pedido/GetListaPrecioDetalleByIdCotizacion', 'PedidoController@GetListaPrecioDetalleByIdCotizacion');
    Route::get('/tipoparametro/GetTipoByIdParametro', 'ParametroController@GetTipoByIdParametro');
    Route::post('/pedido/subirArchivo', 'PedidoController@subirArchivo');
    Route::get('/parametro/GetListParametroByGrupo', 'ParametroController@GetListParametroByGrupo');
    Route::post('/pedido/SetCabeceraPedido', 'PedidoController@SetCabeceraPedido');
    Route::get('/pedido/GetListPedidoByTipoEstado', 'PedidoController@GetListPedidoByTipoEstado');


    Route::get('/gescontacto/UpdReasignarContacto', 'GestionContactoController@UpdReasignarContacto');
    Route::get('/gescontacto/GetRefVehiculoByContacto_JFV', 'GestionContactoController@GetRefVehiculoByContacto_JFV');
    Route::get('/gescotizacion/GetListReferencias', 'CotizacionController@GetListReferencias');
    Route::get('/gescotizacion/GetTipoLista', 'CotizacionController@GetTipoLista');
    Route::get('/gescotizacion/GetListVehiculos', 'CotizacionController@GetListVehiculos');
    Route::get('/gescotizacion/GetTipoCambio', 'CotizacionController@GetTipoCambio');
    Route::get('/gescotizacion/GetListCampañasByVehiculo', 'CotizacionController@GetListCampañasByVehiculo');
    Route::get('/gescotizacion/GetListEventoElementoVenta', 'CotizacionController@GetListEventoElementoVenta');
    Route::post('/gescotizacion/SetCabeceraCotizacion', 'CotizacionController@SetCabeceraCotizacion');
    Route::post('/gescotizacion/SetDetalleCotizacion', 'CotizacionController@SetDetalleCotizacion');
    Route::get('/getPedido/GetLstPedidos', 'PedidoController@GetLstPedidos');
    Route::put('/getPedido/aprobarPedido', 'PedidoController@aprobarPedido');
    Route::get('/getComision/GetLineasByProveedor', 'ComisionController@GetLineasByProveedor');
    Route::get('/getComision/GetParametroByGrupo', 'ComisionController@GetParametroByGrupo');
    Route::post('/getComision/SetRegistrarComision', 'ComisionController@SetRegistrarComision');
    Route::get('/getObjComercial/getCompraActiva', 'ObjComercialController@getCompraActiva');
    Route::get('/getObjComercial/GetLstTipoBeneficio', 'ObjComercialController@GetLstTipoBeneficio');
    Route::get('/getObjComercial/getVentaActiva', 'ObjComercialController@getVentaActiva');
    Route::get('/getObjComercial/getDetalleVehiculo', 'ObjComercialController@getDetalleVehiculo');
    Route::post('/getObjComercial/SetRegistrarObjeComercial', 'ObjComercialController@SetRegistrarObjeComercial');

    
    Route::get('/turnoventa/GetLstTurnoVenta', 'TurnoVentaController@GetLstTurnoVenta');

});
