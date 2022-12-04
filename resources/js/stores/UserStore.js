import {defineStore} from 'pinia';

export const useUserStore = defineStore('user-data-store', {
    state: () => ({isLoggedIn: false}),
    getters: {
        getIsLoggedIn: (state) => state.isLoggedIn,
    },
    actions: {
        setIsLoggedIn(data) {
            this.isLoggedIn = data;
        },
    },
})
