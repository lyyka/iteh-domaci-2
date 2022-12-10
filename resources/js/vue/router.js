import * as VueRouter from 'vue-router';
import Home from '@/vue/pages/Home.vue';
import LogIn from '@/vue/pages/LogIn.vue';
import Register from '@/vue/pages/Register.vue';
import Dashboard from '@/vue/pages/Dashboard.vue';
import Account from '@/vue/pages/Account.vue';
import UserProfile from '@/vue/pages/UserProfile.vue';
import {useUserStore} from "@/stores/UserStore";

const routes = [
    {path: '/', name: 'home', component: Home},
    {path: '/auth/login', name: 'login', component: LogIn},
    {path: '/auth/register', name: 'register', component: Register},
    {path: '/auth/dashboard', name: 'dashboard', component: Dashboard},
    {path: '/auth/account', name: 'account', component: Account},
    {path: '/:username', name: 'userProfile', component: UserProfile},
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
