<template>
    <div>
        <html lang="en">
        <Head/>
        <body class="font-poppins relative">
        <Header/>
        <div id="container" class="p-10 w-auto flex px-24 justify-center relative">
            
            <div id="container" class="p-20 sm:p-16 md:p-20 lg:p-24 xl:p-20 w-auto flex flex-col md:flex-row px-4 sm:px-8 md:px-24 lg:px-24 xl:px-24 relative">
                    <div class="mr-10">
                        <img
                        class="rounded-lg min-w-[100px] w-full h-auto md:w-auto md:h-auto"
                        src="https://ucarecdn.com/833d0fe1-c3b5-4843-b62c-fed9467aceeb/imageOfMyself.jpeg"
                        alt="image of myself"
                        />
                    </div>
            <div class="w-full sm:w-[70%] md:w-[60%] lg:w-[50%]">
                <h1 class="text-white font-bold text-3xl mt-6 mb-8">
                    Hey it's me, Aydin Vesali Moghaddam
                </h1>
    
                <p class=" w-full sm:w-[35rem] md:w-[30rem] lg:w-[25rem] mb-10">
                    I'm Aydin, a 18-year-old high schooler with a passion for web
                    development. My tech journey started with HTML, CSS, and JavaScript,
                    and I was hooked by the thrill of crafting dynamic, interactive
                    websites. As I grew, Node.js and ReactJS became my go-to tools for
                    building scalable applications. Feel free
                    to connect if you have questions, collaboration ideas, or just want to
                    discuss the latest in web development!
                </p>
    
                <div id="social" class="flex flex-wrap justify-start items-center gap-4">
                    <a rel="noopener" target="_blank" href="https://github.com/iam-aydin" class="bg-gray-800 rounded-lg p-5 w-64 flex items-center gap-2 text-white">
                        <img class="mr-2 hover:scale-105 transition duration-300 ease-in-out" src="https://ucarecdn.com/1f465c47-4849-4935-91f4-29135d8607af/github2.svg" width="20px" height="20px" alt="Github" />
                        <span>Visit my Github</span>
                    </a>
                    <a rel="noopener" target="_blank" href="https://www.linkedin.com/in/aydin-vesali-moghaddam-82a860275/" class="bg-gray-800 rounded-lg p-5 w-64 flex items-center gap-2 text-white">
                        <img class="mr-2 hover:scale-105 transition duration-300 ease-in-out" src="https://ucarecdn.com/95eebb9c-85cf-4d12-942f-3c40d7044dc6/linkedin.svg" width="20px" height="20px" alt="LinkedIn" />
                        <span>Follow me on Linkedin</span>
                    </a>
                </div>
            </div>
        </div>
        </div>
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
        <Footer class="mt-20" />
        </body>
        </html>
    </div>
    </template>
    
    <script setup>
    import Head from "../layouts/head.vue"
    import Header from "../layouts/header.vue"
    import Footer from "../layouts/footer.vue"
    
    </script>
    