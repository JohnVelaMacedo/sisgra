<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3>Cargar Datos a {{detalleEscuela.Nombre}}</h3>
                        <p>Subir datos de graduados al sistema</p>
                    </div>
                    <div class="well">
                        <form role="form" class="form" @submit.prevent="sendExcel">
                            <div class="form-group">
                                <p class="help-block">Seleccione un archivo .xlsx para cargar datos al sistema</p>
                                <input type="file" id="excelG" class="form-control">
                            </div>
                            <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <br><br>
                        </form>
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
            detalleEscuela: []
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('escuela')
                .then(data => {
                   this.detalleEscuela=data.data.escuelaDetalle;
                   console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        },
        sendExcel(){

            var data = new FormData();
            data.append('foo', 'bar');
            data.append('excelG', document.getElementById('excelG').files[0]);
            var config = {
                onUploadProgress: function(progressEvent) {
                var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                }
            }
            // this.$Progress.start();
            axios.post('/up-graduado', data, config)
            .then(function (res) {
                if(res.data=="success"){
                    // this.$Progress.finish();
                    swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos ingresados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                }
            })
            .catch(function (err) {
                // this.$Progress.fail();
                swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo realizar operación!: '+err,
                                showConfirmButton: false,
                                timer: 6000
                            });
            //   output.className = 'container text-danger';
            //   output.innerHTML = err.message;
            });
        }
    }
}
</script>