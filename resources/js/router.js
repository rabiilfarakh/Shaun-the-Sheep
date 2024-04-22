import { createRouter, createWebHistory } from 'vue-router';
import { AuthStore } from "@/store/AuthStore";
//----------------- gestion_routes_dashboard--------------------
import dashboardIndex from './pages/dashboard/dashboardIndex.vue';
import animal_add from './pages/dashboard/animal_add.vue';
import animal_update from './pages/dashboard/animal_update.vue';
import categorie_add from './pages/dashboard/categorie_add.vue';
import categorie_update from './pages/dashboard/categorie_update.vue';
//-------------------------- fin--------------------------------

import index from './pages/index.vue';
import login from './pages/login.vue';
import loginA from './pages/loginA.vue';
import blog from './pages/blog.vue';
import product from './pages/product.vue';
import register from './pages/register.vue';
import contact from './pages/contact.vue';
import service from './pages/service.vue';
import panier from './pages/panier.vue';
import animal from './pages/animal.vue';
import { computed } from 'vue';



const routes = [
  //----------------- gestion_routes_dashboard--------------------
  {
    path: '/dashboard/dashboardIndex',
    component: dashboardIndex,
    meta: { requiresAuth: true , role: "admin"} 
  },
  {
    path: '/dashboard/animal_add',
    component: animal_add,
    meta: { requiresAuth: true , role: "admin"} 
  },
  {
    path: '/dashboard/animal_update',
    component: animal_update,
    meta: { requiresAuth: true , role: "admin"} 
  },

  {
    path: '/dashboard/categorie_add',
    component: categorie_add,
    meta: { requiresAuth: true , role: "admin"} 
  },
  {
    path: '/dashboard/categorie_update',
    component: categorie_update,
    meta: { requiresAuth: true , role: "admin"} 
  },
  // --------------------------fin---------------------------------
  {
    path: '/index',
    component: index,
    meta: { requiresAuth: true, role: "client" }
  },
  {
    path: '/blog',
    component: blog,
    meta: { requiresAuth: true , role: "client"} 
  },
  {
    path: '/product',
    component: product,
    meta: { requiresAuth: true , role: "client"} 
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
    meta: { requiresAuth: true , role: "client"} 
  },
  {
    path: '/service',
    component: service,
    meta: { requiresAuth: true , role: "client"} 
  },
  {
    path: '/panier',
    component: panier,
    meta: { requiresAuth: true , role: "client"} 
  },
  {
    path: '/blog/:id/animal',
    component: animal,
    meta: { requiresAuth: true , role: "client"} 
  },

  {
    path: '/logout',
    name: 'logout',
    meta: { requiresAuth: true },
    beforeEnter: (to, from, next) => {
      localStorage.removeItem('token');
      next('/login');
    }
  }
];


const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach(async (to, from, next) => {
  const isAuthenticated = localStorage.getItem('token');
  console.log('Token:', isAuthenticated);

  // Access the AuthStore instance
  const authStore = AuthStore();

  // Call fetchUserData to get the user data
  await authStore.fetchUserData();

  // Access the user data using the user property
  const user = authStore.user;

  console.log('User:', user.role);

  if (to.meta.requiresAuth) {
    if (!isAuthenticated || !user) {
 
      next("/login");
    } else if (to.meta.role && user.role !== to.meta.role) {
    
      next("/unauthorized");
    } else {
    
      next();
    }
  } else {
    
    next();
  }
});

export default router;
