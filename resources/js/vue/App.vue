<script>
import Home from "./pages/Home.vue";
import Header from "./components/Header.vue";
import {mapActions} from "pinia";
import {useUserStore} from "@/stores/UserStore.js";

export default {
    components: {Header, Home},

    methods: {
        ...mapActions(useUserStore, ['setIsLoggedIn']),
    },

    mounted() {
        this.setIsLoggedIn(this.$isLoggedIn);
    },
}
</script>

<template>
    <div>
        <Header/>
        <div class="container">
            <router-view/>
        </div>
    </div>
</template>

<style lang="scss">
@import 'bootstrap/scss/bootstrap.scss';
</style>
