import './bootstrap';

const filterForm = document.querySelector('[data-auto-filter]');

if (filterForm instanceof HTMLFormElement) {
    const filterField = filterForm.querySelector('[data-filter-field]');
    const filterQuery = filterForm.querySelector('[data-filter-query]');
    let filterTimeout;

    filterField?.addEventListener('change', () => filterForm.requestSubmit());

    filterQuery?.addEventListener('input', () => {
        window.clearTimeout(filterTimeout);
        filterTimeout = window.setTimeout(() => filterForm.requestSubmit(), 300);
    });
}
