<template>
	<div class="content">
	    <div class="container-fluid">
	    	<div class="row">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="header">
	                    <h4 class="title">Agregar Nueva Escuela</h4>
	                </div>
	                <div class="content">
	                    <form @submit.prevent="ingresar" method="POST">
	                        <div class="row">
	                            <div class="col-md-8">
	                                <div class="form-group">
	                                    <label>Escuela</label>
	                                    <input type="text" v-model="facu" class="form-control"  maxlength="30">
	                                </div>
	                            </div>
	                        </div>
							<div class="row">
								<div class="col-md-3">
									<input type="submit" value="Agregar" class="btn btn-info btn-fill pull-right">
								</div>
							</div>
							<div class="clearfix"></div>
	                    </form>
	                </div>
				</div>
				<!-- agregar encargado de facultad -->
				<div class="col-md-12">
	            <div class="card">
	                <div class="header">
	                    <h4 class="title">Agregar Nuevo Encargado de Escuela</h4>
	                </div>
	                <div class="content">
	                    <form @submit.prevent="registrar" method="POST">
	                        <div class="row">
	                            <div class="col-md-2">
	                                <div class="form-group">
	                                    <label>DNI</label>
	                                    <input type="text" class="form-control" v-model="persona.dni"  maxlength="8">
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Nombres</label>
	                                    <input type="text" class="form-control" v-model="persona.nombre"  maxlength="30">
	                                </div>
	                            </div>
								<div class="col-md-4">
	                                <div class="form-group">
	                                    <label>Apellidos</label>
	                                    <input type="text" class="form-control" v-model="persona.ape"  maxlength="60">
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Celular</label>
	                                    <input type="text" class="form-control" v-model="persona.cel"  maxlength="10">
	                                </div>
	                            </div>
	                        </div>
							<div class="row">
	                            <div class="col-md-5">
	                                <div class="form-group">
	                                    <label>Direccion</label>
	                                    <input type="text" class="form-control" v-model="persona.dir"  maxlength="100">
	                                </div>
	                            </div>
								<div class="col-md-4">
	                                <div class="form-group">
	                                    <label>Escuela</label>
	                                    <select v-model="persona.idfacu" class="form-control">
											<option v-for="e in escuela" :key="e.id" :value="e.id">
												{{ e.nombre }}
											</option>
										</select>
	                                </div>
	                            </div>
								<div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Correo</label>
	                                    <input type="text" class="form-control" v-model="persona.correo"  maxlength="30">
	                                </div>
	                            </div>
							</div>
							<div class="row text-left">
								<div class="col-md-2">
									<input type="submit" value="Agregar" class="btn btn-info btn-fill pull-right">
								</div>
							</div>
							<div class="clearfix"></div>
	                    </form>
	                </div>
				</div>
				</div>
				<!-- fin agregar encargado -->

				<!-- tabla mostrar encargado por facultades-->
				<div class="content">
						<div class="col-md-12">

							<div class="card">
								<div class="header text-center">
									<h4 class="title"><b>Lista General de Escuelas</b></h4>
									<p class="category"></p>
								</div>
								
								<div class="content table-responsive table-full-width">
									<v-client-table :data="reporte" :columns="columns" :options="options">
									</v-client-table>
								</div>
							</div>
						</div>
					</div>
				<!-- fin	 -->
	         </div>
	    	</div>
	    </div>
	</div>
</template>
<script>
export default {
    data() {
        return {
            reporte: [{
                id: null,
				nombre: null,
				encargado: null
            }],
            columns: ["id","nombre","encargado"],
            options: {
				headings:
				{
					id: "id",
					nombre: "Escuela",
					encargado: "Encargado",
				},
				sortable: ["id","Nombre"],
				filterable: ["id","nombre","encargado"]
			},
			escuela: [],
			facu:null,
			persona: {
				dni:null,
				nombre:null,
				ape:null,
				cel:null,
				dir:null,
				idfacu:null,
				correo:null
			}
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('agregarescuela')
                .then(data => {
                    this.reporte = data.data.encargado;
                    this.escuela = data.data.escuela;
					this.$Progress.finish();
					console.log(data);
                }).catch(error => {
                    this.$Progress.fail();
                    console.log('Error: ' + error);
                }); 
		},
		ingresar()
		{
			axios.post("addescuela",{
				facu:this.facu
			}).then(data=>{
				console.log(data);
			}).catch(error=>{
				console.log(error);
			})

		},
		registrar()
		{
			axios.post("persona",{
				persona:this.persona
			}).then(data=>{
				console.log(data);
			}).catch(error=>{
				console.log(error);	
			})
		}
    }
}

</script>
