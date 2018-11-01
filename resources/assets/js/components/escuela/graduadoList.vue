<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Striped Table with Hover</h4>
                                <p class="category">Here is a subtitle for this table</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>DNI</th>
                                    	<th>Nombre</th>
                                    	<th>Telefono</th>
                                    	<th>Correo</th>
                                    	<th>Fecha Nacimiento</th>
                                    	<th></th>
                                    </thead>
                                    <tbody>

                                        <tr v-for="g in graduado">
                                        	<td>{{ g.DNI }}</td>
                                        	<td>{{ g.Nombre}}</td>
                                        	<td>$36,738</td>
                                        	<td>Niger</td>
                                        	<td>Oud-Turnhout</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>

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
            axios.get('escuela')
                .then(data => {
                   this.graduado=data.data.graduadoEscuela;
                   console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        }
    }
}
</script>