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
                    <button type="button" @click="abrirModal('user','registrar')" class="btn btn-secondary">
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
                            <th>Estado</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in arrayData[0]" :key="user.id">
                            <td v-text="user.id"></td>
                            <td v-text="user.name"></td>
                            <td v-text="user.email"></td>
                            <td v-text="user.roles[0].name"></td>
                          <!--  <td v-for="rol in user.roles" :key="rol.id" v-text="rol.name"  ></td>-->
                            <td>
                                <div v-if="user.activo=='1'">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                            </td>

                            <td>

                                <button type="button" @click="abrirModal('user','actualizar',user)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="user.activo=='1'">
                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(user.id)" >
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-success btn-sm" @click="activarUsuario(user.id)" >
                                        <i class="icon-check"></i>
                                    </button>
                                </template>


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
            <div class="modal-dialog modal-primary modal-sm" role="document">
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
                                <div class="col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese el nombre" >
                                </div>
                            </div>

                            <div v-show="errorNombre" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjNombre" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" v-model="email" class="form-control" placeholder="Ingrese el correo" >
                                </div>
                            </div>
                            <div v-show="errorEmail" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEmail" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" v-model="password" class="form-control" placeholder="Ingrese password" >
                                </div>
                            </div>
                            <div v-show="errorPass" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPass" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label>Escoger Rol</label>
                                    <select  v-model="roles" >
                                        <option value="0">Seleccione un rol</option>
                                        <option v-for="(name, key) in arrayData[1]" :key="key" :value="key" v-text="name"></option>
                                      <!--  <option v-for='(name, key) in arrayData[1]' :value='key' v-text="name" ></option>-->
                                    </select>
                                </div>
                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarUser()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarUser()">Actualizar</button>
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
                email : '',
                arrayData : [],
                roles : 0,
                modal : 0,
                password:'',
                tituloModal : '',
                tipoAccion : 0,
                errorNombre : 0,
                errorMostrarMsjNombre : [],
                errorEmail : 0,
                errorMostrarMsjEmail : [],
                errorPass : 0,
                errorMostrarMsjPass : []
            }
        },
        methods : {
            listarUser (){
                let me=this;
                axios.get('/user').then(function (response) {
                    me.arrayData = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            registrarUser(){
                if (this.validarUser()){
                    return;
                }

                let me = this;
                axios.post('/user/registrar',{
                    'name': this.nombre,
                    'email': this.email,
                    'password': this.password,
                    'rol': this.roles
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            desactivarUsuario(id){
                swal({
                    title: 'Esta seguro de desactivar este usuario?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/user/desactivar',{
                            'id': id
                        }).then(function (response) {
                            me.listarUser();
                            swal(
                                'Desactivado!',
                                'El registro ha sido desactivado con éxito.',
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
            activarUsuario(id){
                swal({
                    title: 'Esta seguro de activar este usuario?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;

                        axios.put('/user/activar',{
                            'id': id
                        }).then(function (response) {
                            me.listarUser();
                            swal(
                                'Activado!',
                                'El registro ha sido activado con éxito.',
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
                if (this.validarUser()){
                    return;
                }
                let me = this;
                axios.put('/user/actualizar',{
                    'descripcion': this.descripcion,
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarUser(){
                this.errorNombre=0;
                this.errorEmail=0;
                this.errorPass=0;
                this.errorMostrarMsjNombre =[];
                this.errorMostrarMsjEmail =[];
                this.errorMostrarMsjPass =[];
                if (!this.nombre) this.errorMostrarMsjNombre.push("El nombre no puede estar vacío.");
                if (!this.email) this.errorMostrarMsjEmail.push("El email no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjPass.push("El pass no puede estar vacío.");
                if (this.errorMostrarMsjEmail.length) this.errorEmail = 1;
                return this.errorEmail;
                if (this.errorMostrarMsjNombre.length) this.errorNombre = 1;
                return this.errorNombre;
                if (this.errorMostrarMsjPass.length) this.errorPass = 1;
                return this.errorPass;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.email='';
                this.password='';
                this.roles = 0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "user":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Usuario';
                                this.tipoAccion=2;
                                this.id=data['id'];
                                this.nombre= data['name'];
                                this.email= data['email'];
                                this.password= data['password'];
                                this.roles=data['roles'];
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