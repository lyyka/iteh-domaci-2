<script>
import unsplashApi from '@/api/unsplash.js';
import {mapState} from "pinia";
import {useUserStore} from "@/stores/UserStore";

export default {
    computed: {
        ...mapState(useUserStore, ['getIsLoggedIn']),
    },

    data() {
        return {
            photos: [],
        };
    },

    async mounted() {
        this.photos = await unsplashApi.search('pets', 1, 12);
    }
}
</script>
<template>
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

        <div class="mt-5">
            <h3>( a list of random pets 💖 )</h3>

            <div class="images-grid three text-center mt-4">
                <div v-for="photo in photos" :key="photo.getId()">
                    <img
                        style="display: inline-block;"
                        :alt="photo.getDescription()"
                        :src="photo.getSrc()"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.images-grid {
    display: grid;
    grid-gap: 32px;

    &.three {
        grid-template-columns: repeat(3, 1fr);

        @media only screen and (max-width: 768px) {
            grid-template-columns: repeat(2, 1fr);
        }

        @media only screen and (max-width: 375px) {
            grid-template-columns: 1fr;
        }
    }
}
</style>
