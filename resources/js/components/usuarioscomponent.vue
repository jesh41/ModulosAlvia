<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Usuarios
                    <button type="button" @click="abrirModal('colores','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" id="opcion" name="opcion">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>rol</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in arrayColor" :key="user.id">
                            <td v-text="user.id"></td>
                            <td v-text="user.name"></td>
                            <td v-text="user.email"></td>
                            <td v-text=""></td>
                            <td>
                                <button type="button" @click="abrirModal('colores','actualizar',colores)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivar(user.id)" >
                                    <i class="icon-trash"></i>
                                </button>
                            </td>



                        </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">Ant</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" >Descripción</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese el color">
                                </div>
                            </div>
                            <div v-show="errorColor" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjColor" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarColor()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarColor()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        <!-- Inicio del modal Eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar Colores</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Estas seguro de eliminar el color?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Fin del modal Eliminar -->
    </main>
</template>

<script>
    export default {
        data (){
            return {
                id: 0,
                nombre : '',
                descripcion : '',
                arrayColor : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorColor : 0,
                errorMostrarMsjColor : []
            }
        },
        methods : {
            listarUser (){
                let me=this;
                axios.get('/user').then(function (response) {
                    me.arrayColor = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            registrarUser(){
                if (this.validarColor()){
                    return;
                }

                let me = this;
                axios.post('/colores/registrar',{
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarColor();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            desactivarUser(id){
                swal({
                    title: 'Esta seguro de eliminar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('',{
                            'id': id
                        }).then(function (response) {
                            me.listarUser();
                            swal(
                                'Eliminado!',
                                'El registro ha sido Eliminado con éxito.',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });


                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {

                    }
                })
            },
            actualizarUser(){
                if (this.validarColor()){
                    return;
                }
                let me = this;
                axios.put('/colores/actualizar',{
                    'descripcion': this.descripcion,
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarColor();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarUser(){
                this.errorColor=0;
                this.errorMostrarMsjColor =[];
                if (!this.descripcion) this.errorMostrarMsjColor.push("El nombre del color no puede estar vacío.");
                if (this.errorMostrarMsjColor.length) this.errorColor = 1;
                return this.errorColor;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "colores":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar color';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar';
                                this.tipoAccion=2;
                                this.id=data['id'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarUser();
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>