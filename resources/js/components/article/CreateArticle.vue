<template>
    <div class="row row-lg">
        <div class="col-md-12 col-lg-8">
            <div class="example-wrap">
                <h4 class="example-title">Type</h4>
                <select v-model="type" class="form-control">
                    <option disabled value="">Please select type</option>
                    <option value="0">STORIES</option>
                    <option value="1">NEWSLETTER</option>
                </select>

            </div>
        </div>
        <div class="col-lg-4">
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="example-wrap">
                <h4 class="example-title">Category</h4>
                <select v-model="category" class="form-control">
                    <option disabled value="">Please select category</option>
                    <option v-for="category in categories" :value="category.id" :key="category.id">
                        {{category.name.toUpperCase()}}
                    </option>
                </select>

            </div>
        </div>
        <div class="col-lg-4">
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
                       v-bind:class="[{'is-invalid' : (this.errors.title.length > 0)}]" placeholder="Title">
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

        <div class="col-md-12 col-lg-8">
            <div class="example-wrap">
                <h4 class="example-title">Content</h4>
                <textarea v-model="content" class="form-control" rows="20"
                          placeholder="Please enter content of article"></textarea>
                <small class="fail-validate">{{ errors.meta_description[0] }}</small>

            </div>
        </div>

        <div class="col-6">
            <div class="example-wrap">
                <h4 class="example-title">Media</h4>
            </div>
        </div>
        <div class="col-6">
            <button class="btn btn-primary" @click="addMedia">
                +
            </button>
        </div>
        <div class="col-12">
            <div v-for="(media,index) in medias" class="row">
                <div style="border: 1px dotted #e0dede; padding-top: 20px; margin-top: 20px" class="col-8">
                    <div class="col-10">
                        <div class="example-wrap">
                            <h4 class="example-title">Media Type</h4>
                            <select v-model="media.media_type" class="form-control">
                                <option disabled value="">Please select type of media</option>
                                <option value="video">VIDEO</option>
                                <option value="image">IMAGE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-10" v-if="media.media_type!==''">
                        <div class="example-wrap">
                            <h4 class="example-title">File</h4>
                            <input type="file" @change="addFile($event,index)">
                        </div>
                    </div>
                    <div class="col-10" v-if="media.media_type==='image' && media.file!==''"
                         style="margin-bottom: 20px">
                        <img
                            :id="`imagePreview${index}`"
                            src=""
                            width="100%"
                        >
                    </div>
                    <div class="col-10">
                        <div class="example-wrap">
                            <h4 class="example-title">Use type</h4>
                            <select v-model="media.use_type" class="form-control">
                                <option disabled value="">Please use type of media</option>
                                <option value="avatar">AVATAR</option>
                                <option value="cover">COVER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="example-wrap">
                            <h4 class="example-title">Sort order</h4>
                            <input type="number" v-model="media.sort_order" class="form-control"
                                   placeholder="Name of media" min="1" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-1" v-if="index > 0" style="margin-top: 20px">
                    <button class="btn btn-danger" @click="removeMedia(index)">-</button>
                </div>
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
                medias: [{"media_type": "", "file": "", "use_type": "", "sort_order": 1}],
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
                formData.append('medias',JSON.stringify(this.medias));
                this.medias.map((item, index) => {
                        formData.append('files[' + index + ']', item.file);
                    }
                );
                axios.post(
                    '/articles',
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    }
                ).then(response => {
                    console.log(response.data);
                    // window.location.href = '/articles';
                }).catch((error) => {
                    console.log(error.response.data);
                    this.errors = error.response.data.errors;
                });

            },
            addMedia() {
                this.medias.push({
                    "media_type": "",
                    "file": "",
                    "use_type": "",
                    "sort_order": this.medias[this.medias.length - 1].sort_order + 1
                })
            },
            addFile(event, index) {
                this.medias[index].file = event.target.files[0];
                if (this.medias[index].media_type === 'image') {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $(`#imagePreview${index}`).attr("src", e.target.result);
                    };
                    reader.readAsDataURL(this.medias[index].file);
                }
            },
            removeMedia(index) {
                this.medias.splice(index, 1);
                console.log(this.medias);
            }
        }
    }
</script>
<style scoped>
    .example-wrap {
        margin-bottom: 20px;
    }
</style>
