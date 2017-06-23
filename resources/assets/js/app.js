/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.$ = window.jQuery = require('jquery');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function () {

   $('#login-out').on('click', function () {
       var text = $(this).data('lang-loginout');
       var href = $(this).attr('data-url');

       swal({
           title: "",
           text: text,
           type: "warning",
           showCancelButton: true,
           cancelButtonText: "取消",
           confirmButtonText: "退出",
           closeOnConfirm: false
       }, function() {
          location.href = href;
       });
   });

    $('#vote').click( function() {

        axios({
            url: $("#vote").attr("data-url"),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            },
        }).then(function (response) {
            if (response.status == 200) {
                $(".vote_value").html(response.data['message'])
            }
        });
    });

    $(document).pjax('a[data-pjax]', '#pjax-container', {
        timeout: 1000,
        maxCacheLength: 500
    });

    $(document).on('pjax:start', function () {
        NProgress.start();
    });

    $(document).on('pjax:end', function () {
       NProgress.done();

    });

});

