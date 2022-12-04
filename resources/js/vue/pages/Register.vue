<script>
import {mapActions} from "pinia/dist/pinia";
import {useUserStore} from "@/stores/UserStore";

export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
            },

            errorMessage: null,
        };
    },

    methods: {
        ...mapActions(useUserStore, ['setIsLoggedIn']),

        register() {
            this.errorMessage = null;
            window.axios.post(this.$appConfig.api.register, this.form)
                .then((res) => {
                    if (res.data.success) {
                        this.setIsLoggedIn(true);
                        this.$router.push({name: 'dashboard'});
                    } else {
                        this.errorMessage = 'Registration failed.';
                    }
                }).catch(() => this.errorMessage = 'Registration failed.');
        }
    }
};
</script>
<template>
    <div class="container">
        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>

        <h1>Register</h1>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" v-model="form.name"
                       autocomplete="name"
                       placeholder="Full name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" v-model="form.email"
                       autocomplete="email"
                       placeholder="example@email.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" autocomplete="new-password" v-model="form.password" class="form-control"
                       id="password"
                       placeholder="Password">
            </div>

            <button class="btn btn-dark" type="button" @click="register">
                Register
            </button>
        </form>
    </div>
</template>
