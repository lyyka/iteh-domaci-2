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

            formErrors: {},
            generalLoginError: null,
        };
    },

    methods: {
        ...mapActions(useUserStore, ['setIsLoggedIn']),

        async handleLogin() {
            this.formErrors = {};
            this.generalLoginError = null;

            const {success, errors} = await authApi.login(new LoginData(
                this.form.email,
                this.form.password
            ));

            if (success) {
                this.setIsLoggedIn(true);
                this.$router.push({name: 'dashboard'});
            } else {
                if (Object.keys(errors).length > 0) {
                    this.formErrors = errors;
                } else {
                    this.generalLoginError = 'log in failed. try again!';
                }
            }
        }
    }
};
</script>
<template>
    <div class="container mt-5">
        <div v-if="generalLoginError" class="alert alert-danger" role="alert">
            {{ generalLoginError }}
        </div>

        <h1>log in</h1>

        <form>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" v-model="form.email"
                       autocomplete="email"
                       placeholder="example@email.com">
                <div v-bind:style="formErrors.email ? 'display: block;' : ''"
                     class="invalid-feedback">
                    {{ formErrors.email ? formErrors.email[0] : '' }}
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" autocomplete="current-password" v-model="form.password" class="form-control"
                       id="password"
                       placeholder="password">
                <div v-bind:style="formErrors.password ? 'display: block;' : ''"
                     class="invalid-feedback">
                    {{ formErrors.password ? formErrors.password[0] : '' }}
                </div>
            </div>

            <button class="btn btn-dark" type="button" @click="handleLogin">
                log in
            </button>
        </form>
    </div>
</template>
