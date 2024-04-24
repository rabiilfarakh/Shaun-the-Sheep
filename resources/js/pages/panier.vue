<template>
  <div>
    <div class="h-screen bg-gray-100 pt-20">
      <h1 class="mb-10 text-center text-2xl font-bold">Panier</h1>
      <!-- Animaux dans les paniers -->
      <div v-for="animal in animauxDansPaniers" :key="animal.id" class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">
          <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
            <!-- Affichage de l'image de l'animal -->
            <img  :src="'storage/images/' + animal.image.url" alt="Image de l'animal" class="w-full rounded-lg sm:w-40" />
            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
              <div class="mt-5 sm:mt-0">
                <!-- Affichage du nom et d'autres détails de l'animal -->
                <h2 class="text-lg font-bold text-gray-900">{{ animal.categorie.name }}</h2>
                <!-- Tu peux ajouter d'autres détails de l'animal ici -->
              </div>
              <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                <div class="flex items-center border-gray-100">
                  <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"> - </span>
                  <input class="h-8 w-8 border bg-white text-center text-xs outline-none" type="number" value="1" min="1" />
                  <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"> + </span>
                </div>
                <div class="flex items-center space-x-4">
                  <!-- Affichage du prix ou d'autres informations -->
                  <p class="text-sm">{{ animal.prix }} €</p>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Sous-total -->
        <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
          <div class="mb-2 flex justify-between">
            <p class="text-gray-700">Sous-total</p>
            <p class="text-gray-700">{{ animal.prix }} €</p>
          </div>
          <!-- Tu peux ajouter d'autres détails de paiement ici -->
          <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Passer la commande</button>
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

const animauxDansPaniers = ref([]);

async function getProduct() {
  try {
    const clientInfo = await authStore.getClient(authStore.user.id);
    const id = clientInfo.clientId;
    const response = await axios.post(`/api/panier`, { id: id }, headers);
    animauxDansPaniers.value = response.data;
    console.log(animauxDansPaniers);
  } catch (error) {
    console.error('Erreur lors de la récupération des produits :', error);
  }
}

onMounted(getProduct);
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
