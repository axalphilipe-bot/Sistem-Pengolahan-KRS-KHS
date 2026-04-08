
document.querySelectorAll(".faq-question").forEach(btn => {
    btn.addEventListener("click", function() {

        const answer = this.nextElementSibling;

        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
        }

    });
});
