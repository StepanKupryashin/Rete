<template>
    <div>
        <nav-bar></nav-bar>
        <div class="wrapper">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import NavBar from './components/NavBar.vue';
export default {
    components: {
        NavBar
    }
}
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