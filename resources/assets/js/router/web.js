import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Index from '../views/Topics/Index.vue'
import Create from '../views/Topics/Create.vue'
import Show from  '../views/Topics/show.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: "active",
    routes: [
        { path: '/', component: Index},
        { path: '/login', component: Login },
        { path: '/register', component: Register },
        { path: '/topic/create', component: Create },
        { path: '/topic/:id', component: Show },
        { path: '/topic/:id/:type', component: Create}
    ]
})

export default router
