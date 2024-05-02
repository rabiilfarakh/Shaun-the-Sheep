<template>
    <!-- General elements -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Elements
    </h4>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 justify-center items-center " style="width: 26rem;">
          
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple files</label>
      <input @change="handleFileUpload" accept="image/*" class="block w-96 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
  
      <!-- Title -->
      <label class="block mt-4 text-sm">
        <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</span>
        <input v-model="title" type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Lieu de l'animal" />
      </label>

  
      <div class="mt-4 col-span-2 sm:col-span-1">
          <label for="prix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
          <textarea name="content" v-model="content"  id="content" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required></textarea>
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
        content: '',
        selectedCategorie: 'defaultCategoryId',
        image: null,
        title: '',
        headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
      };
    },
  
    mounted() {
      this.fetchCategories();
    },
  
    methods: {
  
      handleFileUpload(event) {
        this.image = event.target.files[0];
        console.log('Image uploaded:', this.image);
      },
  
      async submitForm() {
  
        const formData = new FormData();
        formData.append('title', this.title);
        formData.append('image', this.image);
        formData.append('content', this.content);
  
        try {
          const response = await axios.post('/api/blog', formData, {
            headers: this.headers,
          });
  
          await Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: 'Blog ajouté avec succès!',
            showConfirmButton: false,
            timer: 2000 
          });
  
          this.title = '';
          this.image = null;
          this.content = '';
  
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