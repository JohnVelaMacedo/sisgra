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
                Aniobachiller: null,
                facultad: null,
                escuela: null,
                cantidad: null,
                
            }],
            columns: ["AnioBachiller","facultad","escuela","cantidad"],
            options: {
                    headings:
                    {
                        Aniobachiller: "Año de Bachiller",
                        facultad: "Facultad",
                        escuela: "Escuela",
                        cantidad: "Cantidad"
                    },
                    sortable: ["AnioBachiller","facultad","escuela","cantidad"],
                    filterable: ["AnioBachiller","facultad","escuela","cantidad"]
                } 
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('facultadesdatos')
                .then(data => {
                    this.reporte = data.data.resultado;
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
