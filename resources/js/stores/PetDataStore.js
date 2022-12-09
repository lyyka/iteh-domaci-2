import {defineStore} from 'pinia';

export const usePetDataStore = defineStore('pet-data-store', {
    state: () => ({petColorOptions: [], petTypesOptions: []}),
    getters: {
        getPetColorOptions: (state) => state.petColorOptions,
        getPetTypesOptions: (state) => state.petTypesOptions,
    },
    actions: {
        setPetColorOptions(data) {
            this.petColorOptions = data;
        },
        setPetTypesOptions(data) {
            this.petTypesOptions = data;
        },
    },
})
