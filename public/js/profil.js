document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editModal');
    const passwordModal = document.getElementById('passwordModal');
    const openEdit = document.getElementById('openModal');
    const openPassword = document.getElementById('openPasswordModal');

    function openModal(modal) {
        if (!modal) return;
        modal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    function closeAll() {
        closeModal(editModal);
        closeModal(passwordModal);
    }

    if (openEdit) {
        openEdit.addEventListener('click', function () {
            closeModal(passwordModal);
            openModal(editModal);
        });
    }

    if (openPassword) {
        openPassword.addEventListener('click', function () {
            closeModal(editModal);
            openModal(passwordModal);
        });
    }

    document.querySelectorAll('[data-close]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id = btn.getAttribute('data-close');
            closeModal(document.getElementById(id));
        });
    });

    [editModal, passwordModal].forEach(function (modal) {
        if (!modal) return;

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeModal(modal);
            }
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeAll();
        }
    });
});
