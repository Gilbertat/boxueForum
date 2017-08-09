<template>
    <div class="meta" v-if="topic.category">
        <router-link to="" class="category"
                     :style="{color: topic.category.color}">
            {{ topic.category.title }}
        </router-link>
        .
        <abbr :title="topic.created_at" class="timeago">{{ diffForHumans(topic.created_at) }}</abbr>
        由
        <router-link to="" class="author"
                     style="color: #84dfec">
            {{topic.user.name}}
        </router-link>
        编辑
        <template v-if="topic.last_reply_user_id != 0">
            最后回复由
            <router-link to="" style="color: #ec5e2e;">
                {{topic.last_reply_user.name}}
            </router-link>
            于<abbr :title="topic.updated_at" class="timeago">{{ diffForHumans(topic.updated_at)}}</abbr>
        </template>
        .
        {{topic.view_count}}阅读
    </div>
</template>

<script type="text/javascript">
    import moment from 'moment'

    export default {
        props: ['topic'],

        methods: {
            diffForHumans(date) {
                return moment(date, "YYYY-MM-DD HH:mm").fromNow();
            }
        }
    }
</script>
