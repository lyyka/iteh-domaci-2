<script>
import {mapState} from 'pinia';
import {useUserStore} from "@/stores/UserStore";
import authApi from "@/api/auth";

export default {
    computed: {
        ...mapState(useUserStore, ['getIsLoggedIn']),
    },

    methods: {
        async handleLogout() {
            const res = await authApi.logOut();
            if (res) {
                this.$router.push({name: 'home'});
            }
        }
    }
}
</script>
<template>
    <header>
        <nav>
            <div class="py-3 px-5 shadow-sm">
                <div class="container d-flex justify-content-between align-items-center">
                    <ul class="nav-list">
                        <li class="me-2">
                            <router-link class="text-dark" :to="{name: 'home'}">
                                <img
                                    alt="logo"
                                    src="/storage/logo.png"
                                />
                                <span class="ms-3">pets app</span>
                            </router-link>
                        </li>
                    </ul>

                    <ul class="nav-list">
                        <li v-if="!getIsLoggedIn" class="me-2">
                            <router-link class="btn btn-dark" :to="{name: 'login'}">log in</router-link>
                        </li>
                        <li v-if="!getIsLoggedIn">
                            <router-link class="btn btn-success" :to="{name: 'register'}">register</router-link>
                        </li>
                        <li class="me-4" v-if="getIsLoggedIn">
                            <router-link class="btn btn-success" :to="{name: 'dashboard'}">dashboard</router-link>
                        </li>
                        <li v-if="getIsLoggedIn">
                            <a href="#" @click="handleLogout" class="text-dark">log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<style lang="scss">
.nav-list {
    list-style-type: none;
    margin: 0;
    padding: 0;

    li {
        display: inline-flex;
    }
}
</style>
