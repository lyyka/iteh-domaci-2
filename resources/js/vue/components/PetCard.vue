<script>
import PetResource from "@/api/dto/PetResource";
import petsApi from '@/api/pets.js';
import PetModal from "@/vue/components/PetModal.vue";

export default {
    components: {PetModal},

    props: {
        petProp: {
            type: PetResource,
            required: true,
        },

        isEditable: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    emits: ['saved', 'deleted'],

    data() {
        return {
            pet: null,
        }
    },

    beforeMount() {
        this.pet = this.petProp;
    },

    beforeUpdate() {
        this.pet = this.petProp;
    },

    methods: {
        async deletePet() {
            const isDeleted = await petsApi.delete(this.pet);

            if (isDeleted) {
                this.$emit('deleted');
            }
        },

        editPet() {
            this.$refs.petModal.open();
        },

        onSave() {
            this.$emit('saved');
        }
    },
}
</script>

<template>
    <div>
        <div class="pet-card rounded-2">
            <img
                class="pet-card--image"
                :alt="pet.getName()"
                :src="`/storage/pet-images/${pet.getFirstImage()?.getFileName()}`"
            />
            <div class="pet-card--content
            text-center
            rounded-2 bg-dark py-3 px-2 bg-opacity-75">
                <p class="text-white">{{ pet.getName() }}</p>

                <hr/>

                <p class="text-white">{{ pet.getType() }}</p>

                <p class="text-white">{{ pet.getColors().join(', ') }}</p>

                <div class="text-end" v-if="isEditable">
                    <button type="button"
                            @click="editPet"
                            class="btn btn-dark me-3">
                        edit
                    </button>
                    <button type="button"
                            @click="deletePet"
                            class="btn btn-danger">
                        delete
                    </button>
                </div>
            </div>
        </div>

        <div v-if="isEditable">
            <PetModal
                ref="petModal"
                :pet-prop="pet"
                @saved="onSave"
            />
        </div>
    </div>
</template>

<style lang="scss">
@import "~/pet-card";
</style>
