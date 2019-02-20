<template>
    <div class="col-md-12">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Lista General de Graduados</b></h4>
                <p class="category"></p>
            </div>
            <div class="row">
                <div class="col-md-10">&nbsp;</div>
                <div class="col-md-1"><a href="reportegeneralexcel" target="_blank"><img src="assets/img/excIcon.png" height="40" width="40"></a></div>
                <div class="col-md-1"><a href="reportegeneralpdf" target="_blank"><img src="assets/img/pdfIcon.png" height="40" width="40"></a></div>
            </div>
            <div class="content table-responsive table-full-width">
                <v-client-table :data="reporte" :columns="columns" :options="options">
                    
                </v-client-table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            reporte: [{
                DNI: null,
                Nombre: null,
                Telefono: null,
                escuela: null,
                Ingreso: null,
                egreso: null,
                AnioBachiller: null,
                AnioTitulo:null
                
            }],
            columns: ["DNI","Nombre","Telefono","escuela","Ingreso","egreso","AnioBachiller","AnioTitulo"],
            options: {
                    headings:
                    {
                        DNI: "DNI",
                        Nombre: "Graduado",
                        Telefono: "Telefono",
                        escuela: "Escuela",
                        Ingreso: "Ingreso",
                        egreso: "Egreso",
                        AnioBachiller: "Año Bachiller",
                        AnioTitulo:"Año Titulo"
                    },
                    sortable: ["DNI","Nombre","Telefono","escuela","Ingreso","egreso","AnioBachiller","AnioTitulo"],
                    filterable: ["DNI","Nombre","Telefono","escuela","Ingreso","egreso","AnioBachiller","AnioTitulo"]
                } 
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('escueladatos')
                .then(data => {
                    this.reporte = data.data.escuelas;
                    console.log(data);
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    console.log('Error: ' + error);
                }); 
        }
    }
}
</script>
