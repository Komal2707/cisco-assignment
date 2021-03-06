
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('./common');

require('datatables.net');
require('datatables.net-bs');
require('bootstrap-datepicker');
require('select2');

window.Vue = require('vue');

require('notyf');

// Create an instance of Notyf
// var notyf = new Notyf();

import Echo from 'laravel-echo';
import vSelect from 'vue-select';
// import { Notyf } from 'notyf';
// import 'notyf/notyf.min.css'; // for React and Vue

window.notyf = new Notyf();

// Create an instance of Notyf
// var notyf = new Notyf();

// var notyf = new Notyf();

/* window.notifyAndRedirect = function( message, url) {
    notyf.confirm( message);
    setTimeout( function() {
        window.location = url;
    }, 1500);
} */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


$(function () {
    // $('.sidebar-menu').tree();
    // $('.select2').select2();
    // $('.icheckCustom').iCheck({
    //     checkboxClass: 'icheckbox_square-blue',
    //     radioClass: 'iradio_square-blue',
    //     increaseArea: '20%' // optional
    // });


    $("body").on("collapsed.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=closed";
        }
    });

    $("body").on("expanded.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=opened";
        }
    });


    // if($.AdminLTESidebarTweak.options.EnableRemember){
        // var re = new RegExp('toggleState' +"=([^;]+)");
        // var value = re.exec(document.cookie);
        // var toggleState = (value != null) ? unescape(value[1]) : null;
        // if(toggleState == 'closed'){
        //     if($.AdminLTESidebarTweak.options.NoTransitionAfterReload){
                // $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function(){
                //     $(this).removeClass('hold-transition');
                // });
        //     }else{
                $("body").addClass('sidebar-collapse');
        //     }
        // }
    // }


});

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('RouterCreatePage', require('./components/RouterCreatePage.vue'));


Vue.component('v-select', vSelect);


// Global event bus
window.EventBus = new Vue();

window.flash = function (message, level = 'success') {
    window.EventBus.$emit('flash', { message, level });
};

window.firePost = function (callBack) {

    if (window.ajx.url != undefined) {
        axios.post(window.ajx.url, window.ajx).then(callBack).catch(function (error) {
            console.log(error);
        });
    }
};



Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app'
});