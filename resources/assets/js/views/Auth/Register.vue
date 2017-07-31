<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 floating-box">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form @submit.prevent="register">
                            <div class="form-group">
                                <label>昵称:</label>
                                <input type="text" v-model="form.nickname" class="form-control">
                                <small class="error-control" v-if="error.nickname">{{error.nickname[0]}}</small>
                            </div>

                            <div class="form-group">
                                <label>邮箱:</label>
                                <input type="text" v-model="form.email" class="form-control">
                                <small class="error-control" v-if="error.email">{{error.email[0]}}</small>

                            </div>

                            <div class="form-group">
                                <label>密码:</label>
                                <input type="password" v-model="form.password" class="form-control">
                                <small class="error-control" v-if="error.password">{{error.password[0]}}</small>

                            </div>

                            <div class="form-group">
                                <label>确认密码:</label>
                                <input type="password" v-model="form.password_confirmation" class="form-control">

                            </div>

                            <!--<div class="form-group">-->
                            <!--<label class="tt-label">验证码:</label>-->
                            <!--<input class="tt-text form-control" name="captcha"> <img src="{{captcha_src()}}" alt="验证码" onclick="this.src = '{{captcha_src()}}' + Math.random()">-->
                            <!--</div>-->

                            <button :disabled="isProcessing" class="btn btn-primary">注册</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Flash from '../../helpers/flash'
    import {post} from '../../helpers/api'

    export default {
        data() {
            return {
                form: {
                    nickname: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                error: {},
                isProcessing: false
            }
        },

        methods: {
            register() {
                this.isProcessing = true
                this.error = {}

                post('api/register', this.form)
                        .then((res) => {
                            if (res.data.registered) {
                                Flash.setSuccess('注册成功!')
                                this.$router.push('/login')
                            }
                            this.isProcessing = false
                        })
                        .catch((err) => {
                            if (err.response.status === 422) {
                                this.error = err.response.data
                            }
                            this.isProcessing = false
                        })
            }
        }
    }

</script>
