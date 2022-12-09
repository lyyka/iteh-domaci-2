<script>
import Home from "./pages/Home.vue";
import Header from "./components/Header.vue";

export default {
    components: {Header, Home},
}
</script>

<template>
    <div>
        <Header/>
        <router-view/>
    </div>
</template>

<style lang="scss">
@import 'bootstrap/scss/bootstrap.scss';

img {
    max-width: 100%;
}
</style>
