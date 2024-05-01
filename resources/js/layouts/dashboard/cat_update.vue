<template>
    <div class="flex h-screen">
      <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <button @click="addPop" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">   
              Ajouter Categorie
          </button>
          <table class="mt-5 w-full whitespace-no-wrap">
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
        
        <!-- Popup pour ajout de categorie -->
        <div v-if="affichePopAdd" tabindex="-1" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Ajouter la catégorie
                    </h3>
                    <button @click="closePopup()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form @submit.prevent="addCategorie" class="p-4 md:p-5" >
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="name"  v-model="categorie" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">   
                        Ajouter
                    </button>
                </form>
            </div>
        </div>
      </div> 
        <!-- Popup pour la mise à jour de la catégorie -->



      <div v-if="selectedCategory" tabindex="-1" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Modifier la catégorie
                    </h3>
                    <button @click="closePopup()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" @submit.prevent="updateCategory(selectedCategory.id)">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" name="name"  v-model="selectedCategory.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">   
                        Mettre a jour
                    </button>
                </form>
            </div>
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
      affichePopAdd: false,
      categorie: '',
      categories: [],
      selectedCategory: null,
      headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
    };
  },
  mounted() {
    this.getCategories();
  },

  methods: {
    async addCategorie() {
          try {
            const response = await axios.post(`/api/categorie`, { name: this.categorie }, { headers: this.headers });
            this.categories.push(response.data);
            this.categorie = '';
            this.affichePopAdd = false;
            Swal.fire('Succès', 'Catégorie ajoutée avec succès', 'success');
          } catch (error) {
            console.error('Erreur lors de l\'ajout de la catégorie:', error);
            Swal.fire('Erreur', 'Une erreur est survenue lors de l\'ajout de la catégorie', 'error');
          }
        },
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
    addPop(){
      this.affichePopAdd = true;
    },
    showUpdatePopup(category) {
      this.selectedCategory = { ...category };
    },
    closePopup() {
      this.affichePopAdd = false;
      this.selectedCategory = null;
    }
  }
};
</script>

