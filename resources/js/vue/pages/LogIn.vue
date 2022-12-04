<script>
import {mapActions} from "pinia/dist/pinia";
import {useUserStore} from "@/stores/UserStore";

export default {
    data() {
        return {
            form: {
                email: null,
                password: null,
            },

            errorMessage: null,
        };
    },

    methods: {
        ...mapActions(useUserStore, ['setIsLoggedIn']),

        login() {
            window.axios.post(this.$appConfig.api.login, this.form)
                .then((res) => {
                    if (res.data.success) {
                        this.setIsLoggedIn(true);
                        this.$router.push({name: 'dashboard'});
                    } else {
                        this.errorMessage = 'Login failed.';
                    }
                }).catch(() => this.errorMessage = 'Login failed.');
        }
    }
};
</script>
<template>
    <div class="container">
        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>

        <h1>Log in</h1>

        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" v-model="form.email"
                       autocomplete="email"
                       placeholder="example@email.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" autocomplete="current-password" v-model="form.password" class="form-control"
                       id="password"
                       placeholder="Password">
            </div>

            <button class="btn btn-dark" type="button" @click="login">
                Log in
            </button>
        </form>
    </div>
</template>
