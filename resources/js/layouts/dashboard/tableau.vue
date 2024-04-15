<template>
  <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-6 py-3">Id</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Actions</th> <!-- Ajout de la colonne Actions -->
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="client in clients" :key="client.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-6 py-4">{{ client.id }}</td>
            <td class="px-6 py-4">{{ client.name }}</td>
            <td class="px-6 py-4">{{ client.email }}</td>
            <td class="px-6 py-4">
              
              <!-- Utilisation d'une condition pour afficher un switch button -->
              <label class="switch">
                <input type="checkbox" v-model="client.status" @change="toggleStatus(client)">
                <span class="slider"></span>
              </label>
            </td>

            <td class="px-6 py-4">
              <!-- Ajout des icônes pour les actions -->
              <button @click="deleteClient(client.id)" class="text-red-500 hover:text-red-700">
                <!-- Icône pour la suppression -->
                <ion-icon name="trash-outline" ></ion-icon>
              </button>
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
      clients: [],
    };
  },
  mounted() {
    this.fetchClients();
  },
  methods: {
    async fetchClients() {
      try {
        const response = await axios.get('/api/client');
        this.clients = response.data.map(client => ({
          ...client,
          status: client.status === 1 ? true : false, 
        }));
      } catch (error) {
        console.error('Erreur lors de la récupération des données des clients:', error);
      }
    },

    async deleteClient(id) {
      try {
        await axios.delete(`/api/client/${id}`);
        this.fetchClients();
      } catch (error) {
        console.error('Erreur lors de la suppression du client:', error);
      }
    },

    async toggleStatus(client) {
    try {
    

      await axios.put(`/api/client/${client.id}`, { status: client.status });
      this.fetchClients()
     
    } catch (error) {
      console.error('Erreur lors de la mise à jour du statut du client:', error);
      
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
