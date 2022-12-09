<script>
import authApi from "@/api/auth";
import ConfirmDialog from "@/vue/components/ConfirmDialog.vue";

export default {
    components: {ConfirmDialog},
    methods: {
        async deleteAccount() {
            if (await authApi.deleteAccount()) {
                this.$router.push({name: 'home'});
            }
        }
    }
}
</script>

<template>
    <div>
        <h3 class="text-danger mb-4">( danger zone ⚠️ )</h3>

        <ConfirmDialog
            id="delete-account-confirmation"
            @confirmed="deleteAccount"
        >
            <button type="button"
                    class="btn btn-danger">
                Delete your account permanently
            </button>
        </ConfirmDialog>
    </div>
</template>
