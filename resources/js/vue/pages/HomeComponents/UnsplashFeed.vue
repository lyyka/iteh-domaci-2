<script>
import unsplashApi from '@/api/unsplash.js';
import UnsplashCard from "@/vue/components/UnsplashCard.vue";

export default {
    components: {UnsplashCard},

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
        await this.searchUnsplash(this.photosSection.activeCategory);
    },

    methods: {
        async searchUnsplash(term) {
            const apiRes = await unsplashApi.search(
                term, this.photosSection.page, this.photosSection.perPage
            );
            this.photosSection.photos = apiRes.images;
            this.photosSection.activeCategory = term;
        },

        async pageUnsplash(change) {
            this.photosSection.page += change;

            if (this.photosSection.page === 0) {
                this.photosSection.page = 1;
            }

            await this.searchUnsplash(this.photosSection.activeCategory);
        },
    }
}
</script>
<template>
    <div>
        <div class="row mt-4 g-5 overflow-auto">
            <div class="col-md-4 col-sm-2 col-6" v-for="category in photosSection.categories" :key="category">
                <p class="category-item"
                   v-bind:class="photosSection.activeCategory === category ? 'active' : ''"
                   @click="searchUnsplash(category)">
                    {{ category }}
                </p>
            </div>
        </div>

        <div class="row g-5 text-center mt-2">
            <div class="col-12 col-sm-6 col-md-4"
                 v-for="photo in photosSection.photos"
                 :key="photo.getId()">
                <UnsplashCard
                    :image="photo"
                />
            </div>
        </div>

        <p class="my-3 text-dark">
            Powered by <a class="text-info" href="https://unsplash.com">Unsplash</a>
        </p>

        <div class="mt-5 text-end">
            <button class="btn me-4 btn-dark"
                    :disabled="photosSection.page === 1"
                    @click="pageUnsplash(-1)">
                &lt; previous page
            </button>

            <p class="rounded-1 border-dark py-2 px-4 border d-inline-flex me-4">
                {{ photosSection.page }}
            </p>

            <button class="btn btn-dark"
                    @click="pageUnsplash(1)">
                next page &gt;
            </button>
        </div>
    </div>
</template>
