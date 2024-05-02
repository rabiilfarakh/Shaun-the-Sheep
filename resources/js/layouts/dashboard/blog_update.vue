<template>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="mt-6 w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-6 py-3">Image</th>
              <th class="px-6 py-3">Titre</th>
              <th class="px-6 py-3">Contents</th>
              <th class="px-6 py-3">Delete</th>
              <th class="px-6 py-3">Update</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <!-- Boucle sur les blogs paginés -->
            <tr v-for="blog in blogs" :key="blog.id" class="text-gray-700 dark:text-gray-400">
              <td class="px-6 py-4">
                <div class="flex items-center">
                  <div class="h-12 w-12 flex items-center justify-center bg-gray-200 rounded-full overflow-hidden">
                    <img v-if="blog.image" :src="'../storage/images/' + blog.image.url" alt="Product" class="h-full w-full object-cover rounded-full" />
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">{{ blog.title }}</td>
              <td class="px-6 py-4">
                {{ blog.content.length > 100 ? blog.content.slice(0, 100) + '...' : blog.content }}
                </td>
              <td class="px-6 py-4">
                <!-- Bouton Supprimer -->
                <button @click="supprimerBlog(blog.id)" class="mr-2">
                  <ion-icon name="trash-outline" class="text-red-500 text-xl"></ion-icon>
                </button>
              </td>
              <td class="px-6 py-4">
                <!-- Bouton Modifier -->
                <button @click="showUpdatePopup(blog.id)">
                  <ion-icon name="create-outline" class="text-blue-500 text-xl"></ion-icon>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Pagination -->
      <div class="flex justify-end mt-4">
        <button @click="prevPage" :disabled="blogs.current_page === 1" class="px-3 py-1 mr-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Précédent</button>
        <div class="flex items-center space-x-4">
          <!-- Affichage des boutons de page -->
          <button v-for="page in totalPages" :key="page" @click="fetchPage(page)" :class="['px-3 py-1 bg-gray-200 text-gray-700 rounded-md cursor-pointer', { 'bg-blue-500 text-white': page === blogs.current_page }]">{{ page }}</button>
        </div>
        <button @click="nextPage" :disabled="blogs.current_page === blogs.last_page" class="px-3 py-1 ml-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Suivant</button>
      </div>
      <!-- Popup pour la mise à jour de l'animal -->
      <div v-if="blogSelectionne" tabindex="-1" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-75">
          <div class="relative p-4 w-full max-w-md max-h-full">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Modifier Blog
                      </h3>
                      <button @click="fermerPopup()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                  <form class="p-4 md:p-5" @submit.prevent="updateBlog">
                      <div class="grid gap-4 mb-4 grid-cols-2">
                          <div class="col-span-2">
                              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                              <input type="text" name="title"  v-model="blogSelectionne.title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required="">
                          </div>
                          <div class="col-span-2 sm:col-span-1 grid-cols-2">
                              <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                              <textarea name="content" v-model="blogSelectionne.content" id="content" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required></textarea>

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
        blogs: [],
        blogSelectionne: null,
        headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
      };
    },
    mounted() {
      this.recupererBlogs();
    },
    methods: {
  
      async recupererBlogs() {
        try { 
          const reponse = await axios.get('/api/blog', { headers: this.headers });
          this.blogs = reponse.data;
        } catch (erreur) {
          console.error('Erreur lors de la récupération des données des blogs:', erreur);
        }
      },

      async supprimerBlog(idBlog) {
        try {
          await axios.delete(`/api/blog/${idBlog}`, { headers: this.headers });
  
          await Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: 'Blog supprimé avec succès!',
            showConfirmButton: false,
            timer: 2000 
          });
          this.recupererBlogs();
        } catch (erreur) {
          console.error('Erreur lors de la suppression de l\'animal:', erreur);
        }
      },

      async updateBlog() {
        try {
            await axios.put(`/api/blog/${this.blogSelectionne.id}`, this.blogSelectionne, { headers: this.headers });
            await Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: 'Blog mis à jour avec succès!',
            showConfirmButton: false,
            timer: 2000
            });
            this.blogSelectionne = null; 
            this.recupererBlogs();
        } catch (erreur) {
            console.error('Erreur lors de la mise à jour du blog:', erreur);
        }
        },


      showUpdatePopup(idBlog) {
        axios.get(`/api/blog/${idBlog}`, { headers: this.headers })
            .then(reponse => {
            this.blogSelectionne = reponse.data.blog;
        })
        .catch(erreur => {
        console.error('Erreur lors de la récupération des détails du blog:', erreur);
        });
    },

      
      fermerPopup() {
        this.blogSelectionne = null;
      }
    },
    computed: {
      totalPages() {
        return this.blogs.last_page ? Array.from({ length: this.blogs.last_page }, (_, i) => i + 1) : [];
      }
    }
  };
  </script>
  
  