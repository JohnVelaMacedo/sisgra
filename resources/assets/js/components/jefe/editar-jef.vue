<template>
	<div class="content">
	    <div class="container-fluid">
	    	<div class="row">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="header">
	                    <h4 class="title">Editar datos</h4>
	                </div>
	                <div class="content">
	                    <form @submit.prevent="ingresar" method="POST">
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>DNI</label>
	                                    <input type="text" class="form-control" name="dni" v-model="persona.DNI"  maxlength="8" readonly="">
	                                </div>
	                            </div>
	                            <div class="col-md-5">
	                                <div class="form-group">
	                                    <label>Apellidos</label>
	                                    <input type="text" class="form-control" name="apellidos" v-model="persona.Apellidos">
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
				axios.get(`persona/{param}`).then(dato => {
					this.persona = dato.data.persona[0];
					console.log(dato);
				}).catch(error =>console.log(error))
			},
			ingresar()
			{
				axios.put(`persona/{param}`, {
				persona:this.persona
				}).then(data => {
                        if (data.data == 'correcto') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos actualizados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                this.$router.push('/jefedepartamento');
                            }, 2500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo actualizar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                this.$router.push('/jefedepartamento');
                            }, 2500);
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