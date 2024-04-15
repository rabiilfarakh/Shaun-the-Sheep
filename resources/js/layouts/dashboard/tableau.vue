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
              <!-- Utilisation d'une condition pour afficher "active" ou "banner" -->
              <span v-if="client.status === 1" class="bg-green-500 text-white px-2 py-1 rounded-full">Active</span>
              <span v-else class="bg-red-500 text-white px-2 py-1 rounded-full">Banner</span>
            </td>

            <td class="px-6 py-4">
              <!-- Ajout des icônes pour les actions -->
              <button @click="updateClient(client.id)" class="text-blue-500 hover:text-blue-700 mr-2">
                <!-- Icône pour la mise à jour -->
                <ion-icon name="create-outline"></ion-icon>
                
              </button>

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
        this.clients = response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des données des clients:', error);
      }
    },
    updateClient(id) {
      // Logique pour la mise à jour du client avec l'ID donné
    },
    deleteClient(id) {
      // Logique pour la suppression du client avec l'ID donné
    },
  },
};
</script>
