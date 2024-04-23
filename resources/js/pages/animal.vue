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
      </div>
    </div>

    <div class="w-auto px-24 justify-center relative mt-8">
      <div class="w-auto px-24 justify-center relative">
        <h2 class="text-lg font-bold mb-4">Comments</h2>
        <div class="flex flex-col space-y-4">
          <div v-for="comment in blog.comments" :key="comment.id" class="bg-white p-4 rounded-lg shadow-md flex items-start">
            <div class="flex-1">
              <h3 class="text-lg font-bold">{{ comment.client.user.name }}</h3>
              <p class="text-gray-700 text-sm mb-2">{{ formatDate(comment.created_at) }}</p>
              <p class="text-gray-700">{{ comment.contenu }}</p>
            </div>
            <div class="ml-auto">
              <button @click="deleteComment(comment.id)" v-if="comment.client.user.id === user.id" class="text-gray-600 hover:text-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Supprimer
              </button>
              <div class="w-full border-t mt-2"></div> <!-- Ligne sous le bouton -->
            </div>
          </div>
        </div>
      </div>
      <form @submit.prevent="addComment" class="bg-white p-4 rounded-lg shadow-md mt-8">
        <h3 class="text-lg font-bold mb-2">Add a comment</h3>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="comment">Comment</label>
          <textarea v-model="newComment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="comment" rows="3" placeholder="Enter your comment"></textarea>
        </div>
        <button type="submit" class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
      </form>
    </div>

    <Footer class="mt-20" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const token = localStorage.getItem('token');
const headers = { headers: { 'Authorization': `Bearer ${token}` } };

const isLoading = ref(true);
const blog = ref({ comments: [] });
const newComment = ref('');
const router = useRouter();
const user = ref('');

const getClient = async (id) => {
  try {
    const res = await axios.get(`/api/getClient/${id}`, { headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' } });
    return res.data;
  } catch (error) {
    console.error('Error fetching client:', error);
    throw error;
  }
};


onMounted(async () => {
  try {
    if (token) {
      const res = await axios.get("/api/user", { headers: { Authorization: `Bearer ${token}` } });
      user.value = res.data.user;
    }
    const id = router.currentRoute.value.params.id;
    const response = await axios.get(`/api/blog/${id}`, headers);
    blog.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.error('Error fetching blog data:', error);
    isLoading.value = false;
  }
});


//  add a comment
const addComment = async () => {
  try {
    const id = router.currentRoute.value.params.id;
    const blog_id = blog.value.blog.id;

    const clientObj = await getClient(user.value.id);
    const addCommentResponse = await axios.post(`/api/blog/${id}/animal/comment`, { contenu: newComment.value, client_id: clientObj.clientId, blog_id: blog_id }, headers);
    blog.value.comments.push(addCommentResponse.data);
    newComment.value = '';

    const response = await axios.get(`/api/blog/${id}`, headers);
    blog.value.comments = response.data.comments;
    
  } catch (error) {
    console.error('Error adding comment:', error);
  }
}




// Function to delete a comment
const deleteComment = async (commentId) => {
  try {
    const response = await axios.delete(`/api/comment/${commentId}`, headers);
    if (response.status === 200) {
      console.log('Comment deleted successfully');
      blog.value.comments = blog.value.comments.filter(comment => comment.id !== commentId);
    } else {
      console.error('Unexpected status code:', response.status);
    }
  } catch (error) {
    console.error('Error deleting comment:', error);
  }
}

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return `${date.toLocaleDateString()} ${date.toLocaleTimeString()}`;
}
</script>




