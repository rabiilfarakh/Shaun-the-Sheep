import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import App from './layouts/App.vue';
import ToastPlugin from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';

const app = createApp(App); 

app.use(router);
app.use(ToastPlugin);

app.mount('#app');
