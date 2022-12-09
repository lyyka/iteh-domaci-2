import PetTypeResource from "@/api/dto/PetTypeResource";
import {useUserStore} from "@/stores/UserStore";

export default {
    all: async () => {
        const userStore = useUserStore();

        const route = window.appConfig.api.petType.all;

        const res = userStore.getIsLoggedIn ?
            await window.axios.get(route) : {data: []};

        return res.data.map(o => new PetTypeResource(o));
    },
};
