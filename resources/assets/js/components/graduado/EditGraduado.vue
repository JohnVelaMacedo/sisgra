<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Perfil</h4>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="editProfile">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" 
                                            required v-model="graduado.Nombre" v-validate="'required|alpha_spaces'"
                                            :class="{'error': errors.has('nombre')}" placeholder="Ingrese su nombre completo">
                                        <span v-if="errors.has('nombre')" class="errorSpan">{{ errors.first('nombre') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <input type="email" name="correo" id="correo" class="form-control" required 
                                            v-model.trim="graduado.Correo" v-validate="'required|email'" 
                                            :class="{'error': errors.has('correo')}" placeholder="Ingrese su correo">
                                        <span v-if="errors.has('correo')" class="errorSpan">{{ errors.first('correo') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dni">DNI:</label>
                                        <input type="text" name="dni" id="dni" required v-model.trim="graduado.DNI" 
                                            class="form-control" maxlength="8" v-validate="'required|numeric|min:8'" 
                                            :class="{'error': errors.has('dni')}" placeholder="Ingrese su DNI" readonly>
                                        <span v-if="errors.has('dni')" class="errorSpan">{{ errors.first('dni') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Celular:</label>
                                        <input type="text" name="telefono" id="telefono" v-model.trim="graduado.Telefono" 
                                            class="form-control" required maxlength="10" v-validate="'required|numeric|min:9|max:10'" 
                                            :class="{'error': errors.has('telefono')}" placeholder="Ingrese su número de celular">
                                        <span v-if="errors.has('telefono')" class="errorSpan">{{ errors.first('telefono') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="genero">Genero:</label>
                                        <select name="genero" id="genero" class="form-control" v-model="graduado.Genero">
                                            <option value="F">Femenino</option>
                                            <option value="M">Masculino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="anio_nacimiento">Año Nacimiento:</label>
                                        <input type="date" name="anio_nacimiento" id="anio_nacimiento" class="form-control" required
                                            v-model="graduado.AnioNacimiento">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" name="direccion" required v-model="graduado.Dirección" id="direccion"
                                            class="form-control" minlength="5" v-validate="'required'" 
                                            :class="{'error': errors.has('direccion')}">
                                        <span v-if="errors.has('direccion')" class="errorSpan">{{ errors.first('direccion') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais">Pais:</label>
                                        <select name="pais" id="pais" class="form-control" v-model="graduado.idPais" @change="changePais(graduado.idPais)">
                                            <option v-for="p in pais" :value="p.idPais" :key="p.idPais">{{ p.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Departamento:</label>
                                        <select v-model="graduado.DepartamentoEstado" name="departamento" 
                                            id="departamento" class="form-control" required
                                            v-validate="'required'" :class="{'error': errors.has('telefono')}">
                                            <option v-if="departamento.length == 0" value="">No hay departamento disponible</option>
                                            <option v-else v-for="d in departamento" :value="d.DepartamentoEstado" :key="d.DepartamentoEstado">
                                                {{ d.Nombre }}
                                            </option>
                                        </select>
                                        <span v-if="errors.has('departamento')" class="errorSpan">{{ errors.first('departamento') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="distrito_ciudad">Ciudad:</label>
                                        <select name="distrito_ciudad" id="distrito_ciudad" v-model="graduado.DistritoCiudad" 
                                            class="form-control" required>
                                            <option value="calleria">Calleria</option> 
                                            <option value="coronel-portillo">Coronel Portillo</option> 
                                            <option value="manantay">Manantay</option> 
                                            <option value="coronel-portillo">Coronel Portillo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado Civil:</label>
                                        <select v-model="graduado.idEstadoCivil" class="form-control" name="estado_civil" id="estado_civil">
                                            <option v-for="ec in estado_civil" :key="ec.id" :value="ec.id">{{ ec.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cant_hijos">Cantidad de Hijos:</label>
                                        <input type="number" name="cant_hijos" v-model="graduado.CantHijos" 
                                            id="cant_hijos" class="form-control" v-validate="'required|between:0, 10'"
                                            min="0" max="10" :class="{'error': errors.has('cant_hijos')}" maxlength="2">
                                        <span v-if="errors.has('cant_hijos')" class="errorSpan">{{ errors.first('cant_hijos') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discapacidad">Discapacidad:</label>
                                        <select class="form-control" v-model="graduado.idDiscapacidad" name="discapacidad" id="discapacidad">
                                            <option v-for="d in discapacidad" :key="d.id" :value="d.id">{{ d.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facultad">Facultad:</label>
                                        <select class="form-control" v-model="graduado.idFacultad" name="facultad" id="facultad"
                                            @change="changeEscuela(graduado.idFacultad)">
                                            <option v-for="f in facultad" :key="f.id" :value="f.id">{{ f.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="escuela">Escuela:</label>
                                        <select class="form-control" v-model="graduado.idEscuela" name="escuela" id="escuela" required>
                                            <option v-for="e in escuela" :key="e.idEscuela" :value="e.idEscuela">{{ e.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bachillerato">Año de Bachillerato:</label>
                                        <input type="text" name="bachillerato" id="bachillerato" class="form-control" 
                                            v-model="graduado.AnioBachiller" maxlength="4" required 
                                            placeholder="Ingrese su año de Bachillerato" :class="{'error': errors.has('bachillerato')}"
                                            v-validate="'required|date_format:YYYY'">
                                        <span v-if="errors.has('bachillerato')" class="errorSpan">{{ errors.first('bachillerato') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="titulacion">Año de Titulación:</label>
                                        <input type="text" name="titulacion" id="titulacion" class="form-control" 
                                            v-model="graduado.AnioTitulo" placeholder="Ingrese su año de Titulacion" maxlength="4"
                                            :class="{'error': errors.has('titulacion')}" v-validate="'date_format:YYYY'">
                                        <span v-if="errors.has('titulacion')" class="errorSpan">{{ errors.first('titulacion') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" :disabled="errors.any()" class="btn btn-info btn-fill">Actualizar Perfil</button>
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
            graduado: {
                AnioBachiller: null,
                AnioNacimiento: null,
                AnioTitulo: null,
                CantHijos: null,
                Correo: null,
                DNI: null,
                Departamento: null,
                DepartamentoEstado: null,
                Dirección: null,
                Discapacidad: null,
                DistritoCiudad: null,
                Escuela_Profesional: null,
                Estado_Civil: null,
                Facultad: null,
                Genero: null,
                idDiscapacidad: null,
                idEscuela: null,
                idEstadoCivil: null,
                idFacultad: null,
                idPais: null,
                Ingreso: null,
                Nombre: null,
                Pais: null,
                Telefono: null,
                egreso: null,
            },
            pais: [],
            facultad: [],
            escuela: [],
            departamento: [],
            estado_civil: [],
            discapacidad: [],
            user: null
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('datos')
                .then(data => {
                    this.graduado = data.data.resultado[0];
                    this.pais = data.data.pais;
                    this.facultad = data.data.facultad;
                    this.escuela = data.data.escuela;
                    this.departamento = data.data.departamento;
                    this.estado_civil = data.data.estado_civil;
                    this.discapacidad = data.data.discapacidad;
                    this.user = data.data.user;
                    this.$Progress.finish();
                }).catch(error => {
                    console.log('Ocurrio un error ' + error);
                    this.$Progress.fail();
                }); 
        },
        editProfile() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.put(`graduado/${this.user}`, {
                        graduado: this.graduado,
                        user: this.user
                    }).then(data => {
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
                        console.log(`Error: ${error}`);
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
        },
        changePais(id) {
            axios.get(`graduado/${id}`)
                .then(data => {
                    this.departamento = data.data.pais;
                }).catch(error => {
                    console.log(error);
                });
        },
        changeEscuela(id) {
            axios.get(`graduado/${id}`)
                .then(data => {
                    this.escuela = data.data.escuela;
                }).catch(error => {
                    console.log(error);
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
