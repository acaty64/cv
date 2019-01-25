
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueRouter = require('vue-router');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('cv_edit-component', require('./components/cv/Edit.vue'));
// Vue.component('m2_edit-component', require('./components/modulo2/Edit.vue'));

// import { store }   from './components/cv/store.js';
// import { store } from './components/modulo2/cv_store.js';
  import Vue from 'vue';
  import Vuex from 'vuex';

  Vue.use(Vuex);

const app = new Vue({
    el: '#app',
});
