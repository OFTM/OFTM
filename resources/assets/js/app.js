/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import Vue from 'vue';
import VueEvents from 'vue-events';
import Slideout from 'vue-slideout';
import Datepicker from 'vuejs-datepicker';
import * as lang from "vuejs-datepicker/src/locale";

Vue.component('fencertable', require('./components/fencertable'))
Vue.component('tournamenttable', require('./components/tournamenttable'))
Vue.use(VueEvents)

const app = new Vue({
    el: '#app',
    components: {
        Slideout,
        Datepicker,
    },
    data() {
        return {
            languages: lang,
            dateformat: "dd.MM.yyyy",
        };
    },
    methods: {
        open: function () {
            document.getElementById('slideout-button').classList.remove("fa-angle-right");
            document.getElementById('slideout-button').classList.add("fa-angle-left");
        },
        close: function () {
            document.getElementById('slideout-button').classList.remove("fa-angle-left");
            document.getElementById('slideout-button').classList.add("fa-angle-right");
        }
    },
    mounted: function () {
        if (window.innerWidth > 768) {
            this.$children[0].slideout.toggle();
        }
    }
});

export default {
    components: {Datepicker}
}