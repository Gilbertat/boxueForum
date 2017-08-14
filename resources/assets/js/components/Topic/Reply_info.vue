<template>
    <ul class="list-group row">
        <li class="list-group-item media" style="margin-top: 0px;" v-for="(reply, index) in replies">
            <div class="avatar avatar-container pull-left">
                <router-link to="#">
                    <img class="media-object img-thumbnail avatar avatar-middle" :src="`${url}/uploads/avatars/${reply.user.avatar}?/imageView2/1/w/100/h/100`" :alt="reply.user.name" style="width: 55px; height: 55px;">
                </router-link>
            </div>

            <div class="infos">
                <div class="media-heading">
                    <router-link to="#" :title="reply.user.name" class="remove-padding-left author">
                        {{reply.user.name}}
                    </router-link>
                    <span class="operate pull-right">
                        <!--@if(Auth::id() == $reply->user_id)-->
                            <!--<a class="fa fa-trash-o reply_delete_button" href="javascript:void(0);" title="删除评论" data-form="reply_delete_form{{$index}}" data-content="确定要删除该条评论吗"></a>-->
                            <!--<form action="{{route('replies.delete', $reply->id)}}" class="reply_delete_form{{$index}}" method="post">-->
                                <!--{{csrf_field()}}-->
                            <!--</form>-->
                        <!--@endif-->
                        <!--{{&#45;&#45;<a class="fa fa-reply" href="javascript:void(0)" onclick="replyOne('{{$reply->user->name}}');" title="回复{{$reply->user->name}}"></a>&#45;&#45;}}-->
                    </span>

                    <div class="meta">
                        <router-link :name="reply.id" :id="reply.id" class="anchor" :to="`#reply${reply.id}`" aria-hidden="true">#{{index}}</router-link>
                        <!--<span> .  </span>-->
                        <abbr :title="reply.created_at" class="timeago">{{diffForHumans(reply.created_at)}}</abbr>
                    </div>
                </div>
                <div class="media-body markdown-body content-body" v-html="reply.content_html"></div>
            </div>
        </li>
    </ul>
</template>
<script type="text/javascript">
    import moment from 'moment'

    export default {
        props: ["replies", "url"],

        methods: {
            diffForHumans(date) {
                return moment(date, "YYYY-MM-DD HH:mm").fromNow();
            }
        }
    }

</script>
