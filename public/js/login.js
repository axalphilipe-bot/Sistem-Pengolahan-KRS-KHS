document.addEventListener('DOMContentLoaded', function () {

    const roleInputs = document.querySelectorAll('input[name="role"]');
    const loginInput = document.getElementById('loginInput');
    const passwordInput = document.getElementById('passwordInput');
    const toggleBtn = document.querySelector('.toggle-password');

    const placeholders = {
        mahasiswa: 'Masukkan NIM',
        dosen: 'Masukkan NUPTK',
        admin: 'Masukkan Email / Username',
        kps: 'Masukkan Email / Username',
    };

    function updatePlaceholder() {
        const selected = document.querySelector('input[name="role"]:checked');
        if (selected && loginInput) {
            loginInput.placeholder = placeholders[selected.value] || 'Masukkan kredensial';
        }
    }

    roleInputs.forEach(function (input) {
        input.addEventListener('change', updatePlaceholder);
    });

    updatePlaceholder();

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            const icon = toggleBtn.querySelector('i');
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        });
    }
});
