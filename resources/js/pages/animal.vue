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
      <form @submit.prevent="addComment" class="bg-white p-4 rounded-lg shadow-md mt-8">
        <h3 class="text-lg font-bold mb-2">Add a comment</h3>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="comment">Comment</label>
          <textarea v-model="newComment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="comment" rows="3" placeholder="Enter your comment"></textarea>
        </div>
        <button type="submit" class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
      </form>
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

const token = localStorage.getItem('token');
const headers = { headers: { 'Authorization': `Bearer ${token}` } };

const isLoading = ref(true);
const blog = ref({ comments: [] });
const showAlert = ref(false);
const newComment = ref('');

const router = useRouter();


onMounted(async () => {
  try { 
    const id = router.currentRoute.value.params.id; 
    const response = await axios.get(`/api/blog/${id}`, headers);
    blog.value = response.data; 
    isLoading.value = false;
  } catch (error) {
    console.error('Error fetching blog data:', error);
    isLoading.value = false;
  }
});

//ajouter comment
const addComment = async () => {
  try {
    const id = router.currentRoute.value.params.id;
    
    const addCommentResponse = await axios.post(`/api/blog/${id}/comment`, { content: newComment.value }, headers);
  
    if (addCommentResponse.status === 200) {
      const newCommentData = addCommentResponse.data;
      blog.value.comments.push(newCommentData);
      newComment.value = '';
      console.log('Comment added successfully');
    } else {
      console.error('Unexpected status code:', addCommentResponse.status);
    }
  } catch (error) {
    console.error('Error adding comment:', error);
  }
}



// Supprimer un commentaire
const deleteComment = async (commentId) => {
  try {
    const response = await axios.delete(`/api/comment/${commentId}`, headers);
  
    if (response.status === 200) {
      console.log('Comment deleted successfully');
    } else {
      console.error('Unexpected status code:', response.status);
    }
  } catch (error) {
    console.error('Error deleting comment:', error);
  }
}

</script>

