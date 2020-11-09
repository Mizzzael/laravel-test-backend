<template>
    <section id="loading" class="w-full mx-auto"></section>
</template>
<script>
import LottieWeb from "lottie-web";
import loading from "../../js/animations/6528-loading.json";

export default {
    name: "Loading",
    data() {
        return {
            animation: undefined
        };
    },
    methods: {
        startAnimation() {
            this.animation = LottieWeb.loadAnimation({
                container: document.getElementById("loading"),
                renderer: "canvas",
                loop: true,
                autoplay: true,
                animationData: loading
            });
        },
        stopAnimation() {
            this.animation.stop();
            this.animation.destroy();
        }
    },
    mounted() {
        this.startAnimation();
    },
    beforeDestroy() {
        this.stopAnimation();
    }
};
</script>
