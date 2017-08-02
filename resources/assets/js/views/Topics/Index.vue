<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <template v-if="topics.length > 0">
                        <div class="panel-body remove-padding-horizontal">
                            <ul class="list-group row topic-list">
                                <li class="list-group-item" v-for="topic in topics" >
                                    <a class="reply_count_area pull-right" href="#">
                                        <div class="count_set">
                                            <span class="count_of_replies" title="回复">
                                                {{topic.reply_count}}
                                            </span>
                                            <span class="count_separator">/</span>
                                            <span class="count_of_visits" title="查看">
                                                {{topic.view_count}}
                                            </span>
                                            <span class="count_separator">|</span>
                                            <span class="count_of_likes" title="赞">
                                                {{topic.vote_count}}
                                             </span>
                                        </div>
                                    </a>
                                    <div class="avatar pull-left">
                                        <router-link to="">
                                            <img class="media-object img-thumbnail avatar avatar-middle"
                                                 :src="user.avatar">
                                        </router-link>
                                    </div>
                                    <div class="infos">
                                        <div class="media-heading">
                                            <router-link to="">
                                                {{topic.title}}
                                            </router-link>
                                        </div>
                                        <div class="meta">
                                            <!--<a href="{{route('categories.show', $topic->category_id)}}" class="category"-->
                                               <!--data-pjax style="color: {{$topic->category->color}}">-->
                                                <!--{{$topic->category->title}}-->
                                            <!--</a>-->
                                            <!--.-->
                                            <!--<abbr title="{{$topic->created_at}}" class="timeago">{{$topic->created_at->diffForHumans()}}</abbr>-->
                                            <!--由-->
                                            <!--<a href="{{route('users.show',  $topic->user->id)}}" class="author"-->
                                                <!--style="color: #84dfec;">-->
                                                <!--{{$topic->user->name}}-->
                                            <!--</a>-->
                                            <!--编辑-->
                                            <!--@if(count($topic->lastReplyUser))-->
                                            <!--最后回复由-->
                                            <!--<a href="{{URL::route('users.show', [$topic->lastReplyUser->id])}}"-->
                                               <!--data-pjax style="color: #ec5e2e;">-->
                                                <!--{{$topic->lastReplyUser->name}}-->
                                            <!--</a>-->
                                            <!--于<abbr title="{{$topic->updated_at}}" class="timeago">{{$topic->updated_at->diffForHumans()}}</abbr>-->
                                            <!--.-->
                                            <!--&lt;!&ndash;@endif&ndash;&gt;-->
                                            <!--{{$topic->view_count}}阅读-->
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </template>
                    <template v-else>
                        <div class="panel-body">
                            <div class="empty">还没有任何人发帖哦~~</div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import {get} from '../../helpers/api'

    export default {
        data() {
            return {
                topics: [],
                user: []
            }
        },

        created() {
            get('/api/topics')
                    .then((res) => {
                        this.topics = res.data.topics['data']
                    })

            this.show(1)
        },

        methods: {
            show(user_id) {
                get(`/api/users/${user_id}`)
                        .then((res) => {
                            this.user = res.data.user
                        })
            }
        }

    }


</script>
