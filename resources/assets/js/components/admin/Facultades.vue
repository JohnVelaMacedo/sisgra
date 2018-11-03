<template>
    <div class="col-md-12">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Lista General de Graduados</b></h4>
                <p class="category"></p>
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
                bach: null,
                facu: null,
                esc: null,
                cant: null,
                
            }],
            columns: ["bach","facu","esc","cant"],
            options: {
                    headings:
                    {
                        bach: "Año de Bachiller",
                        facu: "Facultad",
                        esc:  "Escuela",
                        cant: "Cantidad"
                    },
                    sortable: ["bach","facu","esc","cant"],
                    filterable: ["bach","facu","esc","cant"]
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
