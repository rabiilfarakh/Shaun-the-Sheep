<template>
  <div class="">
      <div class="bg-white flex flex-col items-center py-16 px-4 w-full">
      <div class="mb-10 text-4xl font-normal text-black">Create Account</div>
      
      <div class="mb-8 flex flex-col">
          <input class="mb-4 text-sm text-gray-600 border border-transparent rounded-lg p-3 focus:outline-none" placeholder="Full name">
          <div class="bg-gray-200 w-96 h-px"></div>
      </div>
      
      <div class="mb-8 flex flex-col">
          <input class="mb-4 text-sm text-gray-600 border border-transparent rounded-lg p-3 focus:outline-none" placeholder="Email Address">
          <div class="bg-gray-200 w-96 h-px"></div>
      </div>
      
      <div class="mb-8 flex flex-col">
          <input class="mb-4 text-sm text-gray-600 border border-transparent rounded-lg p-3 focus:outline-none" placeholder="Password">
          <div class="bg-gray-200 w-96 h-px"></div>
      </div>
      
      <button class="rounded-lg bg-black flex justify-center items-center py-4 px-10 w-96 text-white mb-8">Create Account</button>
      
      <div class="flex items-center">
          <span class="text-sm text-gray-600">Already have an account?</span>
          <a href="{{route('login')}}" class="text-sm text-gray-600 hover:underline ml-1">Log in</a>
      </div>
          
  </div>
  </div>
</template>

  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            users: [],
            user: {name: "", email: "", password: "" },
        }
    },
    methods: {
        register() {
        axios.post('/api/register', this.user)
            .then(res => {
                this.user = {name: "", email: "", password: "" };
                this.$router.push('/login');
            })
            .catch(err => console.error(err));
        }
    }
}
</script>