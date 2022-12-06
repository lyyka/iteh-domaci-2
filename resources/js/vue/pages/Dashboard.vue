<script>
import petsApi from '@/api/pets.js';

export default {
    data() {
        return {
            myPets: [],
        };
    },

    async mounted() {
        this.myPets = await petsApi.myPets();
    }
}
</script>
<template>
    <div class="container">
        <h1>Dashboard</h1>

        <div class="my-5">
            <h3>( a list of your pets 💖 )</h3>

            <div v-for="pet in myPets">
                <div>
                    <img
                        :alt="pet.getName()"
                        :src="`/storage/${pet.getFirstImage()?.getFileName()}`"
                    />
                </div>
            </div>
        </div>

        <div class="my-5">
            <h3>( a list of latest pets 💖 )</h3>
        </div>

    </div>
</template>
