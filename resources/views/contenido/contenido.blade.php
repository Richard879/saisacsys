@extends('principal')
@section('contenido')
    <template v-if="menu==1300362">
        <dashBoard :ruta="ruta" :usuario="{{ auth()->user() }}" :notifications="notifications"></dashBoard>
    </template>
    <template v-if="menu==1300298">
        <permisos :ruta="ruta" :usuario="{{ auth()->user() }}" @cabecera="reiniciaMenu"></permisos>
    </template>
    <template v-if="menu==1300261">
        <elementoventa :ruta="ruta" :usuario="{{ auth()->user() }}"></elementoventa>
    </template>
    <template v-if="menu==1300262">
        <versionvehiculo :ruta="ruta" :usuario="{{ auth()->user() }}"></versionvehiculo>
    </template>
    <template v-if="menu==1300263">
        <pditipoinspeccion :ruta="ruta" :usuario="{{ auth()->user() }}"></pditipoinspeccion>
    </template>
    <template v-if="menu==1300264">
        <pdiplantilla :ruta="ruta" :usuario="{{ auth()->user() }}"></pdiplantilla>
    </template>
    <template v-if="menu==1300460">
        <parametro :ruta="ruta" :usuario="{{ auth()->user() }}"></parametro>
    </template>
    <template v-if="menu==1300467">
        <parparametro :ruta="ruta" :usuario="{{ auth()->user() }}"></parparametro>
    </template>
    <template v-if="menu==1300469">
        <cronograma :ruta="ruta" :usuario="{{ auth()->user() }}"></cronograma>
    </template>
    <template v-if="menu==1300480">
        <lineamarcamodelo :ruta="ruta" :usuario="{{ auth()->user() }}"></lineamarcamodelo>
    </template>
    <template v-if="menu==1300486">
        <tipocambio :ruta="ruta" :usuario="{{ auth()->user() }}"></tipocambio>
    </template>

    <template v-if="menu==1300266">
        <turnoventa :ruta="ruta" :usuario="{{ auth()->user() }}"></turnoventa>
    </template>
    <template v-if="menu==1300267">
        <objcomercial :ruta="ruta" :usuario="{{ auth()->user() }}"></objcomercial>
    </template>
    <template v-if="menu==1300268">
        <asignavendedormodelo :ruta="ruta" :usuario="{{ auth()->user() }}"></asignavendedormodelo>
    </template>
    <template v-if="menu==1300285">
        <comision :ruta="ruta"></comision>
    </template>
    <template v-if="menu==1300286">
        <pdipuntoinspeccion :ruta="ruta"></pdipuntoinspeccion>
    </template>
    <template v-if="menu==1300338">
        <asigvendedorcuota :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorcuota>
    </template>
    <template v-if="menu==1300465">
        <asigvendedorsublinea :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorsublinea>
    </template>
    <template v-if="menu==1300466">
        <asigvendedorcuotasublinea :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorcuotasublinea>
    </template>
    <template v-if="menu==1300481">
        <asignavendedorjefeventas :ruta="ruta"></asignavendedorjefeventas>
    </template>
    <template v-if="menu==1300482">
        <gestionusuarios :ruta="ruta"></gestionusuarios>
    </template>
    <template v-if="menu==1300495">
        <almacen :ruta="ruta"></almacen>
    </template>
    <template v-if="menu==1300497">
        <accesorioconfig :ruta="ruta"></accesorioconfig>
    </template>
    <template v-if="menu==1300525">
        <modeloconfig :ruta="ruta"></modeloconfig>
    </template>
    <template v-if="menu==1300692">
        <gestionmiusuarios :ruta="ruta" :usuario="{{ auth()->user() }}"></gestionmiusuarios>
    </template>
    <template v-if="menu==1300698">
        <reportes :ruta="ruta" :usuario="{{ auth()->user() }}"></reportes>
    </template>
    <template v-if="menu==1300712">
        <descotorgados :ruta="ruta" :usuario="{{ auth()->user() }}"></descotorgados>
    </template>
    {{--  1300716  / 1300737--}}
    <template v-if="menu==1300737">
        <spmodelo :ruta="ruta" :usuario="{{ auth()->user() }}"></spmodelo>
    </template>


    <template v-if="menu==1300284">
        <listapreciovh :ruta="ruta"></listapreciovh>
    </template>
    <template v-if="menu==1300287">
        <compra :ruta="ruta"></compra>
    </template>
    <template v-if="menu==1300288">
        <woperativo :ruta="ruta"></woperativo>
    </template>
    <template v-if="menu==1300289">
        <wfinanciero :ruta="ruta"></wfinanciero>
    </template>
    <template v-if="menu==1300290">
        <campania :ruta="ruta"></campania>
    </template>
    <template v-if="menu==1300280">
        <gestioncontactojf :ruta="ruta"></gestioncontactojf>
    </template>
    <template v-if="menu==1300281">
        <gestioncontactov :ruta="ruta"></gestioncontactov>
    </template>
    <template v-if="menu==1300274">
        <cotizacion :ruta="ruta"></cotizacion>
    </template>
    <template v-if="menu==1300349">
        <cotizacionaprobar :ruta="ruta" :usuario="{{ auth()->user() }}"></cotizacionaprobar>
    </template>
    <template v-if="menu==1300275">
        <pedido :ruta="ruta"></pedido>
    </template>
    <template v-if="menu==1300291">
        <pedidoaprobar :ruta="ruta"></pedidoaprobar>
    </template>
    <template v-if="menu==1300292">
        <pedidodeposito :ruta="ruta"></pedidodeposito>
    </template>
    <template v-if="menu==1300357">
        <pedidodepositoaprobar :ruta="ruta"></pedidodepositoaprobar>
    </template>
    <template v-if="menu==1300701">
        <pedidodepositopreliminar :ruta="ruta"></pedidodepositopreliminar>
    </template>
    <template v-if="menu==1300468">
        <cotizaciondescuento :ruta="ruta" :usuario="{{ auth()->user() }}"></cotizaciondescuento>
    </template>
    <template v-if="menu==1300282">
        <solccjefeventa :ruta="ruta"></solccjefeventa>
    </template>
    <template v-if="menu==1300283">
        <solccvendedor :ruta="ruta"></solccvendedor>
    </template>
    <template v-if="menu==1300293">
        <asigvendedorturno :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorturno>
    </template>
    <template v-if="menu==1300294">
        <maestrovehiculo :ruta="ruta"></maestrovehiculo>
    </template>
    <template v-if="menu==1300277">
        <autorizacionadv :ruta="ruta" @vista="CambiarMenu" :usuario="{{ auth()->user() }}"></autorizacionadv>
    </template>
    <template v-if="menu==1300278">
        <autorizacionjv :ruta="ruta" @vista="CambiarMenu" :usuario="{{ auth()->user() }}"></autorizacionjv>
    </template>
    <template v-if="menu==1300279">
        <autorizacionv :ruta="ruta" @vista="CambiarMenu" :usuario="{{ auth()->user() }}"></autorizacionv>
    </template>
    <template v-if="menu==1300295">
        <cierreventa :ruta="ruta"></cierreventa>
    </template>
    <template v-if="menu==1300296">
        <cierrecompra :ruta="ruta"></cierrecompra>
    </template>
    <template v-if="menu==1300273">
        <pdiprocesoinspeccion :ruta="ruta"></pdiprocesoinspeccion>
    </template>
    <template v-if="menu==1300300">
        <gestioncontactoadv :ruta="ruta"></gestioncontactoadv>
    </template>
    <template v-if="menu==1300302">
        <tramite :ruta="ruta"></tramite>
    </template>
    <template v-if="menu==1300342">
        <entregavehiculo :ruta="ruta" @vista="CambiarMenu"></entregavehiculo>
    </template>
    <template v-if="menu==1300358">
        <exhibiciones :ruta="ruta"></exhibiciones>
    </template>
    <template v-if="menu==1300360">
        <flete :ruta="ruta"></flete>
    </template>
    <template v-if="menu==1300448">
        <obsequio :ruta="ruta"></obsequio>
    </template>

    <template v-if="menu==1300364">
        <reportecotizacion :ruta="ruta"></reportecotizacion>
    </template>

    <template v-if="menu==1300684">
        <generaproyecto :ruta="ruta"></generaproyecto>
    </template>
@endsection
