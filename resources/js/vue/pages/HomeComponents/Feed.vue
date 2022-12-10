<script>
import petsApi from '@/api/pets.js';
import {mapState} from "pinia";
import {useUserStore} from "@/stores/UserStore";
import PetCard from "@/vue/components/PetCard.vue";

export default {
    components: {PetCard},

    computed: {
        ...mapState(useUserStore, ['getIsLoggedIn']),
    },

    data() {
        return {
            feedData: null,
        };
    },

    async mounted() {
        await this.loadFeed();
    },

    methods: {
        async loadFeed() {
            const page = this.feedData?.getCurrentPage() ?? 1;
            this.feedData = await petsApi.latestPets(page);
        },

        async nextPage() {
            this.feedData.next();
            await this.loadFeed();
        },

        async previousPage() {
            this.feedData.previous();
            await this.loadFeed();
        },
    }
}
</script>
<template>
    <div>
        <div v-if="!getIsLoggedIn">
            <div class="row g-5 text-center">
                <div class="col">
                    <img
                        alt="Not logged in animation"
                        src="/storage/feed-register.gif"
                    />
                </div>
                <div class="col align-self-center text-start">
                    <h4>log in or register to see the feed</h4>

                    <hr/>

                    <router-link class="btn btn-dark me-2" :to="{name: 'login'}">log in</router-link>
                    <router-link class="btn btn-success" :to="{name: 'register'}">register</router-link>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="row g-5 text-center mt-2">
                <div class="col-12 col-sm-6 col-md-4"
                     v-for="pet in feedData?.getResources()"
                     :key="pet.getId()">
                    <PetCard
                        :pet-prop="pet"
                    />
                </div>
            </div>

            <div class="mt-5 text-end">
                <button class="btn me-4 btn-dark"
                        :disabled="feedData?.isStart()"
                        @click="previousPage">
                    &lt; previous page
                </button>

                <p class="rounded-1 border-dark py-2 px-4 border d-inline-flex me-4">
                    {{ feedData?.getCurrentPage() }}
                </p>

                <button class="btn btn-dark"
                        :disabled="!feedData?.hasMore()"
                        @click="nextPage">
                    next page &gt;
                </button>
            </div>
        </div>
    </div>
</template>
