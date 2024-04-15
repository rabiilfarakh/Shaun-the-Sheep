import { createRouter, createWebHistory } from 'vue-router';

//----------------- gestion_routes_dashboard--------------------
import dashboardIndex from './pages/dashboard/dashboardIndex.vue';
import animal_add from './pages/dashboard/animal_add.vue';
import animal_update from './pages/dashboard/animal_update.vue';
//-------------------------- fin--------------------------------

import index from './pages/index.vue';
import login from './pages/login.vue';
import blog from './pages/blog.vue';
import product from './pages/product.vue';
import register from './pages/register.vue';
import contact from './pages/contact.vue';
import service from './pages/service.vue';
import panier from './pages/panier.vue';
import animal from './pages/animal.vue';

const routes = [

  //----------------- gestion_routes_dashboard--------------------
  {
    path: '/dashboard/dashboardIndex',
    component: dashboardIndex
  },
  {
    path: '/dashboard/animal_add',
    component: animal_add
  },
  {
    path: '/dashboard/animal_update',
    component: animal_update
  },
  // --------------------------fin---------------------------------

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
  {
    path: '/panier',
    component: panier
  },
  {
    path: '/animal',
    component: animal
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
