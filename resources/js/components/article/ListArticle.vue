<template>
    <div class="row">
        <b-table v-if="this.articlesData.length > 0"
                 id="category-table"
                 :bordered= "true"
                 :items= "articlesData"
                 :per-page="perPage"
                 :current-page="currentPage"
                 :fields="fields"
                 small
        >
            <template v-slot:cell(name)="data">
                <span class="font-weight-bold word-break">{{ data.value }}</span>
            </template>
            <template v-slot:cell(type)="data">
                <span>{{ data.value === 0 ? "STORIES" : "NEWSLETTER" }}</span>
            </template>
            <template v-slot:cell(action)="data">
                <div class="text-center">
                    <button @click="redirectEdit(data.item.id)" class="btn btn-icon btn-outline btn-info btn-round">
                        <i class="icon fa-send" aria-hidden="true"></i>
                    </button>
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

        <b-pagination v-if="this.articlesData.length > perPage"
                      id="paginate-category-table"
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      aria-controls="category-table"
                      size="sm"
                      align="right"
        ></b-pagination>

        <modal id="modal-confirm-import" ref="modalConfirmDelete">-->
            <span slot="modal-title" class="font-weight-bold">Do you want delete this article??</span>

            <div slot="modal-body">
            </div>
            <div slot="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" @click="deleteUser(idDel)">OK</button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    import { BTable,BPagination } from 'bootstrap-vue';
    import modal from '../common/modal';

    export default {
        name: "ListArticle",
        components: {
            BTable,
            BPagination,
            modal
        },
        props: ['articlesData'],
        data() {
            return {
                idDel: '',
                perPage: 10,
                currentPage: 1,
                fields: [
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
                        key: 'type',
                        label: 'Type',
                        thStyle: {
                            width: '7rem',
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
                window.location.href = `/article/edit/${id}`;
            },
            showConfirmDelete(id) {
                this.idDel = id;
                this.$refs.modalConfirmDelete.open();
            },
            deleteUser(id) {
                this.$refs.modalConfirmDelete.close();

                axios.delete(`/articles/delete/${id}`)
                    .then((data) => {
                        location.href = '/articles';
                    }).catch((error) => {
                    console.log(error);
                });
            }
        },
        computed: {
            rows() {
                return this.articlesData.length
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
