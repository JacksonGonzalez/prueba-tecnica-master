<template>
    <section class="conf-section m-3 p-3">
        <div class="row mx-0">
            <div class="col-xl-4 px-0">
                <!-- bodegas -->
                <div class="border-dark p-2 br-5 my-2">
                    <!-- CREAR UNA NUEVA BODEGA -->
                    <div class="row mx-0 pl-2">
                        <b class="mr-2 my-auto">Bodegas</b>
                        <el-popover placement="bottom" title="Crear bodega" width="240" trigger="click" >
                            <div class="row mx-0 my-2">
                                <div class="col">
                                    <label>Nombre Bodega</label>
                                    <input type="text" class="form-control" v-model="nomBodega" />
                                </div>
                            </div>
                            <div class="row mx-0 my-2">
                                <div class="col">
                                    <label>Responsable</label>
                                    <el-select v-model="value" placeholder="Select"> <el-option v-for="user in users" :key="user.value" :label="user.nombre" :value="user.id" /> </el-select>
                                </div>
                            </div>
                            <div class="row mx-0 mt-2 justify-content-end">
                                <button type="button" class="btn btn-sm btn-light mr-2" name="button">Cerrar</button>
                                <button type="button" class="btn btn-sm btn-primary" v-on:click="agregarBodega()">Guardar</button>
                            </div>
                            <i slot="reference" class="mdi mdi-plus-circle f-22 cr-pointer" />
                        </el-popover>
                    </div>

                    <!-- LISTAR LAS BODEGAS -->{{ listarBodegas()}}
                    <div class="row mx-0 my-3" v-for="bodega in arrayBodegas" :key="bodega.id">
                    
                        <p class="mx-2 my-auto" v-text="bodega.nombre">  </p>
                       
                        <!-- CARGAR IMGEN CUANDO NO TIENE -->
                        <div v-if="bodega.foto == null">
                                <el-tooltip class="item" effect="light" content="Roberto Gómez Bolaños" placement="top">
                                    <img class="rounded-circle mx-2 obj-cover" height="40" width="40" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" />
                                </el-tooltip>                    
                        </div>
                        <div v-else>
                                <el-tooltip class="item" effect="light" content="Roberto Gómez Bolaños" placement="top">
                                    <img class="rounded-circle mx-2 obj-cover" height="40" width="40" :src="bodega.foto" alt="" />
                                </el-tooltip>                     
                        </div>
                        <!-- COLOR DEL ESTADO -->
                        <div v-if="bodega.estado == 1">
                            <button type="button" class="btn btn-sm my-auto btn-success" @click="cambiarEstadoBodega(bodega.id, bodega.estado)" >
                            Activo
                        </button>
                        </div>
                        <div v-if="bodega.estado == 0">
                            <button type="button" class="btn btn-sm my-auto btn-danger" name="button" @click="cambiarEstadoBodega(bodega.id, bodega.estado)" >
                            Inactivo
                        </button>
                        </div>
                
                    </div>
                </div>
                <!-- usuarios -->
                {{listarUsuarios()}}
                <div class="border-dark p-2 br-5 my-2">
                    <div class="row mx-0 justify-conent-center pl-2">
                        <b class="mr-2 my-auto">Usuarios</b>
                        <i class="mdi mdi-plus-circle f-22 cr-pointer" />
                    </div>
                    <div v-for="user in users" :key="user.id" class="row mx-0 my-3 px-2">
                        <el-switch v-model="user.estado" :inactive-text="user.nombre"> </el-switch>
                        <!-- <p v-text="user.nombre"></p> -->
                    </div>
                </div>
                <!-- Productos -->
                {{listarProductos()}}
                <div class="border-dark p-2 br-5 my-2">
                    <div class="row mx-0 justify-conent-center">
                        <b class="mr-2 my-auto">Productos</b>
                        <i class="mdi mdi-plus-circle f-22 cr-pointer" />
                    </div>
                    <div v-for="producto in arrayProductos" :key="producto.id" class="row mx-0 my-3">
                         <p class="mx-2 my-auto" v-text="producto.nombre"></p>
                        <div v-if="producto.estado == 1">
                            <button type="button" class="btn btn-sm btn-success" name="button">
                                Activo
                            </button>
                        </div>
                        <div v-else>
                            <button type="button" class="btn btn-sm btn-danger" name="button">
                                Inactivo
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- tablas -->
            <div class="col-xl-8">
                <div class="row mx-0 my-3">
                    <div class="col d-flex">
                        <label class="mr-2">Rojo</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="ColorTabla" v-model="ckeckboxVal" @click="cambiarColor()">
                            <label class="custom-control-label" for="ColorTabla">Azul</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success my-auto btn-sm d-flex" name="button" @click="agregarProducto">
                        <span class="my-auto">Agregar producto</span>
                        <i class="mdi mdi-plus-box cr-pointer f-17 ml-2 my-n1" />
                    </button>
                    <button type="button" class="btn btn-primary ml-2 my-auto btn-sm d-flex" name="button">
                        <span class="my-auto">Transferir producto</span>
                        <i class="mdi mdi-reload f-17 ml-2 my-n1" />
                    </button>
                </div>
                <div class="row mx-0 my-3">
                    <div class="col overflow-auto">
                        <p class="f-600 my-2 text-center f-18">Productos en bodega </p>
                        <table id="listado_por_legal" class="table table-sm table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th class="align-middle">Item</th>
                                    <th class="align-middle">Bodega</th>
                                    <th class="align-middle">Producto</th>
                                    <th class="align-middle">Cantidad</th>
                                    <th class="align-middle text-center">Fecha</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="row mx-0 my-3">
                    <div class="col overflow-auto">
                        <p class="f-600 my-2 text-center f-18">Historial de movimientos</p>
                        <table id="listado_por_legal" class="table table-sm table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th class="align-middle">Producto</th>
                                    <th class="align-middle">Bodega Origen</th>
                                    <th class="align-middle">Bodega Destino</th>
                                    <th class="align-middle">Cantidad</th>
                                    <th class="align-middle text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="historial in tabla_historial" :key="historial.id">
                                    <td v-text="historial.producto"></td>
                                    <td v-text="historial.bodegaOrigen"></td>
                                    <td v-text="historial.bodegaDestino"></td>
                                    <td v-text="historial.cantidad"></td>
                                    <td v-text="historial.fecha"></td>
                                </tr>        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <modal-agregar-producto ref="modalAgregarProducto" />
        <modal-transferir-producto ref="modalTransferirProducto" /> -->

        <!-- CAMBIAR ESTADO BODEGA -->
        <modal ref="cambiarEstadoBodega" titulo="Cambiar estado de la Bodega">
            <div class="row mx-0 my-3 justify-content-center">
                ¿Está seguro de Activar/Desactivar esta bodega?
            </div>
            <div class="row mx-0 mt-2 justify-content-end    py-2">
                <!-- <button type="button" class="btn btn-sm btn-secondary mr-2" name="button">Cerrar</button> -->
                <button type="button" class="btn btn-sm btn-primary" @click="cambiarBodega()">Guardar</button>
            </div>
        </modal>

        <!-- CAMBIAR ESTADO USUARIO -->
        <modal ref="cambiarEstadoUsuario" titulo="Cambiar estado usuario">
            <div class="row mx-0 my-3 justify-content-center">
                ¿Está seguro de Activar/Desactivar este usuario?
            </div>
            <div class="row mx-0 mt-2 justify-content-end    py-2">
                <!-- <button type="button" class="btn btn-sm btn-secondary mr-2" name="button">Cerrar</button> -->
                <button type="button" class="btn btn-sm btn-primary" name="button">Guardar</button>
            </div>
        </modal>

        <!-- CAMBIAR ESTADO DE UN PRODUCTO -->
        <modal ref="cambiarEstadoProducto" titulo="Cambiar estado usuario">
            <div class="row mx-0 my-3 justify-content-center">
                ¿Está seguro de Activar/Desactivar este producto?
            </div>
            <div class="row mx-0 mt-2 justify-content-end    py-2">
                <!-- <button type="button" class="btn btn-sm btn-secondary mr-2" name="button">Cerrar</button> -->
                <button type="button" class="btn btn-sm btn-primary" name="button">Guardar</button>
            </div>
        </modal>
        <!-- https://datatables.net/manual/ -->
        <!-- https://element.eleme.io/#/es -->
    </section>
