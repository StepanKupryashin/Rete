<template>
    <div>
        <vs-navbar shadow square class="fixed"> <!-- header -->
            <template #left>
                <vs-button @click="activeSidebar = !activeSidebar" flat icon>
                    <i class='bx bx-menu text-xs'>
                        Menu
                    </i>
                </vs-button>
            </template>
            <h3>Rete | Интернет форум</h3>

            <template #right>
                <vs-button v-if="!checkAuth()" @click="$router.push({ path: '/login' })" flat>Login</vs-button>
                <vs-button v-else @click="logout" flat>Logout</vs-button>
            </template>

        </vs-navbar>
        <vs-sidebar fixed v-model="active" :open.sync="activeSidebar">
            <template #logo>
                <!-- ...img logo -->
            </template>

            <vs-sidebar-item id="Home">
                <template #icon>
                    <i class='bx bx-home'></i>
                </template>
                <span @click="() => {
                        activeSidebar = false
                        $router.push({ path: '/' })
                    }">
                    Главная
                </span>
            </vs-sidebar-item>

            <vs-sidebar-item id="Profile">
                <template #icon>
                    <i class='bx bx-grid-alt'></i>
                </template>
                <span @click="() => {
                        activeSidebar = false
                        $router.push({ path: '/profile' })
                    }">
                    Профиль
                </span>
            </vs-sidebar-item>

            <vs-sidebar-item id="Projects">
                <template #icon>
                    <i class='bx bxs-music'></i>
                </template>
                <span @click="() => {
                        activeSidebar = false
                        $router.push({ path: '/topics' })
                    }">
                    Топики
                </span>
            </vs-sidebar-item>


            <template #footer>
                <vs-row justify="space-between">
                    <vs-avatar>
                        <img src="https://avatars.mds.yandex.net/i?id=2bf8c047d61a77491675e765c2a8f65d538037fe-9182388-images-thumbs&n=13"
                            alt="">
                    </vs-avatar>
                </vs-row>
            </template>
        </vs-sidebar>
    </div>
</template>
<script>
export default {
    data: () => ({
        active: "guide",
        activeSidebar: false,
        isAuth: false,
    }),
    methods: {
        checkAuth() {
            return localStorage.getItem('isAuth');
        },
        logout() {
            localStorage.removeItem('isAuth');
            localStorage.removeItem('access_token');
            window.location = "/";
        },
    },
    mounted() {
        console.log('Component mounted.')
        if (localStorage.getItem('isAuth')) {
            this.isAuth = true;
        }
    }
}
</script>
