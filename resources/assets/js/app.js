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

    axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);


    $('#logout').on('click', function () {
        var text = $(this).data('lang-logout');
        swal({
            title: "",
            text: text,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "取消",
            confirmButtonText: "退出",
            closeOnConfirm: false
        }, function () {
            $('#logout-form').submit();
        });
    });

    $('#vote').click(function () {

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

    // 隐藏帖， 显示帖
    $('#topic_delete_button').click(function () {
        swal({
            title: "",
            text: '确定隐藏该帖吗？',
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "取消",
            confirmButtonText: "确定",
            closeOnConfirm: false
        }, function () {
            $('#topic_delete_form').submit();
        });
    })

    $('#topic_retry_button').click(function () {
        swal({
            title: "",
            text: '确定显示该帖吗？',
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "取消",
            confirmButtonText: "确定",
            closeOnConfirm: false
        }, function() {
            $('#topic_retry_form').submit();
        });
    });

    $('.reply_delete_button').on('click', function () {
        var text = $(this).attr('data-content');
        var form_name = $(this).attr('data-form');
        console.log(form_name);
        swal({
            title:"",
            text: text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: "取消",
            confirmButtonText: "确定",
            closeOnConfirm: false
        }, function () {
            $('.' + form_name).submit();
        });
    })

    $(document).pjax('a[data-pjax]', '#pjax-container', {
        timeout: 1000,
        maxCacheLength: 500
    });

    $(document).on('pjax:start', function () {
        NProgress.start();
    });

    $(document).on('pjax:end', function () {
        $('.pagination').find("a").attr("data-pjax", "");
        NProgress.done();
    });
});

