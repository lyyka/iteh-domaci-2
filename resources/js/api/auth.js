export default {
    /**
     * @param {LoginData} loginData
     * @returns {Promise<boolean>}
     */
    login: async (loginData) => {
        const route = window.appConfig.api.login;

        let success;
        try {
            const res = await window.axios.post(route, loginData.toRequest());
            success = res.data.success;
        } catch (e) {
            success = false;
        }

        return success;
    },

    /**
     *
     * @param {RegisterData} registerData
     * @returns {Promise<boolean>}
     */
    register: async (registerData) => {
        const route = window.appConfig.api.register;

        let success;
        try {
            const res = await window.axios.post(route, registerData.toRequest());
            success = res.data.success;
        } catch (e) {
            success = false;
        }

        return success;
    },

    /**
     * @returns {Promise<boolean>}
     */
    logOut: async () => {
        const route = window.appConfig.api.logout;

        let success;
        try {
            const res = await window.axios.post(route);
            success = res.data.success;
        } catch (e) {
            success = false;
        }

        return success;
    },
};
