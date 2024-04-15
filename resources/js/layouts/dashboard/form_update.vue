<template>
  <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-6 py-3">Image</th>
            <th class="px-6 py-3">Lieu</th>
            <th class="px-6 py-3">Catégorie</th>
            <th class="px-6 py-3"></th>

          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="animal in animals" :key="animal.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-6 py-4">{{ animal.id }}</td>
            <td class="px-6 py-4">{{ animal.lieu }}</td>
            <td class="px-6 py-4">{{ animal.categorie.name }}</td>
            <td class="px-6 py-4">
              
              <!-- Utilisation d'une condition pour afficher un switch button -->
              <label class="switch">
                <input type="checkbox" v-model="animal.status" @change="toggleStatus(animal)">
                <span class="slider"></span>
              </label>
            </td>


          </tr>
        </tbody>
      </table>
    </div>
    <!-- Pagination et autres éléments -->
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
    this.fetchClients();
  },
  methods: {
    async fetchClients() {
      try { 
        const response = await axios.get('/api/getAnimals');
        this.animals = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des données des animals:', error);
      }
    },

    async toggleStatus(animal) {
    try {
    

      await axios.put(`/api/animal/${animal.id}`, { status: animal.status });
      this.fetchClients()
     
    } catch (error) {
      console.error('Erreur lors de la mise à jour du statut du animal:', error);
      
    }
  },

  },
};
</script>

<style>
/* Styles pour le switch button */
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #4CAF50;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}
</style>
