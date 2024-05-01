<template>

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
            <span class="text-center h-7 w-7 ml-3 bg-red-500 text-white font-semibold rounded-full absolute -top-3 ">{{ nombreNotifs}}</span>
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

    <div class="mx-auto container px-6 xl:px-0 py-12">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
        <div class="flex flex-col">
            <div class="flex flex-col justify-center">
                <div class="relative flex justify-center">
                    <!-- <img class=" hidden sm:block w-96 " src="storage/images/aya.jpg" alt="sofa"/> -->
                    <!-- <img class="sm:hidden w-full "
                        src="https://i.ibb.co/B6qwqPT/jason-wang-Nx-Awry-Abt-Iw-unsplash-1.png" alt="sofa" /> -->
                <div
                        class="absolute sm:bottom-8 bottom-4 pr-10 sm:pr-0 left-4 sm:left-8 flex justify-start items-start">
            </div>
        </div>
    </div>
            <form
                class="mt-10 w-full mx-auto max-w-xl py-2 px-6 rounded-full bg-gray-50 border flex focus-within:border-gray-300">
                <input v-model="searchTerm" type="text" placeholder="Search anything"
                    class="bg-transparent w-full focus:outline-none pr-4 font-semibold border-0 focus:ring-0 px-0 py-0"
                    name="topic">
            </form>
            <!-- Grid Section - Starts Here  -->
            <section id="Projects"
                class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-20 mb-5">

                <!-- Product card 1 - Starts Here -->
                <div v-for="animal in animals" :key="animal.id"
                    class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                    <img v-if="animal.image" :src="'storage/images/' + animal.image.url" alt="Product"
                        class="h-80 w-72 object-cover rounded-t-xl" />

                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">{{ animal.prix }}DH</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">{{ animal.prix + animal.prix * 20 / 100
                                    }}DH</p>
                            </del>
                            <button @click="addProduct(animal.id)" class="ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <button @click="fetchAnimals(currentPage - 1)" :disabled="currentPage === 1"
                    class="px-3 py-1 mr-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Previous</button>

                <div class="flex items-center space-x-4">
                    <!-- <span class="text-gray-700">Page {{ currentPage }} of {{ totalPages }}</span> -->

                    <button v-for="page in totalPages" :key="page" @click="fetchAnimals(page)"
                        :class="['px-3 py-1 bg-gray-200 text-gray-700 rounded-md cursor-pointer', { 'bg-blue-500 text-white': page === currentPage }]">
                        {{ page }}
                    </button>
                </div>

                <button @click="fetchNextPage" :disabled="currentPage === lastPage"
                    class="px-3 py-1 ml-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Next</button>
            </div>
            <!-- credit -->
            <div class="text-center py-10 px-10">
                <h2 class="font-bold text-2xl md:text-4xl mb-4">Thanks to <a href="https://unsplash.com/@nixcreative"
                        class="underline font-black">Tyler Nix</a> for those AMAZING product images!</h2>
            </div>
        </div>
    </div>
    <Footer />
</template>
<script setup>
import Header from "../layouts/header.vue";
import Footer from "../layouts/footer.vue";
import Head from "../layouts/head.vue"
import axios from 'axios';
import { ref, onMounted, watch } from 'vue';
import { AuthStore } from '../store/AuthStore';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const nombreProduitsDansPanier = ref(0); 
const nombreNotifs = ref(0); 
const notifications = ref([]);


const authStore = AuthStore();
const token = localStorage.getItem('token');
const headers = { headers: { 'Authorization': `Bearer ${token}` } };

const searchTerm = ref('');
const originalAnimals = ref([]);
const animals = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);


async function getNombreProduitsDansPanier() {
    try {
        const clientInfo = await authStore.getClient(authStore.user.id);
        const id = clientInfo.clientId;
        const response = await axios.post(`/api/panier`, { id: id }, headers);
        nombreProduitsDansPanier.value = response.data.length;
        console.log('test');
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

function removeNotification(index) {
  notifications.value.splice(index, 1);
}

onMounted(fetchNotifications);

const $toast = useToast({
    position: 'top',
    duration: 1000 
});

const props = defineProps({
    getNombreProduitsDansPanier: Function 
});

const fetchAnimals = async (page = 1) => {
    try {
        await authStore.fetchUserData();
        const userId = authStore.user.id;
        const response = await axios.get('/api/animal', {
            params: { searchTerm: searchTerm.value, page: page, user_id: userId },
            headers: { 'Authorization': `Bearer ${token}` }
        });

        animals.value = response.data.data;
        currentPage.value = response.data.current_page;
        totalPages.value = response.data.last_page;
        originalAnimals.value = response.data;
    } catch (error) {
        console.error('Erreur lors de la récupération des animaux :', error);
    }
};

const fetchNextPage = async () => {
    if (currentPage.value < totalPages.value) {
        await fetchAnimals(currentPage.value + 1);
    }
};

watch(searchTerm, async (newValue) => {
    currentPage.value = 1;
    await fetchAnimals();
});

watch(currentPage, async () => {
    await fetchAnimals(currentPage.value);
});

onMounted(fetchAnimals);

const addProduct = async (animalId) => {
    try {
        const clientInfo = await authStore.getClient(authStore.user.id);
        const clientId = clientInfo.clientId;
        const exist = await product_exist(animalId);
        if(exist == 1){
            $toast.info('Animal existe dans votre panier');
        } else {
            const response = await axios.post(`api/product/panier`, { animal_id: animalId, client_id: clientId }, headers);
            $toast.success('Animal a été ajouté à votre panier avec succès.');
            await getNombreProduitsDansPanier();
        }
    } catch (error) {
        console.error('Une erreur s\'est produite lors de l\'ajout du produit au panier :', error);
    }
};

const product_exist = async (animalId) => {
    try {
        const clientInfo = await authStore.getClient(authStore.user.id);
        const clientId = clientInfo.clientId;
        const response = await axios.post(`api/product/panier_exist`, { animal_id: animalId, client_id: clientId }, headers);
        return response.data;
    } catch (error) {
        console.error('Une erreur s\'est produite lors de la vérification de l\'existence du produit dans le panier :', error);
    }
}

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







