import './bootstrap';
import {createApp} from "vue";
import {createPinia} from 'pinia';
import App from './vue/App.vue';
import router from './vue/router.js';

const app = createApp(App);
const pinia = createPinia();

app.use(router);
app.use(pinia);

app.config.globalProperties.$isLoggedIn = window.isLoggedIn;
app.config.globalProperties.$appConfig = window.appConfig;

app.mount('#app');
