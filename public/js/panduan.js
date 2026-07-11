document.addEventListener('DOMContentLoaded', function () {
    const faqItems = document.querySelectorAll('.mhs-panduan .faq-item');

    faqItems.forEach(function (item) {
        const btn = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        if (!btn || !answer) return;

        btn.addEventListener('click', function () {
            const isOpen = item.classList.contains('open');

            faqItems.forEach(function (other) {
                other.classList.remove('open');
                const otherAnswer = other.querySelector('.faq-answer');
                if (otherAnswer) {
                    otherAnswer.style.maxHeight = null;
                }
            });

            if (!isOpen) {
                item.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });

    document.querySelectorAll('.mhs-panduan a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
