<template>
	<div class="content">
	    <div class="container-fluid">
	    	<div class="row">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="header">
	                    <h4 class="title">Editar Datos</h4>
	                </div>
	                <div class="content">
	                    <form action="controlador/agregarGraduado.php" method="POST">
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>DNI</label>
	                                    <input type="text" class="form-control" name="dni"  maxlength="8" v-model="persona.DNI" readonly="">
	                                </div>
	                            </div>
	                            <div class="col-md-5">
	                                <div class="form-group">
	                                    <label>Apellidos</label>
	                                    <input type="text" class="form-control" name="apellidos" v-model="persona.Apellidos" >
	                                </div>
	                            </div>
	                            <div class="col-md-4">
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Nombre</label>
	                                    <input type="text" class="form-control" name="nombre" v-model="persona.Nombre">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Correo</label>
	                                    <input type="text" class="form-control" name="dir" v-model="persona.Correo">
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Teléfono</label>
	                                    <input type="text" class="form-control" name="tel" v-model="persona.Telefono">
	                                </div>
	                            </div>
	                            <div class="col-md-6">
	                                <div class="form-group">
	                                    <label>Dirección</label>
	                                    <input type="text" class="form-control" name="dir" v-model="persona.Direccion">
	                                </div>
	                            </div>
	                        </div>

	                        <input type="submit" class="btn btn-info btn-fill pull-right">
	                        <div class="clearfix"></div>
	                    </form>
	                </div>
	            </div>
	         </div>
	    	</div>
	    </div>
	</div>
</template>
<script>
	export default 
	{
		data() {
			return {
				 persona: {
					DNI: null,
					Nombre: null,
					Apellidos: null,
					Telefono: null,
					Direccion: null,
					idFacultad: null,
					idEscuela: null,
					Correo: null,
					estado: null
				}
			}
		},
		created(){
			this.getPersona();
		},
		methods:
		{
			getPersona()
			{
				axios.get('admin').then(dato => {
					this.persona = dato.data.persona;
					console.log(this.persona);
				}).catch(error =>console.log(error))
			}
		}
	}
</script>