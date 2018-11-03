<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos del Graduado</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <p>{{ graduado.Nombre }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <p>{{ graduado.Correo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dni">DNI:</label>
                                        <p>{{ graduado.DNI }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Telefono:</label>
                                        <p>{{ graduado.Telefono }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="genero">Genero:</label>
                                        <p v-if="graduado.Genero == 'M'">Masculino</p>
                                        <p v-else>Femenino</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <p>{{ graduado.Dirección }}</p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="anio_nacimiento">Año Nacimiento:</label>
                                        <p>{{ graduado.AnioNacimiento | formatDate }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais">Pais:</label>
                                        <p>{{ graduado.Pais }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Departamento:</label>
                                        <p>{{ graduado.Departamento }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="distrito_ciudad">Ciudad:</label>
                                        <p>{{ graduado.DistritoCiudad }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado Civil:</label>
                                        <p>{{ graduado.Estado_Civil }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cant_hijos">Cantidad de Hijos:</label>
                                        <p v-if="graduado.CantHijos == 0">No tiene hijos</p>
                                        <p v-else-if="graduado.CantHijos == 1">{{ graduado.CantHijos }} hijo(a)</p>
                                        <p v-else>{{ graduado.CantHijos }} hijos(as)</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discapacidad">Discapacidad:</label>
                                        <p>{{ graduado.Discapacidad }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facultad">Facultad:</label>
                                        <p>{{ graduado.Facultad }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="escuela">Escuela:</label>
                                        <p>{{ graduado.Escuela_Profesional }}</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-image">
                        <img src="assets/img/sidebar-5.jpg" width="800" height="100" alt="">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="assets/img/usuario-defecto.png" 
                                height="100" width="100" alt="">
                            <h5 class="title">{{ graduado.Nombre }}</h5>
                        </div>
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
            graduado: {
                AnioBachiller: null,
                AnioNacimiento: null,
                AnioTitulo: null,
                CantHijos: null,
                Correo: null,
                DNI: null,
                Departamento: null,
                Dirección: null,
                Discapacidad: null,
                DistritoCiudad: null,
                Escuela_Profesional: null,
                Estado_Civil: null,
                Facultad: null,
                Genero: null,
                Ingreso: null,
                Nombre: null,
                Pais: null,
                Telefono: null,
                egreso: null,
            }
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('datos')
                .then(data => {
                    this.graduado = data.data.resultado[0];
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    console.log('Error: ' + error);
                }); 
        }
    }
}
</script>