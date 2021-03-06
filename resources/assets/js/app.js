
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Event = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('add-time', require('./components/AddTime.vue'));
Vue.component('issues-list', require('./components/IssuesList.vue'));
Vue.component('issues-logged-time', require('./components/IssueLoggedTime.vue'));
Vue.component('assign-user', require('./components/AssignUser.vue'));
Vue.component('change-status', require('./components/ChangeStatus.vue'));
Vue.component('notifications', require('./components/Notifications.vue'));


const app = new Vue({
    el: '#app',
    data: {
        showModal: false,
    },
});
