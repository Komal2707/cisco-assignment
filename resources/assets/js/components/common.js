/**
 * Created by sreejesh on 04/10/18.
 */

var AdminLTEOptions = {
    sidebarExpandOnHover: true,
    enableBoxRefresh: true,
    enableBSToppltip: true,

};


window.Vue = require('vue');

require('./filters/price_filiters.js');
require('./filters/date_filters.js');

import VueMoment from 'vue-moment';
import moment from 'moment-timezone';

Vue.use(require('vue-moment'));

require('admin-lte');

require('./plugins/icheck');
require('datatables.net');
require('datatables.net-bs');
require('bootstrap-datepicker');
require('select2');

require('notyf');
require('./plugins/loading-bar');
require('socket.io-client');
import Echo from 'laravel-echo';
import vSelect from 'vue-select';
var Chart = require('chart.js');

/* Mixins */
require('./mixins/helpers.js');

//write any tweak configuration related template in this object

    $.AdminLTESidebarTweak = {};


    $.AdminLTESidebarTweak.options = {
       EnableRemember: true,
       NoTransitionAfterReload: false
};




window.notyf = new Notyf();

window.notifyAndRedirect = function( message, url) {
    notyf.confirm( message);
    setTimeout( function() {
        window.location = url;
    }, 1500);
}
$(function () {
    $('.sidebar-menu').tree();
    $('.select2').select2();
    $('.icheckCustom').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });


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


    if($.AdminLTESidebarTweak.options.EnableRemember){
        var re = new RegExp('toggleState' +"=([^;]+)");
        var value = re.exec(document.cookie);
        var toggleState = (value != null) ? unescape(value[1]) : null;
        if(toggleState == 'closed'){
            if($.AdminLTESidebarTweak.options.NoTransitionAfterReload){
                $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function(){
                    $(this).removeClass('hold-transition');
                });
            }else{
                $("body").addClass('sidebar-collapse');
            }
        }
    }


});

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
    'datepicker',
    require('vuejs-datepicker')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

// Vue.component('notifications', require('./components/NotifyListComponent.vue'));
Vue.component('RouterCreatePage', require('./components/router/RouterCreatePage.vue'));

Vue.component('flash', require('./components/util/Flash.vue'));

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',

});
Vue.component('v-select', vSelect);

window.transformDate = function( date, format = 'DD/MM/YYYY') {
    return moment( date).utc().local().format( format);
}
