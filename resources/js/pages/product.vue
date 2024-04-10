<template>
    <Head/>
    <Header/>
    <div class="mx-auto container px-6 xl:px-0 py-12">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->  
        <div class="flex flex-col">
            <div class="flex flex-col justify-center">
                <div class="relative flex justify-center">
                    <!-- <img class=" hidden sm:block w-96 " src="storage/images/aya.jpg" alt="sofa"/> -->
                    <img class="sm:hidden w-full " src="https://i.ibb.co/B6qwqPT/jason-wang-Nx-Awry-Abt-Iw-unsplash-1.png" alt="sofa" />
                    <div class="absolute sm:bottom-8 bottom-4 pr-10 sm:pr-0 left-4 sm:left-8 flex justify-start items-start">
                    </div>
                </div>
            </div>
            <form class="mt-10 w-full mx-auto max-w-xl py-2 px-6 rounded-full bg-gray-50 border flex focus-within:border-gray-300">
                <input v-model="searchTerm" type="text" placeholder="Search anything" class="bg-transparent w-full focus:outline-none pr-4 font-semibold border-0 focus:ring-0 px-0 py-0" name="topic">
            </form>
            <!-- Grid Section - Starts Here  -->
            <section id="Projects"
                class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-20 mb-5">

                <!-- Product card 1 - Starts Here -->
                <div v-for="animal in animals" :key="animal.id" class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                    <a href="#">
                        <img v-if="animal.image" :src="'storage/images/' + animal.image.url" alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />

                        <div class="px-4 py-3 w-72">
                            <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                            <div class="flex items-center">
                                <p class="text-lg font-semibold text-black cursor-auto my-3">{{ animal.prix }}DH</p>
                                <del>
                                    <p class="text-sm text-gray-600 cursor-auto ml-2">{{ animal.prix + animal.prix*20/100 }}DH</p>
                                </del>
                                <div class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                        <path
                                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg></div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <button @click="fetchAnimals(currentPage - 1)" :disabled="currentPage === 1" class="px-3 py-1 mr-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Previous</button>
                <button @click="fetchAnimals(currentPage + 1)" :disabled="currentPage === lastPage" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Next</button>
            </div>
            <!-- credit -->
            <div class="text-center py-10 px-10">
                <h2 class="font-bold text-2xl md:text-4xl mb-4">Thanks to <a href="https://unsplash.com/@nixcreative"
                        class="underline font-black">Tyler Nix</a> for those AMAZING product images!</h2>
            </div>
        </div>
    </div>
    <Footer/>
</template>

<script setup>
    import Header from "../layouts/header.vue"
    import Footer from "../layouts/footer.vue"
    import Head from "../layouts/head.vue"
    import { ref, onMounted, watch } from 'vue';
    import axios from 'axios';

const searchTerm = ref('');
const originalAnimals = ref([]); // Initialiser originalAnimals
const animals = ref([]);
const currentPage = ref(1);

const fetchAnimals = async (page = 1) => {
  try {
    const response = await axios.get('/api/animal', {
      params: {
        searchTerm: searchTerm.value,
        page: page
      }
    });
    animals.value = response.data.data;
    currentPage.value = response.data.current_page;
    originalAnimals.value = response.data; // Mettre à jour originalAnimals
  } catch (error) {
    console.error('Erreur lors de la récupération des animaux :', error);
  }
};

// Watcher pour détecter les changements de la recherche
watch(searchTerm, async (newValue) => {
  currentPage.value = 1; // Réinitialiser la page à 1 lors d'une nouvelle recherche
  await fetchAnimals(); // Appeler fetchAnimals avec la nouvelle recherche
});

// Watcher pour détecter les changements de la page actuelle
watch(currentPage, async () => {
  await fetchAnimals(currentPage.value); // Appeler fetchAnimals avec la nouvelle page
});

// Appeler fetchAnimals lors du montage du composant
onMounted(fetchAnimals);
</script>


