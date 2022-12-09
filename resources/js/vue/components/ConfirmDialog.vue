<script>
export default {
    props: {
        id: {
            type: String,
            required: true,
        }
    },

    mounted() {
        this.$refs.slot.addEventListener('click', () => {
            this.open();
        });
    },

    methods: {
        open() {
            this.$refs.openConfirmation.click();
        },

        close() {
            this.$refs.closeConfirmation.click();
        },

        confirm() {
            this.close();
            this.$emit('confirmed');
        },
    },

    emits: ['confirmed'],
}
</script>
<template>
    <div>
        <div ref="slot">
            <slot></slot>
        </div>

        <button type="button"
                style="display: none;"
                ref="openConfirmation"
                data-bs-toggle="modal"
                :data-bs-target="`#${id}`"></button>

        <button type="button" data-bs-dismiss="modal"
                ref="closeConfirmation"
                style="display: none;"
                :data-bs-target="`#${id}`"
                aria-label="Close"></button>

        <div class="modal"
             :id="id"
             tabindex="-1" data-bs-keyboard="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">confirm action</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <p>are you sure you want to proceed? 🤨</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">no</button>
                        <button @click="confirm" type="button" class="btn btn-danger">yes, i am</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
