document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('.matkul');
    const totalDisplay = document.getElementById('total-sks');

    function updateSKS() {
        let total = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseInt(cb.dataset.sks);
            }
        });

        totalDisplay.innerText = total;
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateSKS);
    });
});