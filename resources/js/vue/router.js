import Home from './pages/Home.vue';
import LogIn from './pages/LogIn.vue';
import Register from './pages/Register.vue';
import Dashboard from './pages/Dashboard.vue';
import * as VueRouter from 'vue-router';
import {useUserStore} from "@/stores/UserStore";

const routes = [
    {path: '/', name: 'home', component: Home},
    {path: '/login', name: 'login', component: LogIn},
    {path: '/register', name: 'register', component: Register},
    {path: '/dashboard', name: 'dashboard', component: Dashboard},
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes
});

router.beforeEach(async (to, from) => {
    const userStore = useUserStore();
    const guestOnlyRouteNames = ['login', 'register'];
    if (
        userStore.getIsLoggedIn && guestOnlyRouteNames.includes(to.name)
    ) {
        return {name: 'dashboard'}
    }
})

export default router;
