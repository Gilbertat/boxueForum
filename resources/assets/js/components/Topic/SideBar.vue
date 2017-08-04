<template>

    <div class="col-md-3 side-bar">
        <template v-if="auth">
            <router-link to="/topic/create" class="create-topic">
                <i class="fa fa-plus text-md"></i>创建话题
            </router-link>
        </template>

        <div class="panel panel-default corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">泊学公告</h3>
            </div>
            <div class="panel-body text-center">
                <b style="display: block; margin-bottom: 10px;">{{post.content}}</b>
                <span style="float: right">
                    {{computedDate(post.updated_at)}}
                </span>
            </div>
        </div>

        <div class="panel panel-default corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">话题分类</h3>
            </div>
            <div class="panel-body text-center pills">
                <router-link to="/" title="全部" style="color: #000;">全部</router-link>
                <template v-for="category in categories">
                    <router-link to="" :title="category.description"
                                 :style="{color: category.color}">{{category.title}}
                    </router-link>
                </template>
            </div>
        </div>


    </div>

</template>


<script type="text/javascript">
    import Auth from '../../store/auth'
    import moment from 'moment'

    export default {
        props: ['post', 'categories'],

        data() {
            return {
                authState: Auth.state,
            }
        },

        methods: {
            computedDate(date) {
                return moment(date, "YYYYMMDD").fromNow();
            },
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
