<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" v-if="data == false">Añadir Trabajo Actual</h4>
                        <h4 v-else>Editar Trabajo Actual</h4>
                    </div>
                    <div class="card-body">
                        <div v-if="!haveData">
                            <h1>No hay Datos</h1>
                            <button @click="haveData = !haveData">Agregar Datos</button>
                        </div>
                        <form @submit.prevent="addEntidad" v-else>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descripcion">Nombre de la Empresa:</label>
                                        <input type="text" class="form-control" required name="descripcion" 
                                            v-model="entidad.descripcion" id="descripcion" :class="{'error': errors.has('descripcion')}" 
                                            placeholder="Ingrese Nombre de la Empresa">
                                        <span v-if="errors.has('descripcion')" class="errorSpan">{{ errors.first('descripcion') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="web">Web:</label>
                                        <input type="text" class="form-control" name="web" 
                                            id="web" v-model="entidad.web" :class="{'error': errors.has('web')}" 
                                            v-validate="'url:require_protocol'" placeholder="Ingrese url de su empresa">
                                        <span v-if="errors.has('web')" class="errorSpan">{{ errors.first('web') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rubro">Rubro:</label>
                                        <select name="rubro" required id="rubro" class="form-control" v-model="entidad.idRubro">
                                            <option v-for="r in rubro" :value="r.id" :key="r.id">{{ r.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sector">Sector:</label>
                                        <select name="sector" required id="sector" class="form-control" v-model="entidad.idSector">
                                            <option v-for="s in sector" :value="s.id" :key="s.id">{{ s.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Telefono:</label>
                                        <input type="text" class="form-control" name="telefono" 
                                            id="telefono" required v-model="entidad.telefono" :class="{'error': errors.has('telefono')}" 
                                            placeholder="Ingrese telefono de la empresa" v-validate="'required|numeric|max:10'">
                                        <span v-if="errors.has('telefono')" class="errorSpan">{{ errors.first('telefono') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" v-if="data == false" class="btn btn-info btn-fill" 
                                    :disabled="errors.any()">
                                    Agregar Entidad
                                </button>
                                <button type="submit" v-else class="btn btn-info btn-fill" :disabled="errors.any()">Editar Entidad</button>
                            </div>
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
            haveData: false,
            entidad: {
                id: null,
                descripcion: null,
                idRubro: null,
                telefono: null,
                web: null,
                idSector: null
            },
            user: null,
            data: false,
            rubro: [ { id: null, descripcion: null } ],
            sector: [ { id: null, descripcion: null } ]
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('entidad')
                .then(data => {
                    console.log(data);
                    this.rubro = data.data.rubro;
                    this.sector = data.data.sector;
                    this.user = data.data.user;
                    if (data.data.data != null) {
                        this.entidad = data.data.data[0];
                        this.haveData = true;
                        this.data = true;
                    } else {
                        this.haveData = false;
                        this.data = false;
                    }
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    console.log('Ocurrio un error ' + error);
                });
        },
        addEntidad() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.post('entidad', {
                        params: {
                            data: this.entidad,
                            user: this.user
                        }
                    }).then(data => {
                        console.log(data);
                        if (data.data == 'correcto') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos actualizados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                this.$router.push('/ver-perfil');
                            }, 2500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo actualizar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                this.$router.push('/ver-perfil');
                            }, 2500);
                        }
                    }).catch(error => {
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Sucedió un error, comuníquese con el Administrador',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    });
                } else {
                    swal({
                        position: 'top-end',
                        type: 'error',
                        title: 'Por favor corrija los errores',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
    }
}
</script>

<style scoped>
.error {
    border-color: #dc3545;
}
.errorSpan {
    color: #dc3545;
}
</style>
