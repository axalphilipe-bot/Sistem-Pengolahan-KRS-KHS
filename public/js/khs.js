document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('khsModal');
    const btn = document.getElementById('openModal');
    const closeBtn = document.querySelector('.khs-modal-close');
    const closeFooterBtn = document.querySelector('.btn-modal-close');

    if (!modal || !btn) return;

    function openModal() {
        modal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    btn.addEventListener('click', openModal);

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (closeFooterBtn) {
        closeFooterBtn.addEventListener('click', closeModal);
    }

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
});
