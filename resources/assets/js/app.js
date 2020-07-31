window.$ = window.jQuery = require('jquery');
require('popper.js');
require('bootstrap');
require('./paper-dashboard');

window._ = require('lodash');
window.moment = require('moment');
window.Swal = require('sweetalert2');
window.ajax = require('./ajax').default;
window.helpers = require('./helpers');

// window.Vue = require('vue');
//
// Vue.prototype.__ = window.__ = require('./helpers').translate;
// Vue.prototype.$eventBus = new Vue();

// require('./vue/filters');
