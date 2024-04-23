import { createApp } from 'vue';
import router from './router.js';
import App from './layouts/App.vue';
import ToastPlugin from 'vue-toast-notification'; // Importez le plugin de toast
import 'vue-toast-notification/dist/theme-bootstrap.css';
import { createPinia } from "pinia";
import { AuthStore } from './store/AuthStore';

const pinia = createPinia();

const app = createApp(App); 

app.use(pinia);
app.use(router);
app.use(ToastPlugin); // Utilisez le plugin de toast

// Montez votre application
const vm = app.mount('#app');
