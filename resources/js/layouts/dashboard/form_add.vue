<template>
    <!-- General elements -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Elements
    </h4>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <!-- Status -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Status</span>
        <div class="mt-2">
          <button 
            class="px-4 py-2 bg-gray-200 rounded-lg dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-green-500 hover:text-white"
            @click="status = 'Available'"
            :class="{ 'bg-green-500 text-white': status === 'Available' }"
          >
            Available
          </button>
          <button 
            class="px-4 py-2 ml-2 bg-gray-200 rounded-lg dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-red-500 hover:text-white"
            @click="status = 'Not Available'"
            :class="{ 'bg-red-500 text-white': status === 'Not Available' }"
          >
            Not Available
          </button>
        </div>
      </label>
  
      <!-- Ville -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Ville</span>
        <select
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        >
          <!-- Liste des villes du Maroc -->
          <option>Casablanca</option>
          <option>Rabat</option>
          <option>Marrakech</option>
          <!-- Ajoutez d'autres villes ici -->
        </select>
      </label>
  
      <!-- Catégorie -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Catégorie</span>
        <select
        v-model="selectedCategorie"
        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
      >
        <option v-for="categorie in categories" :key="categorie.id" :value="categorie.id">{{ categorie.name }}</option>
      </select>
      </label>
        
      <!-- Prix -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Prix</span>
        <div class="flex items-center">
          <input
            v-model="price"
            type="number"
            step="1" 
            class="block w-full mt-1 mr-2 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
            placeholder="Prix de l'animal en Dhs"
          />
          <button 
            class="px-2 py-1 bg-gray-200 w-8 rounded-md dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-gray-400 hover:text-white"
            @click="decrementPrice"
          >
            -
          </button>
          <button 
            class="px-2 py-1 bg-gray-200 ml-1 w-8 rounded-md dark:bg-gray-700 text-gray-800 dark:text-gray-300 transition-colors duration-300 ease-in-out hover:bg-gray-400 hover:text-white"
            @click="incrementPrice"
          >
            +
          </button>
        </div>
      </label>

    </div>
  </template>
  
  <script>
export default {
  data() {
    return {
      status: 'Available',
      price: 0 ,
      categories: [], 
      selectedCategorie: null
    };
  },

  mounted() {
    this.fetchCategories();
  },

  methods: {
    incrementPrice() {
      this.price += 100;
    },
    decrementPrice() {
      if(this.price >= 100)
        this.price -= 100; 
    },
    async fetchCategories() {
      try {
        const response = await axios.get('/api/categorie');
        console.log(response.data); 
        this.categories = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des catégories :', error);
      }
    }
  }
}


  </script>
  