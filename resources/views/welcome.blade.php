<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header & Hero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<header class="sticky top-0 z-50 bg-white shadow transition-shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="https://via.placeholder.com/100x40?text=Logo" alt="Logo" class="h-10 w-auto">
        </div>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="/" class="text-lg text-gray-700 hover:text-blue-600">Home</a>
            <a href="/trips" class="text-lg text-gray-700 hover:text-blue-600">Trips</a>
            <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Log in</a>
        </nav>

        <!-- Hamburger for mobile -->
        <div class="md:hidden">
            <button id="menu-btn" class="focus:outline-none">
                <svg class="w-8 h-8 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Nav Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
        <div class="px-4 py-4 space-y-3">
            <a href="/" class="block text-lg text-gray-700 hover:text-blue-600">Home</a>
            <a href="/trips" class="block text-lg text-gray-700 hover:text-blue-600">Trips</a>
            <a href="/login" class="block text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Log in</a>
        </div>
    </div>
</header>

<main>
    <!-- Hero Section -->
    <section 
        class="relative bg-cover bg-center h-screen" 
        style="background-image: url('https://source.unsplash.com/1600x900/?travel,nature'); background-attachment: fixed;">
        
        <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Overlay -->

        <div class="h-full flex flex-col justify-center items-center relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">Discover Your Next Adventure</h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-8">Explore destinations, plan trips, and create unforgettable memories.</p>
            <a href="#explore" class="px-8 py-3 bg-blue-600 text-white text-lg rounded-md hover:bg-blue-700 transition">
                Get Started
            </a>
        </div>
    </section>

    <!-- Explore Section -->
    <section id="explore" class="max-w-7xl mx-auto px-4 mt-16">
        <h2 class="text-3xl font-bold mb-4">Explore More</h2>
        <p>More content goes here...</p>
    </section>
</main>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Optional: Add dynamic shadow on scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 10) {
            header.classList.add('shadow-md');
        } else {
            header.classList.remove('shadow-md');
        }
    });
</script>

</body>
</html>
