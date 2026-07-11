document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('kpsLaporanSearch');
    const filterSelect = document.getElementById('kpsLaporanFilter');
    const countEl = document.getElementById('kpsLaporanCount');
    const emptyEl = document.getElementById('kpsLaporanEmpty');
    const table = document.getElementById('kpsLaporanTable');

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
        table.hidden = visible === 0;
    }

    searchInput?.addEventListener('input', applyFilter);
    filterSelect?.addEventListener('change', applyFilter);
});
