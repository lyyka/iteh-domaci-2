export default {
    all: async () => {
        const route = window.appConfig.api.pets.all;
        return await window.axios.get(route);
    },
};
