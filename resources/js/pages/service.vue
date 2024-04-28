<template>
    <div class="">
        <!DOCTYPE html>
<html lang="en">
<Head/>
<body>
    <Header/>
    <div class="container relative flex flex-col justify-between h-full max-w-6xl px-10 mx-auto xl:px-0 mt-5">
        <h2 class="mb-1 text-3xl font-extrabold leading-tight text-gray-900">Services</h2>
        <p class=" text-lg text-gray-500">Here is a few of the awesome Services we provide.</p>
        <div class="w-full py-20">
            <div class="flex flex-col w-full mb-5 sm:flex-row">
                <router-link to="/" class="w-full mb-10 sm:mb-0 sm:w-1/2">
                    <div class="relative h-full ml-0 mr-0 sm:mr-10">
                        <span class="absolute top-0 left-0 w-full h-full mt-1 ml-1 bg-blue-400 rounded-lg"></span>
                        <div class="relative h-full p-5 bg-white border-2 border-blue-400 rounded-lg">
                            <div class="flex items-center -mt-1">
                                <h3 class="my-2 ml-3 text-lg font-bold text-gray-800">Moutons</h3>
                            </div>
                            <p class="mt-3 mb-1 text-xs font-medium text-blue-400 uppercase">------------</p>
                            <p class="mb-2 text-gray-600">A Project Audit is a formal review of a project, which is intended
                                to assess the extent up to which project management standards are being upheld.</p>
                        </div>
                    </div>
                </router-link>
                <router-link to="/" class="w-full mb-10 sm:mb-0 sm:w-1/2">
                    <div class="relative h-full ml-0 mr-0 sm:mr-10">
                        <span class="absolute top-0 left-0 w-full h-full mt-1 ml-1 bg-yellow-400 rounded-lg"></span>
                        <div class="relative h-full p-5 bg-white border-2 border-yellow-400 rounded-lg">
                            <div class="flex items-center -mt-1">
                                <h3 class="my-2 ml-3 text-lg font-bold text-gray-800">Vaches</h3>
                            </div>
                            <p class="mt-3 mb-1 text-xs font-medium text-yellow-400 uppercase">------------</p>
                            <p class="mb-2 text-gray-600">A security hacker is someone who explores methods for breaching
                                defenses and exploiting weaknesses in a computer system or network.</p>
                        </div>
                    </div>
                </router-link>
                <router-link to="/" class="w-full sm:w-1/2">
                    <div class="relative h-full ml-0 md:mr-10">
                        <span class="absolute top-0 left-0 w-full h-full mt-1 ml-1 bg-green-500 rounded-lg"></span>
                        <div class="relative h-full p-5 bg-white border-2 border-green-500 rounded-lg">
                            <div class="flex items-center -mt-1">
                                <h3 class="my-2 ml-3 text-lg font-bold text-gray-800">Capras</h3>
                            </div>
                            <p class="mt-3 mb-1 text-xs font-medium text-green-500 uppercase">------------</p>
                            <p class="mb-2 text-gray-600">Bot development frameworks were created as advanced software tools
                                that eliminate a large amount of manual work and accelerate the development process.</p>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
    <!-- source:https://tailwind.besoeasy.com -->
    <x-footer />
</body>
</html>
    </div>
<Footer/>
</template>


<script setup>
import Head from "../layouts/head.vue"
import Header from "../layouts/header.vue"
import Footer from "../layouts/footer.vue"

</script>