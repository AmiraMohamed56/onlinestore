<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-700 via-pink-600 to-red-500 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold tracking-tight text-white">
                🌸 Perfume Store
            </h1>
            <!-- <nav class="flex space-x-6 text-gray-100 text-lg">
                <a href="/" class="hover:text-yellow-300 transition">Home</a>
                <a href="/products" class="hover:text-yellow-300 transition">Products</a>
                <a href="/about" class="hover:text-yellow-300 transition">About</a>
                <a href="/contact" class="hover:text-yellow-300 transition">Contact</a>
            </nav> -->
        </div>
    </header>

    <!-- Main content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-gray-800/60 backdrop-blur-lg rounded-2xl shadow-xl p-8">
            @yield('main')
        </div>
    </main>

    <!-- Extra content section -->
    <div class="bg-gradient-to-r from-purple-800 to-pink-700 py-10 px-6 mt-10 text-center shadow-inner">
        @yield('content')
    </div>

    <!-- Search Filter Script -->
    <script>
        function filterCards(query) {
            const q = (query || '').toLowerCase().trim();
            const grid = document.getElementById('students-grid');
            const cards = grid.querySelectorAll('[data-name]');
            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                card.style.display = name.includes(q) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
