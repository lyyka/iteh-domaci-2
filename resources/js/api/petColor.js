import PetColorResource from "@/api/dto/PetColorResource";

export default {
    all: async () => {
        const route = window.appConfig.api.petColor.all;
        let res = await window.axios.get(route);

        return res.data.map(o => new PetColorResource(o));
    },
};
