<template>
  <div class="flex-col">
    <header class="h-24 sm:h-32 flex items-center z-30 w-full">
      <div class="container mx-auto px-6 flex items-center justify-between">
        <router-link class="text-gray-800 dark:text-white font-black text-3xl" to="/">
          Farm<span class="text-3xl text-gray-600">Con</span>  
        </router-link>
        <!-- Menu pour les écrans larges -->
        <nav class="font-sen text-gray-800 dark:text-white uppercase text-lg lg:flex items-center hidden">
          <router-link to="/index" class="py-2 px-6 flex">Home</router-link>
          <router-link to="/blog" class="py-2 px-6 flex">Blog</router-link>
          <router-link to="/product" class="py-2 px-6 flex">Product</router-link>
          <router-link to="/service" class="py-2 px-6 flex">Services</router-link>
          <router-link to="/contact" class="py-2 px-6 flex">Contact</router-link>
          <router-link to="/panier" class="py-2 px-6 flex relative">
            <i class="fas fa-shopping-cart fa-lg mr-1"></i>
            <span v-if="nombreProduitsDansPanier > 0" class="text-center h-7 w-7 ml-4 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ nombreProduitsDansPanier }}</span>
            <span v-if="nombreProduitsDansPanier < 1" class="text-center h-7 w-7 ml-4 font-semibold rounded-full absolute -top-3 "></span>
          </router-link>
          <button class="py-2 px-6 flex relative ml-6">
            <i @click="afficheNotif()" class="fas fa-bell fa-lg text-gray-800 dark:text-white"></i>
            <span v-if="nombreNotifs > 0" class="text-center h-7 w-7 ml-3 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ nombreNotifs}}</span>
            <span v-if="nombreNotifs < 1" class="text-center h-7 w-7 ml-3  text-white font-semibold rounded-full absolute -top-3 ">{{ nombreNotifs}}</span>
          </button>      
          
          
        </nav>
        <router-link to="/logout" class="text-sm border-b border-gray-500">Logout</router-link>

        <!-- Bouton de menu pour les écrans petits -->
        <button class="lg:hidden flex items-center" @click="toggleMenu">
          <svg class="h-6 w-6 fill-current text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path v-if="!showMenu" fill-rule="evenodd" clip-rule="evenodd" d="M2 5h20a1 1 0 100-2H2a1 1 0 100 2zM2 11h20a1 1 0 100-2H2a1 1 0 100 2zM2 17h20a1 1 0 100-2H2a1 1 0 100 2z"></path>
            <path v-else fill-rule="evenodd" clip-rule="evenodd" d="M21 5H3a1 1 0 00-1 1v1a1 1 0 001 1h18a1 1 0 00-1-1V6a1 1 0 001-1zm0 6H3a1 1 0 00-1 1v1a1 1 0 001 1h18a1 1 0 00-1-1v-1a1 1 0 001-1zm0 6H3a1 1 0 00-1 1v1a1 1 0 001 1h18a1 1 0 00-1-1v-1a1 1 0 001-1z"></path>
          </svg>
        </button>
      </div>
    </header>

    <!-- Menu pour les écrans petits -->
    <nav v-if="showMenu" class="shadow-sm font-sen text-gray-00 dark:text-white uppercase text-lg lg:hidden flex flex-col justify-center items-center h-full">
      <router-link to="/index" class="py-2 px-6 flex">Home</router-link>
      <router-link to="/blog" class="py-2 px-6 flex">Blog</router-link>
      <router-link to="/product" class="py-2 px-6 flex">Product</router-link>
      <router-link to="/service" class="py-2 px-6 flex">Services</router-link>
      <router-link to="/contact" class="py-2 px-6 flex">Contact</router-link>
      <router-link to="/panier" class="py-2 px-6 flex relative">
        <i class="fas fa-shopping-cart fa-lg mr-1 mt-3"></i>
        <span v-if="nombreProduitsDansPanier > 0" class="text-center h-7 w-7 ml-4 mt-3 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ nombreProduitsDansPanier }}</span>
        <span v-if="nombreProduitsDansPanier < 1" class="text-center h-7 w-7 ml-4 mt-3 font-semibold rounded-full absolute -top-3 "></span>
      </router-link>
      <button class="py-2 px-6 flex relative mt-4">
        <i @click="afficheNotif()" class="fas fa-bell fa-lg text-gray-800 dark:text-white"></i>
        <span class="text-center h-7 w-7 ml-3 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ nombreNotifs}}</span>
      </button>                  
    </nav>



    <!-- Notifications -->
    <div id="notifications" class="absolute top-0 right-0 mr-36 mt-24 hidden">
      <div class='flex flex-col gap-3 bg-gray-200 border p-2 border-gray-400 shadow-lg w-96 rounded-lg'>
        <!-- Loop through notifications -->
        <div v-for="(notification, index) in notifications" :key="index" class="relative border rounded-lg bg-white shadow-lg border-gray-400">
          <!-- Close button -->
          <button @click="removeNotification(notification.id)" class="absolute p-1 bg-gray-100 border border-gray-300 rounded-full -top-1 -right-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </button>
          <!-- Notification content -->
          <div class="flex items-center p-4">
            <!-- Notification Avatar -->
            <img class="object-cover w-12 h-12 rounded-lg"  :src="'storage/images/' + notification.url" alt=""/>
            <!-- Notification Text -->
            <div class="ml-3 overflow-hidden">
              <!-- <p class="font-medium text-gray-900">{{ notification.categories.name }}</p> -->
              <p class="max-w-xs text-sm text-black truncate">PRIX: <span class="text-gray-400">{{ notification.prix }}DH</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



  
<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { AuthStore } from '../store/AuthStore';


const authStore = AuthStore();
const token = localStorage.getItem('token');
const headers = { headers: { 'Authorization': `Bearer ${token}` } };
const nombreProduitsDansPanier = ref(0); 
const nombreNotifs = ref(0); 
const notifications = ref([]);

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



async function fetchNotifications() {
  try {
    const clientInfo = await authStore.getClient(authStore.user.id);
    const id = clientInfo.clientId;
    const response = await axios.post(`/api/panier/getCommande`, { client_id: id }, headers);
    getNombreProduitsDansPanier();
    notifications.value = response.data;
    nombreNotifs.value = response.data.length;
    console.log(notifications.value)
  } catch (error) {
    console.error('Error fetching notifications:', error);
  }
}

async function afficheNotif() {
  const notifs = document.getElementById("notifications");
  if (notifs.style.display === "none") {
    await fetchNotifications();
    notifs.style.display = "block";
  } else {
    notifs.style.display = "none";
  }
}

async function removeNotification(id) {
  const response = await axios.delete(`/api/panier/commande${id}`, headers);
  console.log(response);
}

onMounted(fetchNotifications);

</script>

<script>
export default {
  data() {
    return {
      showMenu: false
    };
  },
  methods: {
    toggleMenu() {
      this.showMenu = !this.showMenu;
    },
    afficheNotif() {
      //
    }
  }
};
</script>







  
  
  