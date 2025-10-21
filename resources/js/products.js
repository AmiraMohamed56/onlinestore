window.filterAndSortProducts = function () {
    const searchQuery = document.getElementById('search-input').value.toLowerCase();
    const selectedCategory = document.getElementById('category-filter').value;
    const sortValue = document.getElementById('price-sort').value;

    const grid = document.getElementById('students-grid');
    const cards = Array.from(grid.children);

    // Filter by name and category
    const filteredCards = cards.filter(card => {
        const name = card.dataset.name;
        const category = card.dataset.category;
        const matchesName = name.includes(searchQuery);
        const matchesCategory = selectedCategory === 'all' || category === selectedCategory;
        return matchesName && matchesCategory;
    });

    // Sort filtered cards by price
    filteredCards.sort((a, b) => {
        const priceA = parseFloat(a.dataset.price);
        const priceB = parseFloat(b.dataset.price);
        if (sortValue === 'low') return priceA - priceB;
        if (sortValue === 'high') return priceB - priceA;
        return 0;
    });

    // Clear and re-render grid
    grid.innerHTML = '';
    filteredCards.forEach(card => grid.appendChild(card));
};
