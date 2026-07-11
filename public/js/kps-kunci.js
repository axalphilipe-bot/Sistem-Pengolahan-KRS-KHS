document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('kpsKunciSearch');
    const filterSelect = document.getElementById('kpsKunciFilter');
    const countEl = document.getElementById('kpsKunciCount');
    const emptyEl = document.getElementById('kpsKunciEmpty');
    const table = document.getElementById('kpsKunciTable');

    if (!table) return;

    const rows = Array.from(table.querySelectorAll('tbody tr'));

    function applyFilter() {
        const query = (searchInput?.value || '').trim().toLowerCase();
        const status = filterSelect?.value || '';
        let visible = 0;

        rows.forEach(row => {
            const matchSearch = !query || (row.dataset.search || '').includes(query);
            const matchStatus = !status || row.dataset.status === status;
            const show = matchSearch && matchStatus;

            row.hidden = !show;
            if (show) visible++;
        });

        if (countEl) countEl.textContent = visible;
        if (emptyEl) emptyEl.hidden = visible > 0;
        if (table) table.hidden = visible === 0;
    }

    searchInput?.addEventListener('input', applyFilter);
    filterSelect?.addEventListener('change', applyFilter);
});
