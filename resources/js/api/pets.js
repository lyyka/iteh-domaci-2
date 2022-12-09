import PetResource from "@/api/dto/PetResource";
import PaginatedResource from "@/api/dto/PaginatedResource";

export default {
    /**
     * @returns {Promise<PetResource[]>}
     */
    myPets: async () => {
        const route = window.appConfig.api.pets.myPets;
        let res = await window.axios.get(route);

        res = res.data.data;

        return res.map(o => new PetResource(o));
    },

    /**
     * @param {Number} page
     * @returns {Promise<PaginatedResource>}
     */
    latestPets: async (page = 1) => {
        const route = window.appConfig.api.pets.latestPets;
        let res = await window.axios.get(
            `${route}?page=${page}`
        );

        return new PaginatedResource(
            res.data.data.map(o => new PetResource(o)),
            res.data.meta
        );
    },

    /**
     * @param {PetUpdateData} petUpdateData
     * @returns {Promise<Object>}
     */
    update: async (petUpdateData) => {
        const headers = {
            'Accept': 'application/json',
        };

        const isNew = petUpdateData.pet_id;

        if (!isNew) headers['Content-Type'] = 'multipart/form-data';

        let success;
        let errors = {};

        try {
            const form = {
                name: petUpdateData.name,
                type: petUpdateData.type,
                colors: petUpdateData.colors,
                date_of_birth: petUpdateData.date_of_birth,
                image: petUpdateData.image,
            };

            const res = isNew ?
                await window.axios.put(window.appConfig.api.pets.update, {
                    ...form,
                    image: null,
                    pet_id: petUpdateData.pet_id,
                }, {headers}) :
                await window.axios.post(window.appConfig.api.pets.store, form, {headers});

            success = [200, 201].includes(res.status);
        } catch (e) {
            if (e.response?.status === 422) {
                errors = e.response.data.errors;
            }
            success = false;
        }

        return {success, errors};
    },

    /**
     * @param {PetResource} pet
     * @returns {Promise<boolean>}
     */
    delete: async (pet) => {
        const route = window.appConfig.api.pets.delete;

        const res = await window.axios.delete(
            `${route}?pet_id=${pet.getId()}`
        );

        return res.status === 200;
    },
};
