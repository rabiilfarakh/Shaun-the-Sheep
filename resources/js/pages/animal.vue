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
          {{ blog.title }}
        </h1>
        <p class="w-full sm:w-[35rem] md:w-[30rem] lg:w-[25rem] mb-10">
          {{ blog.content }}
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
            <!-- Condition pour afficher le bouton de suppression -->
            <button v-if="comment.client.user.id === user.id" class="bg-red-600">Supprimer</button>
          </div>
        </div>
      </div> 
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

const router = useRouter();

onMounted(async () => {
  try { 
    const id = router.currentRoute.value.params.id; 
    const response = await axios.get(`/api/blog/${id}`);
    blog = response.data; 
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
      console.log(user);
    }
  } catch (error) {
    console.error("Error fetching user data:", error);
  }
}

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
