<script>
import MyPets from "@/vue/pages/DashboardComponents/MyPets.vue";

export default {
    components: {MyPets},
}
</script>
<template>
    <div class="container mt-5">
        <h1>dashboard</h1>

        <div class="mt-5">
            <MyPets/>
        </div>

        <div class="mb-5">
            <h3 class="me-3 mb-3">( account 💖 )</h3>

            <router-link class="btn btn-dark" :to="{name: 'account'}">
                manage your account ->
            </router-link>
        </div>
    </div>
</template>
