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
                                <input type="file" id="excelG" class="form-control" required>
                            </div>
                            <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <br><br>
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <a type="button" href="ejemploFormato" target="_blank">Descargar Formato Ejemplo de Archivo</a>
                                <p><strong>IMPORTANTE!! </strong> El archivo a subir debe tener el mismo orden de columnas del ejemplo formato.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="" style="display: table; margin: 0 auto;">
                                <div class="loader text-center" v-show="op"></div>
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
            detalleEscuela: [],
            op:false
        }
    },
    created() {
        this.getData();
        this.op = false;
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
            this.op=true;
            axios.post('/up-graduado', data, config)
            .then(res => {
                console.log(res);
                if(res.data=="success"){
                    this.op=false;
                    document.getElementById('excelG').value='';
                    // this.$Progress.finish();
                    swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos ingresados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                //location.reload();
                            }, 1500);
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
                            console.log(err);
            //   output.className = 'container text-danger';
            //   output.innerHTML = err.message;
            });
            
        },
        qswitch(o){
            this.op=o;
        }
    }
}
</script>
<style>
.loader {
    border: 16px solid #dbd8d8; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
