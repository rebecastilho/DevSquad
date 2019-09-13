/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('tabela-component', require('./components/TabelaComponent.vue').default);
//const app = new Vue({
  //  el: '#app',
//});

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './components/App.vue';
Vue.use(VueAxios, axios);


import HomeComponent from './components/HomeComponent.vue';
import ShowComponent from './components/ShowComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import IndexComponent from './components/IndexComponent.vue';
import EditComponent from './components/EditComponent.vue';

const routes = [
  {
      name: 'home',
      path: '/',
      component: HomeComponent
  },
  {
      name: 'create',
      path: '/produto/create',
      component: CreateComponent
  },
  {
      name: 'produtos',
      path: '/produto/produtos',
      component: IndexComponent
  },
  {
      name: 'edit',
      path: '/produto/edit/:id',
      component: EditComponent
  },
  {
    name: 'show',
    path: '/produto/show/:id',
    component: ShowComponent
}
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');