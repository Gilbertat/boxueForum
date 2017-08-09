<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <template v-if="topics">
                        <div class="panel-body remove-padding-horizontal">
                            <ul class="list-group row topic-list">
                                <li class="list-group-item" v-for="topic in topics">
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
                                                 :src="`${url}/uploads/avatars/${topic.user.avatar}?/imageView2/1/w/100/h/100`">
                                        </router-link>
                                    </div>
                                    <div class="infos">
                                        <div class="media-heading">
                                            <router-link :to="`topic/${topic.id}`">
                                                {{topic.title}}
                                            </router-link>
                                        </div>
                                        <info :topic="topic"></info>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                            <pagination :pageInfo="pageInfo" @change="pageChange"></pagination>
                        </div>
                    </template>
                    <template v-else>
                        <div class="panel-body">
                            <div class="empty">还没有任何人发帖哦~~</div>
                        </div>
                    </template>
                </div>
            </div>
            <sidebar :post="post" :categories="category"></sidebar>
        </div>
    </div>
</template>
<script type="text/javascript">
    import {get} from '../../helpers/api'
    import moment from 'moment'
    import pagination from '../Vendor/vue-pagination'
    import sidebar from '../../components/Universal/SideBar'
    import info from '../../components/Universal/topic-info'

    moment.locale('zh-cn');

    export default {
        components: {
            pagination,
            sidebar,
            info,
        },

        data() {
            return {
                topic_data: [],
                topics: [],
                post: [],
                category: [],
                url: '',
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
            this.pageChange(1)
        },

        methods: {
            computedDate(date) {
                return moment(date, "YYYY-MM-DD HH:mm").fromNow();
            },

            pageChange(current) {
                get(`/api/topics?page=${current}`)
                        .then((res) => {
                            this.topic_data = res.data.topics
                            this.post = res.data.post
                            this.category = res.data.categories
                            this.topics = this.topic_data.data
                            this.url = res.data.url
                            this.pageInfo.total = this.topic_data.total
                            this.pageInfo.current = this.topic_data.current_page
                            this.pageInfo.pagenum = this.topic_data.per_page
                            this.pageInfo.pagegroup = 29
                        })
            }
        }

    }


</script>
