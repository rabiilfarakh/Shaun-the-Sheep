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
    component: dashboardIndex,
    meta: { requiresAuth: true } 
  },
  {
    path: '/dashboard/animal_add',
    component: animal_add,
    meta: { requiresAuth: true } 
  },
  {
    path: '/dashboard/animal_update',
    component: animal_update,
    meta: { requiresAuth: true } 
  },
  // --------------------------fin---------------------------------
  {
    path: '/index',
    component: index,
    meta: { requiresAuth: false } 
  },
  {
    path: '/blog',
    component: blog,
    meta: { requiresAuth: false } 
  },
  {
    path: '/product',
    component: product,
    meta: { requiresAuth: true } 
  },
  {
    path: '/login',
    component: login,
    meta: { requiresAuth: false } 
  },
  {
    path: '/register',
    component: register,
    meta: { requiresAuth: false } 
  },
  {
    path: '/contact',
    component: contact,
    meta: { requiresAuth: false } 
  },
  {
    path: '/service',
    component: service,
    meta: { requiresAuth: true } 
  },
  {
    path: '/panier',
    component: panier,
    meta: { requiresAuth: true } 
  },
  {
    path: '/blog/:id/animal',
    component: animal,
    meta: { requiresAuth: false } 
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token');
  
  console.log('Token :', isAuthenticated);

  if (!isAuthenticated && to.meta.requiresAuth) {
    console.log("Vous n'êtes pas connecté");
    next('/login');
  } else {
    console.log('Autorisation d\'accéder à la route.');
    next(); 
  }
});

export default router;
