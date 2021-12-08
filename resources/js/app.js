import Vue from 'vue';
import VueRouter from "vue-router";
import './bootstrap';
import routes from './routes/index.js';
import laravelPagination from 'laravel-vue-pagination';
import moment from 'moment';

window.Vue = Vue;
Vue.use(VueRouter);

const router = new VueRouter(routes);

Vue.component('pagination', laravelPagination);
Vue.filter("timeago", value => moment(value).fromNow());
Vue.filter("longPublished", value => moment(value).format("MMMM do YYYY"));

const app = new Vue({
    el: '#app',
    router
});
