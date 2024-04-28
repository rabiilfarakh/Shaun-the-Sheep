<template>

    <Head />
    <Header :getNombreProduitsDansPanier="getNombreProduitsDansPanier" />
    <div class="mx-auto container px-6 xl:px-0 py-12">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
        <div class="flex flex-col">
            <div class="flex flex-col justify-center">
                <div class="relative flex justify-center">
                    <!-- <img class=" hidden sm:block w-96 " src="storage/images/aya.jpg" alt="sofa"/> -->
                    <img class="sm:hidden w-full "
                        src="https://i.ibb.co/B6qwqPT/jason-wang-Nx-Awry-Abt-Iw-unsplash-1.png" alt="sofa" />
                    <div
                        class="absolute sm:bottom-8 bottom-4 pr-10 sm:pr-0 left-4 sm:left-8 flex justify-start items-start">
                    </div>
                </div>
            </div>
            <form
                class="mt-10 w-full mx-auto max-w-xl py-2 px-6 rounded-full bg-gray-50 border flex focus-within:border-gray-300">
                <input v-model="searchTerm" type="text" placeholder="Search anything"
                    class="bg-transparent w-full focus:outline-none pr-4 font-semibold border-0 focus:ring-0 px-0 py-0"
                    name="topic">
            </form>
            <!-- Grid Section - Starts Here  -->
            <section id="Projects"
                class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-20 mb-5">

                <!-- Product card 1 - Starts Here -->
                <div v-for="animal in animals" :key="animal.id"
                    class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                    <img v-if="animal.image" :src="'storage/images/' + animal.image.url" alt="Product"
                        class="h-80 w-72 object-cover rounded-t-xl" />

                    <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black cursor-auto my-3">{{ animal.prix }}DH</p>
                            <del>
                                <p class="text-sm text-gray-600 cursor-auto ml-2">{{ animal.prix + animal.prix * 20 / 100
                                    }}DH</p>
                            </del>
                            <button @click="addProduct(animal.id)" class="ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <button @click="fetchAnimals(currentPage - 1)" :disabled="currentPage === 1"
                    class="px-3 py-1 mr-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Previous</button>

                <div class="flex items-center space-x-4">
                    <!-- <span class="text-gray-700">Page {{ currentPage }} of {{ totalPages }}</span> -->

                    <button v-for="page in totalPages" :key="page" @click="fetchAnimals(page)"
                        :class="['px-3 py-1 bg-gray-200 text-gray-700 rounded-md cursor-pointer', { 'bg-blue-500 text-white': page === currentPage }]">
                        {{ page }}
                    </button>
                </div>

                <button @click="fetchNextPage" :disabled="currentPage === lastPage"
                    class="px-3 py-1 ml-2 bg-gray-200 text-gray-700 rounded-md cursor-pointer">Next</button>
            </div>
            <!-- credit -->
            <div class="text-center py-10 px-10">
                <h2 class="font-bold text-2xl md:text-4xl mb-4">Thanks to <a href="https://unsplash.com/@nixcreative"
                        class="underline font-black">Tyler Nix</a> for those AMAZING product images!</h2>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script setup>
import Header from "../layouts/header.vue";
import Footer from "../layouts/footer.vue";
import Head from "../layouts/head.vue"
import axios from 'axios';
import { ref, onMounted, watch } from 'vue';
import { AuthStore } from '../store/AuthStore';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const $toast = useToast({
    position: 'top',
    duration: 1000 
});

const props = defineProps({
    getNombreProduitsDansPanier: Function // Type de prop à ajuster en fonction de ce qui est attendu
});

const authStore = AuthStore();
const token = localStorage.getItem('token');
const headers = { headers: { 'Authorization': `Bearer ${token}` } };

const searchTerm = ref('');
const originalAnimals = ref([]);
const animals = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);

const fetchAnimals = async (page = 1) => {
    try {
        await authStore.fetchUserData();
        const userId = authStore.user.id;
        const response = await axios.get('/api/animal', {
            params: { searchTerm: searchTerm.value, page: page, user_id: userId },
            headers: { 'Authorization': `Bearer ${token}` }
        });

        animals.value = response.data.data;
        currentPage.value = response.data.current_page;
        totalPages.value = response.data.last_page;
        originalAnimals.value = response.data;
    } catch (error) {
        console.error('Erreur lors de la récupération des animaux :', error);
    }
};

const fetchNextPage = async () => {
    if (currentPage.value < totalPages.value) {
        await fetchAnimals(currentPage.value + 1);
    }
};

watch(searchTerm, async (newValue) => {
    currentPage.value = 1;
    await fetchAnimals();
});

watch(currentPage, async () => {
    await fetchAnimals(currentPage.value);
});

onMounted(fetchAnimals);

const addProduct = async (animalId) => {
    try {
        const clientInfo = await authStore.getClient(authStore.user.id);
        const clientId = clientInfo.clientId;
        const exist = await product_exist(animalId);
        if(exist == 1){
            $toast.info('Animal existe dans votre panier');
        } else {
            const response = await axios.post(`api/product/panier`, { animal_id: animalId, client_id: clientId }, headers);
            $toast.success('Animal a été ajouté à votre panier avec succès.');
            getNombreProduitsDansPanier();
        }
    } catch (error) {
        console.error('Une erreur s\'est produite lors de l\'ajout du produit au panier :', error);
    }
};

const product_exist = async (animalId) => {
    try {
        const clientInfo = await authStore.getClient(authStore.user.id);
        const clientId = clientInfo.clientId;
        const response = await axios.post(`api/product/panier_exist`, { animal_id: animalId, client_id: clientId }, headers);
        return response.data;
    } catch (error) {
        console.error('Une erreur s\'est produite lors de la vérification de l\'existence du produit dans le panier :', error);
    }
}

</script>








