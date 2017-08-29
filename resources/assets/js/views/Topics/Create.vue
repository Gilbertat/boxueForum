<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="topic-form-submit" style="margin-bottom: 14px" @submit.prevent="createTopic">
                    <div class="form-group">
                        <input type="text" v-model="form.title" class="form-control" placeholder="请填写标题" required
                               value="form.title">
                    </div>
                    <div class="form-group">
                        <select v-model="form.category_id" id="category_select" class="form-control" required>
                            <option disabled value="-1">请选择分类</option>
                            <template v-for="category in categories">
                                <option :value="category.id">{{category.title}}</option>
                            </template>
                        </select>
                    </div>
                    <div class="form-group topic-create">
                        <mde v-model="form.value"></mde>
                    </div>
                    <button class="btn btn-primary">发布话题</button>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
    .loading {
        margin-left: auto;
        margin-right: auto;
    }

</style>

<script type="text/javascript">
    import {get, post} from '../../helpers/api'
    import {mapState} from 'vuex'
    import mde from '../../components/Universal/inline-simple.vue'
    import swal from 'sweetalert'


    export default {
        components: {
            mde,
        },

        data() {
            return {
                categories: [],
                form: {
                    title: '',
                    category_id: -1,
                    value: ''
                }
            }
        },

        created() {
            this.getCategory()
            if (this.$route.params.type == "edit") {
                this.setTopic()
            }

        },

        methods: {
            getCategory() {
                get('/api/topics/create')
                        .then((res) => {
                            this.categories = res.data.categories
                            if (this.$route.params.type == "edit") {
                                this.$emit('setContent', this.topic.content_raw)
                            }
                        })
            },

            setTopic() {
                this.form.title = this.topic.title
                this.form.category_id = this.topic.category_id
                this.form.value = this.topic.content_raw
            },

            createTopic() {
                if (this.$route.params.type === "edit") {


                } else {
                    post('/api/topics/store', this.form)
                            .then((res) => {
                                this.$router.push(`/topic/${res.data.topic_id}`)
                            }, (err) => {
                                swal({
                                    title: "错误",
                                    text: err.response.data.info,
                                    type: 'error',
                                    showConfirmButton: false,
                                    timer: 1000,
                                })
                            })
                }
            },

        },

        computed: {
            ...mapState({
                topic: state => state.topic.topic
            }),

        }

    }

</script>
