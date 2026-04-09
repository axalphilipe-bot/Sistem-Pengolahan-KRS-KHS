document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const target = +counter.dataset.target;
        let current = 0;

        const update = () => {
            const increment = target / 300;

            if (current < target) {
                current += increment;
                counter.innerText = Math.ceil(current).toLocaleString();
                requestAnimationFrame(update);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };

        update();
    });
});