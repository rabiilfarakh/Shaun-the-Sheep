<template>
  <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-6 py-3">Image</th>
            <th class="px-6 py-3">Lieu</th>
            <th class="px-6 py-3">Catégorie</th>
            <th class="px-6 py-3">Statut</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <!-- Boucle sur les animaux paginés -->
          <tr v-for="animal in animals.data" :key="animal.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-6 py-4">
              <div class="flex items-center">
                <div class="h-12 w-12 flex items-center justify-center bg-gray-200 rounded-full overflow-hidden">
                  <img v-if="animal.image" :src="'storage/images/vache' + animal.image.url" alt="Product" class="h-full w-full object-cover rounded-full" />
                </div>
              </div>
            </td>
            <td class="px-6 py-4">{{ animal.lieu }}</td>
            <td class="px-6 py-4">{{ animal.categorie.name }}</td>
            <td class="px-6 py-4">
              <label class="switch">
                <input type="checkbox" :checked="animal.status" @change="toggleStatus(animal)">
                <span class="slider"></span>
              </label>
            </td>
            <td class="px-6 py-4">
              <button @click="deleteAnimal(animal.id)">
                <ion-icon name="trash-outline" class="text-red-500 text-xl"></ion-icon>
              </button>
              <button @click="updateAnimal(animal.id)">
                <ion-icon name="create-outline" class="text-blue-500 text-xl"></ion-icon>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Pagination -->
    <div class="flex justify-end mt-4">
      <button :disabled="animals.current_page === 1" @click="prevPage">Précédent</button>
      <div class="flex">
        <span class="mr-2">Page {{ animals.current_page }} de {{ animals.last_page }}</span>
      </div>
      <button :disabled="animals.current_page === animals.last_page" @click="nextPage">Suivant</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      animals: [],
    };
  },
  mounted() {
    this.fetchAnimals();
  },
  methods: {
    async fetchAnimals() {
      try { 
        const response = await axios.get('/api/getAnimals');
        this.animals = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des données des animaux:', error);
      }
    },
    prevPage() {
      if (this.animals.current_page > 1) {
        this.fetchPage(this.animals.current_page - 1);
      }
    },
    nextPage() {
      if (this.animals.current_page < this.animals.last_page) {
        this.fetchPage(this.animals.current_page + 1);
      }
    },
    async fetchPage(page) {
      try {
        const response = await axios.get(`/api/getAnimals?page=${page}`);
        this.animals = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des données des animaux:', error);
      }
    },
  }
};
</script>
