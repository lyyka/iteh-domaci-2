import PetTypeResource from "@/api/dto/PetTypeResource";

export default {
    all: async () => {
        const route = window.appConfig.api.petType.all;
        let res = await window.axios.get(route);

        return res.data.map(o => new PetTypeResource(o));
    },
};
