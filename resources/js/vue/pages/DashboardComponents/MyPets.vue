<script>
import petsApi from '@/api/pets.js';
import petTypesApi from '@/api/petType.js';
import petColorsApi from '@/api/petColor.js';
import 'bootstrap/dist/js/bootstrap.min';

export default {
    data() {
        return {
            myPets: [],
            petTypes: [],
            colors: [],
            form: {
                name: null,
                type: null,
                colors: [],
                date_of_birth: null,
            },
            formErrors: {},
        };
    },

    async mounted() {
        await this.refreshPetsList();
        this.petTypes = await petTypesApi.all();
        this.colors = await petColorsApi.all();
    },

    methods: {
        async refreshPetsList() {
            this.myPets = await petsApi.myPets();
        },

        save() {
            this.formErrors = {};

            window.axios.post(this.$appConfig.api.pets.store, this.form)
                .then(r => {
                    if (r.status === 201) {
                        this.$refs.closeCreatePetModal.click();
                        this.refreshPetsList();
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
    <div class="d-flex">
        <h3 class="me-3">( a list of your pets 💖 )</h3>

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

    <div v-for="pet in myPets">
        <div>
            <img
                :alt="pet.getName()"
                :src="`/storage/${pet.getFirstImage()?.getFileName()}`"
            />
        </div>
    </div>

    <button type="button" class="btn-close" data-bs-dismiss="modal"
            ref="closeCreatePetModal"
            style="display: none;"
            data-bs-target="#createPetModal" aria-label="Close"></button>

    <div class="modal" id="createPetModal" tabindex="-1" data-bs-keyboard="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">create new pet</h5>
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
