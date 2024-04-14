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
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="client in clients" :key="client.id" class="text-gray-700 dark:text-gray-400">
            <td class="px-6 py-4">
              {{ client.id }}
            </td>
            <td class="px-6 py-4">
              {{ client.name }}
            </td>
            <td class="px-6 py-4">
              {{ client.email }}
            </td>
            <td class="px-6 py-4">
              {{ client.status }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Pagination et autres éléments -->
  </div>
</template>


<script>
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
  },
};
</script>
