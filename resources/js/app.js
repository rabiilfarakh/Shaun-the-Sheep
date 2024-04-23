// Importez le plugin
import { createApp } from 'vue';
import router from './router.js';
import App from './layouts/App.vue';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import { createPinia } from "pinia";
import { AuthStore } from './store/AuthStore';

const pinia = createPinia();

const app = createApp(App); 

app.use(pinia);
app.use(router);
app.use(ToastPlugin);

// Montez votre application
const vm = app.mount('#app');

// Utilisez le plugin toast dans votre composant
// Par exemple, pour afficher un toast success
vm.$toast.success('Votre message de succès ici !');
