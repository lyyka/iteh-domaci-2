import {useUserStore} from "@/stores/UserStore";
import AuthUser from "@/api/dto/AuthUser";
import UserProfile from "@/api/dto/UserProfile";

export default {
    deleteAccount: async () => {
        const userStore = useUserStore();
        const route = window.appConfig.api.deleteUser;

        let success;
        try {
            const res = await window.axios.delete(route);
            success = res.data.success;
        } catch (e) {
            success = false;
        }

        userStore.setIsLoggedIn(!success);

        return success;
    },

    /**
     * @param {UpdateUserData} updateUserData
     * @returns {Promise<{authUser: AuthUser, errors: Array}>}
     */
    updateAccount: async (updateUserData) => {
        const route = window.appConfig.api.updateUser;

        let authUser = null;
        let errors = [];

        try {
            const res = await window.axios.put(route, updateUserData.toRequest());
            authUser = new AuthUser(res.data.data);
        } catch (e) {
            if (e.response?.status === 422) {
                errors = e.response.data.errors;
            }
        }

        return {authUser, errors};
    },

    /**
     * @returns {Promise<AuthUser>}
     */
    getAuthUser: async () => {
        const route = window.appConfig.api.getAuthUser;

        let result = null;
        try {
            const res = await window.axios.get(route);
            result = new AuthUser(res.data.data);
        } catch (e) {
        }

        return result;
    },

    /**
     * @returns {Promise<UserProfile>}
     */
    getProfileByUsername: async (username) => {
        const route = window.appConfig.api.getProfileByUsername;

        let result = null;
        try {
            const res = await window.axios.get(`${route}?username=${username}`);
            result = new UserProfile(res.data.data);
        } catch (e) {
            console.log(e.response.data.errors);
        }

        return result;
    },

    /**
     * @param {LoginData} loginData
     * @returns {Promise<{success: boolean, errors: Array}>}
     */
    login: async (loginData) => {
        const route = window.appConfig.api.login;

        let success;
        let errors = [];

        try {
            const res = await window.axios.post(route, loginData.toRequest());
            success = res.data.success;
        } catch (e) {
            if (e.response?.status === 422) {
                errors = e.response.data.errors;
            }
            success = false;
        }

        return {success, errors};
    },

    /**
     *
     * @param {RegisterData} registerData
     * @returns {Promise<{success: boolean, errors: Array}>}
     */
    register: async (registerData) => {
        const route = window.appConfig.api.register;

        let success;
        let errors = [];

        try {
            const res = await window.axios.post(route, registerData.toRequest());
            success = res.data.success;
        } catch (e) {
            if (e.response?.status === 422) {
                errors = e.response.data.errors;
            }
            success = false;
        }

        return {success, errors};
    },

    /**
     * @returns {Promise<boolean>}
     */
    logOut: async () => {
        const userStore = useUserStore();
        const route = window.appConfig.api.logout;

        let success;
        try {
            const res = await window.axios.post(route);
            success = res.data.success;
        } catch (e) {
            success = false;
        }

        userStore.setIsLoggedIn(!success);

        return success;
    },
};
