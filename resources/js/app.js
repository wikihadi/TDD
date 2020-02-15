import Vue from 'vue';
import store from './store/index';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import { routes } from './routes';


require('./bootstrap');

window.Vue = require('vue');

Vue.use(Vuetify);
Vue.use(VueRouter);

import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
Vue.component('date-picker', VuePersianDatetimePicker);



Vue.component('dashboard', require('./components/Dashboard.vue').default);

//Services
Vue.component('notification', require('./components/services/Notification').default);
Vue.component('contact', require('./components/services/contact').default);
Vue.component('profile', require('./components/services/Profile').default);
Vue.component('activityReportList', require('./components/services/ActivityReportList').default);

//Forms
Vue.component('activity-input', require('./components/Forms/ActivityInput').default);


const router = new VueRouter({
    mode: 'history',
    routes
});
const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        rtl: true,
        theme: { dark: false },
    }),
    router,
    store
});