</template>

<script>
// import $axios from 'axios'   

export default {
    components: {
        modalAgregarProducto: () => import('./modales/modalAgregarProducto'),
        modalTransferirProducto: () => import('./modales/modalTransferirProducto'),
        modal: () => import('~/components/modal')
    },
    data(){return {
        respBodega: false,
        product: false,
        colorTabla: 0,
        arrayBodegas : [],
        arrayProductos : [],
        users: [],
        value: '',
        nomBodega: '',
        numBodega: '',
        estBodega: '',
        ckeckboxVal: false,
        tabla_empresa:[
            { bodega: "Bodega 1",producto: "MFDA12678934501", cantidad: 5, fecha:'12/15/7894' },
            { bodega: "Bodega 2",producto: "MFDA12678934501", cantidad: 15, fecha:'12/15/7894' },
            { bodega: "Bodega 3",producto: "MFDA12678934501", cantidad: 25, fecha:'12/15/7894' },
            { bodega: "Bodega 4",producto: "MFDA12678934501", cantidad: 35, fecha:'12/15/7894' },
            { bodega: "Bodega 5",producto: "MFDA12678934501", cantidad: 45, fecha:'12/15/7894' },
        ],
        tabla_historial:[
            { bodegaOrigen: "Bodega 1", bodegaDestino:"Bodega 3", producto: "MFDA12678934501", cantidad: 5, fecha:'12/15/7894' },
            { bodegaOrigen: "Bodega 2", bodegaDestino:"Bodega 3", producto: "MFDA12678934501", cantidad: 15, fecha:'12/15/7894' },
            { bodegaOrigen: "Bodega 3", bodegaDestino:"Bodega 3", producto: "MFDA12678934501", cantidad: 25, fecha:'12/15/7894' },
            { bodegaOrigen: "Bodega 4", bodegaDestino:"Bodega 3", producto: "MFDA12678934501", cantidad: 35, fecha:'12/15/7894' },
            { bodegaOrigen: "Bodega 5", bodegaDestino:"Bodega 3", producto: "MFDA12678934501", cantidad: 45, fecha:'12/15/7894' },
        ],
    } },
    mounted(){
        this.initDatatables()
    },
    methods: {
        cambiarEstadoUsuario(){ this.$refs.cambiarEstadoUsuario.toggle() },
        cambiarEstadoBodega(id_bodega, estado_bodega){ 
            this.$refs.cambiarEstadoBodega.toggle();
            this.numBodega = id_bodega;
            this.estBodega = estado_bodega;
            // console.log(this.numBodega);
            // console.log(this.estBodega);
        },
        cambiarBodega(){
            // alert(this.numBodega + this.estBodega);
            // console.log(this.numBodega);
            // console.log(this.estBodega);
            let me = this;
            // console.log(me.nomBodega + me.value);
            axios.put('/api/bodegas',{
                'id': this.numBodega,
                'estado': this.estBodega
            }).then(function (response) {
                // me.cerrarModal();
                this.numBodega = '',
                this.estBodega = '',
                me.listarBodegas(),
                alert("Bodega Actualizada")
            }).catch(function (error) {
                console.log(error);
            });
        },
        cambiarEstadoProducto(){ this.$refs.cambiarEstadoProducto.toggle() },
        // cambiarEstadoBodega(){ this.$refs.cambiarEstado.toggle() },
        agregarProducto(){ this.$refs.modalAgregarProducto.toggle() },
        trasnferirProducto(){ this.$refs.modalTransferirProducto.toggle() },
        activarUsuario(){var respBodega = 'Activo'},
        cambiarColor(){
            // alert('lo lee'+ this.ckeckboxVal);
            if(this.ckeckboxVal == false){
                document.body.style.backgroundColor='blue';
            }else{
                document.body.style.backgroundColor='red';
            }
        },
        listarBodegas(){ 
            // console.log("esta");
            let me = this;
            axios.get('api/bodegas')
            .then(function(response){
                // Asignamos el Array retornado
                
                var  bodegas = response.data;
                me.arrayBodegas = bodegas;
                // console.log(me.arrayBodegas);
                // console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });
            
        },
        agregarBodega(){
            // AGREGAR LAS BODEGAS
            let me = this;
            // console.log(me.nomBodega + me.value);
            axios.post('/api/bodegas',{
                'nombreBodega': this.nomBodega,
                'id_responsable': this.value,
                'estado': 1
            }).then(function (response) {
                // me.cerrarModal();
                this.nomBodega = '',
                this.value = '',
                me.listarBodegas();
                alert("Bodega Guardada");
            }).catch(function (error) {
                console.log(error);
            });
        },
        listarUsuarios(){ 
            // console.log("esta");
            let me = this;
            axios.get('api/usuarios')
            .then(function(response){
                // Asignamos el Array retornado
                
                var  usuarios = response.data;
                me.users = usuarios;
                // console.log(me.arrayBodegas);
                // console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });
            
        },
        listarProductos(){ 
            // console.log("esta");
            let me = this;
            axios.get('api/productos')
            .then(function(response){
                // Asignamos el Array retornado
                
                var  productos = response.data;
                me.arrayProductos = productos;
                
                // console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });
            
        },
        initDatatables(){
            let that = this;
            let listado_por_legal = $("#listado_por_legal").DataTable({
                searching:false,
                // ordering:false,
                paging:false,
                // info:false,
                data: that.tabla_empresa,
                createdRow: function (row, data, index) {
                    $(row).addClass("cursor-pointer slc-row");
                    $(row).attr('data-id', data.id);
                },
                columns:[
                    { title:'Item', data:null, className:'align-middle text-center', render(data,type,row,meta){ return meta.row + 1; } },
                    { data:'bodega', className:'align-middle' },
                    { data:'producto', className:'align-middle' },
                    { data:'cantidad', className:' text-center align-middle' },
                    { data:'fecha', className:'text-center align-middle' },
                ],

            })
        } //fin datatable
    }
}
</script>

<style lang="css" scoped>
.border-dark{
    border: 1px solid #8a8a8a
}
</style>
