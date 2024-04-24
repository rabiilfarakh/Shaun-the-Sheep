import { createApp } from 'vue';
import router from './router.js';
import App from './layouts/App.vue';

import { createPinia } from "pinia";
import { AuthStore } from './store/AuthStore';

const pinia = createPinia();

const app = createApp(App); 

app.use(pinia);
app.use(router);
// app.use(ToastPlugin); // Utilisez le plugin de toast

// Montez votre application
const vm = app.mount('#app');
