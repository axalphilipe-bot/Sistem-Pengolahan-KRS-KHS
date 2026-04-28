
    const role = document.getElementById('role');
    const input = document.getElementById('loginInput');

    role.addEventListener('change', function () {
        if (this.value === 'mahasiswa') {
            input.placeholder = 'Masukkan NIM';
        } else if (this.value === 'dosen') {
            input.placeholder = 'Masukkan NIDN';
        } else if (this.value === 'admin') {
            input.placeholder = 'Masukkan Email / Username';
        } else {
            input.placeholder = 'Masukkan Data';
        }
    });
