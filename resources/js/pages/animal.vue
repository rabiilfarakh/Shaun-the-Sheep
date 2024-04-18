<template>
    <div>
      <html lang="en">
      <Head/>
      <body class="font-poppins relative">
      <Header/>
      <div id="container" class="p-10 w-auto flex px-24 justify-center relative">
        <div v-if="isLoading" class="text-center">Loading...</div>
        <div v-else id="container" class="p-20 sm:p-16 md:p-20 lg:p-24 xl:p-20 w-auto flex flex-col md:flex-row px-4 sm:px-8 md:px-24 lg:px-24 xl:px-24 relative">
          <div class="mr-10">
            <img
              class="rounded-lg min-w-[100px] w-full h-auto md:w-auto md:h-auto"
              :src="'/storage/images/' + blog.image.url"
              alt="image of myself"
            />
          </div>
          <div class="w-full sm:w-[70%] md:w-[60%] lg:w-[50%]">
            <h1 class="text-black font-bold text-3xl mt-6 mb-8">
              {{ blog.title.toUpperCase() }}
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
                      stroke-width="2"
                      stroke-linejoin="round"
                      d="M12 2l2.17 6.565H22l-5.505 3.915 2.175 6.545L12 16.13l-6.67 4.895 2.175-6.545L2 8.565h7.83z"
                    />
                  </svg>
                </template>
                </div> 
                </div>
          </div>
        </div>
      </div>
      <div class="w-auto px-24 justify-center relative mt-8">
            <div class=" w-auto px-24 justify-center relative">
            <h2 class="text-lg font-bold mb-4">Comments</h2>
            <div class="flex flex-col space-y-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold">John Doe</h3>
                    <p class="text-gray-700 text-sm mb-2">Posted on April 17, 2023</p>
                    <p class="text-gray-700">This is a sample comment. Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold">Jane Smith</h3>
                    <p class="text-gray-700 text-sm mb-2">Posted on April 16, 2023</p>
                    <p class="text-gray-700">I agree with John. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold">Bob Johnson</h3>
                    <p class="text-gray-700 text-sm mb-2">Posted on April 15, 2023</p>
                    <p class="text-gray-700">I have a different opinion. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                <form class="bg-white p-4 rounded-lg shadow-md">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="comment">
                            Comment
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="comment" rows="3" placeholder="Enter your comment"></textarea>
                    </div>
                    <button
                        class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Submit
                    </button>
                </form>
            </div>
        </div> 
        </div>
      <Footer class="mt-20" />
      </body>
      </html>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router'; 
  import Head from "../layouts/head.vue";
  import Header from "../layouts/header.vue";
  import Footer from "../layouts/footer.vue";
  
  let isLoading = ref(true);
  const router = useRouter();
  
  let blog = ref({});
  
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
  

  const rate = (rating) => {
  };
  
  const like = () => {
  };
  
  const dislike = () => {

  };
  </script>
  