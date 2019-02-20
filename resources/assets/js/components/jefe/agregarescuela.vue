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
								<!-- <div class="col-md-5">
	                                <div class="form-group">
	                                    <label>Alter table</label>
	                                    <input type="text" class="form-control" @keyup="alter()">
	                                </div>
	                            </div> -->
								<div class="col-md-4">
	                                <div class="form-group">
	                                    <label>Escuela</label>
	                                    <select v-model="persona.idesc" class="form-control">
											<option v-for="e in escuela" :key="e.idEscuela" :value="e.idEscuela">
												{{ e.Nombre }}
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
									<h4 class="title"><b>Directores de Escuela</b></h4>
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
                ID: null,
				escuela: null,
				encargado: null
            }],
            columns: ["ID","escuela","encargado"],
            options: {
				headings:
				{
					ID: "ID",
					escuela: "Escuela",
					encargado: "Encargado",
				},
				sortable: ["ID","escuela","encargado"],
				filterable: ["ID","escuela","encargado"]
			},
			escuela: [],
			facu:null,
			persona: {
				dni:null,
				nombre:null,
				ape:null,
				cel:null,
				dir:null,
				idesc:null,
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
            axios.get('getEncargadosEscuela')
                .then(data => {
                    this.reporte = data.data.encargados;
                    this.escuela = data.data.escuelas;
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
				swal({
					type: 'success',
					title: 'Datos ingresados correctamente',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(() => {
					location.reload();
				}, 1500);
			}).catch(error=>{
				console.log(error);
				swal({
					type: 'error',
					title: 'Error',
					text: 'Llene los campos obligatorios',
					showConfirmButton: true,
				});
			})

		},
		registrar()
		{
			axios.post("addEncargado",{
				persona:this.persona
			}).then(data=>{
				swal({
					type: 'success',
					title: 'Datos ingresados correctamente',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(() => {
					location.reload();
				}, 1500);
				console.log(data);
			}).catch(error=>{
				console.log(error);	
				swal({
					type: 'error',
					title: 'Error',
					text: 'Llene los campos obligatorios',
					showConfirmButton: true,
				});
			})
		},
		
    }
}

</script>
