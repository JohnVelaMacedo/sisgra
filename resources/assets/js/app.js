
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from "moment";
import VueRouter from 'vue-router';
import VeeValidate, { Validator } from 'vee-validate';
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';
import {ServerTable, ClientTable, Event} from 'vue-tables-2';

Vue.use(ClientTable);

window.swal = swal;

Vue.filter('formatDate', function(data) {
    return moment(data).format("DD/MM/YYYY"); 
});

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
});

Vue.use(VueRouter);
Vue.use(VeeValidate);

// Configuración de los mensajes de validación
const messages = {
    alpha_spaces: (field) => `El campo ${field} solo debe contener letras y espacios.`,
    between: (field, [min, max]) => `Este campo debe estar entre ${min} y ${max}.`,
    email: (field) => `El campo ${field} debe ser un correo electrónico válido.`,
    date_format: (field, [format]) => format == 'YYYY' ? `Este campo debe tener formato de año` : `Este campo debe tener formato ${format}.`,
    max: (field, [length]) => `El campo de ${field} no debe ser mayor a ${length} caracteres.`,
    min: (field, [length]) => `El campo de ${field} debe tener al menos ${length} caracteres.`,
    numeric: (field) => `Este campo debe contener solo caracteres numéricos.`,
    required: (field) => `El campo ${field} es obligatorio.`,
    url: (field) => `Este campo no es una URL válida.`
};

const locale = {
    name: 'en',
    messages
};

Validator.localize({ [locale.name]: locale });
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Rutas 
const routes = [
    { path: '/home', component: require('./components/MasterComponent.vue') },
    { path: '/admin', component: require('./components/Admin.vue') },
    //principio rutas admin
    { path: '/editar-admin', component: require('./components/admin/editar-admin.vue') },
    { path: '/Facultades', component: require('./components/admin/Facultades.vue') },
    { path: '/AgregarFacultades', component: require('./components/admin/AgregarFacultades.vue') },
    { path: '/Graduados', component: require('./components/admin/Graduados.vue') },
    { path: '/editar-admin', component: require('./components/admin/editar-admin.vue') }, 
    //fin rutas admin
    //principio rutas jefe departamento
    { path: '/editar-jefe', component: require('./components/jefe/editar-jef.vue') }, 
    { path: '/AgregarEscuela', component: require('./components/jefe/agregarescuela.vue') }, 
    { path: '/ReporteFacultad', component: require('./components/jefe/reporteescuela.vue') }, 
    { path: '/ReporteEscuela', component: require('./components/jefe/reportefacultad.vue') }, 
    //fin rutas jefe de departamento
    
    { path: '/editar-perfil', component: require('./components/graduado/EditGraduado.vue') },
    { path: '/listAlumnos', component: require('./components/escuela/graduadoList.vue') },
    { path: '/example', component: require('./components/MasterComponent.vue') },
    { path: '/ver-perfil', component: require('./components/graduado/Graduado.vue') },
    { path: '/trabajo', component: require('./components/graduado/Trabajo.vue') },
    { path: '/ver-hoja-vida', component: require('./components/graduado/HojaVida.vue') },
    { path: '*', component: require('./components/MasterComponent.vue') }
];

const router = new VueRouter({ 
    mode: 'history',
    routes 
});

Vue.component('example-component', require('./components/MasterComponent.vue'));
Vue.component('ver-perfil', require('./components/graduado/Graduado.vue'));
Vue.component('editar-perfil', require('./components/graduado/EditGraduado.vue'));
Vue.component('admin', require('./components/Admin.vue'));

// const app = new Vue({
//     el: '#graduado'
// });

const app = new Vue({
    router
}).$mount('#app');