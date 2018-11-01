
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VeeValidate, { Validator } from 'vee-validate';

Vue.use(VueRouter);
Vue.use(VeeValidate);

const messages = {
    alpha_spaces: (field) => `El campo ${field} solo debe contener letras y espacios.`,
    email: (field) => `El campo ${field} debe ser un correo electrónico válido.`,
    max: (field, [length]) => `El campo de ${field} no debe ser mayor a ${length} caracteres.`,
    min: (field, [length]) => `El campo de ${field} debe tener al menos ${length} caracteres.`,
    numeric: (field) => `El campo ${field} debe contener solo caracteres numéricos.`,
    required: (field) => `El campo ${field} es obligatorio.`
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

const routes = [
    { path: '/home', component: require('./components/MasterComponent.vue') },
    { path: '/admin', component: require('./components/Admin.vue') },
    { path: '/editar-perfil', component: require('./components/graduado/EditGraduado.vue') },
    { path: '/listAlumnos', component: require('./components/escuela/graduadoList.vue') },
    { path: '/example', component: require('./components/MasterComponent.vue') },
    { path: '/ver-perfil', component: require('./components/graduado/Graduado.vue') },
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

Vue.filter('formatDate', data => data.split('-').reverse().join('/'));

const app = new Vue({
    router
  }).$mount('#app');