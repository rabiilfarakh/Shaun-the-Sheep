<template>
    <div>

    <header class="h-24 sm:h-32 flex items-center z-30 w-full">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <router-link class="text-gray-800 dark:text-white font-black text-3xl" to="/">
                Farm<span class="text-3xl text-gray-600">Con</span>  
            </router-link>
            <div class="flex items-center">
                <nav class="font-sen text-gray-800 dark:text-white uppercase text-lg lg:flex items-center hidden">
                    <router-link to="/index" class="py-2 px-6 flex">
                        Home
                    </router-link>
                    <router-link to="/blog" class="py-2 px-6 flex">
                        Blog
                    </router-link>
                    <router-link to="/product" class="py-2 px-6 flex">
                        Product
                    </router-link>
                    <router-link to="/contact" class="py-2 px-6 flex">
                        Contact
                    </router-link>
                    <router-link to="/service" class="py-2 px-6 flex">
                        Services
                    </router-link>
                    <router-link to="/panier" class="py-2 px-6 flex">
                        <i class="fas fa-shopping-cart mr-1"></i>
                    </router-link>
                    
                </nav>
                <button class="lg:hidden flex flex-col ml-4">
                    <span class="w-6 h-1 bg-gray-800 dark:bg-white mb-1">
                    </span>
                    <span class="w-6 h-1 bg-gray-800 dark:bg-white mb-1">
                    </span>
                    <span class="w-6 h-1 bg-gray-800 dark:bg-white mb-1">
                    </span>
                </button>
            </div>
        </div>
    </header>
        <router-view></router-view>
    </div>
</template>
