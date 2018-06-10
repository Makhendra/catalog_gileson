// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

$('#search').submit(function (event) {
    event.preventDefault();

    var form = $(this);
    var action = form.attr('action');
    var search = new FormData();
    var result_div = form.find('.result');
    var serialize = form.serializeArray();
    serialize.forEach(function (item, i, arr) {
        search.append(item.name, item.value);
    });

    $.ajax({
        method: "POST",
        url: action,
        data: search,
        contentType: false,
        processData: false,
        datatype: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        }
    });

    return false;
});