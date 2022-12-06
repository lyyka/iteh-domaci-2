<script>
import PetResource from "@/api/dto/PetResource";

export default {
    props: {
        pet: {
            type: PetResource,
            required: true,
        }
    }
}
</script>

<template>
    <div class="pet-card rounded-2">
        <img
            class="pet-card--image"
            :alt="pet.getName()"
            :src="`/storage/pet-images/${pet.getFirstImage()?.getFileName()}`"
        />
        <div class="pet-card--content rounded-2 bg-dark py-3 px-2 bg-opacity-75">
            <p class="text-white">{{ pet.getName() }}</p>

            <hr/>

            <p class="text-white">{{ pet.getType() }}</p>

            <p class="text-white">{{ pet.getColors().join(', ') }}</p>
        </div>
    </div>
</template>

<style lang="scss">
@import "~/pet-card";
</style>
