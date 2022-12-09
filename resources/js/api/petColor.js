import PetColorResource from "@/api/dto/PetColorResource";
import {useUserStore} from "@/stores/UserStore";

export default {
    all: async () => {
        const route = window.appConfig.api.petColor.all;
        const userStore = useUserStore();

        const res = userStore.getIsLoggedIn ?
            await window.axios.get(route) : {data: []};

        return res.data.map(o => new PetColorResource(o));
    },
};
