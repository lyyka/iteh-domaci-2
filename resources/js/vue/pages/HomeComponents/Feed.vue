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
            page: 1,
        };
    },

    async mounted() {
        await this.loadFeed();
    },

    methods: {
        async loadFeed(page = 1) {
            this.feedData = await petsApi.latestPets(page);
        },

        async pageChange(change) {
            this.page += change;

            if (this.page === 0) {
                this.page = 1;
            }

            await this.loadFeed(this.page);
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

        <div class="row g-5 text-center mt-2">
            <div class="col-12 col-sm-6 col-md-4"
                 v-for="pet in feedData ?? []"
                 :key="pet.getId()">
                <PetCard
                    :pet-prop="pet"
                />
            </div>
        </div>

        <div class="mt-5 text-end">
            <button class="btn me-4 btn-dark"
                    :disabled="page === 1"
                    @click="pageChange(-1)">
                &lt; previous page
            </button>

            <p class="rounded-1 border-dark py-2 px-4 border d-inline-flex me-4">
                {{ page }}
            </p>

            <button class="btn btn-dark"
                    @click="pageChange(1)">
                next page &gt;
            </button>
        </div>
    </div>
</template>
