<template>
	<div class="content">
	    <div class="container-fluid">
	    	<div class="row">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="header">
	                    <h4 class="title">Agregar Nuevo Facultad</h4>
	                </div>
	                <div class="content">
	                    <form @submit.prevent="ingresar" method="POST">
	                        <div class="row">
	                            <div class="col-md-8">
	                                <div class="form-group">
	                                    <label>Facultad</label>
	                                    <input type="text" v-model="facu" class="form-control" name="facu"  maxlength="30">
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
	                    <h4 class="title">Agregar Nuevo Encargado</h4>
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
	                                    <label>Facultad</label>
	                                    <select v-model="persona.idfacu" class="form-control">
											<option v-for="f in facultad" :key="f.id" :value="f.id">
												{{ f.Nombre }}
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
									<h4 class="title"><b>Lista General de Facultades</b></h4>
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
				facultad: null,
				encargado: null
            }],
            columns: ["id","facultad","encargado"],
            options: {
				headings:
				{
					id: "id",
					facultad: "Facultad",
					encargado: "Encargado",
				},
				sortable: ["id","facultad"],
				filterable: ["id","facultad","encargado"]
			},
			facultad: [],
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
            axios.get('agregarfacultad')
                .then(data => {
                    this.reporte = data.data.encargado;
                    this.facultad = data.data.facultad;
					this.$Progress.finish();
					console.log(data);
                }).catch(error => {
                    this.$Progress.fail();
                    console.log('Error: ' + error);
                }); 
		},
		ingresar()
		{
			axios.post("facultad",{
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
					text:  "Verifique ingreso de datos",
					showConfirmButton: true,
				});
			})

		},
		registrar()
		{
			axios.post("persona",{
				persona:this.persona
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
					text:  "Verifique ingreso de datos",
					showConfirmButton: true,
				});
			})
		}
    }
}

</script>
