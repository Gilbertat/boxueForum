<template>
    <div>
        <div class="replies panel panel-default list-panel replies-index">
            <div class="panel-heading">
                <div class="total">回复:{{topic.reply_count}}</div>
            </div>
            <template v-if="replies">
                <div class="panel-body">
                    <rep :replies="replies" :url="url"></rep>
                </div>
                <div class="panel-footer text-right remove-padding-horizontal pager-footer">

                </div>
            </template>
            <template v-else>
                <ul class="list-group row"></ul>
                <div class="empty-block text-center">暂无评论~</div>
            </template>
        </div>
        <template v-if="auth">
            <div class="reply-box form box-block">
                <form @submit.prevent="postReply">
                    <input type="hidden" v-model="form.topic_id">
                    <div class="form-group topic-replies">
                        <mde v-model="form.value"></mde>
                    </div>
                    <div class="form-group reply-post-submit">
                        <button class="btn btn-primary">回复</button>
                    </div>
                </form>
            </div>
        </template>
    </div>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import swal from 'sweetalert'
    import mde from '../../components/Universal/inline-simple.vue'
    import rep from '../../components/Topic/Reply_info.vue'
    import {post} from '../../helpers/api'

    export default {

        components: {
            mde,
            rep,
        },

        props: ["topic", "replies", "url"],

        data() {
            return {
                data: this.replies,
                authState: Auth.state,
                form: {
                    value: '',
                    topic_id: this.$route.params.id,
                },
            }
        },


        methods: {
            postReply() {
                post('/api/replies/store', this.form)
                        .then((res) => {
                            swal({
                                title: "",
                                text: res.data.message,
                                type: res.data.status,
                                timer: 1000,
                                showConfirmButton: false
                            })
                        })
            }
        },

        computed: {
            auth() {
                if (this.authState.api_token) {
                    return true
                }
                return false
            }
            ,
            guest() {
                return !this.auth
            }
        }
        ,
    }

</script>
