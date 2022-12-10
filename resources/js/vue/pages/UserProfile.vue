<script>
import authApi from "@/api/auth";
import PetCard from "@/vue/components/PetCard.vue";

export default {
    components: {PetCard},

    data() {
        return {
            authUser: null,
            pets: [],
        };
    },

    async mounted() {
        this.authUser = await authApi.getProfileByUsername(
            this.$route.params.username
        );

        this.pets = this.authUser.getPets();
    },

    methods: {},
}
</script>
<template>
    <div v-if="authUser" class="container mt-5">
        <h1>@{{ authUser.getUsername() }} - {{ pets.length }} posts</h1>

        <div class="mt-5">
            <div class="row g-5 text-center mt-2">
                <div class="col-12 col-sm-6 col-md-4"
                     v-for="pet in pets"
                     :key="pet.getId()">
                    <PetCard
                        :pet-prop="pet"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
