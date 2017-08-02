<template>
    <div>
        <div role="navigation" class="navbar navbar-default topnav ">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <router-link to="/" class="navbar-brand">泊学论坛</router-link>

                </div>

                <div id="top-navbar-collapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <router-link to="#">话题列表</router-link>
                        </li>
                        <li>
                            <router-link to="https://boxueio.com/" target="_blank">泊学</router-link>
                        </li>
                    </ul>
                    <div class="navbar-right">
                        <div class="aw-search-box hidden-xs hidden-sm">
                            <form class="navbar-search global_search_form">
                                <input class="form-control search-query" type="text" placeholder="搜索问题或人">
                                <span title="搜索" class="global_search_btn">
                            <i class="fa fa-search"></i>
                        </span>
                            </form>
                        </div>

                        <ul class="nav navbar-nav login">
                            <template v-if="auth">
                                <li>
                                </li>
                                <li>
                                    <router-link to="#" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                 aria-expanded="false"
                                                 id="dLabel">
                                        <img class="avatar-topnav" :src="authState.user_avatar" alt="avatar">
                                        {{authState.user_name}}
                                        <span class="caret"></span>
                                    </router-link>

                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li>
                                            <router-link class="button" to="#">
                                                <i class="fa fa-user text-md"></i>个人中心
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link class="button" to="#">
                                                <i class="fa fa-cog text-md"></i>编辑资料
                                            </router-link>
                                        </li>
                                        <li>
                                            <a class="button" @click="logout">
                                                <i class="fa fa-sign-out text-md"></i>退出
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </template>
                            <template v-else>
                                <router-link to="/register" class="btn btn-default btn-sm register-btn">
                                    注册
                                </router-link>
                                <router-link to="/login" class="btn btn-primary btn-sm login-btn">
                                    登录
                                </router-link>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>
<script type="text/javascript">
    import Auth from './store/auth'
    import {post, interceptors} from './helpers/api'
    import Flash from './helpers/flash'

    export default {
        created() {
            interceptors((err) => {
                if (err.response.status === 401) {
                    Auth.remove()
                    this.$router.push('/login')
                }

                if (err.response.status === 500) {
                    Flash.setError(err.response.statusText)
                }

                if (err.response.status === 404) {
                    this.$router.push('/not-found')
                }
            })
            Auth.initialize()
        },
        data() {
            return {
                authState: Auth.state,
                flash: Flash.state
            }
        },
        computed: {
            auth() {
                if (this.authState.api_token) {
                    return true
                }
                return false
            },
            guest() {
                return !this.auth
            }
        },
        methods: {
            logout() {
                post('/api/logout')
                        .then((res) => {
                            if (res.data.done) {
                                Auth.remove()
                                this.$router.push('/login')
                            }
                        })
            }
        }
    }

</script>
