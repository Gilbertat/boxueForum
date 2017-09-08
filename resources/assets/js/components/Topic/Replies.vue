<template>
    <div>
        <div class="replies panel panel-default list-panel replies-index">
            <div class="panel-heading">
                <div class="total">回复:{{topic.reply_count}}</div>
            </div>
            <template v-if="replies">
                <div class="panel-body">
                    <rep :page="pageInfo.current" :pagegroup="pageInfo.pagegroup"></rep>
                </div>
                <pagination :pageInfo="pageInfo" @change="pageChange"></pagination>
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
                        <mde v-model="form.content"></mde>
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
    import {mapState} from 'vuex'
    import mde from '../../components/Universal/inline-simple.vue'
    import rep from '../../components/Topic/Reply_info.vue'
    import pagination from '../../views/Vendor/vue-pagination'


    export default {
        components: {
            mde,
            rep,
            pagination
        },

        props: ['pageInfo'],

        data() {
            return {
                authState: Auth.state,
                form: {
                    content: '',
                    topic_id: this.$route.params.id,
                },
            }
        },

        methods: {
            postReply() {
                this.$store.dispatch('reply', this.form).then(() => {
                    this.$emit('setContent', '')
                    swal({
                        title: "",
                        type: "success",
                        text: "回复成功!",
                        timer: 1000,
                        showConfirmButton: false
                    });
                })
            },

            pageChange(current) {
                var obj = {
                    id: this.$route.params.id,
                    page: current
                }

                this.$store.dispatch('topicShow', obj)
                        .then((res) => {
                            this.pageInfo.total = res.data.replies.total
                            this.pageInfo.current = res.data.replies.current_page
                            this.pageInfo.pagenum = res.data.replies.per_page
                            this.pageInfo.pagegroup = 25
                        })

            }
        },

        computed: {
            ...mapState({
                topic: state => state.topic.topic,
                url: state => state.url,
                replies: state => state.topic.replies
            }),

            auth() {
                if (this.authState.api_token) {
                    return true
                }
                return false
            }
        }
    }

</script>
