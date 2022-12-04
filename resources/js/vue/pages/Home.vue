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

        <div class="container mt-5">
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

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#273036" fill-opacity="1"
                  d="M0,128L20,160C40,192,80,256,120,234.7C160,213,200,107,240,90.7C280,75,320,149,360,192C400,235,440,245,480,240C520,235,560,213,600,197.3C640,181,680,171,720,149.3C760,128,800,96,840,112C880,128,920,192,960,229.3C1000,267,1040,277,1080,277.3C1120,277,1160,267,1200,224C1240,181,1280,107,1320,85.3C1360,64,1400,96,1420,112L1440,128L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"></path>
        </svg>
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
