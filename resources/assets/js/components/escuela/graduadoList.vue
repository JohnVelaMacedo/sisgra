<template>
    <div class="container-fluid">
        <div class="row" v-show="op0">
            <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <button class="btn btn-primary" @click="op=true;op0=false">Agregar</button>
                                        <!-- <router-link to="/foo" tag="button">foo</router-link> -->
                                    </div>
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 col-lg-4">
                                        <center><h4 class="title">{{detalleEscuela.Nombre}}</h4></center>
                                        <center><p class="category">Lista de graduados</p></center>
                                    </div>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                
                                <v-client-table :data="graduadoT" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <!-- <a  target="_blank" slot="Acciones" slot-scope="props" :href="props.row.Acciones" class="pe-7s-pen">ASD</a>
                                        <a  target="_blank" :href="props.row.Acciones" class="pe-7s-pen">DSA</a> -->
                                        <button class="pe-7s-pen" data-toggle="tooltip" v-on:click="editGraduado(props.row.DNI)" data-placement="left" title="Editar Graduado"></button>
                                        <button class="pe-7s-look" data-toggle="tooltip" v-on:click="viewGraduado(props.row.DNI)" data-placement="left" title="Ver Hoja de Vida"></button>
                                    </div>
                                </v-client-table>
                            </div>
                        </div>
                        <!-- <pre>
                            {{ graduadoEd }}
                        </pre> -->
                    </div>
        </div>

        <div class="row" v-show="op1">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="content">
                       <div class="header">
	                    <div class="row">
                            <div class="col-lg-1">
                                
                            </div>
                            <div class="col-lg-4">
                                <h4 class="title">Editar Graduado</h4>
                            </div>
                        </div>
	                    </div>
	                    <form @submit.prevent="editProfile">
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="dni">DNI</label>
	                                    <input type="text" class="form-control" id="dni" name="dni"  maxlength="8" v-model="graduado.DNI" required readonly>
	                                </div>
	                            </div>
	                            <div class="col-md-5">
	                                <div class="form-group">
	                                    <label for="nombres">Nombres y Apellidos</label>
	                                    <input type="text" class="form-control" id="nombre" name="nombre" v-model="graduado.Nombre" required>
	                                </div>
	                            </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo</label>
                                        <select class="form-control" name="sexo" id="sexo" v-model="graduado.Genero" required>
                                            <option value="M">Hombre</option>
                                            <option value="F">Mujer</option>
                                            <option value="I">Indefinido</option>
                                        </select>
                                    </div>
                                </div>
	                            
	                        </div>
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="fechaN">Fecha Nacimiento</label>
	                                    <input type="date" class="form-control" name="fechaN" v-model="graduado.AnioNacimiento" required>
	                                </div>
	                            </div>
                                <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="telefono">Telefono</label>
	                                    <input type="text" id="telefono"  class="form-control"  name="telefono" v-model="graduado.Telefono" required>
                                        <span class="errorSpan" v-if="errors.has('telefono')" >{{errors.first('telefono')}}</span>
	                                </div>
	                            </div>
                                <div class="col-md-6">
	                                <div class="form-group">
	                                    <label for="correo">Correo</label>
	                                    <input type="text" id="correo" class="form-control" name="correo" v-model="graduado.Correo" required>
	                                </div>
	                            </div>
	                            
	                        </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais">Pais de Residencia</label>
                                        <select name="pais" id="pais" class="form-control" v-model="graduado.idPais" required>
                                            <option v-for="p in pais" :value="p.idPais" :key="p.idPais">{{ p.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Departamento:</label>
                                        <select v-model="graduado.DepartamentoEstado" name="departamento" 
                                            id="departamento" class="form-control" required>
                                            <option v-for="d in departamento" :value="d.DepartamentoEstado" :key="d.DepartamentoEstado">
                                                {{ d.Nombre }}
                                            </option>
                                        </select>
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
	                                    <label for="direccion">Dirección</label>
	                                    <input type="text" class="form-control" name="direccion" id="direccion" v-model="graduado.Dirección" required>
	                                </div>
	                            </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado Civil:</label>
                                        <select v-model="graduado.idEstadoCivil" class="form-control" name="estado_civil" id="estado_civil" required>
                                            <option v-for="ec in estado_civil" :key="ec.id" :value="ec.id">{{ ec.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cant_hijos">Cantidad de Hijos:</label>
                                        <input type="number" name="cant_hijos" v-model="graduado.CantHijos" 
                                            id="cant_hijos" class="form-control" 
                                            min="0" max="10" maxlength="2" required>
                                        <span v-if="errors.has('cant_hijos')" class="errorSpan">{{ errors.first('cant_hijos') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discapacidad">Discapacidad:</label>
                                        <select class="form-control" v-model="graduado.idDiscapacidad" name="discapacidad" id="discapacidad" required>
                                            <option v-for="d in discapacidad" :key="d.id" :value="d.id">{{ d.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facultad">Facultad:</label>
                                        <select class="form-control" v-model="graduado.idFacultad" name="facultad" id="facultad" required>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fIngreso">Fecha de Ingreso:</label>
                                        <input type="date" name="fIngreso" id="fIngreso" class="form-control" v-model="graduado.Ingreso" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fEgreso">Fecha de Egreso:</label>
                                        <input type="date" name="fEgreso" id="fEgreso" class="form-control" v-model="graduado.egreso" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bachillerato">Año de Bachillerato:</label>
                                        <input type="text" name="bachillerato" id="bachillerato" class="form-control" 
                                            v-model="graduado.AnioBachiller" maxlength="4" required 
                                            placeholder="Ingrese su año de Bachillerato">
                                        <span v-if="errors.has('bachillerato')" class="errorSpan">{{ errors.first('bachillerato') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titulacion">Año de Titulación:</label>
                                        <input type="text" name="titulacion" id="titulacion" class="form-control" 
                                            v-model="graduado.AnioTitulo" placeholder="Ingrese su año de Titulacion" maxlength="4">
                                        <span v-if="errors.has('titulacion')" class="errorSpan">{{ errors.first('titulacion') }}</span>
                                    </div>
                                </div>
                            </div>
	                        <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <button class="btn btn-primary btn-fill pull-left" @click="submitted = false" v-on:click="op1=false;op0=true">Cancelar</button>
	                        <div class="clearfix"></div>
	                    </form>
                        
	                </div>
	            </div>
	         </div>
	    	</div>
            <!-- <pre>
                {{ graduadoIn }}
            </pre> -->

            <div class="row" v-show="op">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="content">
                       <div class="header">
	                    <center><h3 class="title">Agregar Nuevo Graduado</h3></center>
                        <hr>
	                    </div>
	                    <form @submit.prevent="agregarGraduado">
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="dni_in">DNI</label>
	                                    <input type="text" id="dni_in" name="dni_in"  v-model.trim="graduadoIn.DNIIn" required 
                                            class="form-control" maxlength="8" v-validate="'required|numeric|min:8'" 
                                            :class="{'error': errors.has('dni_in')}" placeholder="Ingrese su DNI">
                                            <span v-if="errors.has('dni_in')" class="errorSpan">{{ errors.first('dni_in') }}</span>
	                                </div>
	                            </div>
	                            <div class="col-md-5">
	                                <div class="form-group">
	                                    <label for="nombres_in">Nombres y Apellidos</label>
	                                    <input type="text" class="form-control" id="nombres_in" name="nombres_in" v-model="graduadoIn.NombresIn" v-validate="'required|alpha_spaces'"
                                            :class="{'error': errors.has('nombres_in')}" placeholder="Ingrese su nombre completo">
                                            <span v-if="errors.has('nombres_in')" class="errorSpan">{{ errors.first('nombres_in') }}</span>
	                                </div>
	                            </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo_in">Sexo</label>
                                        <select class="form-control" name="sexo_in" id="sexo_in" v-model="graduadoIn.SexoIn">
                                            <option value="M">Hombre</option>
                                            <option value="F">Mujer</option>
                                            <option value="I">Indefinido</option>
                                        </select>
                                    </div>
                                </div>
	                            
	                        </div>
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="fNacimiento_in">Fecha Nacimiento</label>
	                                    <input type="date" class="form-control" name="fNacimiento_in" v-model="graduadoIn.fNacimientoIn">
	                                </div>
	                            </div>
                                <div class="col-md-3">
	                                <div class="form-group">
	                                    <label for="telefono_in">Telefono</label>
	                                    <input type="text" id="telefono_in" v-validate="'required|numeric|max:12'" class="form-control"
                                         :class="{'error':errors.has('telefono_in')}" name="telefono_in" v-model.trim="graduadoIn.TelefonoIn">
                                        <span class="errorSpan" v-if="errors.has('telefono_in')" >{{errors.first('telefono_in')}}</span>
	                                </div>
	                            </div>
                                <div class="col-md-6">
	                                <div class="form-group">
	                                    <label for="correo">Correo</label>
	                                    <input type="text" id="correo_in" class="form-control" name="correo_in" v-model.trim="graduadoIn.CorreoIn" required 
                                             v-validate="'required|email'" 
                                            :class="{'error': errors.has('correo_in')}" placeholder="Ingrese su correo">
                                            <span v-if="errors.has('correo_in')" class="errorSpan">{{ errors.first('correo_in') }}</span>
	                                </div>
	                            </div>
	                            
	                        </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais">Pais de Residencia</label>
                                        <select name="pais_in" id="pais_in" class="form-control" v-model="graduadoIn.PaisIn">
                                            <option v-for="p in pais" :value="p.idPais" :key="p.idPais">{{ p.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Departamento:</label>
                                        <select v-model="graduadoIn.DepartamentoIn" name="departamento_in" 
                                            id="departamento_in" class="form-control">
                                            <option v-for="d in departamento" :value="d.DepartamentoEstado" :key="d.DepartamentoEstado">
                                                {{ d.Nombre }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="distrito_ciudad">Ciudad:</label>
                                        <select name="distrito_ciudad" id="distrito_ciudad" v-model="graduadoIn.DistritoCiudadIn" 
                                            class="form-control">
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
	                                    <label for="direccion_in">Dirección</label>
	                                    <input type="text" class="form-control" name="direccion_in" id="direccion_in" v-model="graduadoIn.DirecciónIn"
                                         minlength="5" v-validate="'required'" 
                                            :class="{'error': errors.has('direccion_in')}">
                                            <span v-if="errors.has('direccion_in')" class="errorSpan">{{ errors.first('direccion_in') }}</span>
	                                </div>
	                            </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado Civil:</label>
                                        <select v-model="graduadoIn.EstadoCivilIn" class="form-control" name="estado_civil" id="estado_civil">
                                            <option v-for="ec in estado_civil" :key="ec.id" :value="ec.id">{{ ec.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cant_hijos">Cantidad de Hijos:</label>
                                        <input type="number" name="CantHijos_in" v-model="graduadoIn.CantHijosIn" 
                                            id="CantHijos_in" class="form-control" v-validate="'required|between:0, 10'"
                                            min="0" max="10" :class="{'error': errors.has('CantHijos_in')}" maxlength="2">
                                        <span v-if="errors.has('CantHijos_in')" class="errorSpan">{{ errors.first('CantHijos_in') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discapacidad">Discapacidad:</label>
                                        <select class="form-control" v-model="graduadoIn.DiscapacidadIn" name="discapacidad_in" id="discapacidad_in">
                                            <option v-for="d in discapacidad" :key="d.id" :value="d.id">{{ d.descripcion }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="facultad">Facultad:</label>
                                        <select class="form-control" v-model="graduadoIn.FacultadIn" name="facultad_in" id="facultad_in">
                                            <option v-for="f in facultad" :key="f.id" :value="f.id">{{ f.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="escuela">Escuela:</label>
                                        <select class="form-control" v-model="graduadoIn.EscuelaIn" name="escuela_in" id="escuela_in">
                                            <option v-for="e in escuela" :key="e.idEscuela" :value="e.idEscuela">{{ e.Nombre }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fIngreso">Fecha de Ingreso:</label>
                                        <input type="date" name="fIngreso_in" id="fIngreso_in" class="form-control" v-model="graduadoIn.fIngresoIn" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fEgreso">Fecha de Egreso:</label>
                                        <input type="date" name="fEgreso_in" id="fEgreso_in" class="form-control" v-model="graduadoIn.fEgresoIn" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bachillerato">Año de Bachillerato:</label>
                                        <input type="text" name="bachillerato_in" id="bachillerato_in" class="form-control" 
                                            v-model="graduadoIn.BachilleratoIn" maxlength="4" required 
                                            placeholder="Ingrese su año de Bachillerato" :class="{'error': errors.has('bachillerato_in')}"
                                            v-validate="'required|date_format:YYYY'">
                                        <span v-if="errors.has('bachillerato_in')" class="errorSpan">{{ errors.first('bachillerato_in') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titulacion">Año de Titulación:</label>
                                        <input type="text" name="titulacion_in" id="titulacion_in" class="form-control" 
                                            v-model="graduadoIn.TitulacionIn" placeholder="Ingrese su año de Titulacion" maxlength="4"
                                            :class="{'error': errors.has('titulacion_in')}" v-validate="'date_format:YYYY'">
                                        <span v-if="errors.has('titulacion_in')" class="errorSpan">{{ errors.first('titulacion_in') }}</span>
                                    </div>
                                </div>
                            </div>
	                        <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <button type="button" class="btn btn-primary btn-fill pull-left" @click="submitted = false" v-on:click="op=false;op0=true">Cancelar</button>
	                        <div class="clearfix"></div>
	                    </form>
                        
	                </div>
	            </div>
	         </div>
	    	</div>
            
            <div class="row" v-show="op2">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h3 class="card-title text-center">DATOS DEL GRADUADO</h3>
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="assets/img/usuario-defecto.png" height="100" width="100" 
                                style="margin-top: 70px">
                        </div>
                        <div class="cuerpo">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="seccion">
                                <h4 class="card-title"><b>Datos Personales</b></h4>
                                <div class="datos">
                                    <p>Nombres Completos: {{ graduadoH.Nombre }}</p>
                                    <p>Fecha de Nacimiento: {{ graduadoH.AnioNacimiento | formatDate }}</p>
                                    <p>DNI: {{ graduadoH.DNI }}</p>
                                    <p>País de Nacimiento: {{ graduadoH.Pais }}</p>
                                    <p>Departamento: {{ graduadoH.Departamento }}</p>
                                    <p>Dirección: {{ graduadoH.Dirección }}</p>
                                    <p>Celular: {{ graduadoH.Telefono }}</p>
                                    <p>Estado Civil: {{ graduadoH.Estado_Civil }}</p>
                                    <p v-if="graduadoH.Genero == 'M'">Género: Masculino</p>
                                    <p v-else>Género: Femenino</p>
                                </div>
                            </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="seccion">
                                <h4 class="card-title"><b>Universidad</b></h4>
                                <div class="datos">
                                    <p>Facultad: {{ graduadoH.Facultad }}</p>
                                    <p>Escuela: {{ graduadoH.Escuela_Profesional }}</p>
                                    <p>Fecha de Ingreso: {{ graduadoH.Ingreso | formatDate }}</p>
                                    <p>Fecha de Egreso: {{ graduadoH.egreso | formatDate }}</p>
                                    <p>Año de Bachillerato: {{ graduadoH.AnioBachiller }}</p>
                                    <p v-if="graduadoH.AnioTitulo">Año de Titulación: {{ graduadoH.AnioTitulo }}</p>
                                    <p v-else>Año de Titulación: Sin datos</p>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="seccion" v-if="entidad">
                                <h4 class="card-title"><b>Empresa</b></h4>
                                <div class="datos">
                                    <p>Empresa: {{ entidad.descripcion }}</p>
                                    <p v-if="entidad.web">Web: {{ entidad.web }}</p>
                                    <p v-else>Web: <b>Sin datos</b></p>
                                    <p>Teléfono: {{ entidad.telefono }}</p>
                                    <p>Rubro: {{ entidad.Rubro }}</p>
                                    <p>Sector: {{ entidad.Sector }}</p>
                                </div>
                            </div>
                            <div class="seccion" v-else>
                                <h4 class="card-title"><b>Empresa</b></h4>
                                <div class="datos">
                                    <p>Empresa: Sin datos</p>
                                    <p>Web: Sin datos</p>
                                    <p>Teléfono: Sin datos</p>
                                    <p>Rubro: Sin datos</p>
                                    <p>Sector: Sin datos</p>
                                    
                                </div>
                            </div>
                            <div class="seccion">
                                <div class="datos">
                                    <button type="button" class="btn btn-primary btn-fill pull-right" v-on:click="op2=false;op0=true">Cerrar</button>
                                    <br><br>
                                </div>
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
            graduadoT: [
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
            graduadoH: {
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
            },
            graduadoIn: {
                BachilleratoIn: null,
                fNacimientoIn: null,
                TitulacionIn: null,
                CantHijosIn: null,
                CorreoIn: null,
                DNIIn: null,
                DepartamentoIn: null,
                DirecciónIn: null,
                DiscapacidadIn: null,
                DistritoCiudadIn: null,
                EscuelaIn: null,
                EstadoCivilIn: null,
                FacultadIn: null,
                SexoIn: null,
                fIngresoIn: null,
                NombresIn: null,
                PaisIn: null,
                TelefonoIn: null,
                fEgresoIn: null,
            },
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
            op: false,
            op0:true,
            op1:false,
            op2:false,
            pais: [],
            facultad: [],
            escuela: [],
            detalleEscuela: [],
            departamento: [],
            estado_civil: [],
            discapacidad: [],
            user: null,
            persona: {
					DNI: null,
					Nombre: null,
					Apellidos: null,
					Telefono: null,
					Direccion: null,
					idFacultad: null,
					idEscuela: null,
					Correo: null,
					estado: null
				},
            columns: ['DNI', 'Nombre', 'egreso','Acciones'],
            options: {
                headings: {
                    DNI: 'N° DNI',
                    Nombre: 'Nombres',
                    egreso: 'Fecha Egreso',
                    Acciones:'Acciones'
                        },
                sortable: ['DNI', 'Nombre','egreso'],
                filterable: ['DNI', 'Nombre']
                    }
        }
    },
    created() {
        this.getData();
        this.getPersona();
        this.getPaisDep();
    },
    methods: {
        getData() {
            axios.get('escuela')
                .then(data => {
                   this.graduadoT=data.data.graduadoEscuela;
                   this.detalleEscuela=data.data.escuelaDetalle;
                   this.graduadoT.forEach((element,i) => {
                       this.graduadoT[i].Acciones=this.graduadoT[i].DNI;
                   });
                   console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        },
        getPersona()
			{
				axios.get('admin').then(dato => {
					this.persona = dato.data.Persona[0];
					console.log(this.persona);
				}).catch(error =>console.log(error))
            },
        getPaisDep()
            {
            this.$Progress.start();
            axios.get('datos')
                .then(data => {
                    this.pais = data.data.pais;
                    this.departamento = data.data.departamento;
                    this.estado_civil = data.data.estado_civil;
                    this.discapacidad = data.data.discapacidad;
                    this.facultad = data.data.facultad;
                    this.escuela = data.data.escuela;
                    this.$Progress.finish();
                }).catch(error => {
                    console.log('Ocurrio un error ' + error);
                    this.$Progress.fail();
                }); 
        },
        editGraduado(id){
            this.op0=false;
            this.op1=true;
            this.$Progress.start();
            axios.get(`/get-graduado/${id}`)
                .then(data => {
                    this.graduado = data.data.resultado[0];
                    // this.pais = data.data.pais;
                    // this.facultad = data.data.facultad;
                    // this.escuela = data.data.escuela;
                    // this.departamento = data.data.departamento;
                    // this.estado_civil = data.data.estado_civil;
                    // this.discapacidad = data.data.discapacidad;
                    this.user = data.data.user;
                    // this.$Progress.finish();
                    // console.log(data.data.resultado[0]);
                    //console.log(this.graduado);
                }).catch(error => {
                    console.log('Ocurrio un error ' + error);
                    this.$Progress.fail();
                }); 
        },
        agregarGraduado() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.post(`graduado`, {
                        graduadoIn: this.graduadoIn,
                        // user: this.user
                    }).then(data => {
                        console.log(data);
                        if (data.data == 'ambos correcto') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos ingresados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                this.$router.push('/home');
                            }, 2500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo actualizar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            // setTimeout(() => {
                            //     this.$router.push('/ver-perfil');
                            // }, 2500);
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
        editProfile() {
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
                                this.$router.push('/listAlumnos');
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
                                this.$router.push('/listAlumnos');
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
                
            
        },
        viewGraduado(id){
            axios.get(`/get-graduado/${id}`)
                .then(data => {
                    this.graduadoH = data.data.resultado[0];
                    // this.pais = data.data.pais;
                    // this.facultad = data.data.facultad;
                    // this.escuela = data.data.escuela;
                    // this.departamento = data.data.departamento;
                    // this.estado_civil = data.data.estado_civil;
                    // this.discapacidad = data.data.discapacidad;
                    this.user = data.data.user;
                    // this.$Progress.finish();
                    // console.log(data.data.resultado[0]);
                    //console.log(this.graduado);
                    this.op0=false;
                    this.op2=true;
                }).catch(error => {
                    console.log('Ocurrio un error ' + error);
                    this.$Progress.fail();
                });
        }
    }
}
</script>
<style scoped>
    .error {
        border-color: #dc3545;
    }
    .errorSpan{
        color: #dc3545;
    }
</style>
