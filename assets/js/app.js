/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
//const $ = require('jquery');
import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App';
import router from './router/';
Vue.use(VueRouter);


new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
})
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');