<template>
  <div>
    <Head />
    <Header/>
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
              <img :src="'storage/images/' + animal.url" :alt="animal.name" class="h-full object-center object-cover md:block hidden" />
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
                  <button @click="deleteProduct(animal.id)" class="text-xs leading-3 underline text-red-500 pl-5 cursor-pointer">Remove</button>
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
            <button @click="commande()" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
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


async function getProduct() {
  try {
    const clientInfo = await authStore.getClient(authStore.user.id);
    const id = clientInfo.clientId;
    const response = await axios.post(`/api/panier`, { id: id }, headers);
    animauxDansPaniers.value = response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération des produits :', error);
  }
}

async function deleteProduct(id){
  try{
    const response = await axios.delete(`/api/product/panier/${id}`, headers);
    animauxDansPaniers.value = animauxDansPaniers.value.filter(animal => animal.id !== id);
    $toast.info('Ce produit a été supprimé de votre panier avec succès.');
    console.log(response);
  } catch (erreur){
    console.error('Erreur lors de la suppression du produit :', erreur)
  }
}

async function commande(){
  try{
    const arr = animauxDansPaniers.value.map(animal => animal.id);
    const response = await axios.post(`/api/panier/commande`, { arr_id: arr }, headers);
    // console.log(response);
    
    $toast.success('Les produits ont été achetés avec succès.');
  } catch (erreur){
    console.error('Erreur lors de l\'achat des produits :', erreur);
  }
}



onMounted(getProduct);

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
