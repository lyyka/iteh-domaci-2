<script>
import authApi from "@/api/auth";

export default {
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
        <button type="button"
                @click="deleteAccount"
                class="btn btn-danger">
            Delete your account permanently
        </button>
    </div>
</template>
