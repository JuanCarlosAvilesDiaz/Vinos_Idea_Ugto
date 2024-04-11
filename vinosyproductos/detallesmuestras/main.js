const searchInput = document.querySelector('#search');
const filterSelect = document.querySelector('#filter');
const applyFiltersButton = document.querySelector('#apply-filters');

searchInput.addEventListener('input', handleSearchInput);
filterSelect.addEventListener('change', handleFilterSelect);
applyFiltersButton.addEventListener('click', handleApplyFilters);

function handleSearchInput() {
const searchValue = searchInput.value.trim().toLowerCase();
const grapeSampleCards = document.querySelectorAll('.card-sample');

grapeSampleCards.forEach(card => {
    const sampleName = card.querySelector('h3').textContent.trim().toLowerCase();
    const sampleDescription = card.querySelector('.card-sample-body p:first-of-type').textContent.trim().toLowerCase();
    const sampleLocation = card.querySelector('.card-sample-body p:last-of-type').textContent.trim().toLowerCase();

    if (sampleName.includes(searchValue) || sampleDescription.includes(searchValue) || sampleLocation.includes(searchValue)) {
        card.style.display = 'block';
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

function handleApplyFilters() {
handleSearchInput();
handleFilterSelect();
}


