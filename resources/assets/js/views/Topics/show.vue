<template>
    <div class="container">
        <div class="loading" v-if="loading">
            <Circle8></Circle8>
        </div>

        <div class="row" v-else>
            <div class="col-md-9 topic-show main-col">
                <div class="topic panel panel-default">
                    <div class="infos panel-heading">
                        <h1 class="panel-title topic-title">{{topic.title}}</h1>
                        <router-link to="" class="vote_count">
                            <i class="fa fa-star"></i><i class="vote_value">{{topic.vote_count}}</i>
                        </router-link>
                        <info :topic="topic"></info>
                    </div>
                    <div class="content-body entry-content panel-body">
                        <div class="markdown-body" v-html="topic.content_html" v-hljs></div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right action" v-if="auth">
                            <router-link :to="`/topic/${topic.id}/edit`" class="topic_edit" title="编辑该帖">
                                <i class="fa fa-edit"></i>
                            </router-link>
                        </div>
                    </div>
                </div>
                <reply :pageInfo="pageInfo"></reply>
            </div>
            <div class="col-md-3 side-bar">
            </div>
        </div>
    </div>

</template>
<style>
    .loading {
        margin-left: auto;
        margin-right: auto;
        width: 120px;
        height: 120px;
    }


</style>

<script type="text/javascript">
    import { mapState } from 'vuex'
    import hljs from 'highlight.js'
    import Auth from '../../store/auth'
    import info from '../../components/Universal/topic-info.vue'
    import reply from '../../components/Topic/Replies.vue'
    import Circle8 from 'vue-loading-spinner/src/components/Circle8.vue'

    export default {
        components: {
            info,
            reply,
            Circle8
        },

        data() {
            return {
                authState: Auth.state,
                loading: false,
                pageInfo: {
                    total: 0,  // 记录总条数   默认空，如果小于pageNum则组件不显示   类型Number
                    current: 0,  // 当前页数，   默认为1                             类型Number
                    pagenum: 0, // 每页显示条数,默认10                              类型Number
                    pagegroup: 0,    // 分页条数     默认为5，需传入奇数                 类型Number
                    skin: '#16a086'  // 选中页码的颜色主题 默认为'#16a086'               类型String
                }
            }
        },

        created() {
            this.getData(1)
        },

        directives: {
            hljs(el) {
                let blocks = el.querySelectorAll('pre code')
                Array.prototype.forEach.call(blocks, hljs.highlightBlock)
            }
        },

        computed: {
            ...mapState({
                topic: state => state.topic.topic,
                replies: state => state.topic.replies,
                url: state => state.url
            }),

            auth() {
                if (this.authState.api_token) {
                    return true
                }
                return false
            }
        },

        methods: {
            getData(page) {
                var obj = {
                    id: this.$route.params.id,
                    page: page
                }
                this.loading = true
                this.$store.dispatch('topicShow', obj)
                        .then((res) => {
                            this.loading = false
                            this.pageInfo.total = res.data.replies.total
                            this.pageInfo.current = res.data.replies.current_page
                            this.pageInfo.pagenum = res.data.replies.per_page
                            this.pageInfo.pagegroup = 25
                        })

            }
        }

    }


</script>
