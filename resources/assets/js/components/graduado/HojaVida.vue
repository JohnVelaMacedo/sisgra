<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h3 class="card-title text-center">DATOS DEL GRADUADO</h3>
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="assets/img/usuario-defecto.png" height="100" width="100" 
                                style="margin-top: 70px">
                        </div>
                        <div class="cuerpo">
                            <div class="seccion">
                                <h4 class="card-title"><b>Datos Personales</b></h4>
                                <div class="datos">
                                    <p>Nombres Completos: {{ graduado.Nombre }}</p>
                                    <p>Fecha de Nacimiento: {{ graduado.AnioNacimiento | formatDate }}</p>
                                    <p>DNI: {{ graduado.DNI }}</p>
                                    <p>País de Nacimiento: {{ graduado.Pais }}</p>
                                    <p>Departamento: {{ graduado.Departamento }}</p>
                                    <p>Dirección: {{ graduado.Dirección }}</p>
                                    <p>Celular: {{ graduado.Telefono }}</p>
                                    <p>Estado Civil: {{ graduado.Estado_Civil }}</p>
                                    <p v-if="graduado.Genero == 'M'">Género: Masculino</p>
                                    <p v-else>Género: Femenino</p>
                                </div>
                            </div>
                            <div class="seccion">
                                <h4 class="card-title"><b>Universidad</b></h4>
                                <div class="datos">
                                    <p>Facultad: {{ graduado.Facultad }}</p>
                                    <p>Escuela: {{ graduado.Escuela_Profesional }}</p>
                                    <p>Fecha de Ingreso: {{ graduado.Ingreso | formatDate }}</p>
                                    <p>Fecha de Egreso: {{ graduado.egreso | formatDate }}</p>
                                    <p>Año de Bachillerato: {{ graduado.AnioBachiller }}</p>
                                    <p v-if="graduado.AnioTitulo">Año de Titulación: {{ graduado.AnioTitulo }}</p>
                                    <p v-else>Año de Titulación: Sin datos</p>
                                </div>
                            </div>
                            <div class="seccion" v-if="entidad">
                                <h4 class="card-title"><b>Empresa</b></h4>
                                <div class="datos">
                                    <p>Empresa: {{ entidad.descripcion }}</p>
                                    <p v-if="entidad.web">Web: {{ entidad.web }}</p>
                                    <p v-else>Web: <b>Sin datos</b></p>
                                    <p>Teléfono: {{ entidad.telefono }}</p>
                                    <p>Rubro: {{ entidad.Rubro }}</p>
                                    <p>Sector: {{ entidad.Sector }}</p>
                                </div>
                            </div>
                            <div class="seccion" v-else>
                                <h4 class="card-title"><b>Empresa</b></h4>
                                <div class="datos">
                                    <p>Empresa: Sin datos</p>
                                    <p>Web: Sin datos</p>
                                    <p>Teléfono: Sin datos</p>
                                    <p>Rubro: Sin datos</p>
                                    <p>Sector: Sin datos</p>
                                </div>
                            </div>
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
            graduado: [{
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
            }],
            entidad: [{
                Rubro: null,
                Sector: null,
                descripcion: null,
                telefono: null,
                web: null
            }]
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('hoja-vida')
                .then(data => {
                    this.graduado = data.data.resultado[0];
                    this.entidad = data.data.entidad[0];
                    this.$Progress.finish();
                    console.log(this.entidad);
                }).catch(error => {
                    this.$Progress.fail();
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>
.datos {
    padding-left: 20px;
}
.cuerpo {
    padding-left: 60px;
}
</style>
