<template>
    <div>
        <nav-bar></nav-bar>
        <div class="wrapper">
            <router-view></router-view>
        </div>
        <div class="fixed right-0 bottom-0" v-show="scY > 300" @click="toTop">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="48"
                height="48"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#4a5568"
                stroke-width="1"
                stroke-linecap="square"
                stroke-linejoin="arcs"
            >
                <path d="M18 15l-6-6-6 6" />
            </svg>
        </div>
    </div>
</template>
<script>
import NavBar from "./components/NavBar.vue";
export default {
    components: {
        NavBar,
    },
    data: () => ({
        scTimer: 0,
        scY: 0,
    }),
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    methods: {
        handleScroll: function () {
            if (this.scTimer) return;
            this.scTimer = setTimeout(() => {
                this.scY = window.scrollY;
                clearTimeout(this.scTimer);
                this.scTimer = 0;
            }, 100);
        },
        toTop: function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        },
    },
};
</script>

<style lang="scss">
.wrapper {
    margin-top: 6vh;
    min-height: 94vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 100vw;
    overflow-x: hidden;
}
</style>
