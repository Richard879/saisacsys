<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO RELACION PARAMETROS</vs-divider>
                    </h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Grupo</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillParametro.nidgrupopar" filterable clearable placeholder="SELECCIONE" v-on:change="limpiarGrupo()">
                                                                <el-option
                                                                v-for="item in arrayGrupoParametro"
                                                                :key="item.nIdGrupoPar"
                                                                :label="item.cGrupoParNombre"
                                                                :value="item.nIdGrupoPar">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" v-if="fillParametro.nidgrupopar!= 0">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Descripción</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillParametro.cparnombre" @keyup.enter="listarParametroByGrupo(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-4">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarParametroByGrupo(1);">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <template v-if="arrayParametro.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Grupo</th>
                                                            <th>Nombre</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(p, index) in arrayParametro" :key="p.nIdPar">
                                                            <td v-text="p.nIdPar"></td>
                                                            <td v-text="p.nIdGrupoPar"></td>
                                                            <td v-text="p.cParNombre"></td>
                                                            <td>
                                                                <input type="checkbox" v-model="arrayIndex[index]" class="checkbox-template" v-on:change="selectParametro(index, p.nIdPar)">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10">No existen registros!</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <template v-if="arrayParParametro.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Grupo</th>
                                                            <th>Nombre</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="p in arrayParParametro" :key="p.nIdPar">
                                                            <td v-if="p.nFlagParParametro==1" v-text="p.nIdPar"></td>
                                                            <td v-if="p.nFlagParParametro==1" v-text="p.nIdGrupoPar"></td>
                                                            <td v-if="p.nFlagParParametro==1" v-text="p.cParNombre"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10">No existen registros!</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Sub Grupo</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillParametro.nidsubgrupopar" filterable clearable placeholder="SELECCIONE" v-on:change="limpiarSubGrupo()">
                                                                <el-option
                                                                v-for="item in arraySubGrupoParametro"
                                                                :key="item.nIdGrupoPar"
                                                                :label="item.cGrupoParNombre"
                                                                :value="item.nIdGrupoPar">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" v-if="fillParametro.nidsubgrupopar!= 0">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Descripción</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillParametro.csubparnombre" @keyup.enter="listarParParametro(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-4">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarParParametro(1);">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <template v-if="arrayParParametro.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Codigo</th>
                                                            <th>Grupo</th>
                                                            <th>Nombre</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="p in arrayParParametro" :key="p.nIdPar">
                                                            <td>
                                                                <template v-if="p.nFlagParParametro==1">
                                                                    <el-tooltip class="item" :content="'Desactivar ' + p.cParNombre" effect="dark" placement="top-start">
                                                                        <i @click="eliminar(p)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                    </el-tooltip>
                                                                </template>
                                                                <template v-else>
                                                                    <el-tooltip class="item" :content="'Activar ' + p.cParNombre" effect="dark" placement="top-start">
                                                                        <i @click="registrar(p)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                    </el-tooltip>
                                                                </template>
                                                            </td>
                                                            <td v-text="p.nIdPar"></td>
                                                            <td v-text="p.nIdGrupoPar"></td>
                                                            <td v-text="p.cParNombre"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10">No existen registros!</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Show Errors -->
            <div class="modal fade" v-if="accionmodal==1" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Automotores INKA</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div v-for="e in mensajeError" :key="e" v-text="e">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </transition>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                arrayProveedor: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                // =============================================================
                // =========== VARIABLES PARAMETRO ===========
                fillParametro:{
                    nidgrupopar: '',
                    nidsubgrupopar: '',
                    cparnombre: '',
                    csubparnombre: ''
                },
                formParametro:{
                    nidpar: 0,
                    nidgrupopar: '',
                    cparjerarquia: '',
                    cparabreviatura: '',
                    cparnombre: ''
                },
                arrayGrupoParametro: [],
                arraySubGrupoParametro: [],
                arrayParametro: [],
                arrayParParametro: [],
                arrayIndex: [],
                // =============================================================
                pagination: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                paginationModal: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset:3,
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormulario: 1
            }
        },
        mounted(){
            this.llenarComboGrupoParametro();
            this.llenarComboSubGrupoParametro();
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            isActivedModal: function(){
                return this.paginationModal.current_page;
            },
            pagesNumberModal: function() {
                if(!this.paginationModal.to) {
                    return [];
                }

                var from = this.paginationModal.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.paginationModal.last_page){
                    to = this.paginationModal.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            limpiarGrupo(){
                this.arrayParametro = [];
                this.arrayIndex= [];
                this.formParametro.nidpar='';
                this.arrayParParametro = [];
            },
            limpiarSubGrupo(){
                this.arrayParParametro = [];
            },
            llenarComboGrupoParametro(){
                var url = this.ruta + '/grupopar/GetListGrupoParametro';

                axios.get(url, {
                    params: {
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayGrupoParametro = response.data.arrayGrupoParametro;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboSubGrupoParametro(){
                var url = this.ruta + '/grupopar/GetListGrupoParametro';

                axios.get(url, {
                    params: {
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arraySubGrupoParametro = response.data.arrayGrupoParametro;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            listarParametroByGrupo(page){
                if(this.validarBusqueda()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/parametro/GetListParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid'   : this.fillParametro.nidgrupopar,
                        'cparnombre'    : this.fillParametro.cparnombre,
                        'opcion'        : 1,
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayParametro = response.data.arrayParametro;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarBusqueda(){
                this.error = 0;
                this.mensajeError =[];
                if(this.fillParametro.nidgrupopar == 0 || !this.fillParametro.nidgrupopar){
                    this.mensajeError.push('Debes Seleccionar un Grupo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarParParametro(page){
                if(this.validarBusquedaSubParametro()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/parparametro/GetListParParametroByGrupoTodos';

                axios.get(url, {
                    params: {
                        'nidpar'        : this.formParametro.nidpar,
                        'nidgrupopar'   : this.fillParametro.nidgrupopar,
                        'nidsubgrupopar': this.fillParametro.nidsubgrupopar,
                        'cparnombre'    : this.fillParametro.csubparnombre,
                        'opcion'        : 1
                    }
                }).then(response => {
                    this.arrayParParametro = response.data.arrayParParametro;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarBusquedaSubParametro(){
                this.error = 0;
                this.mensajeError =[];
                if(this.fillParametro.nidsubgrupopar == 0 || !this.fillParametro.nidsubgrupopar){
                    this.mensajeError.push('Debes Seleccionar un Sub Grupo');
                };
                if(this.formParametro.nidpar == 0 || !this.formParametro.nidpar){
                    this.mensajeError.push('Debes Seleccionar un Parámetro de Grupo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarParametroByGrupo(page);
            },
            selectParametro(index, nIdPar){
                let me = this;

                if(me.arrayIndex[index])
                {
                    me.formParametro.nidpar = nIdPar;
                }
                else{
                    me.formParametro.nidpar = '';
                }

                me.arrayParametro.map(function(value, key) {
                    if(me.arrayIndex[key] && key == index) {
                        console.log("activa");
                        me.limpiarFormulario();
                    }
                    else{
                        me.arrayIndex[key] = false;
                    }
                });
            },
            registrar(p){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/parparametro/SetParParametro';
                axios.post(url, {
                    'nParSrcCodigo'         : parseInt(this.formParametro.nidpar),
                    'nParSrcGrupoParametro' : parseInt(this.fillParametro.nidgrupopar),
                    'nParDstCodigo'         : parseInt(p.nIdPar),
                    'nParDstGrupoParametro' : parseInt(this.fillParametro.nidsubgrupopar),
                    'cValor'                : ''
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Parámetro registrado');
                        //this.limpiarFormulario();
                        this.listarParParametro(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Parámetro');
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillParametro.nidgrupopar == 0 || !this.fillParametro.nidgrupopar){
                    this.mensajeError.push('Debes Seleccionar un Grupo');
                };
                if(this.fillParametro.nidsubgrupopar == 0 || !this.fillParametro.nidsubgrupopar){
                    this.mensajeError.push('Debes Seleccionar un Sub Grupo');
                };
                if(this.formParametro.nidpar == 0 || !this.formParametro.nidpar){
                    this.mensajeError.push('Debes Seleccionar un Parámetro de Grupo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            eliminar(p){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/parparametro/ElmParParametro';
                axios.post(url, {
                    'nParSrcCodigo'         : parseInt(this.formParametro.nidpar),
                    'nParSrcGrupoParametro' : parseInt(this.fillParametro.nidgrupopar),
                    'nParDstCodigo'         : parseInt(p.nIdPar),
                    'nParDstGrupoParametro' : parseInt(this.fillParametro.nidsubgrupopar),
                    'cValor'                : ''
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Parámetro eliminado');
                        //this.limpiarFormulario();
                        this.listarParParametro(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Parámetro');
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            cambiarVistaFormulario(){
                if(this.accion == 1){
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }else{
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }

            },
            limpiarFormulario(){
                this.arrayParParametro = [];
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        }
    }
</script>
<style>
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #3c29297a !important;
        overflow-y: scroll;
    }
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .error{
        display: flex;
        justify-content: center;
    }
    .text-center{
        color: red;
        font-weight: bold;
        font-size: 0.75rem;
    }
</style>
