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
                                    <p>Nombres y Apellidos: John Ray Vela Macedo</p>
                                    <p>Fecha de Nacimiento: 31/12/1997</p>
                                    <p>DNI: 70370572</p>
                                    <p>País de Nacimiento: Perú</p>
                                    <p>Celular: 998428074</p>
                                    <p>Género: Masculino</p>
                                </div>
                            </div>
                            <div class="seccion">
                                <h4 class="card-title"><b>Universidad</b></h4>
                                <div class="datos">
                                    <p>Facultad: Ingeniería de Sistemas</p>
                                    <p>Escuela: Escuela Profesional de Ingeniería de Sistemas</p>
                                    <p>Año de Ingreso: 04/12/2014</p>
                                    <p>Año de Egreso: 04/12/2018</p>
                                </div>
                            </div>
                            <div class="seccion">
                                <h4 class="card-title"><b>Datos Personales</b></h4>
                            </div>
                            <div class="seccion">
                                <h4 class="card-title"><b>Datos Personales</b></h4>
                                <a href="reporteexcel" target="_blank">Descargar Excel</a>
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
    methods: {
        getData() {
            
        }
    }
}
</script>

<style>
.datos {
    padding-left: 20px;
}
.cuerpo {
    padding-left: 60px;
}
</style>
