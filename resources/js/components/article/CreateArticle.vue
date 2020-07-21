<template>
    <div class="row row-lg">
        <div class="col-md-12 col-lg-10">
            <div class="example-wrap">
                <h4 class="example-title">Type</h4>
                <select v-model="type" class="form-control">
                    <option disabled value="">Please select type</option>
                    <option value="stories">STORIES</option>
                    <option value="newsletter">NEWSLETTER</option>
                </select>

            </div>
        </div>
        <div class="col-md-12 col-lg-10">
            <div class="example-wrap">
                <h4 class="example-title">Category</h4>
                <select v-model="category" class="form-control">
                    <option disabled value="">Please select category</option>
                    <option v-for="category in categories" :value="category.id" :key="category.id">{{category.name.toUpperCase()}}</option>
                </select>

            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="example-wrap">
                <h4 class="example-title">Name</h4>
                <input type="text" v-model="name" class="form-control"
                       v-bind:class="[{'is-invalid' : (this.errors.name.length > 0)}]" placeholder="Name">
                <small class="fail-validate">{{ errors.name[0] }}</small>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="example-wrap">
                <h4 class="example-title">Title</h4>
                <input type="text" v-model="title" class="form-control"
                       v-bind:class="[{'is-invalid' : (this.errors.title.length > 0)}]" placeholder="Name">
                <small class="fail-validate">{{ errors.title[0] }}</small>

            </div>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="example-wrap">
                <h4 class="example-title">Meta Description</h4>
                <input type="text" v-model="metaDescription" class="form-control"
                       v-bind:class="[{'is-invalid' : (this.errors.meta_description.length > 0)}]" id="name-category"
                       placeholder="Meta Description">
                <small class="fail-validate">{{ errors.meta_description[0] }}</small>

            </div>
        </div>

        <div class="col-12">
            <div class="example-wrap">
                <h4 class="example-title">Content</h4>
                <textarea v-model="content" class="form-control" rows="20" placeholder="Please enter content of article"></textarea>
                <small class="fail-validate">{{ errors.meta_description[0] }}</small>

            </div>
        </div>

        <div class="col-12 form-group">
            <button type="button" @click="createCategory" class="btn btn-info">Submit</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "CreateArticle",
        data() {
            return {
                type: '',
                name: '',
                title: '',
                metaDescription: '',
                content: '',
                category: '',
                errors: {
                    type: [],
                    name: [],
                    title: [],
                    meta_description: [],
                    content: [],
                    category: [],
                },
                categories: [],
            }
        },
        created() {
            axios.get('/categories').then(res => {
                this.categories = res.data.data;
            }).catch(err => console.log(err))
        },
        methods: {
            createCategory() {
                this.errors = {
                    type: [],
                    name: [],
                    title: [],
                    meta_description: [],
                    content: [],
                    category: [],
                };
                let formData = new FormData();

                formData.append('type', this.type);
                formData.append('name', this.name);
                formData.append('title', this.title);
                formData.append('meta_description', this.metaDescription);
                formData.append('content', this.content);
                formData.append('category_id', this.category);

                axios.post('/articles', formData).then(response => {
                    console.log(response.data);
                    // window.location.href = '/articles';
                }).catch((error) => {
                    console.log(error.response.data);
                    this.errors = error.response.data.errors;
                });

            }
        }
    }
</script>
