<template>
    <div class="container-fluid">
        <div class="row" v-show="tabla">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <button class="btn btn-primary" @click="tabla=false;agregar=true;">Agregar</button>
                                        <!-- <router-link to="/foo" tag="button">foo</router-link> -->
                                    </div>
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 col-lg-4">
                                    <h3>Sectores de Trabajo</h3>
                                    <p>Lista de sectores</p>
                                    </div>
                        </div>
                    </div>
                    <div class="well">
                        <div class="content table-responsive table-full-width">
                                
                                <v-client-table :data="sector" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <!-- <a  target="_blank" slot="Acciones" slot-scope="props" :href="props.row.Acciones" class="pe-7s-pen">ASD</a>
                                        <a  target="_blank" :href="props.row.Acciones" class="pe-7s-pen">DSA</a> -->
                                        <button class="pe-7s-pen" data-toggle="tooltip" v-on:click="viewEditarSector(props.row.id,props.row.descripcion)" data-placement="left" title="Editar Sector"></button>
                                        <button class="pe-7s-trash" data-toggle="tooltip" v-on:click="eliminarSector(props.row.id)" data-placement="left" title="Eliminar"></button>
                                    </div>
                                </v-client-table>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-show="agregar">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="content">
                       <div class="header">
	                    <center><h3 class="title">Agregar Nuevo Sector</h3></center>
                        <hr>
	                    </div>
	                    <form @submit.prevent="agregarSector">
	                        <div class="row">
                                <div class="col-md-5">
	                                <div class="form-group">
	                                    <label for="ndescripcion">Descripcion</label>
	                                    <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="sectorForm.descripcion" required>
	                                </div>
	                            </div>
	                        </div>
	                        <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <button type="button" class="btn btn-primary btn-fill pull-left" @click="submitted = false" v-on:click="agregar=false;tabla=true;">Cancelar</button>
	                        <div class="clearfix"></div>
	                    </form>
                        
	                </div>
	            </div>
	         </div>
	    	</div>

            <div class="row" v-show="editar">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="content">
                       <div class="header">
	                    <center><h3 class="title">Editar Sector</h3></center>
                        <hr>
	                    </div>
	                    <form @submit.prevent="editarSector">
	                        <div class="row">
                                <div class="col-md-5">
	                                <div class="form-group">
	                                    <label for="ndescripcion">Descripcion</label>
	                                    <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="sectorEdit.descripcion" required>
	                                </div>
	                            </div>
	                        </div>
	                        <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <button type="button" class="btn btn-primary btn-fill pull-left" @click="submitted = false" v-on:click="editar=false;tabla=true;">Cancelar</button>
	                        <div class="clearfix"></div>
	                    </form>
                        
	                </div>
	            </div>
	         </div>
	    	</div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            sector: [
                {
                    id:null,
                    descripcion:null
                }
            ],
            sectorForm:{
                id:null,
                descripcion:null
            },
            sectorEdit:{
                id:null,
                descripcion:null
            },
            columns: ['id','descripcion','Acciones'],
            options: {
                headings: {
                    ID:'ID',
                    Descripcion:'Descripcion',
                    Acciones:'Acciones'
                        },
                sortable: ['ID','Descripcion'],
                filterable: ['id','descripcion']
                    },
                tabla:true,
                agregar:false,
                editar:false
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('getSector')
                .then(data => {
                   this.sector=data.data.sector;
                   console.log(data);
                   this.sector.forEach((element,i) => {
                       this.sector[i].id=this.sector[i].id;
                   });
                //    console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        },
        agregarSector(){
            axios.post(`agregarSector`, {
                        sectorForm:this.sectorForm
                    }).then(data => {
                        if (data.data == 'OK') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos ingresados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo agregar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }).catch(error => {
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Sucedió un error, comuníquese con el Administrador',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        console.log(`Error: ${error}`);
                    });
        },
        eliminarSector(id){
            swal({
                title: 'Deseas eliminar este sector?',
                text: "No será posible revertir esta acción!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, elíminalo!',
                cancelButtonText: 'No, cancelar!',
            }).then((result) => {
                if (result.value) {
                    axios.get(`/eliminarSector/${id}`)
                        .then(data => {
                        if(data.data=="OK"){
                            swal(
                            'Eliminado!',
                             'El sector ha sido eliminado.',
                             'success'
                                );
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }
                        }).catch(error => {
                            console.log('Ocurrio un error ' + error);
                            this.$Progress.fail();
                        });
                     }
                });
        },
        viewEditarSector(id,des){
            this.editar=true;
            this.tabla=false;
            this.sectorEdit.descripcion=des;
            this.sectorEdit.id=id;
        },
        editarSector(){
            axios.post(`actualizarSector`, {
                        sectorEdit:this.sectorEdit
                    }).then(data => {
                        if (data.data == 'OK') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos actualizados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo actualizar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            console.log(data);
                        }
                    }).catch(error => {
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Sucedió un error, comuníquese con el Administrador',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        console.log(`Error: ${error}`);
                    });
        }
    }
}
</script>