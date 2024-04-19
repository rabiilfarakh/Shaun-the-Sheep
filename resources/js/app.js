import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import App from './layouts/App.vue';
import ToastPlugin from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import { createPinia } from "pinia";
import { AuthStore } from './store/AuthStore';

const pinia = createPinia();


const app = createApp(App); 

app.use(pinia);
app.use(router);
app.use(ToastPlugin);

app.mount('#app');



const userStore = AuthStore()