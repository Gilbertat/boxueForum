<template>
    <div class="container">
        <div class="row">
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
                <reply :topic="topic" :replies="replies" :url="url"></reply>
            </div>
            <div class="col-md-3 side-bar">

            </div>
        </div>
    </div>

</template>

<script type="text/javascript">
    import auth from '../../store/auth'
    import {get} from '../../helpers/api'
    import info from '../../components/Universal/topic-info.vue'
    import reply from  '../../components/Topic/Replies.vue'

    export default {
        components: {
            info,
            reply,
        },

        data() {
            return {
                url: '',
                topics: [],
                topic: [],
                user: [],
                replies_data: [],
                replies: []
            }
        },

        created() {
            this.getData()
        },

        methods: {
            getData() {
                get(`/api/topics/${this.$route.params.id}`)
                        .then((res) => {
                            this.url = res.data.url
                            this.topic = res.data.topic
                            this.replies_data = res.data.replies
                            this.replies = this.replies_data.data
                        })
            }
        }

    }



</script>
