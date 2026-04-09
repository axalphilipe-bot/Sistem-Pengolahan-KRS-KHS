const modal = document.getElementById("editModal");
const btn = document.getElementById("openModal");
const close = document.querySelector(".close");

// buka modal
btn.onclick = function() {
    modal.style.display = "block";
}

// tutup modal
close.onclick = function() {
    modal.style.display = "none";
}

// klik luar modal
window.onclick = function(e) {
    if (e.target == modal) {
        modal.style.display = "none";
    }
}