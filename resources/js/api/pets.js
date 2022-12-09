import PetResource from "@/api/dto/PetResource";
import PaginatedResource from "@/api/dto/PaginatedResource";

export default {
    myPets: async () => {
        const route = window.appConfig.api.pets.myPets;
        let res = await window.axios.get(route);

        res = res.data.data;

        return res.map(o => new PetResource(o));
    },

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

    delete: async (pet) => {
        const route = window.appConfig.api.pets.delete;

        const res = await window.axios.delete(
            `${route}?pet_id=${pet.getId()}`
        );

        return res.status === 200;
    },
};
