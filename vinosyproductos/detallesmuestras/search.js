const applyFiltersButton = document.getElementById('apply-filters');
    const searchInput = document.getElementById('search');
    const searchDate = document.getElementById('datepicker');
    const filterSelect = document.getElementById('filter');

    searchInput.addEventListener('input', handleSearchInput);
    filterSelect.addEventListener('change', antes);
    applyFiltersButton.addEventListener('click', handleApplyFilters);

    // Agrega un evento onChange al elemento del datepicker
    searchDate.addEventListener('change', (event) => {
      const selectedDate = event.target.value;
    
      // Filtra las tarjetas por la fecha seleccionada
      const cards = document.querySelectorAll('.card-grape-sample, .card-must-sample, .card-wine-sample');
      cards.forEach(card => {
        if (card.dataset.date === selectedDate) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });

    function handleApplyFilters() {
    handleSearchInput();
    handleFilterSelect();
    }

    function handleSearchInput() {
        const searchValue = searchInput.value.toLowerCase();
            const selectedFilter = filterSelect.value;

            // Seleccionar todas las tarjetas
            const cards = document.querySelectorAll('.card-grape-sample, .card-must-sample, .card-wine-sample');

            cards.forEach((card) => {
                // Filtrar por palabra clave
                const cardText = card.innerText.toLowerCase();
                if (cardText.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
    }

    function handleFilterSelect() {
        const filterValue = filterSelect.value;
        const grapeSampleCards = document.querySelectorAll('.card-sample');
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        const lastWeek = new Date(today);
        lastWeek.setDate(lastWeek.getDate() - 7);
        const lastMonth = new Date(today);
        lastMonth.setMonth(lastMonth.getMonth() - 1);

        grapeSampleCards.forEach(card => {
            const cardDate = new Date(card.querySelector('.card-sample-header p').textContent);

            if (filterValue === 'all' ||
                (filterValue === 'today' && cardDate.getDate() === today.getDate() && cardDate.getMonth() === today.getMonth() && cardDate.getFullYear() === today.getFullYear()) ||
                (filterValue === 'yesterday' && cardDate.getDate() === yesterday.getDate() && cardDate.getMonth() === yesterday.getMonth() && cardDate.getFullYear() === yesterday.getFullYear()) ||
                (filterValue === 'last-week' && cardDate >= lastWeek) ||
                (filterValue === 'last-month' && cardDate >= lastMonth)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function antes()
    {
        const searchValue = searchInput.value.toLowerCase();
            const selectedFilter = filterSelect.value;

            // Seleccionar todas las tarjetas
            const cards = document.querySelectorAll('.card-grape-sample, .card-must-sample, .card-wine-sample');

            cards.forEach((card) => {
                // Filtrar por palabra clave
                const cardText = card.innerText.toLowerCase();
                if (cardText.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }

                // Filtrar por fecha
                const cardDate = new Date(card.dataset.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const yesterday = new Date(today);
                yesterday.setDate(yesterday.getDate() - 1);
                const lastWeek = new Date(today);
                lastWeek.setDate(lastWeek.getDate() - 7);
                const lastMonth = new Date(today);
                lastMonth.setMonth(lastMonth.getMonth() - 1);
                //alert(cardDate.getTime());
                if (selectedFilter === 'today' && cardDate.getTime() !== today.getTime()) {
                    card.style.display = 'none';
                } else if (selectedFilter === 'yesterday' && cardDate.getTime() !== yesterday.getTime()) {
                card.style.display = 'none';
                } else if (selectedFilter === 'last-week' && cardDate.getTime() < lastWeek.getTime()) {
                    card.style.display = 'none';
                } else if (selectedFilter === 'last-month' && cardDate.getTime() < lastMonth.getTime()) {
                    card.style.display = 'none';
                } else if (selectedFilter === 'all') {
                    card.style.display = '';
                }
            });
    }
    const filter = document.getElementById('filter');
    const filterWrapper = document.getElementById('filter-wrapper');
    
    filter.addEventListener('change', (event) => {
      filterWrapper.setAttribute('data-value', event.target.value);
    });
    
    filterWrapper.addEventListener('click', () => {
      filter.focus();
    });