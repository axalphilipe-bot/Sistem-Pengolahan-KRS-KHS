document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('.matkul:not(:disabled)');
    const totalDisplay = document.getElementById('total-sks');
    const barFill = document.getElementById('sks-bar-fill');
    const maxSks = 24;

    function updateSKS() {
        let total = 0;

        checkboxes.forEach(function (cb) {
            if (cb.checked) {
                total += parseInt(cb.dataset.sks, 10) || 0;
            }
        });

        if (totalDisplay) {
            totalDisplay.textContent = total;
        }

        if (barFill) {
            var pct = Math.min((total / maxSks) * 100, 100);
            barFill.style.width = pct + '%';
            barFill.classList.toggle('over-limit', total > maxSks);
        }
    }

    checkboxes.forEach(function (cb) {
        cb.addEventListener('change', updateSKS);
    });

    updateSKS();
});
