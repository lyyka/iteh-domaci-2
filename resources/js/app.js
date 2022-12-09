import './bootstrap';
import {createApp} from "vue";
import {createPinia} from 'pinia';
import App from './vue/App.vue';
import router from './vue/router.js';
import 'bootstrap/dist/js/bootstrap.min';
import {usePetDataStore} from './stores/PetDataStore';
import petTypesApi from './api/petType.js';
import petColorsApi from './api/petColor.js';
import {useUserStore} from "@/stores/UserStore";

const app = createApp(App);

app.use(router);
app.use(createPinia());

const userStore = useUserStore();
userStore.setIsLoggedIn(window.isLoggedIn);

const petDataStore = usePetDataStore();
petDataStore.setPetColorOptions(await petColorsApi.all());
petDataStore.setPetTypesOptions(await petTypesApi.all());

app.mount('#app');
