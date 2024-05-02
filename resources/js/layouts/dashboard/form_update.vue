<template>
  <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <button v-if="popupAjoutVisible" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">   
                        Ajouter Animal
      </button>
      <table class="mt-6 w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-6 py-3">Image</th>
            <th class="px-6 py-3">Lieu</th>
            <th class="px-6 py-3">Catégorie</th>
            <th class="px-6 py-3">Prix</th>
            <th class="px-6 py-3">Delete</th>
            <th class="px-6 py-3">Update</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <!-- Boucle sur les animaux paginés -->
          <tr v-for="animal in animaux.data" :key="animal.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-6 py-4">
              <div class="flex items-center">
                <div class="h-12 w-12 flex items-center justify-center bg-gray-200 rounded-full overflow-hidden">
                  <img v-if="animal.image" :src="'../storage/images/' + animal.image.url" alt="Product" class="h-full w-full object-cover rounded-full" />
                </div>
              </div>
            </td>
            <td class="px-6 py-4">{{ animal.lieu }}</td>
            <td class="px-6 py-4">{{ animal.categorie.name }}</td>
            <td class="px-6 py-4">{{ animal.prix }}</td>
            <td class="px-6 py-4">
              <!-- Bouton Supprimer -->
              <button @click="supprimerAnimal(animal.id)" class="mr-2">
                <ion-icon name="trash-outline" class="text-red-500 text-xl"></ion-icon>
              </button>
            </td>
            <td class="px-6 py-4">
              <!-- Bouton Modifier -->
              <button @click="showUpdatePopup(animal.id)">
                <ion-icon name="create-outline" class="text-blue-500 text-xl"></ion-icon>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Pagination -->
    <div class="flex justify-end mt-4">
      <button @click="prevPage" :disabled="animaux.current_page === 1" class="px-3 py-1 mr-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Précédent</button>
      <div class="flex items-center space-x-4">
        <!-- Affichage des boutons de page -->
        <button v-for="page in totalPages" :key="page" @click="fetchPage(page)" :class="['px-3 py-1 bg-gray-200 text-gray-700 rounded-md cursor-pointer', { 'bg-blue-500 text-white': page === animaux.current_page }]">{{ page }}</button>
      </div>
      <button @click="nextPage" :disabled="animaux.current_page === animaux.last_page" class="px-3 py-1 ml-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Suivant</button>
    </div>
    <!-- Popup pour la mise à jour de l'animal -->
    <div v-if="animalSelectionne" tabindex="-1" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Modifier l'animal
                    </h3>
                    <button @click="fermerPopup()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" @submit.prevent="updateAnimal">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu</label>
                            <input type="text" name="name"  v-model="animalSelectionne.lieu" id="lieu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                            <input type="number" name="prix"  v-model="animalSelectionne.prix" id="prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catégories</label>
                            <select v-model="animalSelectionne.categorie_id" id="categorie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select category</option>
                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">   
                        Mettre à jour
                    </button>
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
      animaux: [],
      popupAjoutVisible: null,
      animalSelectionne: null,
      categories: [],
      headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
    };
  },
  mounted() {
    this.recupererAnimaux();
    this.recupererCategories(); 
  },
  methods: {
    async recupererCategories() {
      try {
        const reponse = await axios.get('/api/categorie', { headers: this.headers });
        this.categories = reponse.data;
      } catch (erreur) {
        console.error('Erreur lors de la récupération des catégories:', erreur);
      }
    },

    async recupererAnimaux() {
      try { 
        const reponse = await axios.get('/api/getAnimals', { headers: this.headers });
        this.animaux = reponse.data;
        console.log(reponse);
      } catch (erreur) {
        console.error('Erreur lors de la récupération des données des animaux:', erreur);
      }
    },
    async supprimerAnimal(idAnimal) {
      try {
        await axios.delete(`/api/animal/${idAnimal}`, { headers: this.headers });

        await Swal.fire({
          icon: 'success',
          title: 'Succès!',
          text: 'Animal supprimé avec succès!',
          showConfirmButton: false,
          timer: 2000 
        });
        this.recupererAnimaux();
      } catch (erreur) {
        console.error('Erreur lors de la suppression de l\'animal:', erreur);
      }
    },
    async updateAnimal() {
      try {
        await axios.put(`/api/animal/${this.animalSelectionne.id}`, this.animalSelectionne, { headers: this.headers });
        await Swal.fire({
          icon: 'success',
          title: 'Succès!',
          text: 'Animal mis à jour avec succès!',
          showConfirmButton: false,
          timer: 2000
        });
        this.animalSelectionne = null; 
        this.recupererAnimaux();
      } catch (erreur) {
        console.error('Erreur lors de la mise à jour de l\'animal:', erreur);
      }
    },
    showUpdatePopup(idAnimal) {
      axios.get(`/api/getAnimal/${idAnimal}`, { headers: this.headers })
        .then(reponse => {
          this.animalSelectionne = reponse.data;
        })
        .catch(erreur => {
          console.error('Erreur lors de la récupération des détails de l\'animal:', erreur);
        });
    },
    fermerPopup() {
      this.animalSelectionne = null;
    },

    async nextPage() {
      if (this.animaux.current_page < this.animaux.last_page) {
        const page = this.animaux.current_page + 1;
        await this.fetchPage(page);
      }
    }

  },
  computed: {
    totalPages() {
      return this.animaux.last_page ? Array.from({ length: this.animaux.last_page }, (_, i) => i + 1) : [];
    }
  }
};
</script>

