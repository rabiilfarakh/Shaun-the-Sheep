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
                  <img v-if="animal.image" :src="'../storage/images/' + animal.image.url" alt="Product" class="h-full w-full object-cover rounded-full" />
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
              <!-- Bouton Supprimer -->
              <button @click="deleteAnimal(animal.id)" class="mr-2">
                <ion-icon name="trash-outline" class="text-red-500 text-xl"></ion-icon>
              </button>
              <!-- Bouton Modifier -->
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
      <button @click="prevPage" :disabled="animals.current_page === 1"
        class="px-3 py-1 mr-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Précédent</button>

      <div class="flex items-center space-x-4">
        <!-- Affichage des boutons de page -->
        <button v-for="page in totalPages" :key="page" @click="fetchPage(page)"
          :class="['px-3 py-1 bg-gray-200 text-gray-700 rounded-md cursor-pointer', { 'bg-blue-500 text-white': page === animals.current_page }]">
          {{ page }}
        </button>
      </div>

      <button @click="nextPage" :disabled="animals.current_page === animals.last_page"
        class="px-3 py-1 ml-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Suivant</button>
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
    async toggleStatus(animal) {
      try {
        await axios.put(`/api/animal/${animal.id}`, { status: animal.status });
        this.fetchAnimals(this.currentPage);
      } catch (error) {
        console.error('Erreur lors de la mise à jour du statut de l\'animal:', error);
      }
    },
    async deleteAnimal(animalId) {
      try {
        await axios.delete(`/api/animal/${animalId}`);
        this.fetchAnimals(this.currentPage); 
      } catch (error) {
        console.error('Erreur lors de la suppression de l\'animal:', error);
      }
    },
    async updateAnimal(animalId) {
      //
    }
  },
  computed: {
    totalPages() {
      return this.animals.last_page ? Array.from({ length: this.animals.last_page }, (_, i) => i + 1) : [];
    }
  }
};
</script>
