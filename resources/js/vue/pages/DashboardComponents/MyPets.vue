<script>
import petsApi from '@/api/pets.js';
import 'bootstrap/dist/js/bootstrap.min';
import PetCard from "@/vue/components/PetCard.vue";
import PetModal from "@/vue/components/PetModal.vue";

export default {
    components: {PetCard, PetModal},

    data() {
        return {
            myPets: [],
        };
    },

    async beforeMount() {
        await this.refreshPetsList();
    },

    methods: {
        async refreshPetsList() {
            this.myPets = await petsApi.myPets();
        },
    }
}
</script>
<template>
    <div class="d-flex">
        <h3 class="me-3">( a list of your posts 💖 )</h3>

        <button type="button" class="btn btn-dark"
                data-bs-toggle="modal" data-bs-target="#createPetModal">
            create +
        </button>
    </div>

    <div v-if="myPets.length === 0">
        <img
            alt="Empty"
            src="/storage/empty-cat.gif"
        />
    </div>

    <div class="row g-5 mt-2">
        <div class="col-12 col-sm-6 col-md-4"
             v-for="pet in myPets" :key="pet.getId()">
            <PetCard
                @deleted="refreshPetsList"
                @saved="refreshPetsList"
                :pet-prop="pet"
                :is-editable="true"
            />
        </div>
    </div>

    <PetModal
        @saved="refreshPetsList"
    />
</template>
