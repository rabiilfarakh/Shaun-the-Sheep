<template>
    <div class="w-96 mx-auto">
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Ajouter Catégorie
      </h4>
      <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">  
        <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">Catégorie</span>
          <input v-model="categorie" type="text"
            class="mt-1 block w-full text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
            placeholder="Nom de catégorie" />
        </label>
        <button @click="addCategorie"
          class="mt-5 px-4 py-2 bg-blue-500 rounded-lg text-white hover:bg-blue-600 transition-colors duration-300 ease-in-out">
          Ajouter
        </button>
      </div>
    </div>
  </template>
    
    <script>
    import axios from 'axios';
    import Swal from 'sweetalert2';
  
    export default {
      data() {
        return {
          categorie: '', // Variable pour stocker le nom de la catégorie à ajouter
          categories: [], // Initialisation de la liste des catégories
          headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
        };
      },
  
      methods: {
        async addCategorie() {
          try {
            const response = await axios.post(`/api/categorie`, { name: this.categorie }, { headers: this.headers });
            this.categories.push(response.data);
            this.categorie = '';
            Swal.fire('Succès', 'Catégorie ajoutée avec succès', 'success');
          } catch (error) {
            console.error('Erreur lors de l\'ajout de la catégorie:', error);
            Swal.fire('Erreur', 'Une erreur est survenue lors de l\'ajout de la catégorie', 'error');
          }
        },
      },
    };
</script>
