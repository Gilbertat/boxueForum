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
            <form id="submit-reply-form" accept-charset="UTF-8">
                <input type="hidden" v-model="form.topic_id" :value="topic.id">
                <div class="form-group topic-replies">
                    <mde v-model="form.value"></mde>
                </div>
                <div class="form-group reply-post-submit">
                    <a class="btn btn-primary">回复</a>
                </div>
            </form>
        </div>
    </template>
    </div>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import mde from '../../components/Universal/inline-simple.vue'
    import rep from '../../components/Topic/Reply_info.vue'

    export default {

        props: ["topic", "replies", "url"],

        components: {
            mde,
            rep,
        },

        data() {
            return {
                authState: Auth.state,
                form: {
                    value: ''
                }
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
    }

</script>
