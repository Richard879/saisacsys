<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO TIPO DE INSPECCIÓN</vs-divider>
                    </h2>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label">Empresa</label>
                                            <div class="col-sm-4">
                                                <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-control-label">Nombre Tipo Inspección</label>
                                            <div class="col-sm-4">
                                                <input type="text" v-model="fillTipoInsp.cnombre" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarTipoInspeccion()"><i class="fa fa-search"></i> Buscar</button>
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('inspeccion','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">LISTADO</h3>
                                </div>
                                <div class="card-body">
                                    <template v-if="arrayTipoInspeccion.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Nombre</th>
                                                        <th>Almacén</th>
                                                        <th>Accesorio</th>
                                                        <th>Test Drive</th>
                                                        <th>Sección Inspección</th>
                                                        <th>Ficha Técnica</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="inspeccion in arrayTipoInspeccion" :key="inspeccion.nIdTipoInspeccion">
                                                        <td v-text="inspeccion.nIdTipoInspeccion"></td>
                                                        <td v-text="inspeccion.cNombreTipoInspeccion"></td>
                                                        <td v-text="inspeccion.cFlagAlmacen"></td>
                                                        <td v-text="inspeccion.cFlagAccesorio"></td>
                                                        <td v-text="inspeccion.cFlagTestDrive"></td>
                                                        <td v-text="inspeccion.cFlagSeccionInspeccion"></td>
                                                        <td v-text="inspeccion.cFlagValidarFichaTecnica"></td>
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Editar {{ inspeccion.cNombreTipoInspeccion }}</div>
                                                                <i @click="abrirFormulario('inspeccion','actualizar', inspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                            </el-tooltip>&nbsp;
                                                            <template v-if="inspeccion.cSituacionRegistro=='A'">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Desactivar {{ inspeccion.cNombreTipoInspeccion }}</div>
                                                                    <i @click="desactivar(inspeccion.nIdTipoInspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Activar {{ inspeccion.cNombreTipoInspeccion }}</div>
                                                                    <i @click="activar(inspeccion.nIdTipoInspeccion)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                <a @click.prevent="cambiarPagina(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                            </li>
                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                            :class="[page==isActived?'active':'']">
                                                                <a class="page-link"
                                                                href="#" @click.prevent="cambiarPagina(page)"
                                                                v-text="page"></a>
                                                            </li>
                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                <a @click.prevent="cambiarPagina(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                </div>
                                            </div>
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
                </section>
            </template>

            <template v-else>
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4" v-text="tituloFormulario"></h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">* Empresa</label>
                                            <div class="col-sm-4">
                                                <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">* Nombre Tipo Inspección</label>
                                            <div class="col-sm-4">
                                                <input type="text" v-model="formTipoInsp.cnombre" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">Almacén</label>
                                            <div class="col-sm-4">
                                                <span class="switch">
                                                    <el-switch v-model="formTipoInsp.nflagalmacen">
                                                    </el-switch>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">Accesorio</label>
                                            <div class="col-sm-4">
                                                <span class="switch">
                                                    <el-switch v-model="formTipoInsp.nflagaccesorio">
                                                    </el-switch>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">Test Drive</label>
                                            <div class="col-sm-4">
                                                <span class="switch">
                                                    <el-switch v-model="formTipoInsp.nflagtestdrive">
                                                    </el-switch>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">Sección Inspección</label>
                                            <div class="col-sm-4">
                                                <span class="switch">
                                                    <el-switch v-model="formTipoInsp.nflagseccion">
                                                    </el-switch>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label">Ficha Técnica</label>
                                            <div class="col-sm-4">
                                                <span class="switch">
                                                    <el-switch v-model="formTipoInsp.nflagfichatecnica">
                                                    </el-switch>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-4">
                                                <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                                <button type="button" v-if="accion==2" class="btn btn-secondary btn-corner btn-sm" @click="actualizar()">
                                                    <i class="fa fa-save"></i> Actualizar
                                                </button>
                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
                                                    <i class="fa fa-close"></i> Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>

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
                fillTipoInsp:{
                    cnombre: ''
                },
                formTipoInsp:{
                    nidtipoinspeccion: 0,
                    cnombre: '',
                    nflagalmacen: 0,
                    nflagaccesorio: 0,
                    nflagtestdrive: 0,
                    nflagseccion: 0,
                    nflagfichatecnica: 0
                },
                arrayTipoInspeccion: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
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
            buscarTipoInspeccion(){
                this.listarTipoInspeccion(1);
            },
            listarTipoInspeccion(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/tipoinspeccion/GetListTipoInspeccion';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'cnombre': this.fillTipoInsp.cnombre,
                        'page': page
                    }
                }).then(response => {
                    this.arrayTipoInspeccion = response.data.arrayTipoInspeccion.data;
                    this.pagination.current_page =  response.data.arrayTipoInspeccion.current_page;
                    this.pagination.total = response.data.arrayTipoInspeccion.total;
                    this.pagination.per_page    = response.data.arrayTipoInspeccion.per_page;
                    this.pagination.last_page   = response.data.arrayTipoInspeccion.last_page;
                    this.pagination.from        = response.data.arrayTipoInspeccion.from;
                    this.pagination.to           = response.data.arrayTipoInspeccion.to;
                }).then(function (response) {
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
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarTipoInspeccion(page);
            },
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/tipoinspeccion/SetTipoInspeccion';

                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    cNombreTipoInspeccion: this.formTipoInsp.cnombre,
                    nFlagAlmacen: this.formTipoInsp.nflagalmacen,
                    nFlagAccesorio: this.formTipoInsp.nflagaccesorio,
                    nFlagTestDrive: this.formTipoInsp.nflagtestdrive,
                    nFlagSeccion: this.formTipoInsp.nflagseccion,
                    nFlagFichaTecnica: this.formTipoInsp.nflagfichatecnica
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Tipo Inspección registrado');
                        this.listarTipoInspeccion(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Tipo Inspección');
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

                if(!this.formTipoInsp.cnombre){
                    this.mensajeError.push('Debes Ingresar un nombre');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            actualizar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/tipoinspeccion/UpdTipoInspeccionById';
                axios.post(url, {
                    nIdEmpresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nIdTipoInspeccion: parseInt(this.formTipoInsp.nidtipoinspeccion),
                    cNombreTipoInspeccion: this.formTipoInsp.cnombre,
                    nFlagAlmacen: this.formTipoInsp.nflagalmacen,
                    nFlagAccesorio: this.formTipoInsp.nflagaccesorio,
                    nFlagTestDrive: this.formTipoInsp.nflagtestdrive,
                    nFlagSeccion: this.formTipoInsp.nflagseccion,
                    nFlagFichaTecnica: this.formTipoInsp.nflagfichatecnica
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Tipo Inspección Actualizado');
                        this.limpiarFormulario();
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Tipo Inspección');
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
            activar(nIdTipoInspeccion){
                swal({
                    title: 'Estas seguro de activar este inspeccion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/tipoinspeccion/activar';
                        axios.put(url , {
                            nIdTipoInspeccion: nIdTipoInspeccion
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarTipoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdTipoInspeccion){
                swal({
                    title: 'Estas seguro de desactivar este inspeccion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/tipoinspeccion/desactivar';
                        axios.put(url , {
                            nIdTipoInspeccion: nIdTipoInspeccion
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarTipoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'inspeccion':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO TIPO DE INSPECCIÓN';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.tituloFormulario = 'ACTUALIZAR TIPO DE INSPECCIÓN';
                                this.formTipoInsp.nidtipoinspeccion = data['nIdTipoInspeccion'];
                                this.formTipoInsp.cnombre = data['cNombreTipoInspeccion'];
                                this.formTipoInsp.nflagalmacen = (data['nFlagAlmacen'] == 1 ? true : false);
                                this.formTipoInsp.nflagaccesorio = (data['nFlagAccesorio'] == 1 ? true : false);
                                this.formTipoInsp.nflagtestdrive = (data['nFlagTestDrive'] == 1 ? true : false);
                                this.formTipoInsp.nflagseccion = (data['nFlagSeccionInspeccion'] == 1 ? true : false);
                                this.formTipoInsp.nflagfichatecnica = (data['nFlagValidarFichaTecnica'] == 1 ? true : false);
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formTipoInsp.nidtipoinspeccion= 0,
                this.formTipoInsp.cnombre= '',
                this.formTipoInsp.nflagalmacen=  0,
                this.formTipoInsp.nflagaccesorio= 0,
                this.formTipoInsp.nflagtestdrive= 0,
                this.formTipoInsp.nflagseccion= 0,
                this.formTipoInsp.nflagfichatecnica= 0,
                this.arrayTipoInspeccion = []
            },
            cambiarVistaFormulario(){
                this.listarTipoInspeccion(1);
                this.vistaFormulario = 1;
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
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
