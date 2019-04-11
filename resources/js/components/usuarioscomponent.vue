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
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="name">Nombre</option>
                                    <option value="email">Email</option>

                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarUser(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarUser(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        <!--<tr v-for="user in arrayData[0]" :key="user.id">-->
                        <tr v-for="user in arrayData" :key="user.id">
                            <td v-text="user.id"></td>
                            <td v-text="user.name"></td>
                            <td v-text="user.email"></td>
                            <td v-text="user.rol"></td>

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
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
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



                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" v-model="email" class="form-control" placeholder="Ingrese el correo" >
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" v-model="password" class="form-control" placeholder="Ingrese password" >
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Rol (*)</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idrol">
                                        <option value="0">Seleccione un rol</option>
                                        <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre">

                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div v-show="errorUser" class="form-group row div-error">
                                <div class="text-center text-error" >
                                    <div v-for="error in errorMostrarMsjUser" :key="error" v-text="error">
                                    </div>
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
                arrayRol : [],
                activo:0,
                modal : 0,
                password:'',
                idrol : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUser:0,
                errorMostrarMsjUser:[],
                pagination: {
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3,
                criterio : 'name',
                buscar : ''
            }
        },
        computed:{
          isActived:function () {
              return this.pagination.current_page;
          } ,
            pagesNumber: function () {
              if(!this.pagination.to){
                  return [];
              }
                  var from=this.pagination.current_page-this.offset;
                  if(from<1){
                      from =1;
                  }
                  var to= from +(this.offset*2);
                  if (to>=this.pagination.last_page){
                      to=this.pagination.last_page;
                  }
                  var pagesArray=[];
                  while(from<=to){
                      pagesArray.push(from);
                      from++;
                  }
                  return pagesArray;
            }
        },
        methods : {
            cambiarPagina(page,buscar,criterio){
                let me= this;
                me.pagination.current_page=page;
                me.listarUser(page,buscar,criterio);
            },
            selectRol(){
                let me=this;
                var url= '/rol/selectRol';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            listarUser (page,buscar,criterio){
                let me=this;
                var url= '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayData = respuesta.user.data;
                    me.pagination=respuesta.pagination;
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
                    'idrol' : this.idrol
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser(1,'','name');
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
                            me.listarUser(1,'','name');
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
                            me.listarUser(1,'','name');
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
                    'name': this.nombre,
                    'email': this.email,
                    'password': this.password,
                    'idrol' : this.idrol,
                    'id':this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser(1,'','name');
                    swal(
                        'Usuario actualizado!',
                        'Actualizacion ha sido un éxito.',
                        'success'
                    )
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarUser(){
                this.errorUser=0;
                this.errorMostrarMsjUser =[];

                if (!this.nombre) this.errorMostrarMsjUser.push("El nombre no puede estar vacío.");
                if (!this.email) this.errorMostrarMsjUser.push("El email no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjUser.push("El password no puede estar vacío.");
                if (this.idrol==0) this.errorMostrarMsjUser.push("Debes seleccionar un rol para el usuario.");

                if (this.errorMostrarMsjUser.length) this.errorUser = 1;
                return this.errorUser;
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.email='';
                this.password='';
                this.idrol=0;
                this.errorUser=0;
            },
            abrirModal(modelo, accion, data = []){
                this.selectRol();
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
                                this.idrol=0;
                                this.email='';
                                this.usuario='';
                                this.password='';
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
                                this.idrol=data['idrol'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarUser(1,this.buscar,this.criterio);
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