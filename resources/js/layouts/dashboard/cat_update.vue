<template>
    <div class="flex h-screen">
      <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nom</th>
                <th class="px-6 py-3">Delete</th>
                <th class="px-6 py-3">Update</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              <tr v-for="category in categories" :key="category.id" class="text-gray-700 dark:text-gray-400">
                <td class="px-6 py-4">{{ category.id }}</td>
                <td class="px-6 py-4">{{ category.name }}</td>
                <td class="px-6 py-4">
                  <!-- Icône pour supprimer -->
                  <button @click="deleteCategory(category.id)" class="mr-2">
                      <ion-icon name="trash-outline" class="text-red-500 text-xl"></ion-icon>
                  </button>
                </td>
                <td class="px-6 py-4">
                  <!-- Icône pour modifier -->
                  <button @click="showUpdatePopup(category)">
                      <ion-icon name="create-outline" class="text-blue-500 text-xl"></ion-icon>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Popup pour la mise à jour de la catégorie -->
        <div v-if="selectedCategory" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-75">
          <div class="bg-white p-8 rounded-lg shadow-xl w-96">
            <h2 class="text-lg font-semibold mb-4">Modifier la catégorie</h2>
            <form @submit.prevent="updateCategory(selectedCategory.id)">
              <!-- Champ pour le nom -->
              <div class="mb-4">
                <label for="name" class="block mb-2">Nom</label>
                <input type="text" v-model="selectedCategory.name" id="name" class="w-full border-gray-300 rounded-md">
              </div>
              <!-- Bouton de soumission -->
              <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Mettre à jour</button>
              <!-- Bouton pour annuler -->
              <button @click="closePopup" class="bg-gray-300 text-gray-700 ml-2 px-4 py-2 rounded-md">Annuler</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
  
  
<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      categories: [],
      selectedCategory: null,
      headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
    };
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    async getCategories() {
      try {
        const res = await axios.get(`/api/categorie`, { headers: this.headers });
         this.categories = res.data;
      } catch (error) {
        console.error(error);
        Swal.fire('Erreur', 'Une erreur est survenue lors de la récupération des catégories', 'error');
      }
    },
    async updateCategory(id) {
      try {
        const res = await axios.put(`/api/categorie/${id}`, this.selectedCategory, { headers: this.headers });
        this.getCategories();
        this.closePopup();
        Swal.fire('Succès', 'Catégorie mise à jour avec succès', 'success');
      } catch (error) {
        console.error('Une erreur est survenue lors de la mise à jour de la catégorie:', error);
        // Afficher un message d'erreur à l'utilisateur en cas d'échec de la mise à jour de la catégorie
        Swal.fire('Erreur', 'Une erreur est survenue lors de la mise à jour de la catégorie', 'error');
      }
    },
    async deleteCategory(id) {
      try {
        const res = await axios.delete(`/api/categorie/${id}`, { headers: this.headers });
        this.getCategories();
        Swal.fire('Succès', 'Catégorie supprimée avec succès', 'success');
      } catch (error) {
        console.error('Une erreur est survenue lors de la suppression de la catégorie:', error);
        // Afficher un message d'erreur à l'utilisateur en cas d'échec de la suppression de la catégorie
        Swal.fire('Erreur', 'Une erreur est survenue lors de la suppression de la catégorie', 'error');
      }
    },
    showUpdatePopup(category) {
      this.selectedCategory = { ...category };
    },
    closePopup() {
      this.selectedCategory = null;
    }
  }
};
</script>

