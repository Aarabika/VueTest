
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('pagination', require('./components/PaginationComponent.vue'));
Vue.component('task_table', require('./components/TaskTableComponent.vue'));
import  task_info from './components/TaskInfoComponent.vue'

const routes = [
    {path: '/:id', component: task_info, name: 'info', props: true},
];

const router = new VueRouter({ routes });

const app = new Vue({ router }).$mount('#app');
