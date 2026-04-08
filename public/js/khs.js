
const modal = document.getElementById("khsModal");
const btn = document.getElementById("openModal");
const close = document.querySelector(".close");

btn.onclick = function() {
    modal.style.display = "block";
}

close.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(e) {
    if (e.target == modal) {
        modal.style.display = "none";
    }
}
