<template>
  <!-- General elements -->
  <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    Elements
  </h4>
  <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <label class="block mt-4 text-sm">
      <span class="text-gray-700 dark:text-gray-400">Image</span>
      <input type="file" @change="handleFileUpload" accept="image/*"
        class="mt-1 focus:outline-none focus:border-purple-400 focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
    </label>

    <!-- Status -->
    <label class="block mt-4 text-sm">
      <span class="text-gray-700 dark:text-gray-400">Status</span>
      <div class="mt-2">
        <button
          class="px-4 py-2 bg-gray-200 rounded-lg dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-green-500 hover:text-white"
          @click="status = true" :class="{ 'bg-green-500 text-white': status === true }">
          Available
        </button>
        <button
          class="px-4 py-2 ml-2 bg-gray-200 rounded-lg dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-red-500 hover:text-white"
          @click="status = 'false'" :class="{ 'bg-red-500 text-white': status === false }">
          Not Available
        </button>
      </div>
    </label>

    <!-- Ville -->
    <label class="block mt-4 text-sm">
      <span class="text-gray-700 dark:text-gray-400">Lieu</span>
      <input v-model="lieu" type="text"
        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
        placeholder="Lieu de l'animal" />
    </label>

    <!-- Catégorie -->
    <label class="block mt-4 text-sm">
      <span class="text-gray-700 dark:text-gray-400">Catégorie</span>
      <select v-model="selectedCategorie" block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600
        dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
        dark:focus:shadow-outline-gray class="">
        <option disabled value="">Select a category</option>
        <option v-for="categorie in categories" :key="categorie.id" :value="categorie.id">{{ categorie.name }}</option>
      </select>
    </label>

    <!-- Prix -->
    <label class="block mt-4 text-sm">
      <span class="text-gray-700 dark:text-gray-400">Prix</span>
      <div class="flex items-center">
        <input v-model="prix" type="number" step="1"
          class="block w-full mt-1 mr-2 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
          placeholder="Prix de l'animal en Dhs" />
        <button
          class="px-2 py-1 bg-gray-200 w-8 rounded-md dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-gray-400 hover:text-white"
          @click="decrementPrice">
          -
        </button>
        <button
          class="px-2 py-1 bg-gray-200 ml-1 w-8 rounded-md dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-gray-400 hover:text-white"
          @click="incrementPrice">
          +
        </button>
      </div>
    </label>
    <button @click="submitForm"
      class="px-4 py-2 bg-blue-500 rounded-lg text-white hover:bg-blue-600 transition-colors duration-300 ease-in-out">
      Soumettre
    </button>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  props: {
    animalId: {
      type: Number,
      default: null
    }
  },

  data() {
    return {
      status: true,
      prix: 0,
      categories: [],
      selectedCategorie: 'defaultCategoryId',
      image: null,
      lieu: '',
      showSuccessMessage: false 
    };
  },

  mounted() {
    this.fetchCategories();
    if (this.animalId) {
      this.fetchAnimalDetails();
    }
  },

  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('/api/categorie');
        this.categories = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des catégories :', error);
      }
    },

    async fetchAnimalDetails() {
      try {
        const response = await axios.get(`/api/animal/${this.animalId}`);
        const animal = response.data;
        // Remplir le formulaire avec les détails de l'animal
        this.status = animal.status;
        this.prix = animal.prix;
        this.selectedCategorie = animal.categorie_id;
        this.lieu = animal.lieu;
        // Notez que l'image ne peut pas être pré-remplie pour des raisons de sécurité
      } catch (error) {
        console.error('Erreur lors de la récupération des détails de l\'animal :', error);
      }
    },

    handleFileUpload(event) {
      this.image = event.target.files[0];
    },

    incrementPrice() {
      this.prix += 100;
    },

    decrementPrice() {
      if (this.prix >= 100)
        this.prix -= 100;
    },
    async submitForm() {
      const formData = new FormData();
      formData.append('status', this.status === true ? true : false);
      formData.append('prix', this.prix);
      formData.append('categorie_id', this.selectedCategorie);
      formData.append('image', this.image);
      formData.append('lieu', this.lieu);

      let url = '/api/animal';
      let successMessage = 'Animal ajouté avec succès!';

      if (this.animalId) {
        url = `/api/animal/${this.animalId}`;
        successMessage = 'Animal mis à jour avec succès!';
      }

      try {
        const response = await axios.post(url, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        await Swal.fire({
          icon: 'success',
          title: 'Succès!',
          text: successMessage,
          showConfirmButton: false,
          timer: 2000 
        });

        this.status = true;
        this.prix = 0;
        this.selectedCategorie = 'defaultCategoryId';
        this.image = null;
        this.lieu = '';
        this.showSuccessMessage = true;

        setTimeout(() => {
          this.showSuccessMessage = false;
        }, 5000); 

      } catch (error) {
        console.error('Erreur lors de la soumission du formulaire :', error);
      }
    }

  }
}
</script>

<style>
.success-message {
  background-color: #4CAF50; /* Green */
  color: white;
  padding: 10px;
  text-align: center;
}
</style>
