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
            photosSection: {
                activeCategory: 'pets',
                page: 1,
                perPage: 12,
                categories: ['pets', 'cats', 'dogs', 'birds', 'turtles', 'fish'],
                photos: [],
            }
        };
    },

    async mounted() {
        await this.search(this.photosSection.activeCategory);
    },

    methods: {
        async search(term) {
            const apiRes = await unsplashApi.search(
                term, this.photosSection.page, this.photosSection.perPage
            );
            this.photosSection.photos = apiRes.images;
            this.photosSection.activeCategory = term;
        },

        async page(change) {
            this.photosSection.page += change;

            if (this.photosSection.page === 0) {
                this.photosSection.page = 1;
            }

            await this.search(this.photosSection.activeCategory);
        }
    }
}
</script>
<template>
    <div>
        <div class="hero py-5 d-flex justify-content-center align-items-center">
            <div class="container text-center">
                <h1 class="main-title text-white">
                    pets app
                </h1>
                <p class="mt-2 text-white">
                    app to upload yours and view other peoples pets
                </p>
            </div>
        </div>

        <div class="container mt-5">
            <h3>( a list of random pets 💖 )</h3>

            <div class="row mt-4 g-5 overflow-auto">
                <div class="col-md-4 col-sm-2 col-6" v-for="category in photosSection.categories" :key="category">
                    <p class="category-item"
                       v-bind:class="photosSection.activeCategory === category ? 'active' : ''"
                       @click="search(category)">
                        {{ category }}
                    </p>
                </div>
            </div>

            <div class="row g-5 text-center mt-2">
                <div class="col-12 col-sm-6 col-md-4"
                     v-for="photo in photosSection.photos"
                     :key="photo.getId()">
                    <img
                        class="pet-image"
                        style="display: inline-block;"
                        :alt="photo.getDescription()"
                        :src="photo.getSrc()"
                    />
                </div>
            </div>

            <div class="mt-5 text-end">
                <button class="btn me-4 btn-dark"
                        :disabled="photosSection.page === 1"
                        @click="page(-1)">
                    &lt; previous page
                </button>

                <p class="rounded-1 border-dark py-2 px-4 border d-inline-flex me-4">
                    {{ photosSection.page }}
                </p>

                <button class="btn btn-dark"
                        @click="page(1)">
                    next page &gt;
                </button>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#273036" fill-opacity="1"
                  d="M0,128L20,160C40,192,80,256,120,234.7C160,213,200,107,240,90.7C280,75,320,149,360,192C400,235,440,245,480,240C520,235,560,213,600,197.3C640,181,680,171,720,149.3C760,128,800,96,840,112C880,128,920,192,960,229.3C1000,267,1040,277,1080,277.3C1120,277,1160,267,1200,224C1240,181,1280,107,1320,85.3C1360,64,1400,96,1420,112L1440,128L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"></path>
        </svg>
    </div>
</template>

<style lang="scss">
.hero {
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/storage/home-hero.jpeg") center;
    height: 420px;
}

.main-title {
    letter-spacing: 4px;
}

.category-item {
    color: #c2c2c2;
    font-size: 24px;
    line-height: 30px;
    display: inline-flex;

    &:hover, &.active {
        color: black;
        cursor: pointer;
    }
}

.pet-image {
    border-radius: 8px;
    max-height: 360px;
}
</style>
