<template>
    <div class="py-16">
      <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <img class="hidden lg:block lg:w-1/2 bg-cover" src="storage/images/log2.jpg">
        <div class="w-full p-8 lg:w-1/2">
          <h2 class="text-2xl font-semibold text-gray-700 text-center">Sign up</h2>
          <form @submit.prevent="registerUser">
            <div class="mt-4">
              <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
              <input v-model="user.name" :class="{ 'border-red-500': !user.name }" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="text" />
              <span v-if="!user.name" class="text-red-500 text-xs">Name is required</span>
            </div>
            <div class="mt-4">
              <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
              <input v-model="user.email" :class="{ 'border-red-500': !user.email || !emailRegex.test(user.email) }" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" />
              <span v-if="!user.email" class="text-red-500 text-xs">Email address is required</span>
              <span v-if="user.email && !emailRegex.test(user.email)" class="text-red-500 text-xs">Please enter a valid email address</span>
            </div>
            <div class="mt-4">
              <div class="flex justify-between">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
              </div>
              <input v-model="user.password" :class="{ 'border-red-500': !user.password || !passwordRegex.test(user.password) }" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" />
              <span v-if="!user.password" class="text-red-500 text-xs">Password is required</span>
              <span v-if="user.password && !passwordRegex.test(user.password)" class="text-red-500 text-xs">Password must contain at least 8 characters, including uppercase, lowercase, number, and special character.</span>
            </div>
            <div class="mt-2">
              <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
              <div>
                <input value="client" class="form-radio h-4 w-4 text-indigo-600" v-model="user.role" type="radio" name="role"> Client
                <input value="admin" class="form-radio h-4 w-4 text-indigo-600" v-model="user.role" type="radio" name="role"> Admin
              </div>
              <span v-if="!user.role" class="text-red-500 text-xs">Role is required</span>
            </div>
            <div class="mt-5">
              <button class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Sign up</button>
            </div>
            <div class="mt-4 flex items-center justify-between">
              <span class="border-b w-1/5 md:w-1/4"></span>
              <router-link to="/login" class="text-xs text-gray-500 uppercase hover:underline">or Login</router-link>
              <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { AuthStore } from '../store/AuthStore';
  
  export default {
    setup() {
      const auth = AuthStore(); 
      return { auth };
    },
    data() {
      return {
        user: { name: "", email: "", role: "", password: "" },
        emailRegex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        passwordRegex:/^(?=.*[a-z])(?=.*[@$!%*?&])[^A-Z0-9\s]{8,}$/
      }
    },
    methods: {
      async registerUser() {
        if (!this.user.name) {
          this.message = "Name is required.";
          return;
        }
  
        if (!this.user.email || !this.emailRegex.test(this.user.email)) {
          this.message = "Please enter a valid email address.";
          return;
        }
  
        if (!this.user.password || !this.passwordRegex.test(this.user.password)) {
          this.message = "Password must contain at least 8 characters, including uppercase, lowercase, number, and special character.";
          return;
        }
  
        if (!this.user.role) {
          this.message = "Role is required.";
          return;
        }
  
        try {
          await this.auth.signUp(this.user);
          this.$router.push('/login');
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>
  