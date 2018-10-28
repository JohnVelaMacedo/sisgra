
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    { path: '/graduado', component: require('./components/Graduado.vue') },
    { path: '/', component: require('./components/ExampleComponent.vue') },
    { path: '/admin', component: require('./components/Admin.vue') },
    { path: '/example', component: require('./components/ExampleComponent.vue') },
    { path: '*', component: require('./components/ExampleComponent.vue') }
];

const router = new VueRouter({ 
    mode: 'history',
    routes 
});

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('graduado', require('./components/Graduado.vue'));
Vue.component('admin', require('./components/Admin.vue'));

// const app = new Vue({
//     el: '#graduado'
// });

const app = new Vue({
    router
  }).$mount('#app')