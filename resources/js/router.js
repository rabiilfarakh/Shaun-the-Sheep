import { createRouter, createWebHistory } from 'vue-router';
import dashboard from './pages/dashboard.vue';
import index from './pages/index.vue';
import login from './pages/login.vue';
import blog from './pages/blog.vue';
import product from './pages/product.vue';
import register from './pages/register.vue';
import contact from './pages/contact.vue';
import service from './pages/service.vue';

const routes = [
  {
    path: '/dashboard',
    component: dashboard
  },
  {
    path: '/index',
    component: index
  },
  {
    path: '/blog',
    component: blog
  },
  {
    path: '/product',
    component: product
  },
  {
    path: '/index',
    component: index
  },
  {
    path: '/login',
    component: login
  },
  {
    path: '/register',
    component: register
  },
  {
    path: '/contact',
    component: contact
  },
  {
    path: '/service',
    component: service
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
