<template>
    <div>
      <header class="h-24 sm:h-32 flex items-center z-30 w-full">
        <div class="container mx-auto px-6 flex items-center justify-between">
          <router-link class="text-gray-800 dark:text-white font-black text-3xl" to="/">
            Farm<span class="text-3xl text-gray-600">Con</span>  
          </router-link>
          <div class="flex items-center">
            <nav class="font-sen text-gray-800 dark:text-white uppercase text-lg lg:flex items-center hidden">
              <router-link to="/index" class="py-2 px-6 flex">
                Home
              </router-link>
              <router-link to="/blog" class="py-2 px-6 flex">
                Blog
              </router-link>
              <router-link to="/product" class="py-2 px-6 flex">
                Product
              </router-link>
              <router-link to="/service" class="py-2 px-6 flex">
                Services
              </router-link>
              <router-link to="/contact" class="py-2 px-6 flex">
                Contact
              </router-link>
              <router-link to="/panier" class="py-2 px-6 flex relative">
                <i class="fas fa-shopping-cart fa-lg mr-1"></i>
                <span v-if="nombreProduitsDansPanier > 0" class="text-center h-7 w-7 ml-4 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ nombreProduitsDansPanier }}</span>
                <span v-if="nombreProduitsDansPanier < 1" class="text-center h-7 w-7 ml-4 font-semibold rounded-full absolute -top-3 "></span>
              </router-link>
              <router-link to="/panier" class="py-2 px-6 flex relative ml-6">
                <i class="fas fa-bell fa-lg text-gray-800 dark:text-white"></i>
                <span class="text-center h-7 w-7 ml-3 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ notification}}</span>
              </router-link>
            </nav>
            <button class="lg:hidden flex flex-col ml-4">
              <span class="w-6 h-1 bg-gray-800 dark:bg-white mb-1">
              </span>
              <span class="w-6 h-1 bg-gray-800 dark:bg-white mb-1">
              </span>
              <span class="w-6 h-1 bg-gray-800 dark:bg-white mb-1">
              </span>
            </button>
          </div>
        </div>
      </header>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import Product from "../pages/product.vue";
  import { ref, onMounted } from 'vue';
  import { AuthStore } from '../store/AuthStore';
  const authStore = AuthStore();
  const token = localStorage.getItem('token');
  const headers = { headers: { 'Authorization': `Bearer ${token}` } };
  
  const nombreProduitsDansPanier = ref(0);
  const notification = ref(0);
  async function getNombreProduitsDansPanier() {
      try {
          const clientInfo = await authStore.getClient(authStore.user.id);
          const id = clientInfo.clientId;
          const response = await axios.post(`/api/panier`, { id: id }, headers);
          nombreProduitsDansPanier.value = response.data.length;
      } catch (error) {
          console.error('Erreur lors de la récupération des produits :', error);
      }
  }
  
  onMounted(getNombreProduitsDansPanier);
  </script>
  
  
  