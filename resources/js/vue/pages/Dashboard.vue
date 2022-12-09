<script>
import MyPets from "@/vue/pages/DashboardComponents/MyPets.vue";
import DangerZone from "@/vue/pages/DashboardComponents/DangerZone.vue";

export default {
    components: {DangerZone, MyPets},
}
</script>
<template>
    <div class="container mt-5">
        <h1>dashboard</h1>

        <div class="mt-5">
            <MyPets/>
        </div>

        <div class="mb-5">
            <DangerZone/>
        </div>
    </div>
</template>
