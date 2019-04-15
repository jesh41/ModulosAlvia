
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//require('bootstrap-sass');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('formrol-componente',require('./components/FormRolesComponent.vue'));
Vue.component('formusuario-componente',require('./components/usuarioscomponent.vue'));
Vue.component('cliente',require('./components/Clientes.vue'));
Vue.component('proveedor',require('./components/Proveedor.vue'));
Vue.component('rol',require('./components/Rol.vue'));

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }

});


