<script>
import {mapActions} from "pinia/dist/pinia";
import {useUserStore} from "@/stores/UserStore";
import LoginData from "@/api/dto/LoginData";
import authApi from "@/api/auth";

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

        handleLogin() {
            const loggedIn = authApi.login(new LoginData(
                this.form.email,
                this.form.password
            ));

            if (loggedIn) {
                this.setIsLoggedIn(true);
                this.$router.push({name: 'dashboard'});
            } else {
                this.errorMessage = 'Login failed.'
            }
        }
    }
};
</script>
<template>
    <div class="container mt-5">
        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>

        <h1>log in</h1>

        <form>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" v-model="form.email"
                       autocomplete="email"
                       placeholder="example@email.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" autocomplete="current-password" v-model="form.password" class="form-control"
                       id="password"
                       placeholder="password">
            </div>

            <button class="btn btn-dark" type="button" @click="handleLogin">
                log in
            </button>
        </form>
    </div>
</template>
