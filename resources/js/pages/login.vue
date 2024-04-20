<template>
    <div class="py-16">
      <div class="flex rounded-lg bg-gray-200 shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <img class="hidden lg:block lg:w-1/2 bg-cover" src="storage/images/log2.jpg">
        <div class="w-full p-8 lg:w-1/2">
          <h2 class="text-2xl font-semibold text-gray-700 text-center"></h2>
          <!-- <div class="bg-red" v-if="message">{{ message }}</div> -->
          <p class="text-xl text-gray-600 text-center">Login</p>
          <a href="#" class="flex items-center justify-center mt-4 text-white rounded-lg shadow-md hover:bg-gray-100">
            <div class="px-4 py-3">
              <svg class="h-6 w-6" viewBox="0 0 40 40">
                <!-- SVG icon code -->
              </svg>
            </div>
            <h1 class="px-4 py-3 w-5/6 text-center text-gray-600 font-bold">Login in with Google</h1>
          </a>
          <form @submit.prevent="login">
            <div class="mt-8">
              <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
              <input v-model="user.email" :class="{ 'border-red-500': !user.email || !emailRegex.test(user.email) }" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" />
              <span v-if="!user.email" class="text-red-500 text-xs">Email address is required</span>
              <span v-if="user.email && !emailRegex.test(user.email)" class="text-red-500 text-xs">Please enter a valid email address</span>
            </div>
            <div class="mt-4">
              <div class="flex justify-between">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <a href="#" class="text-xs text-gray-500">Forget Password?</a>
              </div>
              <input v-model="user.password" :class="{ 'border-red-500': !user.password || !passwordRegex.test(user.password) }" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" />
              <span v-if="!user.password" class="text-red-500 text-xs">Password is required</span>
              <span v-if="user.password && !passwordRegex.test(user.password)" class="text-red-500 text-xs">Password must contain at least 8 characters, including uppercase, lowercase, number, and special character.</span>
            </div>
            <div class="mt-8">
              <button @click="login" type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Login</button>
            </div>
            <div class="mt-4 flex items-center justify-between">
              <span class="border-b w-1/5 md:w-1/4"></span>
              <router-link to="/register" class="text-xs text-gray-500 uppercase hover:underline">or sign up</router-link>
              <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { AuthStore } from '../store/AuthStore';
import { useRouter } from 'vue-router'; 

export default {
  setup() {
    const auth = AuthStore();
    const router = useRouter(); 

    return { auth, router }; 
  },
  data() {
    return {
      user: { email: "", password: "" , role:""},
      message: '',
      emailRegex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
      passwordRegex:/^(?=.*[a-z])(?=.*[@$!%*?&])[^A-Z0-9\s]{8,}$/
    };
  },
  methods: {
    async login() {
    if (!this.user.email || !this.emailRegex.test(this.user.email)) {
        this.message = "Please enter a valid email address.";
        return;
    }

    if (!this.user.password || !this.passwordRegex.test(this.user.password)) {
        this.message = "Password must contain at least 8 characters, including uppercase, lowercase, number, and special character.";
        return;
    }
    
    try {
        const userData = await this.auth.signIn(this.user, this.router); 
        
        this.user = userData;
        if(this.user.role == "client"){
            console.log("client");
            this.router.push('/index');
        } else if(this.user.role == "admin"){
            console.log("admin");
            this.router.push('/dashboard/dashboardIndex');
        }
    } catch (error) {
        console.error("Error during login:", error);
    }
}

  }
}

  </script>
  