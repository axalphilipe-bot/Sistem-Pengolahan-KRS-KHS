document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('kpsApproveSearch');

    const filterSelect = document.getElementById('kpsApproveFilter');

    const countEl = document.getElementById('kpsApproveCount');

    const emptyEl = document.getElementById('kpsApproveEmpty');

    const table = document.getElementById('kpsApproveTable');

    const modal = document.getElementById('kpsApproveModal');

    const modalTitle = document.getElementById('kpsApproveModalTitle');

    const modalSubtitle = document.getElementById('kpsApproveModalSubtitle');

    const modalBody = document.getElementById('kpsApproveModalBody');



    if (table) {

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

    }



    function closeModal() {

        if (!modal) return;

        modal.hidden = true;

        document.body.style.overflow = '';

    }



    function openModal(button) {

        if (!modal || !modalBody || !modalTitle || !modalSubtitle) return;



        const nim = button.dataset.nim || '-';

        const nama = button.dataset.nama || '-';

        let items = [];



        try {

            items = JSON.parse(button.dataset.detail || '[]');

        } catch (error) {

            items = [];

        }



        modalTitle.textContent = nama;

        modalSubtitle.textContent = 'NIM ' + nim + ' · ' + items.length + ' mata kuliah';

        modalBody.innerHTML = '';



        if (items.length === 0) {

            modalBody.innerHTML = '<tr><td colspan="4" class="kps-action-muted">Belum ada detail nilai.</td></tr>';

        } else {

            items.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML =
                    '<td><strong>' + item.nama_mk + '</strong><br><small class="kps-td-muted">' + item.kode_mk + '</small></td>' +

                    '<td><span class="kps-grade-badge grade-' + String(item.nilai_huruf || 'x').toLowerCase() + '">' + item.nilai_huruf + '</span> ' +

                    '<small class="kps-score-muted">' + item.nilai_akhir + '</small></td>' +

                    '<td><span class="kps-index-badge">' + item.index_nilai + '</span></td>' +

                    '<td>' + item.status + '</td>';

                modalBody.appendChild(row);

            });

        }



        modal.hidden = false;

        document.body.style.overflow = 'hidden';

    }



    document.querySelectorAll('.kps-approve-detail-btn').forEach(button => {

        button.addEventListener('click', () => openModal(button));

    });



    modal?.querySelectorAll('[data-close-modal]').forEach(el => {

        el.addEventListener('click', closeModal);

    });



    document.addEventListener('keydown', event => {

        if (event.key === 'Escape') closeModal();

    });

});

