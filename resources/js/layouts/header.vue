<template>
<div class="flex-col">
    <header class="bg-red-400  h-24 sm:h-32 flex items-center z-30 w-full">
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
                    <button class="py-2 px-6 flex relative ml-6">
                        <i @click="afficheNotif()" class="fas fa-bell fa-lg text-gray-800 dark:text-white"></i>
                        <span class="text-center h-7 w-7 ml-3 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ notification}}</span>
                    </button>                  
                </nav>
            </div>
        </div>
    </header>
                    <!-- notifications-->
              <div class="absolute top-0 right-0 mr-6 mt-24">
                <div class='flex flex-col gap-3 bg-red-200 border p-2 border-gray-500 shadow-lg w-96 rounded-lg'>
                  <div class="relative border  rounded-lg bg-white  shadow-lg border-gray-400">
                            <button onClick='return this.parentNode.remove()'
                              class="absolute p-1 bg-gray-100 border border-gray-300 rounded-full -top-1 -right-1"
                            >
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-3 h-3"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                              >
                                <path
                                  fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"
                                />
                              </svg>
                            </button>
                          
                            <div class="flex items-center p-4">
                              <img
                                class="object-cover w-12 h-12 rounded-lg"
                                src="https://randomuser.me/api/portraits/women/71.jpg"
                                alt=""
                              />
                          
                              <div class="ml-3 overflow-hidden">
                                <p class="font-medium text-gray-900">Jan Doe</p>
                                <p class="max-w-xs text-sm text-gray-500 truncate">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet,
                                  laborum?
                                </p>
                              </div>
                            </div>
                  </div>   
                </div>
              </div>
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

  async  function afficheNotif(){
       let n=notification.value+1;
       notification.value=n;
  }
  
  onMounted(getNombreProduitsDansPanier);
  </script>
  
  
  