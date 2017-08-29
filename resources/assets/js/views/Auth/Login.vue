<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 floating-box">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <label>邮箱:</label>
                                <input type="text" v-model="form.email" class="form-control">
                                <small class="error_control" v-if="error.email">{{error.email[0]}}</small>
                            </div>

                            <div class="form-group">
                                <label>密码:</label>
                                <input type="password" v-model="form.password" class="form-control">
                                <small class="error_control" v-if="error.password">{{error.password[0]}}</small>
                            </div>

                            <!--<div class="checkbox">-->
                            <!--<label><input type="checkbox" name="form.remember">七日内自动登录</label>-->
                            <!--</div>-->

                            <button :disabled="isProcessing" class="btn btn-primary">登录</button>
                        </form>
                        <hr>
                        <h4>无法登录?</h4>
                        <p>
                            <router-link to="#">点击这里</router-link>
                            重置密码
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import auth from  '../../store/auth'
    import swal from 'sweetalert'
    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                error: {},
                isProcessing: false
            }
        },

        methods: {
            login() {
                this.isProcessing = true
                this.error = {}
                this.$store.dispatch('login', this.form).then(() => {
                    swal({
                        title: "欢迎回来",
                        text: auth.get('user_name'),
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1000,
                    })
                    this.$router.go(-1)
                    this.isProcessing = false
                }, (err) => {
                       this.error = err.response.data
                       this.isProcessing = false
                })

            }
        }
    }

</script>
