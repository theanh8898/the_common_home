<template>
    <div class="row row-lg">
        <div class="col-md-6 col-lg-4">
            <div class="example-wrap">
                <h4 class="example-title">Name</h4>
                <input type="text" v-model="nameCategory" class="form-control" v-bind:class="[{'is-invalid' : (this.errors.name && this.errors.name.length > 0)}]" placeholder="Name">
                <small class="fail-validate" v-if="errors.name && errors.name.length > 0">{{ errors.name[0] }}</small>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="example-wrap">
                <h4 class="example-title">Title</h4>
                <input type="text" v-model="titleCategory" class="form-control" v-bind:class="[{'is-invalid' : (this.errors.title && this.errors.title.length > 0)}]" placeholder="Name">
                <small class="fail-validate" v-if="errors.title && errors.title.length > 0">{{ errors.title[0] }}</small>

            </div>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="example-wrap">
                <h4 class="example-title">Meta Description</h4>
                <input type="text" v-model="metaDescriptionCategory" class="form-control" v-bind:class="[{'is-invalid' : (this.errors.meta_description && this.errors.meta_description.length > 0)}]" id="name-category" placeholder="Name">
                <small class="fail-validate" v-if="errors.meta_description && errors.meta_description.length > 0">{{ errors.meta_description[0] }}</small>

            </div>
        </div>

        <div class="col-12 form-group">
            <button type="button" @click="updateCategory" class="btn btn-info">Submit</button>
            <button type="button" @click="backToList" class="btn btn-danger">Back</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "EditCategory",
        props: [
            'categoryData'
        ],
        data() {
            return {
                nameCategory: this.categoryData.name,
                titleCategory: this.categoryData.title,
                metaDescriptionCategory: this.categoryData.meta_description,
                errors: {
                    name: [],
                    title: [],
                    meta_description: []
                }
            }
        },
        methods: {
            updateCategory() {
                this.errors = {
                    name: [],
                    title: [],
                    meta_description: []
                };
                let formData = new FormData();

                formData.append('id', this.categoryData.id);
                formData.append('name', this.nameCategory);
                formData.append('title', this.titleCategory);
                formData.append('meta_description', this.metaDescriptionCategory);
                formData.append("_method", "put");


                axios.post('/categories/update/' + this.categoryData.id, formData).then(response => {
                    console.log(response.data);
                    window.location.href = '/categories'
                }).catch((error) => {
                    console.log(error.response.data);
                    this.errors = error.response.data.errors;
                    console.log(this.errors.name);
                });
            },
            backToList() {
                window.location.href = `/categories`;
            }
        }
    }
</script>
