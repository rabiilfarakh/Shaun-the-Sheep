<template>
    <div class="">
        <div class="bg-white flex flex-col items-center py-16 px-4 w-full">
        <div class="mb-10 text-4xl font-normal text-black">Login</div>
        
        <div class="mb-8 flex flex-col">
            <input class="mb-4 text-sm text-gray-600 border border-transparent rounded-lg p-3 focus:outline-none" placeholder="Email Address">
            <div class="bg-gray-200 w-96 h-px"></div>
        </div>
        
        <div class="mb-8 flex flex-col">
            <input class="mb-4 text-sm text-gray-600 border border-transparent rounded-lg p-3 focus:outline-none" placeholder="Password">
            <div class="bg-gray-200 w-96 h-px"></div>
        </div>
        
        <button class="rounded-lg bg-black flex justify-center items-center py-4 px-10 w-96 text-white mb-8 hover:bg-gray-800">Create Account</button>
  
            <a href="#" class="text-sm text-gray-600  hover:text-gray-400">FORGOT PASSWORD?</a>
  
            <div class="flex items-center mt-5">
                <span class="text-sm text-gray-600">No account?</span>
                <a href="{{route('register')}}" class="text-sm text-gray-600 hover:underline ml-1">Create One</a>
            </div>  
    </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        user: { email: "", password: "" },
        message: ''
      };
    },
    methods: {
      login() {
    axios.post('/api/login', this.user)
      .then(res => {
        if (res.data.token) {
          this.message = res.data.message;
          localStorage.setItem('token', res.data.token); 
          this.$router.push('/dashboard');
        } else {
          this.message = res.data.message;
        }
      })
      .catch(error => {
        console.error('Error during login:', error);
      });
  }
  
    }
  }
  </script>