<script>
import petTypesApi from '@/api/petType.js';
import petColorsApi from '@/api/petColor.js';
import PetResource from "@/api/dto/PetResource";

export default {
    props: {
        petProp: {
            type: PetResource,
            required: false,
            default: null,
        },
    },

    data() {
        return {
            pet: null,
            petTypes: [],
            colors: [],
            form: {
                pet_id: null,
                name: null,
                type: null,
                colors: [],
                date_of_birth: null,
            },
            formErrors: {},
        };
    },

    async mounted() {
        this.petTypes = await petTypesApi.all();
        this.colors = await petColorsApi.all();
    },

    emits: ['saved'],

    beforeMount() {
        this.init();
    },

    methods: {
        init() {
            this.pet = this.petProp;
            if (this.pet) {
                this.initForPet(this.pet);
            }
        },

        initForPet(pet) {
            this.form.name = pet.getName();
            this.form.type = pet.getType();
            this.form.colors = pet.getColors();

            const dob = new Date(pet.getDateOfBirth());
            const day = ("0" + dob.getDate()).slice(-2);
            const month = ("0" + (dob.getMonth() + 1)).slice(-2);
            this.form.date_of_birth = dob.getFullYear() + "-" + (month) + "-" + (day);
        },

        open() {
            this.$refs.openCreatePetModal.click();
        },

        close() {
            this.$refs.closeCreatePetModal.click();
        },

        save() {
            this.formErrors = {};

            const promise = this.pet ?
                window.axios.put(this.$appConfig.api.pets.update, {
                    ...this.form,
                    pet_id: this.pet.getId(),
                }) :
                window.axios.post(this.$appConfig.api.pets.store, this.form);

            promise
                .then(r => {
                    if (r.status === 201 || r.status === 200) {
                        this.close();
                        this.$emit('saved');
                    }
                })
                .catch(e => {
                    if (e.response?.status === 422) {
                        this.formErrors = e.response.data.errors;
                    }
                });
        },
    }
}
</script>

<template>
    <button type="button"
            style="display: none;"
            ref="openCreatePetModal"
            data-bs-toggle="modal"
            :data-bs-target="pet ? `#createPetModal-${pet.getId()}` : '#createPetModal'"></button>

    <button type="button" data-bs-dismiss="modal"
            ref="closeCreatePetModal"
            style="display: none;"
            :data-bs-target="pet ? `#createPetModal-${pet.getId()}` : '#createPetModal'"
            aria-label="Close"></button>

    <div class="modal"
         :id="pet ? `createPetModal-${pet.getId()}` : 'createPetModal'"
         tabindex="-1" data-bs-keyboard="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ pet ? 'edit a pet' : 'create new pet' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <span class="text-danger">*</span> name</label>
                            <input type="text" class="form-control" id="name" v-model="form.name"
                                   autocomplete="name"
                                   placeholder="Your pets name">
                            <div v-bind:style="formErrors.name ? 'display: block;' : ''"
                                 class="invalid-feedback">
                                {{ formErrors.name ? formErrors.name[0] : '' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <span class="text-danger">*</span> type</label>
                            <select class="form-control" id="type" v-model="form.type">
                                <option
                                    v-for="type in petTypes"
                                    :key="type.getValue()"
                                    :value="type.getValue()">{{ type.getLabel() }}
                                </option>
                            </select>
                            <div v-bind:style="formErrors.type ? 'display: block;' : ''"
                                 class="invalid-feedback">
                                {{ formErrors.type ? formErrors.type[0] : '' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <span class="text-danger">*</span> color(s)</label>
                            <div class="row container g-3">
                                <div class="form-check col-6 col-md-4"
                                     v-for="color in colors"
                                     :key="color">
                                    <input class="form-check-input" type="checkbox"
                                           name="colors[]"
                                           v-model="form.colors"
                                           :value="color.getValue()"
                                           :id="`cb-color-${color.getValue()}`">
                                    <label class="form-check-label"
                                           :for="`cb-color-${color.getValue()}`">
                                        {{ color.getLabel() }}
                                    </label>
                                </div>
                            </div>
                            <div v-bind:style="formErrors.colors ? 'display: block;' : ''"
                                 class="invalid-feedback">
                                {{ formErrors.colors ? formErrors.colors[0] : '' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">date of birth</label>
                            <input type="date" class="form-control" id="name"
                                   v-model="form.date_of_birth"
                                   placeholder="Date of birth">
                            <div v-bind:style="formErrors.date_of_birth ? 'display: block;' : ''"
                                 class="invalid-feedback">
                                {{ formErrors.date_of_birth ? formErrors.date_of_birth[0] : '' }}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                    <button @click="save" type="button" class="btn btn-success">save</button>
                </div>
            </div>
        </div>
    </div>
</template>
