<script>
import {mapActions} from "pinia/dist/pinia";
import {useUserStore} from "@/stores/UserStore";
import authApi from "@/api/auth";
import RegisterData from "@/api/dto/RegisterData";

export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
            },

            formErrors: {},
        };
    },

    methods: {
        ...mapActions(useUserStore, ['setIsLoggedIn']),

        async register() {
            this.formErrors = {};

            const {success, errors} = await authApi.register(new RegisterData(
                this.form.name,
                this.form.email,
                this.form.password
            ));

            if (success) {
                this.setIsLoggedIn(true);
                this.$router.push({name: 'dashboard'});
            } else {
                this.formErrors = errors;
            }
        }
    }
};
</script>
<template>
    <div class="container mt-5">
        <h1>register</h1>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control" id="name" v-model="form.name"
                       autocomplete="name"
                       placeholder="full name">
                <div v-bind:style="formErrors.name ? 'display: block;' : ''"
                     class="invalid-feedback">
                    {{ formErrors.name ? formErrors.name[0] : '' }}
                </div>
            </div>

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
                <label for="password" class="form-label">Password</label>
                <input type="password" autocomplete="new-password" v-model="form.password" class="form-control"
                       id="password"
                       placeholder="password">
                <div v-bind:style="formErrors.password ? 'display: block;' : ''"
                     class="invalid-feedback">
                    {{ formErrors.password ? formErrors.password[0] : '' }}
                </div>
            </div>

            <button class="btn btn-dark" type="button" @click="register">
                register
            </button>
        </form>
    </div>
</template>
