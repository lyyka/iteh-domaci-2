<script>
import UnsplashImage from "@/api/dto/UnsplashImage";

export default {
    props: {
        image: {
            type: UnsplashImage,
            required: true,
        }
    }
}
</script>

<template>
    <div class="pet-card rounded-2">
        <img
            class="pet-card--image"
            :alt="image.getDescription()"
            :src="image.getSrc()"
        />
        <div class="pet-card--content rounded-2 bg-dark py-3 px-2 bg-opacity-75">
            <p v-if="image.getDescription()"
               class="text-white">{{ image.getDescription() }}</p>

            <hr v-if="image.getDescription()"/>

            <a :href="image.getImageUrl()"
               class="text-info">{{ image.getImageUrl() }}</a>
        </div>
    </div>
</template>

<style lang="scss">
@import "~/pet-card";
</style>
