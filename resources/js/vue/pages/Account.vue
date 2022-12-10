<script>
import authApi from "@/api/auth";
import UpdateUserData from "@/api/dto/UpdateUserData";
import DangerZone from "@/vue/pages/DashboardComponents/DangerZone.vue";

export default {
    components: {DangerZone},

    data() {
        return {
            authUser: null,
            form: {
                name: null,
                email: null,
            },
            formErrors: {},
            successMessage: 'update was successful!',
            showSuccess: false,
        };
    },

    async mounted() {
        this.authUser = await authApi.getAuthUser();
        this.form.name = this.authUser.getName();
        this.form.email = this.authUser.getEmail();
    },

    methods: {
        async handleUpdate() {
            this.formErrors = {};

            const {authUser, errors} = await authApi.updateAccount(new UpdateUserData(
                this.form.name, this.form.email
            ));

            if (authUser) {
                this.authUser = authUser;
                this.showSuccess = true;

                window.setTimeout(() => {
                    this.showSuccess = false;
                }, 1500);
            } else {
                this.formErrors = errors;
            }
        }
    }
}
</script>
<template>
    <div v-if="authUser !== null" class="container mt-5">
        <router-link class="text-dark mb-5 d-block" :to="{name: 'dashboard'}">
            &lt; back to dashboard
        </router-link>

        <h1>hello <span class="text-decoration-underline">@{{ authUser.getUsername() }}</span> 👋</h1>

        <div class="mt-5 mb-5">
            <h3 class="me-3 mb-3">( info ✨ )</h3>

            <div v-if="showSuccess" class="alert alert-success" role="alert">
                {{ successMessage }}
            </div>

            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">name</label>
                    <input type="text" class="form-control" id="name"
                           v-model="form.name"
                           autocomplete="name"
                           placeholder="full name">
                    <div v-bind:style="formErrors.name ? 'display: block;' : ''"
                         class="invalid-feedback">
                        {{ formErrors.name ? formErrors.name[0] : '' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control" id="email"
                           v-model="form.email"
                           autocomplete="email"
                           placeholder="example@email.com">
                    <div v-bind:style="formErrors.email ? 'display: block;' : ''"
                         class="invalid-feedback">
                        {{ formErrors.email ? formErrors.email[0] : '' }}
                    </div>
                </div>

                <button class="btn btn-dark" type="button" @click="handleUpdate">
                    update
                </button>
            </form>
        </div>

        <div class="mb-5">
            <DangerZone/>
        </div>
    </div>
</template>
