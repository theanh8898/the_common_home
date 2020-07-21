<template>
    <div class="modal myModal fade" :id="id">
        <div class="modal-dialog" :class="modalSize">
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="modal-title">
                        <h5 class="modal-title">Title</h5>
                    </slot>
                    <slot name="modal-button-close">
                    </slot>
                </div>
                <slot name="modal-body">
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                </slot>

                <slot name="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">OK</button>
                    </div>
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "modal",
        props: {
            id: {
                required: true
            },
            modalSize: {
                default: 'modal-xs'
            }
        },
        methods: {
            open() {
                $('#' + this.id).modal();
            },
            close() {
                $('#' + this.id).modal('hide');
            }
        }
    }
</script>

<style scoped>
    .modal-content {
        background-color: rgb(53, 64, 82);
        color: white;
    }
</style>
