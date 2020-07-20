<template>
    <div class="row">
        <b-table v-if="this.categoriesData.length > 0"
                 id="category-table"
                 :bordered= "true"
                 :items= "categoriesData"
                 :per-page="perPage"
                 :current-page="currentPage"
                 :fields="fields"
                 small
        >
            <template v-slot:cell(name)="data">
                <span class="font-weight-bold word-break">{{ data.value }}</span>
            </template>
            <template v-slot:cell(action)="data">
                <div class="text-center">
                    <button @click="redirectEdit(data.item.id)" class="btn btn-icon btn-outline btn-success btn-round">
                        <i class="icon fa-edit" aria-hidden="true"></i>
                    </button>
                    <button @click="showConfirmDelete(data.item.id)" class="btn btn-icon btn-outline btn-danger btn-round">
                        <i class="icon fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </template>
            <template v-slot:head(action)="data">
                <div class="text-center">
                    {{ data.label }}
                </div>
            </template>
        </b-table>

        <b-pagination v-if="this.categoriesData.length > perPage"
                      id="paginate-category-table"
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      aria-controls="category-table"
                      size="sm"
                      align="right"
        ></b-pagination>

    </div>
</template>

<script>
    import { BTable,BPagination } from 'bootstrap-vue';

    export default {
        name: "ListCategory",
        components: {
            BTable,
            BPagination
        },
        props: ['categoriesData'],
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                fields: [
                    // {
                    //     key: 'key',
                    //     label: 'No.',
                    //     thStyle: {
                    //         width: '3rem'
                    //     },
                    // },
                    {
                        key: 'name',
                        label: 'Name',
                        thStyle: {
                            width: '10rem',
                            textAlign: 'center',
                            color: '#00e08d'
                        },
                    },
                    {
                        key: 'title',
                        label: 'Title',
                        thStyle: {
                            width: '25rem',
                            textAlign: 'center',
                            color: '#00e08d'
                        },
                    },
                    {
                        key: 'meta_description',
                        label: 'Meta Description',
                        thStyle: {
                            width: '30rem',
                            textAlign: 'center',
                            color: '#00e08d'
                        },
                    },
                    {
                        key: 'action',
                        label: 'Action',
                        thStyle: {
                            textAlign: 'center',
                            color: '#00e08d',
                            width: '8rem'
                        },
                    }
                ]
            }
        },
        methods: {
            redirectEdit(id) {
                window.location.href = `/categories/edit/${id}`;
            },
            showConfirmDelete(id) {

            }
        },
        computed: {
            rows() {
                return this.categoriesData.length
            }
        },
    }
</script>

<style>
    #category-table {
        margin-top: 30px;
    }

    #category-table th {
        background-color: #2c3e50;
    }

    #paginate-category-table {
        justify-content: flex-end !important;
    }

    .btn-action {
        padding: .4rem .6rem !important;
    }
</style>
