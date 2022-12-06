<script>
import {mapActions, mapState} from 'pinia';
import {useUserStore} from "@/stores/UserStore";

export default {
    computed: {
        ...mapState(useUserStore, ['getIsLoggedIn']),
    },

    methods: {
        ...mapActions(useUserStore, ['setIsLoggedIn']),

        logout() {
            window.axios.post(this.$appConfig.api.logout)
                .then(res => {
                    if (res.data.success) {
                        this.setIsLoggedIn(false);
                        this.$router.push({name: 'home'});
                    }
                });
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
                            <router-link class="text-dark" :to="{name: 'home'}">home</router-link>
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
                            <a href="#" @click="logout" class="text-dark">log out</a>
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
