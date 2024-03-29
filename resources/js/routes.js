import Home from './views/Home.vue';
import Authorization from './views/Authorization.vue';
import Topic from './views/Topic.vue';
import Topics from './views/Topics.vue';
import Profile from './views/Profile.vue';
import Admin from './views/Admin.vue';
import Register from './views/Register.vue';
/* import Tasks from './views/Tasks.vue'; */


const checkAdmin = (to, from, next) => {
    if(localStorage.getItem('is_admin') != 'true') next('/');
    next();
}

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
    },
    {
        name: 'topic',
        path: '/topic/:id',
        component: Topic
    },
    {
        name : 'topics',
        path: '/topics',
        component: Topics
    },
    {
        name: 'profile',
        path: '/profile',
        component: Profile
    },
    {
        name: 'profile_user',
        path: '/profile/:id',
        component: Profile
    },
    {
        name: 'admin',
        path: '/admin',
        component: Admin,
        beforeEnter: checkAdmin
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    }
];
