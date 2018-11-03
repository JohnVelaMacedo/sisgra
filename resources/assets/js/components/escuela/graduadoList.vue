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
                                
                                <v-client-table :data="graduado" :columns="columns" :options="options">
                                <a slot="Acciones" slot-scope="props" target="_blank" :href="props.row.Acciones" class="glyphicon glyphicon-eye-open"></a>
                                
                                </v-client-table>
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
            graduado: [
                {
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
            ],
            columns: ['DNI', 'Nombre', 'egreso','Acciones'],
            options: {
                headings: {
        DNI: 'N° DNI',
        Nombre: 'Nombres',
        egreso: 'Fecha Egreso',
        Acciones:'Acciones'
      },
      sortable: ['DNI', 'Nombre','egreso'],
      filterable: ['name', 'code']
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
                   this.graduado.forEach((element,i) => {
                       this.graduado[i].Acciones=this.graduado[i].DNI;
                   });
                   console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        }
    }
}
</script>