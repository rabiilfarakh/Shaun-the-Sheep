<template>
  <div class="">
    <main class="dark:bg-gray-800 bg-white relative overflow-hidden h-screen">

        <div class="bg-white dark:bg-gray-800 flex relative z-20 items-center overflow-hidden">
            <div class="container mx-auto px-6 flex relative py-16">
                <div class="sm:w-2/3 lg:w-2/5 flex flex-col relative z-20">
                    <span class="w-20 h-2 bg-gray-800 dark:bg-white mb-12">
                    </span>
                    <h1 class="font-bebas-neue uppercase text-6xl sm:text-8xl font-black flex flex-col leading-none dark:text-white text-gray-800">
                        Be on
                        <span class="text-5xl sm:text-7xl">
                            Time
                        </span>
                    </h1>
                    <p class="text-sm sm:text-base text-gray-700 dark:text-white">
                        Dimension of reality that makes change possible and understandable. An indefinite and homogeneous environment in which natural events and human existence take place.
                    </p>
                    <div class="flex mt-8">
                        <a href="#" class="uppercase py-2 px-4 rounded-lg bg-black border-2 border-transparent text-white text-md mr-4 hover:bg-gray-800">
                            Get started
                        </a>
                        <a href="#" class="uppercase py-2 px-4 rounded-lg bg-transparent border-2 border-black text-black dark:text-white hover:bg-gray-800 hover:text-white text-md">
                            Read more
                        </a>
                    </div>
                </div>
                <div class="hidden sm:block sm:w-1/3 lg:w-3/5 relative">
                    <img src="{{ asset('storage/images/vaches.png') }}" class="max-w-xs md:max-w-sm lg:max-w-full m-auto"/>
                </div>                
            </div>
        </div>
    </main>
    <section class="container w-3/4 mx-auto px-5 md:px-0 py-10 md:py-20 mt-0">
        <section class="flex flex-col md:flex-row items-center justify-between relative transform duration-500 hover:shadow-2xl cursor-pointer hover:-translate-y-1 ">
            <img class="w-full md:w-auto md:max-w-5xl h-96 object-cover" src="{{ asset('storage/images/mouton1.jpg') }}" alt="">
            <div class="bg-white p-6 md:p-12 lg:max-w-lg w-full">
                <div class="flex  font-bold text-sm mb-2 md:mb-6">
                    <p>Product Review</p>
                    <p class="text-gray-400 ml-4">17th March, 2021</p>
                </div>
                <h2 class="text-3xl font-semibold mt-0 md:mt-10">Coffee From Heaven</h2>
                <p class="my-3 text-justify font-medium text-gray-700 leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem aperiam nulla cupiditate saepe sed quis veritatis minus rem adipisci aliquid.</p>
                <button class="mt-2 md:mt-5 p-3 px-5 bg-black text-white font-bold text-sm hover:bg-gray-800">Read More</button>
            </div>
        </section>
    </section>
    
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Empowering Businesses Globally</h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">
              Our platform is trusted by organizations worldwide to boost productivity, streamline operations, and enhance
              customer experiences.
            </p>
          </div>
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
            
            <div class="rounded overflow-hidden shadow-lg">
    
                <a href="#"></a>
                <div class="relative">
                    <a href="#">
                        <img class="w-full"
                            src="{{ asset('storage/images/mouton6.jpg') }}"
                            alt="Sunset in the mountains">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                    <a href="#!">
                        <div
                            class="absolute bottom-0 left-0 bg-black px-4 py-2 text-white text-sm hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
    
                    <a href="!#">
                        <div
                            class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4">
    
                    <a href="#"
                        class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best
                        View in Newyork City</a>
                    <p class="text-gray-500 text-sm">
                        The city that never sleeps
                    </p>
                </div>
                <div class="px-6 py-4 flex flex-row items-center">
                    <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                        <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
                c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
                c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="ml-1">6 mins ago</span></span>
                </div>
            </div>
            <div class="rounded overflow-hidden shadow-lg">
                <a href="#"></a>
                <div class="relative">
                    <a href="#">
                        <img class="w-full"
                            src="{{ asset('storage/images/vach1.jpg') }}"
                            alt="Sunset in the mountains">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                    <a href="#!">
                        <div
                            class="absolute bottom-0 left-0 bg-black px-4 py-2 text-white text-sm hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
    
                    <a href="!#">
                        <div
                            class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            <span class="font-bold">20</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4">
    
                    <a href="#"
                        class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best
                        Pizza in Town</a>
                    <p class="text-gray-500 text-sm">
                        The collection of best pizza images in Newyork city
                    </p>
                </div>
                <div class="px-6 py-4 flex flex-row items-center">
                    <span href="#"
                        class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row justify-between items-center">
                        <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path
                                        d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span class="ml-1">3 mins read</span></span>
                </div>
            </div>
            <div class="rounded overflow-hidden shadow-lg">
    
                <a href="#"></a>
                <div class="relative">
                    <a href="#">
                        <img class="w-full"
                            src="{{ asset('storage/images/moutons.jpg') }}"
                            alt="Sunset in the mountains">
                        <div
                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                        </div>
                    </a>
                    <a href="#!">
                        <div
                            class="absolute bottom-0 left-0 bg-black px-4 py-2 text-white text-sm hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
    
                    <a href="!#">
                        <div
                            class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            <span class="font-bold">15</span>
                            <small>April</small>
                        </div>
                    </a>
                </div>
                <div class="px-6 py-4">
    
                    <a href="#"
                        class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best
                        Salad Images ever</a>
                    <p class="text-gray-500 text-sm">
                        The collection of best salads of town in pictures
                    </p>
                </div>
                <div class="px-6 py-4 flex flex-row items-center">
                    <span href="#"
                        class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row justify-between items-center">
                        <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path
                                        d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span class="ml-1">6 mins read</span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:max-w-none">
            <div class="text-center">
              <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Empowering Businesses Globally</h2>
              <p class="mt-4 text-lg leading-8 text-gray-600">
                Our platform is trusted by organizations worldwide to boost productivity, streamline operations, and enhance
                customer experiences.
              </p>
            </div>
            <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Active Users</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">12,345</dd>
              </div>
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Transactions Today</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">1.23M</dd>
              </div>
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Total Revenue</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">$5.6B</dd>
              </div>
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Happy Customers</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">98%</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
  </div>
</template>

<script>

</script>