<script>
import {mapState} from "pinia";
import {useUserStore} from "@/stores/UserStore";
import Feed from "@/vue/pages/HomeComponents/Feed.vue";
import UnsplashFeed from "@/vue/pages/HomeComponents/UnsplashFeed.vue";

export default {
    components: {UnsplashFeed, Feed},

    computed: {
        ...mapState(useUserStore, ['getIsLoggedIn']),
    },

    data() {
        return {
            activeTab: 'randomList',
        };
    },

    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
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
            <div class="row text-center g-5">
                <h3
                    @click="setActiveTab('randomList')"
                    v-bind:class="activeTab === 'randomList' ? 'active' : ''"
                    class="tab col-12 col-sm-6">( random pets 💖 )</h3>
                <h3
                    @click="setActiveTab('feed')"
                    v-bind:class="activeTab === 'feed' ? 'active' : ''"
                    class="tab col-12 col-sm-6">( feed 🐶 )</h3>
            </div>

            <div v-if="activeTab === 'randomList'">
                <UnsplashFeed/>
            </div>

            <div v-else-if="activeTab === 'feed'">
                <Feed/>
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
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/images/home-hero.jpeg") center;
    height: 420px;
}

.main-title {
    letter-spacing: 4px;
}

.tab {
    color: #c2c2c2;

    &:hover, &.active {
        color: black;
        cursor: pointer;
    }
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
</style>
