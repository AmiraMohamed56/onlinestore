<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="border-b bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight">Perfume website</h1>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
      @yield('main')
    </main>
    <div style='background:red;'> 
        @yield('content')
    </div>

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

