<template>
  <!-- General elements -->
  <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
    Elements
  </h4>
  <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 justify-center items-center " style="width: 26rem;">
        
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple files</label>
    <input @change="handleFileUpload" accept="image/*" class="block w-96 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>

    <!-- Ville -->
    <label class="block mt-4 text-sm">
      <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu</span>
      <input v-model="lieu" type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Lieu de l'animal" />
    </label>

    <!-- Catégorie -->

    <div class="mt-4 col-span-2 sm:col-span-1">
      <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
      <select v-model="selectedCategorie" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-96 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="">Select category</option>
        <option v-for="categorie in categories" :key="categorie.id" :value="categorie.id">{{ categorie.name }}</option>
      </select>
    </div>

    <!-- Prix -->

    <div class="mt-4 col-span-2 sm:col-span-1">
        <label for="prix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
        <input  v-model="prix" type="number" name="prix" id="prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-96 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="2999DH" required="">
    </div>
    <button  @click="submitForm"
      class="mt-4 px-4 py-2 bg-blue-500 rounded-lg text-white hover:bg-blue-600 transition-colors duration-300 ease-in-out">
      Soumettre
    </button>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      status: true,
      prix: 0,
      categories: [],
      selectedCategorie: 'defaultCategoryId',
      image: null,
      lieu: '',
      headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
    };
  },

  mounted() {
    this.fetchCategories();
  },

  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('/api/categorie',{ headers: this.headers });
        console.log(response.data);
        this.categories = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des catégories :', error);
      }
    },

    handleFileUpload(event) {
      this.image = event.target.files[0];
      console.log('Image uploaded:', this.image);
    },

    async submitForm() {

      const formData = new FormData();
      formData.append('status', this.status === true ? true : false);
      formData.append('prix', this.prix);
      formData.append('categorie_id', this.selectedCategorie);
      formData.append('image', this.image);
      formData.append('lieu', this.lieu);

      try {
        const response = await axios.post('/api/animal', formData, {
          headers: this.headers,
        });

        await Swal.fire({
          icon: 'success',
          title: 'Succès!',
          text: 'Animal ajouté avec succès!',
          showConfirmButton: false,
          timer: 2000 
        });

        this.status = true;
        this.prix = 0;
        this.selectedCategorie = 'defaultCategoryId';
        this.image = null;
        this.lieu = '';

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