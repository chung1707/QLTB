/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dropzone-uploader', require('./components/dropZoneImgUploader.vue').default);

Vue.component('block-user', require('./components/admin/user_management/blockUser.vue').default);

Vue.component('account-infos', require('./components/admin/user_management/infos.vue').default);

//category
Vue.component('edit-category', require('./components/admin/category/edit_category.vue').default);
Vue.component('add-category', require('./components/admin/category/add_category.vue').default);

//equipment
Vue.component('edit-supplier', require('./components/admin/supplier/edit_supplier.vue').default);
Vue.component('add-supplier', require('./components/admin/supplier/add_supplier.vue').default);

// import
Vue.component('import', require('./components/admin/import/import.vue').default);

//equipment

Vue.component('edit-equipment', require('./components/equipment/edit_equipment.vue').default);
Vue.component('restore-equipment', require('./components/equipment/restore_equipment.vue').default);


//cart
Vue.component('add-to-cart', require('./components/cart/addToCart.vue').default);
Vue.component('cart-icon', require('./components/cart/cartIcon.vue').default);
// export
Vue.component('export', require('./components/cart/export.vue').default);

//sell
Vue.component('sell', require('./components/sell_cart/sell.vue').default);
Vue.component('sell-cart-icon', require('./components/sell_cart/sellCartIcon.vue').default);
Vue.component('add-to-sell-cart', require('./components/sell_cart/addToSellCart.vue').default);

// print invoice
Vue.component('print', require('./components/print_invoice.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//vuex
 import Vue from 'vue';
 import Vuex from 'vuex';
 Vue.use(Vuex);

 import storeConfig from './store';

 const store = new Vuex.Store(storeConfig);
 Vue.config.productionTip = false;

// vee validate 3
import { ValidationObserver } from 'vee-validate';
import { ValidationProvider } from 'vee-validate';

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

import  './vee_rules';

const app = new Vue({
    el: '#app',store,
});
