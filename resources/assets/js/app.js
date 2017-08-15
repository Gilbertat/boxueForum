/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue'

import App from './App.vue'
import router from './router/web'

import Nprogress from 'nprogress'
import 'nprogress/nprogress.css'
import store from './store/store'

Nprogress.inc(0.2)
Nprogress.configure({ easing: 'ease', speed: 500, showSpinner: false})


router.beforeEach((to, from, next) => {
    Nprogress.start()
    next()
})

router.afterEach(() => {
    Nprogress.done()
})

const app = new Vue({
    el: '#root',
    store,
    template: `<app></app>`,
    components: { App },
    router
});



// $(document).ready(function () {
//
//     axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');
//
//     $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
//
//
//     $('#logout').on('click', function () {
//         var text = $(this).data('lang-logout');
//         swal({
//             title: "",
//             text: text,
//             type: "warning",
//             showCancelButton: true,
//             cancelButtonText: "取消",
//             confirmButtonText: "退出",
//             closeOnConfirm: false
//         }, function () {
//             $('#logout-form').submit();
//         });
//     });
//
//     $('#vote').click(function () {
//
//         axios({
//             url: $("#vote").attr("data-url"),
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
//             },
//         }).then(function (response) {
//             if (response.status == 200) {
//                 $(".vote_value").html(response.data['message'])
//             }
//         });
//     });
//
//     // 发帖
//     $('#topic-form-button').click(function () {
//         var method = $('.topic-form-submit').attr('data-method');
//         var url = $('.topic-form-submit').attr('data-url');
//         axios({
//             url: url,
//             method: method,
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
//             },
//             data: $('.topic-form-submit').serialize(),
//         }).then(function (response) {
//             var res = response.data;
//             var message = res.info;
//             swal({
//                 title: "",
//                 text: message,
//                 type: res.status,
//                 showConfirmButton: false,
//                 timer: 1000,
//             }, function () {
//                 window.location.href = res.href;
//             })
//         })
//     })
//
//
//     // 隐藏帖， 显示帖
//     $('#topic_delete_button').click(function () {
//         swal({
//             title: "",
//             text: '确定隐藏该帖吗？',
//             type: "warning",
//             showCancelButton: true,
//             cancelButtonText: "取消",
//             confirmButtonText: "确定",
//             closeOnConfirm: false
//         }, function () {
//             $('#topic_delete_form').submit();
//         });
//     })
//
//     $('#topic_retry_button').click(function () {
//         swal({
//             title: "",
//             text: '确定显示该帖吗？',
//             type: "warning",
//             showCancelButton: true,
//             cancelButtonText: "取消",
//             confirmButtonText: "确定",
//             closeOnConfirm: false
//         }, function () {
//             $('#topic_retry_form').submit();
//         });
//     });
//
//     $('.reply_delete_button').on('click', function () {
//         var text = $(this).attr('data-content');
//         var form_name = $(this).attr('data-form');
//         swal({
//             title: "",
//             text: text,
//             type: 'warning',
//             showCancelButton: true,
//             cancelButtonText: "取消",
//             confirmButtonText: "确定",
//             closeOnConfirm: false
//         }, function () {
//             $('.' + form_name).submit();
//         });
//     })
//
//     $(document).pjax('a[data-pjax]', '#pjax-container', {
//         timeout: 1000,
//         maxCacheLength: 500
//     });
//
//     $(document).on('pjax:start', function () {
//         NProgress.start();
//     });
//
//     $(document).on('pjax:end', function () {
//         $('.pagination').find("a").attr("data-pjax", "");
//         NProgress.done();
//     });
//
//     // 回帖
//     $('#reply-submit-button').on('click', function () {
//         var url = $('#submit-reply-form').attr('data-url');
//         axios({
//             url: url,
//             method: 'post',
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
//             },
//             data: $('#submit-reply-form').serialize(),
//         }).then(function (response) {
//             var res = response.data;
//             if (res) {
//                 swal({
//                     title: "",
//                     text: "回复成功!",
//                     type: "success",
//                     showConfirmButton: false,
//                     timer: 1000,
//                 }, function () {
//                     location.reload();
//                 });
//             } else {
//                 var message = res.info;
//                 swal({
//                     title: "",
//                     text: message,
//                     type: res.status,
//                     showConfirmButton: false,
//                     timer: 1000,
//                 })
//             }
//         })
//     })
//
//
//
// });



