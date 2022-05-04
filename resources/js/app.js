/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Medcentre from "./pages/Medcentre";

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
import VueRouter from 'vue-router'

Vue.use(Vuetify)
Vue.use(VueRouter)

import 'vuetify/dist/vuetify.min.css'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin', require('./components/Admin.vue').default);

import Dashboard from './pages/Dashboard'
import Projects from './pages/Medcentre'
import Users from './pages/Users'
import Doctors from './pages/Doctors'
import Employee from './pages/Employee'
import Patient from './pages/Patient'
import Department from './pages/Department'

const routes = [
    {
        path: '/admin/',
        component: Dashboard
    },
    {
        path: '/admin/users',
        component: Users
    }
    ,{
        path: '/admin/department',
        component: Department
    },
    {
        path: '/admin/patient',
        component: Patient
    },
    {
        path: '/admin/employees',
        component: Employee
    },
    {
        path: '/admin/doctors',
        component: Doctors
    },
    {
        path: '/admin/medcentre',
        component: Medcentre
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});

