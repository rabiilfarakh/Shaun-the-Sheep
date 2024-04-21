<template>
  <div>
    <div v-if="isLoading" class="text-center">Loading...</div>
    <div v-else class="p-20 sm:p-16 md:p-20 lg:p-24 xl:p-20 w-auto flex flex-col md:flex-row px-4 sm:px-8 md:px-24 lg:px-24 xl:px-24 relative">
      <div class="mr-10">
        <img
          class="rounded-lg min-w-[100px] w-full h-auto md:w-auto md:h-auto"
          :src="'/storage/images/' + blog.blog.image.url"
          alt="image of myself"
        />
      </div>
      <div class="w-full sm:w-[70%] md:w-[60%] lg:w-[50%]">
        <h1 class="text-black font-bold text-3xl mt-6 mb-8">
          {{ blog.blog.title }}
        </h1>
        <p class="w-full sm:w-[35rem] md:w-[30rem] lg:w-[25rem] mb-10">
          {{ blog.blog.content }}
        </p>
        <div id="social" class="flex flex-wrap justify-start items-center gap-4">
          <!-- Étoiles pour les avis -->
          <div class="flex items-center gap-2">
            <span class="text-lg font-bold mr-2">Rate:</span>
            <template v-for="n in 5">
              <svg
                @click="rate(n)"
                class="cursor-pointer w-6 h-6 fill-current text-yellow-500"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
              >
                <path
                  v-if="n <= blog.rating"
                  fill="currentColor"
                  d="M12 2l2.17 6.565H22l-5.505 3.915 2.175 6.545L12 16.13l-6.67 4.895 2.175-6.545L2 8.565h7.83z"
                />
                <path
                  v-else
                  fill="none"
                  stroke="currentColor"
                  :stroke-width="2"
                  stroke-linejoin="round"
                  d="M12 2l2.17 6.565H22l-5.505 3.915 2.175 6.545L12 16.13l-6.67 4.895 2.175-6.545L2 8.565h7.83z"
                />
              </svg>
            </template>
          </div>
        </div>
      </div>
    </div>

    <div class="w-auto px-24 justify-center relative mt-8">
      <div class=" w-auto px-24 justify-center relative">
        <h2 class="text-lg font-bold mb-4">Comments</h2>
        <div class="flex flex-col space-y-4">
          <div v-for="comment in blog.comments" :key="comment.id" class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-bold">{{ comment.client.user.name }}</h3>
            <p class="text-gray-700 text-sm mb-2">{{ comment.created_at }}</p>
            <p class="text-gray-700">{{ comment.contenu }}</p>

            <button @click="deleteComment(comment.id)" v-if="comment.client.user.id === user.id" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              Supprimer
            </button>
          </div>
        </div>
      </div> 
    </div>

    <!-- Alert box -->
    <div v-if="showAlert" class="absolute top-0 left-0 right-0 bg-green-500 text-white px-4 py-2 text-center">
      Commentaire supprimé avec succès!
    </div>
    <Footer class="mt-20" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

let isLoading = ref(true);
let blog = ref({ comments: [] });
let user = ref(null);
let showAlert = ref(false); // Variable pour contrôler l'affichage de l'alerte

const router = useRouter();

onMounted(async () => {
  try { 
    const id = router.currentRoute.value.params.id; 
    const response = await axios.get(`/api/blog/${id}`);
    blog.value = response.data; 
    isLoading.value = false;
  } catch (error) {
    console.error('Error fetching blog data:', error);
    isLoading.value = false;
  }
});

async function fetchUserData() {
  try {
    const token = localStorage.getItem("token");
    if (token) {
      const res = await axios.get("/api/user", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      user = res.data.user;
    }
  } catch (error) {
    console.error("Error fetching user data:", error);
  }
}

const deleteComment = async (commentId) => {
  try {
    const response = await axios.delete(`/api/comment/${commentId}`);
    if (response.status === 200) {
      showAlert.value = true; // Mettre à jour la variable showAlert pour afficher l'alerte
      setTimeout(() => {
        showAlert.value = false; // Masquer l'alerte après un certain délai (par exemple, 3 secondes)
      }, 3000);
    }
  } catch (error) {
    console.error('Error deleting comment:', error);
  }
};

const rate = (rating) => {
  // Logique pour noter le blog
};

const like = () => {
  // Logique pour "liker" le blog
};

const dislike = () => {
  // Logique pour "disliker" le blog
};

fetchUserData();
</script>
