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
                        <div class="markdown-body" v-html="topic.content_html"></div>
                    </div>
                </div>
                <reply></reply>
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
    import {mapState} from 'vuex'
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
                loading: false,
            }
        },

        created() {
            this.getData()
        },

        computed: {
            ...mapState({
                topic: state => state.topic.topic,
                replies: state => state.topic.replies,
                url: state => state.url
            })
        },

        methods: {
            getData() {
                this.loading = true
                this.$store.dispatch('topicShow', this.$route.params.id)
                        .then(() => {
                            this.loading = false
                        })
            }
        }

    }


</script>
