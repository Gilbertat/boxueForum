<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="topic-form-submit" style="margin-bottom: 14px" @submit.prevent="createTopic">
                    <div class="form-group">
                        <input type="text" v-model="form.title" class="form-control" placeholder="请填写标题" required>
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

<script type="text/javascript">
    import {get, post} from '../../helpers/api'
    import mde from '../../components/Universal/inline-simple.vue'

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
        },

        methods: {
            getCategory() {
                get('/api/topics/create')
                        .then((res) => {
                            this.categories = res.data.categories
                        })
            },

            createTopic() {
                post('/api/topics/store', this.form)
                        .then((res) => {
                            console.log(res)
                        })
            },

    }

    }

</script>
