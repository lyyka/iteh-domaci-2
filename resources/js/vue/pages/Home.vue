<script>
import petsApi from '@/api/pets.js';
import {mapState} from "pinia";
import {useUserStore} from "@/stores/UserStore";

export default {
    computed: {
        ...mapState(useUserStore, ['getIsLoggedIn']),
    },

    data() {
        return {
            pets: [],
        };
    },

    async mounted() {
        if (this.getIsLoggedIn) {
            const res = await petsApi.all();
            this.pets = res.data.data;
        }
    }
}
</script>
<template>
    <div>
        <div>
            <div class="container text-center">
                <h1>
                    Pets App API
                </h1>
                <p class="mt-2">
                    API returns a list of pets
                </p>
                <div>
                    <router-link v-if="!getIsLoggedIn" class="d-inline-block btn btn-dark me-2" :to="{name: 'login'}">
                        Log in
                    </router-link>
                    <router-link v-if="!getIsLoggedIn" class="d-inline-block btn btn-success" :to="{name: 'register'}">
                        Register
                    </router-link>
                    <router-link v-if="getIsLoggedIn" class="d-inline-block btn btn-success" :to="{name: 'dashboard'}">
                        Dashboard
                    </router-link>
                </div>
            </div>
        </div>

        <div>

        </div>
    </div>
</template>
