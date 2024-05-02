<template>
  <div>
    <Head />
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


    <div class="container mx-auto mt-10">
      <div class="sm:flex shadow-md my-10">
        <div class="w-full sm:w-3/4 bg-white px-10 py-10">
          <div class="flex justify-between border-b pb-8">
            <h1 class="font-semibold text-2xl">Shopping Cart</h1>
            <h2 class="font-semibold text-2xl">{{ animauxDansPaniers.length }} Items</h2>
          </div>

          <!-- Affichage des animaux dans le panier -->
          <div v-for="animal in animauxDansPaniers" :key="animal.id" class="md:flex items-stretch py-8 md:py-10 lg:py-8 border-t border-gray-50">
            <div class="md:w-4/12 2xl:w-1/4 w-full">
              <!-- Image de l'animal -->
              <img :src="'storage/images/' + animal.url" :alt="animal.name" class="h-36 w-44 object-center object-cover md:block" />

            </div>
            <div class="md:pl-3 md:w-8/12 2xl:w-3/4 flex flex-col justify-center">
              <p class="text-xs leading-3 text-gray-800 md:pt-0 pt-4"></p>
              <div class="flex items-center justify-between w-full">
                <p class="text-base font-black leading-none text-gray-800">{{ animal.name }}</p>
              </div>
              <p class="text-xs leading-3 text-black pt-2">Catégorie: <span class="text-gray-500">{{ animal.name }}</span></p>
              <p class="mt-2 w-96 text-xs leading-3 text-black">Lieu: <span class="text-gray-500">{{ animal.lieu }}</span></p>
              <div class="flex items-center justify-between pt-5">
                <div class="flex items-center">
                  <button @click="deleteProduct(animal.id,animal.animal_id)" class="text-xs leading-3 underline text-red-500 pl-5 cursor-pointer">Remove</button>
                </div>
                <p class="text-base font-black leading-none text-gray-800">{{ animal.prix }}.00 DH</p>
              </div>
            </div>
          </div>

          <router-link to ="/product" class="flex font-semibold text-indigo-600 text-sm mt-10">
            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
              <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
            </svg>
            Continue Shopping
          </router-link>
        </div>

        <!-- Résumé de la commande -->
        <div id="summary" class="w-full sm:w-1/4 md:w-1/2 px-8 py-10">
          <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
          <div class="flex justify-between mt-10 mb-5">
            <span class="font-semibold text-sm uppercase">Items {{ animauxDansPaniers.length }}</span>
            <span class="font-semibold text-sm">{{ total }}.00 DH</span>
          </div>
          <div>
            <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
            <select class="block p-2 text-gray-600 w-full text-sm">
              <option>Standard shipping - 50.00 DH</option>
            </select>
          </div>

          <div class="border-t mt-8">
            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
              <span>Total cost</span>
              <span>{{ total }}.00 DH</span>
            </div>
            <button  @click="commande()" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
          </div>
        </div>
      </div>
    </div>


    <Footer/>
  </div>
</template>

<script setup>

import axios from 'axios';
import Head from "../layouts/head.vue";
import Header from "../layouts/header.vue";
import Footer from "../layouts/footer.vue";
import { ref, onMounted, computed } from 'vue';
import { AuthStore } from '../store/AuthStore';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const $toast = useToast({
    position: 'top',
    duration: 1000 
});

const authStore = AuthStore();
const token = localStorage.getItem('token');
const headers = { headers: { 'Authorization': `Bearer ${token}` } };
const animauxDansPaniers = ref([]);
const nombreProduitsDansPanier = ref(0); 
const nombreNotifs = ref(0); 
const notifications = ref([]);

async function getProduct() {
  try {
    const clientInfo = await authStore.getClient(authStore.user.id);
    const id = clientInfo.clientId;
    const response = await axios.post(`/api/panier`, { id: id }, headers);
    animauxDansPaniers.value = response.data;
    console.log(animauxDansPaniers.value);
  } catch (error) {
    console.error('Erreur lors de la récupération des produits :', error);
  }
}

async function deleteProduct(idPanier,idAnimal){
  try{
    const response = await axios.post(`/api/product/panier/deleteA`,{idPanier:idPanier,idAnimal:idAnimal}, headers);
    // animauxDansPaniers.value = animauxDansPaniers.value.filter(animal => animal.id !== id);
    $toast.info('Ce produit a été supprimé de votre panier avec succès.');
    getProduct();
    console.log(response);
  } catch (erreur){
    console.error('Erreur lors de la suppression du produit :', erreur)
  }
}

async function commande(){
  try{
    const clientInfo = await authStore.getClient(authStore.user.id);
    const id = clientInfo.clientId;
    const arr = animauxDansPaniers.value[0].id;
    const response = await axios.post(`/api/panier/commande`, { arr_id: arr ,client_id:id}, headers);
    console.log(response);    
    $toast.success('Les produits ont été achetés avec succès.');
    getProduct();
    getNombreProduitsDansPanier();
    afficheNotif();
  } catch (erreur){
    console.error('Erreur lors de l\'achat des produits :', erreur);
  }
}

onMounted(getProduct);

//header

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

//

// Calcul du total en additionnant les prix de tous les animaux
const total = computed(() => {
  return animauxDansPaniers.value.reduce((sum, animal) => sum + animal.prix+50, 0);
});

</script>

<style scoped>
@layer utilities {
  input[type="number"]::-webkit-inner-spin-button,
  input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
}


</style>

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