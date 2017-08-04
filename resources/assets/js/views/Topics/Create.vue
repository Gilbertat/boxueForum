<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="topic-form-submit">
                    <div class="form-group">
                        <input type="text" v-model="form.title" class="form-control" placeholder="请填写标题" required>
                    </div>
                    <div class="form-group">
                        <select v-model="form.category_id" id="category_select" class="form-control" required>
                            <option value disabled selected>请选择分类</option>
                            <template v-for="category in categories">
                                <option :value="category.id">{{category.title}}</option>
                            </template>
                        </select>
                    </div>
                    <div class="form-group topic-create">
                        <textarea v-model="form.editor" id="editor"></textarea>
                    </div>
                    <router-link class="btn btn-primary">发布话题</router-link>
                </form>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {get, post} from '../../helpers/api'

    export default {
        data() {
            return {
                categories: [],
                form: {
                    title: '',
                    category_id: 0,
                    editor: ''
                }
            }
        },

        created() {
            this.getCategory()
        },

        methods: {
            getCategory() {
                get('api/topics/create')
                        .then((res) => {
                            this.categories = res.data.categories
                        })
            }
        }

    }

</script>
