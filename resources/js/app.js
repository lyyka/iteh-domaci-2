import './bootstrap';
import {createApp} from "vue";
import {createPinia} from 'pinia';
import App from './vue/App.vue';
import router from './vue/router.js';
import 'bootstrap/dist/js/bootstrap.min';
import {usePetDataStore} from './stores/PetDataStore';
import petTypesApi from './api/petType.js';
import petColorsApi from './api/petColor.js';

const app = createApp(App);
const pinia = createPinia();

app.use(router);
app.use(pinia);

app.config.globalProperties.$isLoggedIn = window.isLoggedIn;
app.config.globalProperties.$appConfig = window.appConfig;

const petDataStore = usePetDataStore();
petDataStore.setPetColorOptions(await petColorsApi.all());
petDataStore.setPetTypesOptions(await petTypesApi.all());

app.mount('#app');
