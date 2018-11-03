<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Añadir Trabajo Actual</h4>
                    </div>
                    <div class="card-body">
                        <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
                        <!-- <table class="table">
                            <thead>
                                <tr>
                                    <th>Rubro</th>
                                    <th>Sector</th>
                                    <th>Descripcion</th>
                                    <th>Telefono</th>
                                    <th>Web</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table> -->
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
            columns: ['id', 'name', 'age'],
            tableData: [
                { id: 1, name: "John", age: "20" },
                { id: 2, name: "Jane", age: "24" },
                { id: 3, name: "Susan", age: "16" },
                { id: 4, name: "Chris", age: "55" },
                { id: 5, name: "Dan", age: "40" }
            ],
        }
    },
    methods: {

    }
}
</script>
