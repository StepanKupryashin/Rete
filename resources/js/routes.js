import Home from './views/Home.vue';
import Authorization from './views/Authorization.vue';
/* import Tasks from './views/Tasks.vue'; */

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
    },
    {
        name: 'login',
        path: '/login',
        component: Authorization
    }
];