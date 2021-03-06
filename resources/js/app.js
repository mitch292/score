/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// Vue
import Vue from 'vue';
import VueRouter from 'vue-router';

window.Vue = Vue;
Vue.use(VueRouter);

// Font awesome icons
import { library } from '@fortawesome/fontawesome-svg-core';
import { faBaseballBall, faCalendarTimes  } from '@fortawesome/free-solid-svg-icons';
import { faGoogle } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faBaseballBall, faCalendarTimes, faGoogle);

// Axios
import axios from 'axios';
window.axios = axios;

// Internal
import './bootstrap';
import router from './routes.js';

// Our Global Store / State
import { store } from './store.js';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('score-app', require('./components/App.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        sharedState: store.state
    }
});
